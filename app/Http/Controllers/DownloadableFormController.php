<?php

namespace App\Http\Controllers;

use App\Enums\RequestApprovalStatus;
use App\Enums\RequestItemStatus;
use App\Enums\RequestStatus;
use App\Enums\UserRole;
use App\Models\Expense\RequestItem;
use Illuminate\Http\Request;
use App\Models\Expense\Request as ExpenseRequest;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DownloadableFormController
{
    public function index(Request $request)
    {

        $requests = ExpenseRequest::with('company')
            ->when($request->input('search'), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->whereLike('reference', '%' . $request->input('search') . '%');
                    $query->orWhereLike('paid_to', '%' . $request->input('search') . '%');
                    $query->orWhereLike('request_by', '%' . $request->input('search') . '%');
                });
            })
            ->when($request->input('company') && $request->input('company') != 'ALL', function ($qb) use ($request) {
                $qb->where('company_id', $request->input('company'));
            })
            ->when($request->input('status') && $request->input('status') != 'ALL', function ($qb) use ($request) {
                $qb->where('status', RequestStatus::valueOf($request->input('status'))->value);
            })
            ->when($request->input('fund_status') && $request->input('fund_status') != 'ALL', function ($qb) use ($request) {

                $approvedRoles = [
                    UserRole::BOOK_KEEPER->value,
                    UserRole::ACCOUNTANT->value,
                    UserRole::FINANCE->value,
                    UserRole::AUDITOR->value,
                ];

                $qb->whereHas('approvals', function ($query) use ($approvedRoles, $request) {

                    $query->whereHas('role', function ($roleQuery) use ($approvedRoles) {
                        $roleQuery->whereIn('name', $approvedRoles)
                            ->where('status', RequestApprovalStatus::APPROVED);
                    });


                    if ($request->input('fund_status') == 'OPEN') {
                        $query->having(DB::raw('COUNT(*)'), '<=', 3);
                    } else {
                        $query->having(DB::raw('COUNT(*)'), '=', 4);
                    }
                });
            })
            ->withSum(['items' => function ($query) {
                $query->select(DB::raw('SUM(quantity * cost)'))
                    ->groupBy('request_id');
            }], 'sub_total')
            ->withSum(['items' => function ($query) {
                $query->select(DB::raw('SUM(quantity * cost)'))
                    ->whereIn('status', [RequestItemStatus::APPROVED->name, RequestItemStatus::PRIORITY->name])
                    ->groupBy('request_id');
            }], 'approve_total')
            ->withCount(['approvals' => function ($query) {
                $query->whereHas('role', function ($qb) {

                    $approvedRoles = [
                        UserRole::BOOK_KEEPER->value,
                        UserRole::ACCOUNTANT->value,
                        UserRole::FINANCE->value,
                        UserRole::AUDITOR->value,
                    ];

                    $qb->whereIn('name', $approvedRoles)
                        ->where('status', RequestApprovalStatus::APPROVED);
                });
            }])
            ->with([
                'bookKeeper' => function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', RequestApprovalStatus::APPROVED->name);
                        $query->whereHas('role', function ($query) {
                            $query->where('name', UserRole::BOOK_KEEPER->value);
                        });
                    });
                },
                'accountant' => function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', RequestApprovalStatus::APPROVED->name);
                        $query->whereHas('role', function ($query) {
                            $query->where('name', UserRole::ACCOUNTANT->value);
                        });
                    });
                },
                'finance' => function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', RequestApprovalStatus::APPROVED->name);
                        $query->whereHas('role', function ($query) {
                            $query->where('name', UserRole::FINANCE->value);
                        });
                    });
                },
                'auditor' => function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', RequestApprovalStatus::APPROVED->name);
                        $query->whereHas('role', function ($query) {
                            $query->where('name', UserRole::AUDITOR->value);
                        });
                    });
                }
            ]);

        return view('expense.downloadable-forms', [
            'requests' => $requests->paginate(20)->appends(request()->except('page')),
            'total' => $this->totalSum($request),
            'approved' => $this->approved($request),
        ]);
    }

    private function totalSum(Request $request): float
    {
        $query = RequestItem::query();

        $query->select([DB::raw('SUM(quantity * cost) as total_sum')]);

        $query->when($request->input('company') && $request->input('company') != 'ALL',
            function ($query) use ($request) {
                $query->whereHas('request', function ($query) use ($request) {
                    $query->whereHas('company', function ($query) use ($request) {
                        $query->where('company_id', $request->input('company'));
                    });
                });
            }
        );

        $query->when($request->input('search'), function ($query) use ($request) {
            $query->whereHas('request', function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->whereLike('reference', '%' . $request->input('search') . '%');
                    $query->orWhereLike('paid_to', '%' . $request->input('search') . '%');
                    $query->orWhereLike('request_by', '%' . $request->input('search') . '%');
                });
            });
        });

        $query->when($request->input('status') && $request->input('status') != 'ALL',
            function ($query) use ($request) {
                $query->whereHas('request', function ($query) use ($request) {
                    $query->where('status', RequestStatus::valueOf($request->input('status'))->value);
                });
            }
        );

        $query->when($request->input('fund_status') && $request->input('fund_status') != 'ALL',
            function ($query) use ($request) {
                $query->whereHas('request', function ($query) use ($request) {

                    $query->whereHas('approvals', function ($query) use ($request) {

                        if ($request->input('fund_status') == 'OPEN') {
                            $query->having(DB::raw('COUNT(*)'), '<=', 3);
                        } else {
                            $query->having(DB::raw('COUNT(*)'), '=', 4);
                        }

                        $query->where('status', RequestApprovalStatus::APPROVED);
                    });
                });
            }
        );

        return $query->value('total_sum') ?? 0;
    }

    private function approved(Request $request): float
    {
        $query = RequestItem::query();

        $query->select([DB::raw('SUM(quantity * cost) as total_sum')]);

        $query->whereIn('status', [
            RequestItemStatus::APPROVED->name,
            RequestItemStatus::PRIORITY->name,
        ]);

        $query->when($request->input('company') && $request->input('company') != 'ALL',
            function ($query) use ($request) {
                $query->whereHas('request', function ($query) use ($request) {
                    $query->whereHas('company', function ($query) use ($request) {
                        $query->where('company_id', $request->input('company'));
                    });
                });
            }
        );

        $query->when($request->input('search'), function ($query) use ($request) {
            $query->whereHas('request', function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->whereLike('reference', '%' . $request->input('search') . '%');
                    $query->orWhereLike('paid_to', '%' . $request->input('search') . '%');
                    $query->orWhereLike('request_by', '%' . $request->input('search') . '%');
                });
            });
        });

        $query->when($request->input('status') && $request->input('status') != 'ALL',
            function ($query) use ($request) {
                $query->whereHas('request', function ($query) use ($request) {
                    $query->where('status', RequestStatus::valueOf($request->input('status'))->value);
                });
            }
        );

        $query->when($request->input('fund_status') && $request->input('fund_status') != 'ALL',
            function ($query) use ($request) {
                $query->whereHas('request', function ($query) use ($request) {

                    $query->whereHas('approvals', function ($query) use ($request) {

                        if ($request->input('fund_status') == 'OPEN') {
                            $query->having(DB::raw('COUNT(*)'), '<=', 3);
                        } else {
                            $query->having(DB::raw('COUNT(*)'), '=', 4);
                        }

                        $query->where('status', RequestApprovalStatus::APPROVED);
                    });
                });
            }
        );

        return $query->value('total_sum') ?? 0;
    }

    public function generateExcel(Request $request)
    {

          $requests = ExpenseRequest::with('company')
            ->when($request->input('search'), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->whereLike('reference', '%' . $request->input('search') . '%');
                    $query->orWhereLike('paid_to', '%' . $request->input('search') . '%');
                    $query->orWhereLike('request_by', '%' . $request->input('search') . '%');
                });
            })
            ->when($request->input('company') && $request->input('company') != 'ALL', function ($qb) use ($request) {
                $qb->where('company_id', $request->input('company'));
            })
            ->when($request->input('status') && $request->input('status') != 'ALL', function ($qb) use ($request) {
                $qb->where('status', RequestStatus::valueOf($request->input('status'))->value);
            })
            ->when($request->input('fund_status') && $request->input('fund_status') != 'ALL', function ($qb) use ($request) {

                $approvedRoles = [
                    UserRole::BOOK_KEEPER->value,
                    UserRole::ACCOUNTANT->value,
                    UserRole::FINANCE->value,
                    UserRole::AUDITOR->value,
                ];

                $qb->whereHas('approvals', function ($query) use ($approvedRoles, $request) {

                    $query->whereHas('role', function ($roleQuery) use ($approvedRoles) {
                        $roleQuery->whereIn('name', $approvedRoles)
                            ->where('status', RequestApprovalStatus::APPROVED);
                    });


                    if ($request->input('fund_status') == 'OPEN') {
                        $query->having(DB::raw('COUNT(*)'), '<=', 3);
                    } else {
                        $query->having(DB::raw('COUNT(*)'), '=', 4);
                    }
                });
            })
            ->withSum(['items' => function ($query) {
                $query->select(DB::raw('SUM(quantity * cost)'))
                    ->groupBy('request_id');
            }], 'sub_total')
            ->withSum(['items' => function ($query) {
                $query->select(DB::raw('SUM(quantity * cost)'))
                    ->whereIn('status', [RequestItemStatus::APPROVED->name, RequestItemStatus::PRIORITY->name])
                    ->groupBy('request_id');
            }], 'approve_total')
            ->withCount(['approvals' => function ($query) {
                $query->whereHas('role', function ($qb) {

                    $approvedRoles = [
                        UserRole::BOOK_KEEPER->value,
                        UserRole::ACCOUNTANT->value,
                        UserRole::FINANCE->value,
                        UserRole::AUDITOR->value,
                    ];

                    $qb->whereIn('name', $approvedRoles)
                        ->where('status', RequestApprovalStatus::APPROVED);
                });
            }])
            ->with([
                'bookKeeper' => function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', RequestApprovalStatus::APPROVED->name);
                        $query->whereHas('role', function ($query) {
                            $query->where('name', UserRole::BOOK_KEEPER->value);
                        });
                    });
                },
                'accountant' => function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', RequestApprovalStatus::APPROVED->name);
                        $query->whereHas('role', function ($query) {
                            $query->where('name', UserRole::ACCOUNTANT->value);
                        });
                    });
                },
                'finance' => function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', RequestApprovalStatus::APPROVED->name);
                        $query->whereHas('role', function ($query) {
                            $query->where('name', UserRole::FINANCE->value);
                        });
                    });
                },
                'auditor' => function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', RequestApprovalStatus::APPROVED->name);
                        $query->whereHas('role', function ($query) {
                            $query->where('name', UserRole::AUDITOR->value);
                        });
                    });
                }
            ]);

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
        $spreadsheet = $reader->loadFromString(view('expense.excel.downloadable-forms-excel', [
            'requests' => $requests->get(),
            'total' => $this->totalSum($request),
            'approved' => $this->approved($request),
        ]));

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="file.xls"');
        $writer->save("php://output");

        die();
    }
}
