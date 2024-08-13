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

    <link rel="stylesheet" href="/css/navigation.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="/js/header.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('style')

    <style>

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

        .cursor-pointer{
            cursor: pointer !important;
        }
    </style>
</head>
<body>

<section class="loader"></section>

<main>
    <div class="row mx-0">
        <nav class="d-none d-md-block col-2 px-0">
            <header class="bg-dark text-light collapse show" id="collapseLayouts">
                <div class="w-100">
                    <a href="/request">
                        <img class="d-block mx-auto" src="images/logos/ELITE_ACES_LOGO.jpg" height="75px"
                             alt="Management System">
                    </a>
                    <h6 class="mt-3 text-center">MANAGEMENT SYSTEM</h6>
                </div>

                <div class="mt-1" style="height: 1px; background-color: rgb(255, 255, 255, 0.5); width: 100%;"></div>
                <small class="my-2" style="color: rgb(255, 255, 255, 0.5);"><b>MAKE REQUEST</b></small>

                <div class="mb-3">
                    <a href="request.php" class="request_nav">
                        <i class="fas fa-shopping-basket" style="height: 20px; width: 20px;"></i>
                        <small><b>Request</b></small>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="my_request.php" class="my_request_nav">
                        <i class="fas fa-clipboard-list" style="height: 20px; width: 20px;"></i>
                        <small><b>My Request</b></small>
                    </a>
                </div>

                <div class="mt-1" style="height: 1px; background-color: rgb(255, 255, 255, 0.5); width: 100%;"></div>
                <small class="my-2" style="color: rgb(255, 255, 255, 0.5);"><b>MANAGE REQUESTS</b></small>

                <div class="mb-3">
                    <a href="book_keeper.php" class="book_keeper_nav">
                        <i class="fas fa-book" style="height: 20px; width: 20px;"></i>
                        <small><b>Book Keeper</b></small>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="accountant.php" class="accountant_nav">
                        <i class="fas fa-file-invoice-dollar" style="height: 20px; width: 20px;"></i>
                        <small><b>Accountant</b></small>
                    </a>
                </div>
                <div class="mb-3">
                    <a href="finance.php" class="finance_nav">
                        <i class="fas fa-landmark" style="height: 20px; width: 20px;"></i>
                        <small><b>Finance</b></small>
                    </a>
                </div>
                <div class="mb-3">
                    <a href="president.php" class="president_nav">
                        <i class="fas fa-crown" style="height: 20px; width: 20px;"></i>
                        <small><b>President</b></small>
                    </a>
                </div>
                <div class="mb-3">
                    <a href="auditor.php" class="auditor_nav">
                        <i class="fas fa-calculator" style="height: 20px; width: 20px;"></i>
                        <small><b>Auditor</b></small>
                    </a>
                </div>
                <div class="mt-1" style="height: 1px; background-color: rgb(255, 255, 255, 0.5); width: 100%;"></div>
                <small class="my-2" style="color: rgb(255, 255, 255, 0.5);"><b>EDIT OPTIONS</b></small>

                <div class="mb-3">
                    <a href="entity.php" class="entity_nav">
                        <i class="fas fa-code-branch" style="height: 20px; width: 20px;"></i>
                        <small><b>Entity</b></small>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="job_order.php" class="job_order_nav">
                        <i class="fas fa-sort-amount-up-alt" style="height: 20px; width: 20px;"></i>
                        <small><b>Job Order</b></small>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="uom.php" class="uom_nav">
                        <i class="fas fa-balance-scale" style="height: 20px; width: 20px;"></i>
                        <small class="text-start"><b>Units Of Measurement</b></small>
                    </a>
                </div>
                <div class="mt-1" style="height: 1px; background-color: rgb(255, 255, 255, 0.5); width: 100%;"></div>
                <small class="my-2" style="color: rgb(255, 255, 255, 0.5);"><b>MANAGE ACCOUNTS</b></small>

                <div class="mb-3">
                    <a href="my_profile.php" class="my_profile_nav">
                        <i class="fas fa-user" style="height: 20px; width: 20px;"></i>
                        <small><b>My Profile</b></small>
                    </a>
                </div>
                <div class="mb-3">
                    <a href="accounts.php" class="accounts_nav">
                        <i class="fas fa-users" style="height: 20px; width: 20px;"></i>
                        <small><b>Accounts</b></small>
                    </a>
                </div>

                <div class="mt-1" style="height: 1px; background-color: rgb(255, 255, 255, 0.5); width: 100%;"></div>
                <small class="my-2" style="color: rgb(255, 255, 255, 0.5);"><b>REPORTS</b></small>

                <div class="mb-3">
                    <a href="exp.php" class="exp_nav">
                        <i class="fas fa-folder-open" style="height: 20px; width: 20px;"></i>
                        <small><b>Expected Events</b></small>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="analytics.php" class="analytics_nav">
                        <i class="fas fa-file-signature" style="height: 20px; width: 20px;"></i>
                        <small><b>Analytics</b></small>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="calculator.php" class="calculator_nav">
                        <i class="fas fa-calculator" style="height: 20px; width: 20px;"></i>
                        <small><b>Calculator</b></small>
                    </a>
                </div>

                <div class="mt-1" style="height: 1px; background-color: rgb(255, 255, 255, 0.5); width: 100%;"></div>
                <small class="my-2" style="color: rgb(255, 255, 255, 0.5);"><b>REPORTS</b></small>

                <div class="mb-3">
                    <a href="analytics.php" class="analytics_nav">
                        <i class="fas fa-file-signature" style="height: 20px; width: 20px;"></i>
                        <small><b>Analytics</b></small>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="calculator.php" class="calculator_nav">
                        <i class="fas fa-calculator" style="height: 20px; width: 20px;"></i>
                        <small><b>Calculator</b></small>
                    </a>
                </div>
                <div class="mt-1" style="height: 1px; background-color: rgb(255, 255, 255, 0.5); width: 100%;"></div>
                <small class="my-2" style="color: rgb(255, 255, 255, 0.5);"><b>MESSAGES</b></small>

                <div class="mb-3">
                    <a href="group_message.php" class="group_message_nav">
                        <i class="far fa-comments" style="height: 20px; width: 20px;"></i>
                        <small><b>Group Message</b></small>
                    </a>
                </div>
            </header>

        </nav>
        <section class="col-12 col-md-10 container-fluid px-0 mx-0" style="background-color: #EDEEF1;">
            <div class="bg-white d-flex align-items-center px-3" style="height: 70px;">
                <button class="btn btn-link text-dark me-auto collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <i class="fas fa-bars"></i>
                </button>

                <form method="POST" action="/logout" class="logoutForm">
                    @csrf
                    <button type="submit"> 
                        <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>
                        <small>LOGOUT</small>
                    </button>
                </form>
            </div>

            @yield('body')
        </section>
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

    logoutForm.addEventListener('submit',(e)=>{
        
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

</script>
</body>
</html>
