@extends('layouts.index')


@section('title', 'Sign In')

@section('style')
    <link rel="stylesheet" type="text/css" href="./css/index.css">

    <style type="text/css">
        .wraper {
            position: relative;
            height: 50px;
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
            height: 50px;
            width: 200px;
            overflow: hidden;
            position: absolute;
            left: max(calc(150px * 5), 100%);
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
@endsection

@section('body')
    <div class="font-monospace">
        <main class="container-fluid p-0">
            <div class="row m-0 p-0 w-100"
                 style="height: 100vh; height: 100svh; background-image: linear-gradient(135deg, rgb(169, 169, 169),rgb(41, 41, 41)),linear-gradient(22.5deg, rgb(84, 190, 204) 0%, rgb(84, 190, 204) 19%,rgb(89, 172, 188) 19%, rgb(89, 172, 188) 20%,rgb(94, 154, 171) 20%, rgb(94, 154, 171) 22%,rgb(99, 136, 155) 22%, rgb(99, 136, 155) 31%,rgb(105, 117, 138) 31%, rgb(105, 117, 138) 33%,rgb(110, 99, 122) 33%, rgb(110, 99, 122) 45%,rgb(115, 81, 105) 45%, rgb(115, 81, 105) 51%,rgb(120, 63, 89) 51%, rgb(120, 63, 89) 100%),linear-gradient(45deg, rgb(84, 190, 204) 0%, rgb(84, 190, 204) 19%,rgb(89, 172, 188) 19%, rgb(89, 172, 188) 20%,rgb(94, 154, 171) 20%, rgb(94, 154, 171) 22%,rgb(99, 136, 155) 22%, rgb(99, 136, 155) 31%,rgb(105, 117, 138) 31%, rgb(105, 117, 138) 33%,rgb(110, 99, 122) 33%, rgb(110, 99, 122) 45%,rgb(115, 81, 105) 45%, rgb(115, 81, 105) 51%,rgb(120, 63, 89) 51%, rgb(120, 63, 89) 100%); background-blend-mode:overlay, overlay, normal;">
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

                 <div class="m-auto signin_form text-center">
                    <div>
                        <h1 class="text-danger">SIGN IN</h1>
                        <div class="my-5 wraper">
                            <div class="item item1"><img src="images/logos/GTI_LOGO.png"
                                                         style="height: 50px; width: auto;"></div>
                            <div class="item item2"><img src="images/logos/BALLISTIC_LOGO.png"
                                                         style="height: 50px; width: auto;"></div>
                            <div class="item item3"><img src="images/logos/GUNTECH_LOGO.png"
                                                         style="height: 50px; width: auto;"></div>
                            <div class="item item4"><img src="images/logos/SOTERIA_LOGO.webp"
                                                         style="height: 50px; width: auto;"></div>
                            <div class="item item5"><img src="images/logos/ELITE_ACES_LOGO.png"
                                                         style="height: 50px; width: auto;"></div>
                        </div>

                        <form method="POST" action="/login" id="signin_form" class="text-start">
                            @csrf
                            <div class="input_label">
                                <input type="email" name="email" class="px-3 w-100 h-100" required>
                                <span id="username_span">Email</span>
                            </div>
                            <small id="wrong-email"
                                   class="text-danger bg-white border border-danger rounded-pill px-3 py-1"
                                   style="font-size: 10px; visibility: hidden;">You've entered a wrong email!</small>

                            <div class="input_label mt-4">
                                <input type="password" name="password" minlength="8" maxlength="16"
                                       class="px-3 w-100 h-100" required>
                                <i class="far fa-eye me-3" style="cursor: pointer;"
                                   onclick="toggle_password(this);"></i>
                                <span id="password_span">Password</span>
                            </div>

                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="remember_me">
                                <label class="form-check-label text-white" for="flexCheckDefault">
                                    Remember Me
                                </label>
                            </div>

                            <small id="wrong-password"
                                   class="text-danger bg-white border border-danger rounded-pill px-3 py-1"
                                   style="font-size: 10px; visibility: hidden;">You've entered a wrong password!</small>

                            <div class="text-center">
                                <button type="submit" class="btn btn-light rounded-pill py-1 w-100 mt-4">Enter</button>
                            </div>


                            @if($errors->any())
                                <p class="mt-2 text-center text-danger bg-white">{{$errors->first()}}</p>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection


@section('script')

    <script>
        $(window).on('load', function() {
            $('#signin_form').find('input[name="email"]').focus();

            // document.addEventListener('keydown', function(event) {
            //     const audio = new Audio('src/sound/type_any_key.mp3');
            //     audio.play();
            // });
        })

        $('#signin_form').find('input[name="email"]').on('input', function() {
            if ($(this).val().trim() !== '') {

                $('#wrong-email').css({
                    'visibility': 'hidden'
                });

                $(this).siblings('span').css({
                    'transform': 'translateX(-10px) translateY(-25px)',
                    'padding': '1px 6px',
                    'background': '#fff',
                    'letter-spacing': '0em',
                    'border': '1px solid #000'
                });
            } else {
                if ($(this).val().trim() === '') {
                    $(this).siblings('span').css({
                        'transform': '',
                        'padding': '',
                        'background': '',
                        'letter-spacing': '',
                        'border': ''
                    });
                }
            }
        });

        $('#signin_form').find('input[name="password"]').on('input', function() {

            if ($(this).val().trim() !== '') {

                $('#wrong-password').css({
                    'visibility': 'hidden'
                });

                $(this).siblings('span').css({
                    'transform': 'translateX(-10px) translateY(-25px)',
                    'padding': '1px 6px',
                    'background': '#fff',
                    'letter-spacing': '0em',
                    'border': '1px solid #000'
                });
            } else {
                if ($(this).val().trim() === '') {
                    $(this).siblings('span').css({
                        'transform': '',
                        'padding': '',
                        'background': '',
                        'letter-spacing': '',
                        'border': ''
                    });
                }
            }
        });

        $('#username_span').on('click, mouseover', function() {
            $('#signin_form').find('input[name="email"]').focus();
        })

        $('#password_span').on('click, mouseover', function() {
            $('#signin_form').find('input[name="password"]').focus();
        })

        $('#signin_form').find('input[name="password"]').on('mouseover', function() {
            $(this).focus();
        })

        $('#signin_form').find('input[name="email"]').on('mouseover', function() {
            $(this).focus();
        })

        function toggle_password(element) {
            var icon = $(element);
            if (icon.hasClass('far fa-eye')) {
                icon.removeClass('far fa-eye').addClass('fas fa-eye-slash');
                $(element).prev('input').attr('type', 'text');
            } else {
                icon.removeClass('fas fa-eye-slash').addClass('far fa-eye');
                $(element).prev('input').attr('type', 'password');
            }
        }
    </script>

@endsection
