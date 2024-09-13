<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    @yield('files')
    @yield('style')

    <style>

        input[name="search"]:focus{
            outline: none;
        }

        header > div {
            :hover {
                color: rgb(255, 255, 255, 1.0);
            }

            a {
                text-decoration: none;
                text-align: left;
                color: rgb(255, 255, 255, 0.5);
                display: flex;
                justify-content: start;
                align-items: center;
                flex-direction: row;
                gap: 10px;
            }
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        * {
            /* color: red !important; */
            /* border:  solid red 1px !important */
        }

        .uploaded-img {
            width: 100px;
            height: 100px;
        }

        .cursor-pointer {
            cursor: pointer !important;
        }

        .wraper {
            position: relative;
            height: 75px;
            width: 100%;
            overflow: hidden;
            mask-image: linear-gradient(
                to right,
                rgba(0, 0, 0, 0),
                rgba(0, 0, 0, 1) 20%,
                rgba(0, 0, 0, 1) 80%,
                rgba(0, 0, 0, 0)
            );
        }

        @keyframes scroll {
            to {
                left: -200px;
            }
        }

        .item {
            text-align: center;
            height: 75px;
            width: 200px;
            overflow: hidden;
            position: absolute;
            left: max(calc(250px * 5), 100%);
            animation-name: scroll;
            animation-duration: 20s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }

        .item1 {
            animation-delay: calc(20s / 5 * (5 - 1) * -1);
        }

        .item2 {
            animation-delay: calc(20s / 5 * (5 - 2) * -1);
        }

        .item3 {
            animation-delay: calc(20s / 5 * (5 - 3) * -1);
        }

        .item4 {
            animation-delay: calc(20s / 5 * (5 - 4) * -1);
        }

        .item5 {
            animation-delay: calc(20s / 5 * (5 - 5) * -1);
        }
    </style>

    <style>
        .lightrope {
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            position: absolute;
            z-index: 1;
            margin: -15px 0 0 0;
            padding: 0;
            pointer-events: none;
            width: 100%;
        }

        .lightrope li {
            position: relative;
            animation-fill-mode: both;
            animation-iteration-count: infinite;
            list-style: none;
            margin: 0;
            padding: 0;
            display: block;
            width: 12px;
            height: 28px;
            border-radius: 50%;
            margin: 20px;
            display: inline-block;
            background: rgba(0, 247, 165, 1);
            box-shadow: 0px 4.6666666667px 24px 3px rgba(0, 247, 165, 1);
            animation-name: flash-1;
            animation-duration: 2s;
        }
        .lightrope li:nth-child(2n+1) {
            background: rgba(0, 255, 255, 1);
            box-shadow: 0px 4.6666666667px 24px 3px rgba(0, 255, 255, 0.5);
            animation-name: flash-2;
            animation-duration: 0.4s;
        }
        .lightrope li:nth-child(4n+2) {
            background: rgba(247, 0, 148, 1);
            box-shadow: 0px 4.6666666667px 24px 3px rgba(247, 0, 148, 1);
            animation-name: flash-3;
            animation-duration: 1.1s;
        }
        .lightrope li:nth-child(odd) {
            animation-duration: 1.8s;
        }
        .lightrope li:nth-child(3n+1) {
            animation-duration: 1.4s;
        }
        .lightrope li:before {
            content: "";
            position: absolute;
            background: #222;
            width: 10px;
            height: 9.3333333333px;
            border-radius: 3px;
            top: -4.6666666667px;
            left: 1px;
        }
        .lightrope li:after {
            content: "";
            top: -14px;
            left: 9px;
            position: absolute;
            width: 52px;
            height: 18.6666666667px;
            border-bottom: solid #222 2px;
            border-radius: 50%;
        }
        .lightrope li:last-child:after {
            content: none;
        }
        .lightrope li:first-child {
            margin-left: -40px;
        }
        @keyframes flash-1 {
            0%, 100% {
                background: rgba(0, 247, 165, 1);
                box-shadow: 0px 4.6666666667px 24px 3px rgba(0, 247, 165, 1);
            }
            50% {
                background: rgba(0, 247, 165, 0.4);
                box-shadow: 0px 4.6666666667px 24px 3px rgba(0, 247, 165, 0.2);
            }
        }
        @keyframes flash-2 {
            0%, 100% {
                background: rgba(0, 255, 255, 1);
                box-shadow: 0px 4.6666666667px 24px 3px rgba(0, 255, 255, 1);
            }
            50% {
                background: rgba(0, 255, 255, 0.4);
                box-shadow: 0px 4.6666666667px 24px 3px rgba(0, 255, 255, 0.2);
            }
        }
        @keyframes flash-3 {
            0%, 100% {
                background: rgba(247, 0, 148, 1);
                box-shadow: 0px 4.6666666667px 24px 3px rgba(247, 0, 148, 1);
            }
            50% {
                background: rgba(247, 0, 148, 0.4);
                box-shadow: 0px 4.6666666667px 24px 3px rgba(247, 0, 148, 0.2);
            }
        }
    </style>
</head>
<body>

<section class="loader"></section>

<main>
    <div class="row m-0 p-0">
        <div class="col-2 m-0 p-0 px-3 bg-dark bg-gradient"
             style="min-height: 100vh; max-height: 100%; overflow-y: auto;" id="collapseLayout1">
            <header class="text-light text-center d-flex flex-column p-2 pt-3">
                <div>
                    <a href="/expense/request">
                        <div class="my-3 wraper">
                            <div class="item item1"><img src="/././images/logos/GTI_LOGO.png"
                                                         style="height: 75px; width: auto;"></div>
                            <div class="item item2"><img src="/././images/logos/BALLISTIC_LOGO.png"
                                                         style="height: 75px; width: auto;"></div>
                            <div class="item item3"><img src="/././images/logos/GUNTECH_LOGO.png"
                                                         style="height: 75px; width: auto;"></div>
                            <div class="item item4"><img src="/././images/logos/SOTERIA_LOGO.webp"
                                                         style="height: 75px; width: auto;"></div>
                            <div class="item item5"><img src="/././images/logos/ELITE_ACES_LOGO.png"
                                                         style="height: 75px; width: auto;"></div>
                        </div>
                        {{-- <img class="d-block mx-auto" src="/././images/logos/ELITE_ACES_LOGO.png" height="75px" alt="Management System"> --}}
                    </a>
                    <h6>MANAGEMENT SYSTEM</h6>
                </div>
                <hr class="border-1 border-top border-light m-0 p-0 w-100"/>
                <div class="my-3">
                    <a href="/expense/home" class="home_nav">
                        <i class="fas fa-home" style="height: 20px; width: 20px;"></i>
                        <small><b>Home</b></small>
                    </a>
                </div>
                <hr class="border-1 border-top border-light m-0 p-0 w-100"/>

                <small class="my-2 text-start" style="color: rgb(255, 255, 255, 0.5);"><b>MAKE REQUEST</b></small>

                <div class="mb-3">
                    <a href="/expense/request" class="request_nav">
                        <i class="fas fa-shopping-basket" style="height: 20px; width: 20px;"></i>
                        <small><b>New Request</b></small>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="/expense/past-request" class="past_request_nav">
                        <i class="fas fa-record-vinyl" style="height: 20px; width: 20px;"></i>
                        <small><b>Past Request</b></small>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="/expense/requests" class="my_request_nav">
                        <i class="fas fa-clipboard-list" style="height: 20px; width: 20px;"></i>
                        <small><b>My Request</b></small>
                    </a>
                </div>

                @can('managing-role',auth()->user())
                    <hr class="border-1 border-top border-light m-0 p-0 w-100"/>
                    <small class="my-2 text-start" style="color: rgb(255, 255, 255, 0.5);"><b>MANAGE REQUESTS</b></small>
                @endcan

                @can('book-keeper',auth()->user())
                    <div class="mb-3">
                        <a href="/expense/book-keeper" class="book_keeper_nav">
                            <i class="fas fa-book" style="height: 20px; width: 20px;"></i>
                            <small><b>Book Keeper</b></small>
                        </a>
                    </div>
                @endcan

                @can('accountant',auth()->user())
                    <div class="mb-3">
                        <a href="/expense/accountant" class="accountant_nav">
                            <i class="fas fa-file-invoice-dollar" style="height: 20px; width: 20px;"></i>
                            <small><b>Accountant</b></small>
                        </a>
                    </div>
                @endcan

                @can('finance',auth()->user())
                    <div class="mb-3">
                        <a href="/expense/finance" class="finance_nav">
                            <i class="fas fa-landmark" style="height: 20px; width: 20px;"></i>
                            <small><b>Finance</b></small>
                        </a>
                    </div>
                @endcan

                @can('president',auth()->user())
                    <div class="mb-3">
                        <a href="/expense/president" class="president_nav">
                            <i class="fas fa-crown" style="height: 20px; width: 20px;"></i>
                            <small><b>President</b></small>
                        </a>
                    </div>
                @endcan

                @can('auditor',auth()->user())
                    <div class="mb-3">
                        <a href="/expense/auditor" class="auditor_nav">
                            <i class="fas fa-calculator" style="height: 20px; width: 20px;"></i>
                            <small><b>Auditor</b></small>
                        </a>
                    </div>
                @endcan

                @can('managing-role',auth()->user())
                    <hr class="border-1 border-top border-light m-0 p-0 w-100"/>
                    <small class="my-2 text-start" style="color: rgb(255, 255, 255, 0.5);"><b>EDIT OPTIONS</b></small>
                    <div class="mb-3">
                        <a href="/expense/entity" class="entity_nav">
                            <i class="fas fa-code-branch" style="height: 20px; width: 20px;"></i>
                            <small><b>Entity</b></small>
                        </a>
                    </div>
                    <div class="mb-3">
                        <a href="/expense/job-order" class="job_order_nav">
                            <i class="fas fa-sort-amount-up-alt" style="height: 20px; width: 20px;"></i>
                            <small><b>Job Order</b></small>
                        </a>
                    </div>
                    <div class="mb-3">
                        <a href="/expense/unit-of-measure" class="uom_nav">
                            <i class="fas fa-balance-scale" style="height: 20px; width: 20px;"></i>
                            <small class="text-start"><b>Units Of Measurement</b></small>
                        </a>
                    </div>
                @endcan

                <hr class="border-1 border-top border-light m-0 p-0 w-100"/>
                <small class="my-2 text-start" style="color: rgb(255, 255, 255, 0.5);"><b>MANAGE ACCOUNTS</b></small>
                <div class="mb-3">
                    <a href="/expense/account" class="my_profile_nav">
                        <i class="fas fa-user" style="height: 20px; width: 20px;"></i>
                        <small><b>My Profile</b></small>
                    </a>
                </div>

                @can('finance-president',auth()->user())
                    <div class="mb-3">
                        <a href="/expense/accounts" class="accounts_nav">
                            <i class="fas fa-users" style="height: 20px; width: 20px;"></i>
                            <small><b>Accounts</b></small>
                        </a>
                    </div>
                @endcan

                @can('managing-role',auth()->user())
                    <hr class="border-1 border-top border-light m-0 p-0 w-100"/>
                    <small class="my-2 text-start" style="color: rgb(255, 255, 255, 0.5);"><b>REPORTS</b></small>
                @endcan

                @can('finance-president',auth()->user())
                    <div class="mb-3">
                        <a href="/expense/logs" class="exp_nav">
                            <i class="fas fa-folder-open" style="height: 20px; width: 20px;"></i>
                            <small><b>Logs</b></small>
                        </a>
                    </div>
                @endcan

                @can('managing-role',auth()->user())
                    <div class="mb-3">
                        <a href="/expense/forms" class="dl_forms_nav">
                            <i class="fas fa-download" style="height: 20px; width: 20px;"></i>
                            <small><b>Downloadable Forms</b></small>
                        </a>
                    </div>
                @endcan

                @can('finance-president',auth()->user())
                <div class="mb-3">
                    <a href="/expense/daily-request" class="daily_request_nav">
                        <i class="fas fa-calendar" style="height: 20px; width: 20px;"></i>
                        <small><b>Daily Request</b></small>
                    </a>
                </div>
                @endcan

                <hr class="border-1 border-top border-light m-0 p-0 w-100"/>
                <small class="my-2 text-start" style="color: rgb(255, 255, 255, 0.5);"><b>MESSAGES</b></small>
                <div class="mb-3">
                    <a href="/expense/chat" class="group_message_nav">
                        <i class="far fa-comments" style="height: 20px; width: 20px;"></i>
                        <small><b>Group Message</b></small>
                    </a>
                </div>
            </header>
        </div>
        <div class="col-10 m-0 p-0 d-flex flex-column" style="
        background-image: repeating-linear-gradient(0deg, rgb(221,219,219) 0px, rgb(221,219,219) 1px,transparent 1px, transparent 51px),repeating-linear-gradient(90deg, rgb(221,219,219) 0px, rgb(221,219,219) 1px,transparent 1px, transparent 51px),linear-gradient(90deg, rgb(201,201,201),rgb(201,201,201));
        min-height: 100vh; position: relative;" id="collapseLayout2">
            <div class="d-flex align-items-center px-3 bg-white bg-gradient" style="height: 70px;">
                <button class="btn btn-link text-dark me-auto collapsed" id="collapseButton">
                    <i class="fas fa-bars"></i>
                </button>
                <form method="POST" action="/logout" class="logoutForm">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger rounded-0" type="submit" onclick="localStorage.removeItem('checkedInputs');">
                        <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>
                        <small>LOGOUT</small>
                    </button>
                </form>
            </div>
            <ul class="lightrope">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            @yield('body')
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="imageModalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="imageModalHolder" class="img-fluid d-block mx-auto">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@yield('script')
<script>
    const logoutForm = document.querySelector('.logoutForm');

    logoutForm.addEventListener('submit', (e) => {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure you want to logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "log out"
        }).then((result) => {
            if (result.isConfirmed) {
                logoutForm.submit();
            }
        })
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function speek(message) {
        try {
            const utterance = new SpeechSynthesisUtterance(message);
            utterance.voice = speechSynthesis.getVoices()[4];
            speechSynthesis.speak(utterance);
        } catch (error) {
            console.error('unable to text to speech')
        }
    }


    function reloadImageModal() {
        const imageModalForm = new bootstrap.Modal(document.getElementById('imageModalForm'), {keyboard: false})
        const imageModalHolder = document.getElementById('imageModalHolder');

        const imageModal = document.querySelectorAll('.imageModal');

        imageModal.forEach(image => {
            image.addEventListener('click', () => {
                imageModalHolder.src = image.src;
                imageModalForm.show();
            })
        });
    }

    $(window).on('load', function () {
        $(".loader").fadeOut('slow');
        reloadImageModal();
    });

    $(document).ready(function () {
        function handleResize() {

            if (window.innerWidth <= 1024) {
                $('#collapseLayout1').hide();
                $('#collapseLayout2').removeClass('col-10').addClass('col-12');
            } else {
                $('#collapseLayout1').show();
                $('#collapseLayout2').removeClass('col-12').addClass('col-10');
            }
        }

        handleResize();
        window.addEventListener('resize', handleResize);
    });

    $('#collapseButton').on('click', function () {
        $('#collapseLayout1').toggle();
        $('#collapseLayout2').toggleClass('col-10 col-12');
    })
</script>
</body>
</html>
