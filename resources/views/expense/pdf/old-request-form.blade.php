<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Request Form</title>

    <link rel="stylesheet" href="{{public_path('css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}">


</head>
<body>
<div class="container-fluid mx-auto bg-white">
    <div class="mx-auto px-4 py-2" id="printable">

        <div class="row m-0 py-4 px-2 bg-white w-100" id="printable">
            <div>
                <div style="display: flex; flex-direction: row;">

                    <div class="me-2">
                        <div class="border border-dark"
                             style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                            <img src="./src/logos/ELITE_ACES_LOGO.png" class="img-fluid" alt="LOGO">
                        </div>
                        <div class="bg-danger text-center text-white border border-dark"
                             style="width: 100px; border-style: none solid none solid !important;">
                            <b>ELITE ACES</b>
                        </div>
                    </div>

                    <div class="ms-auto" style="flex: auto;">
                        <small><select
                                class="px-5 h-100 border border-5 border-danger d-flex justify-content-center align-items-center text-danger text-center"
                                style="font-size: 5em;" name="status">

                                <option value="PENDING">PENDING</option>
                                <option value="TO RETURN">TO RETURN</option>
                                <option value="HOLD">HOLD</option>
                                <option value="TO PROCESS">TO PROCESS</option>
                                <option value="PROCESSING">PROCESSING</option>
                                <option value="FOR FUNDING">FOR FUNDING</option>
                                <option value="RELEASED">RELEASED</option>

                            </select></small>
                    </div>
                    <div class="ms-auto me-2">
                        <div class="bg-danger text-center text-white border border-dark px-2"
                             style="border-style: solid solid none solid !important;">
                            <b>PAYMENT STATUS</b>
                        </div>
                        <div class="border border-dark"
                             style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                            <div class="w-100" style="display: flex; flex-direction: row;">
                                <div class="w-25 text-center border border-dark"
                                     style="border-style: none solid solid none !important;">
                                    <input type="checkbox" name="FUNDED">
                                </div>
                                <div class="w-75 text-start border border-dark px-2"
                                     style="border-style: none none solid none !important;">
                                    <small>FUNDED</small>
                                </div>
                            </div>

                            <div class="w-100" style="display: flex; flex-direction: row;">
                                <div class="w-25 text-center border border-dark"
                                     style="border-style: none solid none none !important;">
                                    <input type="checkbox" name="DECLINED">
                                </div>
                                <div class="w-75 text-start border border-dark px-2"
                                     style="border-style: none none none none !important;">
                                    <small>DECLINED</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ms-auto me-2" style="width: 150px;">
                        <div class="bg-danger text-center text-white border border-dark px-2"
                             style="border-style: solid solid none solid !important;">
                            <b>STATUS</b>
                        </div>
                        <div class="border border-dark"
                             style="height: 100px; display: flex; align-items: center; justify-content: center;">

                            <h1 class="text-success">OPEN</h1>

                        </div>
                    </div>
                    <div class="ms-auto">
                        <div class="bg-danger text-center text-white border border-dark px-2"
                             style="border-style: solid solid none solid !important;">
                            <b>REQUEST FORM NUMBER</b>
                        </div>
                        <div class="border border-dark"
                             style="height: 100px; display: flex; align-items: center; justify-content: center;">
                            <h1><b>190</b></h1>
                        </div>
                    </div>

                </div>

                <br>

                <div class="row m-0">
                    <div class="col-8 border border-dark" style="border-style: solid solid none solid !important;">
                        <div class="row m-0">
                            <div class="col-3 border border-dark"
                                 style="border-style: none solid none none !important;">
                                <b>Date :</b>
                            </div>
                            <div class="col-9">
                                <small>2024-06-11 13:07</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 border border-dark" style="border-style: solid solid none none !important;">
                        <div class="row m-0">
                            <div class="col-4 border border-dark"
                                 style="border-style: none solid none none !important;">
                                <b>CV NO :</b>
                            </div>
                            <div class="col-8">
                                <small></small>
                            </div>
                        </div>
                    </div>

                    <div class="col-8 border border-dark" style="border-style: solid solid none solid !important;">
                        <div class="row m-0">
                            <div class="col-3 border border-dark"
                                 style="border-style: none solid none none !important;">
                                <b>Supplier :</b>
                            </div>
                            <div class="col-9">
                                <small>n/a</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 border border-dark" style="border-style: solid solid none none !important;">
                        <div class="row m-0">
                            <div class="col-4 border border-dark"
                                 style="border-style: none solid none none !important;">
                                <b>REF NO :</b>
                            </div>
                            <div class="col-8">
                                <small>20240611-190</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 border border-dark" style="border-style: solid solid none solid !important;">
                        <div class="row m-0">
                            <div class="col-3 border border-dark"
                                 style="border-style: none solid none none !important;">
                                <b>Paid to :</b>
                            </div>
                            <div class="col-9">

                                <small>AMORBELLE A. DIJAMCO</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 border border-dark" style="border-style: solid solid none solid !important;">
                        <div class="row m-0">
                            <div class="col-3 border border-dark"
                                 style="border-style: none solid none none !important;">
                                <b>Requested by :</b>
                            </div>
                            <div class="col-9">
                                <small>AMORBELLE A. DIJAMCO</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 border border-dark" style="border-style: solid solid none solid !important;">
                        <div class="row m-0">
                            <div class="col-3 border border-dark"
                                 style="border-style: none solid none none !important;">
                                <b>Prepared by :</b>
                            </div>
                            <div class="col-9">
                                <small>belledijamco</small>
                            </div>
                        </div>
                    </div>

                    <div class="bg-dark border border-dark m-0 p-0 text-center">
                        <small class="text-white">EXPENSE REQUEST</small>
                    </div>

                    <div class="row p-0 m-0">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-1 text-center m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                            <b>QTY</b>
                                        </div>
                                        <div class="col-2 text-center m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                            <b>UOM</b>
                                        </div>
                                        <div class="col-2 text-center m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                            <b>JOB ORDER</b>
                                        </div>
                                        <div class="col-3 text-center m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                            <b>DESCRIPTION</b>
                                        </div>
                                        <div class="col-2 text-center m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                            <b>UNIT COST</b>
                                        </div>
                                        <div class="col-2 text-center m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                            <b>TOTAL</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-6 text-center m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                            <b>STATUS</b>
                                        </div>
                                        <div class="col-6 text-center m-0 p-0 border border-dark px-2"
                                             style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                            <b>REMARKS</b>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row expense_item" onclick="get_requested_item(455);">
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-1 text-center m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                            <small style="text-wrap: nowrap;">1</small>
                                        </div>
                                        <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                            <small style="text-wrap: nowrap;">UNKNOWN</small>
                                        </div>
                                        <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                            <small style="text-wrap: nowrap;">PR23-101</small>
                                        </div>
                                        <div
                                            class="col-3 text-start m-0 p-0 border border-dark px-2 d-flex align-items-center"
                                            style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">

                                            <small style="text-wrap: nowrap;">LTO EXPENSES FOR TRANSFER OF OWNERSHIP OF
                                                ONE UNIT BLS AMBULANCE UNIT DELIVERED TO BUCOR</small>
                                        </div>
                                        <div class="col-2 text-end m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                            <small style="text-wrap: nowrap;">₱10,000.00</small>
                                        </div>
                                        <div class="col-2 text-end m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                            <small style="text-wrap: nowrap;">₱10,000.00</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-6 text-start m-0 p-0 border border-dark px-2"
                                             style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                            <small style="text-wrap: nowrap;">Priority</small>
                                        </div>
                                        <div class="col-6 text-start m-0 p-0 border border-dark px-2"
                                             style="border-style: none solid solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                            <small style="text-wrap: nowrap;"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-9">
                                    <div class="row">
                                        <div class="text-end col-8 border border-dark"
                                             style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2);">
                                            <b>TOTAL</b>
                                        </div>
                                        <div class="text-end col-4 border border-dark px-2"
                                             style="border-style: none none solid solid !important;">
                                            <small>₱10,000.00</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row text-center">
                                        <div class="text-center col-12 border border-dark"
                                             style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2);">
                                            <b>₱10,000.00</b>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="bg-dark border border-dark m-0 p-0 text-center">
                        <small class="text-white">PURCHASE REQUEST</small>
                    </div>

                    <div class="row p-0 m-0">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2);">
                                    <b>Supplier:</b>
                                </div>
                                <div class="col-4 text-start m-0 p-0 border border-dark"
                                     style="border-style: none none solid solid !important;">
                                    <small><input type="text" class="w-100 rounded-0 border-0 px-2" value="n/a"
                                                  name="supplier"></small>
                                </div>
                                <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2);">
                                    <b>Payment Type:</b>
                                </div>
                                <div class="col-4 text-start m-0 p-0 border border-dark"
                                     style="border-style: none solid solid none !important;">
                                    <small><select class="w-100 rounded-0 border-0 px-2" name="payment_type">

                                            <option value="NONE">SELECT AN OPTION</option>
                                            <option value="CASH">CASH</option>
                                            <option value="ONLINE TRANSFER">ONLINE TRANSFER</option>
                                            <option value="GCASH">GCASH</option>
                                            <option value="CREDIT CARD">CREDIT CARD</option>
                                            <option value="CHECK">CHECK</option>

                                        </select></small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2);">
                                    <b>Paid to:</b>
                                </div>
                                <div class="col-4 text-start m-0 p-0 border border-dark"
                                     style="border-style: none none solid solid !important;">

                                    <small><input type="text" class="w-100 rounded-0 border-0 px-2"
                                                  value="AMORBELLE A. DIJAMCO" name="paid_to"></small>

                                </div>
                                <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2);">
                                    <b>Terms:</b>
                                </div>
                                <div class="col-4 text-start m-0 p-0 border border-dark"
                                     style="border-style: none solid solid none !important;">
                                    <small><input type="text" class="w-100 rounded-0 border-0 px-2" value=""
                                                  name="terms"></small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m-0 p-0">
                        <div class="col-2 text-center m-0 p-0 border border-dark px-2"
                             style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4); word-wrap: break-word;">
                            <b>QTY</b>
                        </div>
                        <div class="col-2 text-center m-0 p-0 border border-dark px-2"
                             style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4); word-wrap: break-word;">
                            <b>UOM</b>
                        </div>
                        <div class="col-2 text-center m-0 p-0 border border-dark px-2"
                             style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4); word-wrap: break-word;">
                            <b>JOB ORDER</b>
                        </div>
                        <div class="col-2 text-center m-0 p-0 border border-dark px-2"
                             style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4); word-wrap: break-word;">
                            <b>DESCRIPTION</b>
                        </div>
                        <div class="col-2 text-center m-0 p-0 border border-dark px-2"
                             style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4); word-wrap: break-word;">
                            <b>UNIT COST</b>
                        </div>
                        <div class="col-2 text-center m-0 p-0 border border-dark px-2"
                             style="border-style: none solid solid solid !important; background: rgba(255, 255, 0, 0.4); word-wrap: break-word;">
                            <b>TOTAL</b>
                        </div>
                    </div>


                    <div class="row m-0 p-0">
                        <div class="col-2 text-center m-0 p-0 border border-dark px-2"
                             style="border-style: none none solid solid !important; word-wrap: break-word;">
                            <small>1</small>
                        </div>
                        <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                             style="border-style: none none solid solid !important; word-wrap: break-word;">
                            <small>UNKNOWN</small>
                        </div>
                        <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                             style="border-style: none none solid solid !important; word-wrap: break-word;">
                            <small>PR23-101</small>
                        </div>
                        <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                             style="border-style: none none solid solid !important; word-wrap: break-word;">
                            <small>LTO EXPENSES FOR TRANSFER OF OWNERSHIP OF ONE UNIT BLS AMBULANCE UNIT DELIVERED TO
                                BUCOR</small>
                        </div>
                        <div class="col-2 text-end m-0 p-0 border border-dark px-2"
                             style="border-style: none none solid solid !important; word-wrap: break-word;">
                            <small>₱10,000.00</small>
                        </div>
                        <div class="col-2 text-end m-0 p-0 border border-dark px-2"
                             style="border-style: none solid solid solid !important; word-wrap: break-word;">
                            <small>₱10,000.00</small>
                        </div>
                    </div>

                    <div class="row m-0 p-0">
                        <div class="col-10">
                            <div class="row">
                                <div class="text-end col-12 border border-dark"
                                     style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4);">
                                    <b>TOTAL</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row text-center">
                                <div class="text-center col-12 border border-dark"
                                     style="border-style: none solid solid solid !important; background: rgba(255, 255, 0, 0.4);">
                                    <b>₱10,000.00</b>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-dark border border-dark m-0 p-0 text-center">
                        <small class="text-white">VOUCHER</small>
                    </div>

                    <div class="row p-0 m-0">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2);">
                                    <b>Supplier:</b>
                                </div>
                                <div class="col-4 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none none solid solid !important;">
                                    <small>n/a</small>
                                </div>
                                <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2);">
                                    <b>Date:</b>
                                </div>
                                <div class="col-4 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none solid solid none !important;">
                                    <small>2024-06-11 13:07</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2);">
                                    <b>Paid to:</b>
                                </div>
                                <div class="col-4 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none none solid solid !important;">


                                    <small>AMORBELLE A. DIJAMCO</small>

                                </div>
                                <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2);">
                                    <b>Paid Amount:</b>
                                </div>
                                <div class="col-4 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none solid solid none !important;">
                                    <small>₱10,000.00</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2);">
                                    <b>Payment type:</b>
                                </div>
                                <div class="col-4 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none none solid solid !important;">
                                    <small></small>
                                </div>
                                <div class="col-2 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2);">
                                    <b>Amount in words:</b>
                                </div>

                                <div class="col-4 text-start m-0 p-0 border border-dark px-2"
                                     style="border-style: none solid solid none !important;">
                                    <small>TEN THOUSAND ONLY</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 text-center border border-dark"
                         style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4);">
                        <small>RELEASED BY :</small>
                    </div>
                    <div class="col-4 text-center border border-dark"
                         style="border-style: none none solid solid !important; background: rgba(255, 0, 0, 0.4);">
                        <small>RECEIVED BY :</small>
                    </div>
                    <div class="col-4 text-center border border-dark"
                         style="border-style: none solid solid solid !important; background: rgba(75, 200, 75, 0.5);">
                        <small>AUDITED BY :</small>
                    </div>
                </div>

                <div class="row m-0 p-0">
                    <div class="col-4 border border-dark"
                         style="border-style: none none solid solid !important; height: 60px; display: flex; align-items: end; justify-content: center;">
                        <small><b>MR. RYLAN C. ALINGAROG</b></small>
                    </div>
                    <div class="col-4 border border-dark"
                         style="border-style: none none solid solid !important; height: 60px; display: flex; align-items: end; justify-content: center;">
                        <small><b>AMORBELLE A. DIJAMCO</b></small>
                    </div>
                    <div class="col-4 border border-dark"
                         style="border-style: none solid solid solid !important; height: 60px; display: flex; align-items: end; justify-content: center;">
                        <small><input type="text" class="border-0 text-center" style="font-weight: bold;"></small>
                    </div>
                </div>

                <div class="row m-0 p-0">
                    <div class="col-4 text-center border border-dark"
                         style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4);">
                        <small>Signature Over Printed Name</small>
                    </div>
                    <div class="col-4 text-center border border-dark"
                         style="border-style: none none solid solid !important; background: rgba(255, 0, 0, 0.4);">
                        <small>Signature Over Printed Name</small>
                    </div>
                    <div class="col-4 text-center border border-dark"
                         style="border-style: none solid solid solid !important; background: rgba(75, 200, 75, 0.5);">
                        <small>Signature Over Printed Name</small>
                    </div>
                </div>

                <div class="bg-dark border border-dark m-0 p-0 text-center">
                    <small>20240611-190</small>
                </div>

                <div class="row m-0 p-0">
                    <div class="col-6 text-center border border-dark py-2"
                         style="border-style: none none solid solid !important;">
                        <b>ACCOUNTING DEPARTMENT</b>
                    </div>
                    <div class="col-6 text-center border border-dark py-2"
                         style="border-style: none solid solid solid !important;">
                        <b>AUDITOR DEPARTMENT</b>
                    </div>
                </div>

                <div class="row m-0 p-0">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-4 border border-dark text-center"
                                 style="border-style: none none solid solid !important; background: rgba(255, 0, 0, 0.4);">
                                <small><b>Priority Level</b></small>
                            </div>
                            <div class="col-4 border border-dark text-center"
                                 style="border-style: none none solid solid !important; background: rgba(173, 216, 230, 1.0);">
                                <small><b>TYPE</b></small>
                            </div>
                            <div class="col-4 border border-dark text-center"
                                 style="border-style: none none solid solid !important; background: rgba(173, 216, 230, 1.0);">
                                <small><b>BANK NAME</b></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-6 border border-dark"
                                 style="border-style: none none solid solid !important;">
                                <small><b>ITEMS DELIVERY</b></small>
                            </div>
                            <div class="col-6 border border-dark"
                                 style="border-style: none solid solid solid !important; background: rgba(173, 216, 230, 1.0);">
                                <small><b>BOOK KEEPER</b></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row m-0 p-0">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-2 p-0 text-center border border-dark"
                                         style="border-style: none none none solid !important;">
                                        <small><input type="checkbox" name="Low"></small>
                                    </div>
                                    <div class="col-5 p-0 px-2 border border-dark"
                                         style="border-style: none none none solid !important;">
                                        <small>Low</small>
                                    </div>
                                    <div class="col-5 p-0 px-2 border border-dark"
                                         style="border-style: none none none solid !important;">
                                        <small>5 Days</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-2 p-0 text-center border border-dark"
                                         style="border-style: none none none solid !important;">
                                        <small><input type="checkbox" name="type_1l"></small>
                                    </div>
                                    <div class="col-10 m-0 p-0 border border-dark"
                                         style="border-style: none none none solid !important;">
                                        <small><select class="px-2 h-100 w-100 border-0" name="type_1r">
                                                <option value="None"></option>
                                                <option value="Cost of Sales">Cost of Sales</option>
                                                <option value="Supplies and materials">Supplies and materials</option>
                                                <option value="Cost of labour">Cost of labour</option>
                                                <option value="Shipping, Freight and Delivery">Shipping, Freight and
                                                    Delivery
                                                </option>
                                                <option value="Freight and delivery">Freight and delivery</option>
                                                <option value="Other costs of sales">Other costs of sales</option>
                                                <option value="Amortisation expense">Amortisation expense</option>
                                                <option value="Bad debts">Bad debts</option>
                                                <option value="Bank charges">Bank charges</option>
                                                <option value="Commissions and fees">Commissions and fees</option>
                                                <option value="Other selling expenses">Other selling expenses</option>
                                                <option value="Office/General Administrative Expenses">Office/General
                                                    Administrative Expenses
                                                </option>
                                                <option value="Payroll Expenses">Payroll Expenses</option>
                                                <option value="Legal and professional fees">Legal and professional
                                                    fees
                                                </option>
                                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings
                                                </option>
                                                <option value="Travel expenses">Travel expenses</option>
                                                <option value="Shipping and delivery expense">Shipping and delivery
                                                    expense
                                                </option>
                                                <option value="Meals and entertainment">Meals and entertainment</option>
                                                <option value="Repair and maintenance">Repair and maintenance</option>
                                                <option value="Equipment rental">Equipment rental</option>
                                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous
                                                    Service Cost
                                                </option>
                                                <option value="Income tax expense">Income tax expense</option>
                                                <option value="Insurance">Insurance</option>
                                                <option value="Interest paid">Interest paid</option>
                                                <option value="Loss on discontinued operations, net of tax">Loss on
                                                    discontinued operations, net of tax
                                                </option>
                                                <option value="Management compensation">Management compensation</option>
                                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill
                                                    Payment Expense
                                                </option>
                                                <option value="Utilities">Utilities</option>
                                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                                <option value="Other Expense">Other Expense</option>
                                                <option value="Penalties and settlements">Penalties and settlements
                                                </option>
                                            </select></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 m-0 p-0 border border-dark"
                                 style="border-style: none none solid solid !important;">
                                <small><select class="px-2 w-100 h-100 border-0" name="BANK_NAME">
                                        <option value="NONE">SELECT AN OPTION</option>
                                        <option value="SECURITY BANK">SECURITY BANK</option>
                                        <option value="BDO">BDO</option>
                                        <option value="METRO BANK">METRO BANK</option>
                                        <option value="BPI">BPI</option>
                                        <option value="AUB">AUB</option>
                                        <option value="CHINA BANK">CHINA BANK</option>
                                        <option value="RCBC">RCBC</option>
                                        <option value="UNION BANK">UNION BANK</option>
                                    </select></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6"
                    "="">
                    <div class="row"
                    "="">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-2 p-0 text-center border border-dark"
                                 style="border-style: none none none solid !important;">
                                <small><input type="checkbox" name="Complete"></small>
                            </div>
                            <div class="col-10 p-0 px-2 border border-dark"
                                 style="border-style: none none none solid !important; background: rgba(75, 200, 75, 0.5);">
                                <small>Complete</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 border border-dark m-0 p-0"
                         style="border-style: none solid none solid !important;">
                        <small class="px-2">Priority</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-0 p-0">
            <div class="col-6">
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2 p-0 text-center border border-dark"
                                 style="border-style: solid none none solid !important;">
                                <small><input type="checkbox" name="Medium"></small>
                            </div>
                            <div class="col-5 p-0 px-2 border border-dark"
                                 style="border-style: solid none none solid !important;">
                                <small>Medium</small>
                            </div>
                            <div class="col-5 p-0 px-2 border border-dark"
                                 style="border-style: solid none none solid !important;">
                                <small>3 Days</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2 p-0 text-center border border-dark"
                                 style="border-style: solid none none solid !important;">
                                <small><input type="checkbox" name="type_2l"></small>
                            </div>
                            <div class="col-10 m-0 p-0 border border-dark"
                                 style="border-style: solid none none solid !important;">
                                <small><select class="px-2 h-100 w-100 border-0" name="type_2r">
                                        <option value="None"></option>
                                        <option value="Cost of Sales">Cost of Sales</option>
                                        <option value="Supplies and materials">Supplies and materials</option>
                                        <option value="Cost of labour">Cost of labour</option>
                                        <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery
                                        </option>
                                        <option value="Freight and delivery">Freight and delivery</option>
                                        <option value="Other costs of sales">Other costs of sales</option>
                                        <option value="Amortisation expense">Amortisation expense</option>
                                        <option value="Bad debts">Bad debts</option>
                                        <option value="Bank charges">Bank charges</option>
                                        <option value="Commissions and fees">Commissions and fees</option>
                                        <option value="Other selling expenses">Other selling expenses</option>
                                        <option value="Office/General Administrative Expenses">Office/General
                                            Administrative Expenses
                                        </option>
                                        <option value="Payroll Expenses">Payroll Expenses</option>
                                        <option value="Legal and professional fees">Legal and professional fees</option>
                                        <option value="Advertising/Promotional">Advertising/Promotional</option>
                                        <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                        <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                        <option value="Travel expenses">Travel expenses</option>
                                        <option value="Shipping and delivery expense">Shipping and delivery expense
                                        </option>
                                        <option value="Meals and entertainment">Meals and entertainment</option>
                                        <option value="Repair and maintenance">Repair and maintenance</option>
                                        <option value="Equipment rental">Equipment rental</option>
                                        <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service
                                            Cost
                                        </option>
                                        <option value="Income tax expense">Income tax expense</option>
                                        <option value="Insurance">Insurance</option>
                                        <option value="Interest paid">Interest paid</option>
                                        <option value="Loss on discontinued operations, net of tax">Loss on discontinued
                                            operations, net of tax
                                        </option>
                                        <option value="Management compensation">Management compensation</option>
                                        <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment
                                            Expense
                                        </option>
                                        <option value="Utilities">Utilities</option>
                                        <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                        <option value="Other Expense">Other Expense</option>
                                        <option value="Penalties and settlements">Penalties and settlements</option>
                                    </select></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 border border-dark text-center"
                         style="border-style: solid none none solid !important; background: rgba(173, 216, 230, 1.0);">
                        <small><b>BANK CODE</b></small>
                    </div>
                </div>
            </div>
            <div class="col-6"
            "="">
            <div class="row"
            "="">
            <div class="col-6">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="Incomplete"></small>
                    </div>
                    <div class="col-10 p-0 px-2 border border-dark"
                         style="border-style: solid none none solid !important; background: rgba(173, 216, 230, 1.0);">
                        <small>Incomplete</small>
                    </div>
                </div>
            </div>
            <div class="col-6 border border-dark m-0 px-2" style="border-style: solid solid none solid !important;">
                <small>2024-06-11 13:07</small>
            </div>
        </div>
    </div>
</div>

<div class="row m-0 p-0">
    <div class="col-6">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="High"></small>
                    </div>
                    <div class="col-5 p-0 px-2 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small>High</small>
                    </div>
                    <div class="col-5 p-0 px-2 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small>1 Day</small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="type_3l"></small>
                    </div>
                    <div class="col-10 m-0 p-0 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><select class="px-2 h-100 w-100 border-0" name="type_3r">
                                <option value="None"></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative
                                    Expenses
                                </option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost
                                </option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued
                                    operations, net of tax
                                </option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment
                                    Expense
                                </option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                    </div>
                </div>
            </div>
            <div class="col-4 m-0 p-0 border border-dark text-center"
                 style="border-style: solid none none solid !important;">
                <small><select class="px-2 w-100 h-100 border-0" name="BANK_CODE">
                        <option value="NONE">SELECT AN OPTION</option>
                        <option value="SB-GTI-9791">SB-GTI-9791</option>
                        <option value="SB-RCA-1810">SB-RCA-1810</option>
                        <option value="BDO-Guntech-0559">BDO-Guntech-0559</option>
                        <option value="BDO-GTI-3561">BDO-GTI-3561</option>
                        <option value="BDO-RCA-5143">BDO-RCA-5143</option>
                        <option value="BDO-NOV-2603">BDO-NOV-2603</option>
                        <option value="MTB-GTI-1579">MTB-GTI-1579</option>
                        <option value="MTB-GTIUSD-0619">MTB-GTIUSD-0619</option>
                        <option value="AUB-Ballistic-0494">AUB-Ballistic-0494</option>
                        <option value="AUB-RCA-7916">AUB-RCA-7916</option>
                        <option value="BPI-RCA-1496">BPI-RCA-1496</option>
                    </select></small>
            </div>
        </div>
    </div>
    <div class="col-6"
    "="">
    <div class="row"
    "="">
    <div class="col-6 border border-dark" style="border-style: solid none none solid !important;">
        <small><b>SUPPLIER VERIFICATION</b></small>
    </div>
    <div class="col-6 border border-dark"
         style="border-style: solid solid none solid !important; background: rgba(173, 216, 230, 1.0);">
        <small><b>ACCOUNTANT</b></small>
    </div>
</div>
</div>
</div>

<div class="row m-0 p-0">
    <div class="col-6">
        <div class="row">
            <div class="col-4 border border-dark text-center"
                 style="border-style: solid none none solid !important; background: rgba(255, 0, 0, 0.4);">
                <small><b>Attachment</b></small>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="type_4l"></small>
                    </div>
                    <div class="col-10 m-0 p-0 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><select class="px-2 h-100 w-100 border-0" name="type_4r">
                                <option value="None"></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative
                                    Expenses
                                </option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost
                                </option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued
                                    operations, net of tax
                                </option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment
                                    Expense
                                </option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                    </div>
                </div>
            </div>
            <div class="col-4 m-0 p-0 border border-dark text-center"
                 style="border-style: solid none none solid !important; background: rgba(173, 216, 230, 1.0);">
                <small><b>CHECK NUMBER</b></small>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="Yes"></small>
                    </div>
                    <div class="col-10 p-0 px-2 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small>Yes</small>
                    </div>
                </div>
            </div>
            <div class="col-6 border border-dark m-0 p-0" style="border-style: solid solid none solid !important;">
                <small class="px-2">Priority</small>
            </div>
        </div>
    </div>
</div>

<div class="row m-0 p-0">
    <div class="col-6">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="With"></small>
                    </div>
                    <div class="col-10 m-0 px-2 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small>With</small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="type_5l"></small>
                    </div>
                    <div class="col-10 m-0 p-0 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><select class="px-2 h-100 w-100 border-0" name="type_5r">
                                <option value="None"></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative
                                    Expenses
                                </option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost
                                </option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued
                                    operations, net of tax
                                </option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment
                                    Expense
                                </option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                    </div>
                </div>
            </div>
            <div class="col-4 m-0 p-0 border border-dark text-center"
                 style="border-style: solid none none solid !important;">
                <input type="text" class="px-2 w-100 h-100 border-0" name="CHECK_NUMBER">
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="No"></small>
                    </div>
                    <div class="col-10 p-0 px-2 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small>No</small>
                    </div>
                </div>
            </div>
            <div class="col-6 border border-dark m-0 px-2" style="border-style: solid solid none solid !important;">
                <small>2024-06-11 13:07</small>
            </div>
        </div>
    </div>
</div>

<div class="row m-0 p-0">
    <div class="col-6">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="Without"></small>
                    </div>
                    <div class="col-10 p-0 px-2 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small>Without</small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="type_6l"></small>
                    </div>
                    <div class="col-10 m-0 p-0 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><select class="px-2 h-100 w-100 border-0" name="type_6r">
                                <option value="None"></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative
                                    Expenses
                                </option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost
                                </option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued
                                    operations, net of tax
                                </option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment
                                    Expense
                                </option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                    </div>
                </div>
            </div>
            <div class="col-4 m-0 p-0 border border-dark text-center"
                 style="border-style: solid none none solid !important; position: relative;">
                <small style="position: absolute; top: 0; left:0; width: 100%; height: calc(6px + (100% * 7));"
                       class="expense_item"></small>
            </div>
        </div>
    </div>
    <div class="col-6"
    "="">
    <div class="row"
    "="">
    <div class="col-6  p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
        <small><b>VAT INPUT AMOUNT</b></small>
    </div>
    <div class="col-6 border border-dark"
         style="border-style: solid solid none solid !important; background: rgba(173, 216, 230, 1.0);">
        <small><b>FINANCE</b></small>
    </div>
</div>
</div>
</div>

<div class="row m-0 p-0">
    <div class="col-6">
        <div class="row">
            <div class="col-4 border border-dark text-center"
                 style="border-style: solid none none solid !important; background: rgba(255, 0, 0, 0.4);">
                <small><b>Type</b></small>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <input type="checkbox" name="type_7l">
                    </div>
                    <div class="col-10 m-0 p-0 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><select class="px-2 h-100 w-100 border-0" name="type_7r">
                                <option value="None"></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative
                                    Expenses
                                </option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost
                                </option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued
                                    operations, net of tax
                                </option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment
                                    Expense
                                </option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                    </div>
                </div>
            </div>
            <div class="col-4 m-0 p-0 border border-dark text-center"
                 style="border-style: none none none solid !important;">

            </div>
        </div>
    </div>
    <div class="col-6"
    "="">
    <div class="row"
    "="">
    <div class="col-6 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
        <small><input type="text" class="px-2 h-100 w-100 border-0" name="vat_1"></small>
    </div>
    <div class="col-6 border border-dark m-0 p-0" style="border-style: solid solid none solid !important;">

        <small><select class="w-100 border-0 rounded-0 px-2" name="fin_status">
                <option value="Pending">Pending</option>
                <option value="Approve">Approve</option>
                <option value="Disapprove">Disapprove</option>
            </select></small>

    </div>
</div>
</div>
</div>

<div class="row m-0 p-0">
    <div class="col-6">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="OPEX"></small>
                    </div>
                    <div class="col-10 p-0 px-2 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small>OPEX</small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="type_8l"></small>
                    </div>
                    <div class="col-10 m-0 p-0 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><select class="px-2 h-100 w-100 border-0" name="type_8r">
                                <option value="None"></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative
                                    Expenses
                                </option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost
                                </option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued
                                    operations, net of tax
                                </option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment
                                    Expense
                                </option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                    </div>
                </div>
            </div>
            <div class="col-4 m-0 p-0 border border-dark text-center"
                 style="border-style: none none none solid !important;">

            </div>
        </div>
    </div>
    <div class="col-6"
    "="">
    <div class="row"
    "="">
    <div class="col-6 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
        <small><input type="text" class="px-2 h-100 w-100 border-0" name="vat_2"></small>
    </div>
    <div class="col-6 border border-dark m-0 px-2" style="border-style: solid solid none solid !important;">
        <small></small>
    </div>
</div>
</div>
</div>

<div class="row m-0 p-0">
    <div class="col-6">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="NON OPEX"></small>
                    </div>
                    <div class="col-10 p-0 px-2 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small>NON OPEX</small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="type_9l"></small>
                    </div>
                    <div class="col-10 m-0 p-0 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><select class="px-2 h-100 w-100 border-0" name="type_9r">
                                <option value="None"></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative
                                    Expenses
                                </option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost
                                </option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued
                                    operations, net of tax
                                </option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment
                                    Expense
                                </option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                    </div>
                </div>
            </div>
            <div class="col-4 m-0 p-0 border border-dark text-center"
                 style="border-style: none none none solid !important;">

            </div>
        </div>
    </div>
    <div class="col-6"
    "="">
    <div class="row"
    "="">
    <div class="col-6">
        <div class="row">
            <div class="col-6 border border-dark" style="border-style: solid none none solid !important;">
                <small><b>PO No</b></small>
            </div>
            <div class="col-6 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                <small><input type="text" class="px-2 h-100 w-100 border-0" name="po"></small>
            </div>
        </div>
    </div>
    <div class="col-6 border border-dark"
         style="border-style: solid solid none solid !important; background: rgba(173, 216, 230, 1.0);">
        <small><b>AUDITOR</b></small>
    </div>
</div>
</div>
</div>

<div class="row m-0 p-0">
    <div class="col-6">
        <div class="row">
            <div class="col-4 border border-dark text-center"
                 style="border-style: solid none none solid !important; background: rgba(255, 0, 0, 0.4);">
                <small><b>Receipt</b></small>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <input type="checkbox" name="type_10l">
                    </div>
                    <div class="col-10 m-0 p-0 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><select class="px-2 h-100 w-100 border-0" name="type_10r">
                                <option value="None"></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative
                                    Expenses
                                </option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost
                                </option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued
                                    operations, net of tax
                                </option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment
                                    Expense
                                </option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                    </div>
                </div>
            </div>
            <div class="col-4 border border-dark text-center" style="border-style: none none none solid !important;">

            </div>
        </div>
    </div>
    <div class="col-6"
    "="">
    <div class="row"
    "="">
    <div class="col-6">
        <div class="row">
            <div class="col-6 border border-dark" style="border-style: solid none none solid !important;">
                <small><b>Invoice No</b></small>
            </div>
            <div class="col-6 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                <small><input type="text" class="px-2 h-100 w-100 border-0" name="invoice"></small>
            </div>
        </div>
    </div>
    <div class="col-6 border border-dark m-0 p-0" style="border-style: solid solid none solid !important;">
        <small class="px-2"></small>
    </div>
</div>
</div>
</div>

<div class="row m-0 p-0">
    <div class="col-6">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="Official Receipt VAT"></small>
                    </div>
                    <div class="col-10 p-0 px-2 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small>Official Receipt VAT</small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="type_11l"></small>
                    </div>
                    <div class="col-10 m-0 p-0 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><select class="px-2 h-100 w-100 border-0" name="type_11r">
                                <option value="None"></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative
                                    Expenses
                                </option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost
                                </option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued
                                    operations, net of tax
                                </option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment
                                    Expense
                                </option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                    </div>
                </div>
            </div>
            <div class="col-4 border border-dark text-center" style="border-style: none none none solid !important;">

            </div>
        </div>
    </div>
    <div class="col-6"
    "="">
    <div class="row"
    "="">
    <div class="col-6">
        <div class="row">
            <div class="col-6 border border-dark" style="border-style: solid none none solid !important;">
                <small><b>Bill No</b></small>
            </div>
            <div class="col-6 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                <small><input type="text" class="px-2 h-100 w-100 border-0" name="bill"></small>
            </div>
        </div>
    </div>
    <div class="col-6 border border-dark m-0 px-2" style="border-style: solid solid none solid !important;">
        <small></small>
    </div>
</div>
</div>
</div>

<div class="row m-0 p-0">
    <div class="col-6">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="Delivery Receipt"></small>
                    </div>
                    <div class="col-10 p-0 px-2 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small>Delivery Receipt</small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="type_12l"></small>
                    </div>
                    <div class="col-10 m-0 p-0 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><select class="px-2 h-100 w-100 border-0" name="type_12r">
                                <option value="None"></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative
                                    Expenses
                                </option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost
                                </option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued
                                    operations, net of tax
                                </option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment
                                    Expense
                                </option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                    </div>
                </div>
            </div>
            <div class="col-4 border border-dark text-center" style="border-style: none none none solid !important;">

            </div>
        </div>
    </div>
    <div class="col-6"
    "="">
    <div class="row"
    "="">
    <div class="col-6">
        <div class="row">
            <div class="col-6 border border-dark" style="border-style: solid none none solid !important;">
                <small><b>OR No</b></small>
            </div>
            <div class="col-6 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                <small><input type="text" class="px-2 h-100 w-100 border-0" name="or"></small>
            </div>
        </div>
    </div>
    <div class="col-4 border border-dark" style="border-style: solid none none solid !important;">

    </div>
    <div class="col-2 border border-dark" style="border-style: solid solid none solid !important;">

    </div>
</div>
</div>
</div>

<div class="row m-0 p-0">
    <div class="col-6">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="col-2 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="None"></small>
                    </div>
                    <div class="col-10 p-0 px-2 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small>None</small>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col-1 p-0 text-center border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="checkbox" name="type_13l"></small>
                    </div>
                    <div class="col-11 m-0 p-0 border border-dark"
                         style="border-style: solid none none solid !important;">
                        <small><input type="text" class="px-2 h-100 w-100 border-0"
                                      value="Others: ____________________________________________________"
                                      name="type_13r"></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-6">
                <div class="row"
                "="">
                <div class="col-6 border border-dark" style="border-style: solid none solid solid !important;">
                    <small><b>Voucher No</b></small>
                </div>
                <div class="col-6 m-0 p-0 border border-dark px-2"
                     style="border-style: solid none solid solid !important;">
                    <small></small>
                </div>
            </div>
        </div>
        <div class="col-4 border border-dark" style="border-style: none none none solid !important;">

        </div>
        <div class="col-2 border border-dark text-center"
             style="border-style: none solid none solid !important; position: relative;">
            <small style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%);"><b>RCA</b></small>
        </div>
    </div>
</div>
</div>

<div class="bg-dark border border-dark m-0 p-0 text-center">
    <small>20240611-190</small>
</div>
</div>


<input type="hidden" id="VALUE" value="">
<input type="hidden" id="VALUE2" value="">
<input type="hidden" id="CHECK" value="">
<input type="hidden" id="CHECK2" value="High">
<input type="hidden" id="BANK_NAME" value="">
<input type="hidden" id="BANK_CODE" value="">
<input type="hidden" id="NUMBER" value="10,000.00">
<input type="hidden" id="WORD" value="TEN THOUSAND ONLY">
<input type="hidden" id="CHECK_NUMBER" value="">
<input type="hidden" id="PAYMENT_TYPE" value="">
<input type="hidden" id="STAMP" value="20240611-190-ELITE ACES\n\n">
<input type="hidden" id="REFERENCE" value="20240611-190">

<input type="hidden" id="PAID_TO" value="AMORBELLE A. DIJAMCO">
</div>
</div>
</div>

</body>
</html>
