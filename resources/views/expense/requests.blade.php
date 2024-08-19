@extends('layouts.expense-index')


@section('title', 'My Request')

@section('body')
    <div class="container p-3" style="position: relative;">
        <form id="filterForm" class="row align-items-center mb-2">

            <div class="col-6 col-md-2 form-group d-flex gap-2 align-items-center">
                <label class="form-label mb-0" for="status">Filter</label>
                <select name="status" class="form-control inputs" id="status">
                    <option value="ALL">All</option>
                    <option value="PENDING">Pending</option>
                    <option value="TO_RETURN">To Return</option>
                    <option value="HOLD">Hold</option>
                    <option value="TO_PROCESS">To Process</option>
                    <option value="PROCESSING">Processing</option>
                    <option value="FOR_FUNDING">For Funding</option>
                    <option value="RELEASED">Released</option>
                </select>
            </div>

            <div class="col-6 col-md-2 form-group d-flex gap-2 align-items-center">
                <label class="form-label">Entries</label>
                <select name="entries" class="form-control inputs">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">30</option>
                    <option value="25">50</option>
                    <option value="25">100</option>
                </select>
            </div>

            <div class="mt-2 mt-md-0 col-10 col-md-7 form-group d-flex gap-2 align-items-center">
                <i class="fas fa-search"></i>
                <input autocomplete="off" name="search" type="search" class="form-control inputs"
                       placeholder="Search...">
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="mt-2 mt-md-0 col-2 col-md-1 btn" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Advance filter">
                <i class="fas fa-filter"></i>
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Advance Filter</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row mb-2">
                                <div class="col-6">
                                    <label>From</label>
                                    <input class="form-control" type="date">
                                </div>
                                <div class="col-6">
                                    <label>To</label>
                                    <input class="form-control" type="date">
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-6">
                                    <p class="mb-0">Payment Status</p>
                                    <small class="text-secondary mb-1">Check the box to filter.</small>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Default checkbox
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                               checked>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Checked checkbox
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <p class="mb-0">Entity</p>
                                    <small class="text-secondary mb-1">Check the box to filter.</small>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Default checkbox
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                               checked>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Checked checkbox
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row mb-3">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 text-start">
                                <i class="fas fa-table me-1"></i>
                                <b>My Request</b>
                            </div>
                        </div>
                    </div>
                    <div class="card-body overflow-x-auto">
                        <table class="table sortable">
                            <thead>
                            <tr>
                                <th>REFERENCE</th>
                                <th>DURATION</th>
                                <th>ENTITY</th>
                                <th>REQUESTED BY</th>
                                <th>STATUS</th>
                                <th>TOTAL</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody id="requestData">
                            <!-- Dynamic Data -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>

        const requestData = document.querySelector('#requestData');
        const filterForm = document.querySelector('#filterForm');
        const inputs = document.querySelectorAll('.inputs');

        filterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            getData();
        })


        inputs.forEach(input => {
            input.addEventListener('change', () => {
                getData();
            })
        });

        window.addEventListener('load', () => {
            getData()
        })

        function getData() {
            let formData = new FormData(filterForm);
            const params = new URLSearchParams(formData);

            fetch(`/expense/api/my-requests?${params.toString()}`, {
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            })
                .then(data => data.text())
                .then(data => {
                    requestData.innerHTML = data;
                }).catch(err => {
                console.log('Something went wrong')
            })
        }


    </script>

    <script type="text/javascript" src="/js/sortable.js"></script>
@endsection
