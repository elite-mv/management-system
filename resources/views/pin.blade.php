<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>

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
<main class="container-fluid p-0" style="background-image: repeating-linear-gradient(0deg, rgb(221,219,219) 0px, rgb(221,219,219) 1px,transparent 1px, transparent 51px),repeating-linear-gradient(90deg, rgb(221,219,219) 0px, rgb(221,219,219) 1px,transparent 1px, transparent 51px),linear-gradient(90deg, rgb(201,201,201),rgb(201,201,201));">

    @php
        if (session('pin_verified') === true) {
            header("Location: /navigation");
            exit();
        }
    @endphp

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

    <form id="pinForm" method="POST" action="/pin">

        <div id="pin" class="mx-auto"
             style="width: 80%; height: 100vh; display: flex; align-items: center; justify-content: center; flex-direction: column; margin: 0; padding: 0;">
            <div class="text-center">
                <small><h1>ENTER YOUR 5 SECRET PIN</h1></small>
            </div>
            <div style="display: flex; flex-direction: row; align-items: center; justify-content: center; gap: 0 15px;">

                @csrf
                <div style="width: 50px; height: 50px;">
                    <input class="pin" type="text" minlength="1" maxlength="1" style="width: 50px; height: 50px; text-align: center;"
                           name="pin[]">
                </div>
                <div style="width: 50px; height: 50px;">
                    <input class="pin" type="text" minlength="1" maxlength="1" style="width: 50px; height: 50px; text-align: center;"
                           name="pin[]">
                </div>
                <div style="width: 50px; height: 50px;">
                    <input class="pin" type="text" minlength="1" maxlength="1" style="width: 50px; height: 50px; text-align: center;"
                           name="pin[]">
                </div>
                <div style="width: 50px; height: 50px;">
                    <input class="pin" type="text" maxlength="1" style="width: 50px; height: 50px; text-align: center;"
                           name="pin[]">
                </div>
                <div style="width: 50px; height: 50px;">
                    <input class="pin" type="text" minlength="1" maxlength="1" style="width: 50px; height: 50px; text-align: center;"
                           name="pin[]">
                </div>
            </div>
        </div>

    </form>

</main>
<script>


    const firstPin = document.querySelector('.pin');
    const pins = document.querySelectorAll('.pin');
    const pinForm = document.querySelector('#pinForm');


    window.addEventListener('load',()=>{
        firstPin.focus();
    })

    pins.forEach((pin, index) => {
        pin.addEventListener('input', () => {
            if (index + 1 < pins.length) {
                pins[index + 1].focus();
            } else {
                submitForm();
            }
        })

        pin.addEventListener('keydown', (event) => {
        if (event.keyCode === 8 || event.keyCode === 46) {
            if (index > 0) {
                pins[index - 1].value = '';
                pins[index - 1].focus();
            }
        }

        if (event.ctrlKey && event.altKey && event.key === 's') {
            pins.forEach((pin) => {
                pin.value = '1';
            });

            submitForm();
        }
    });
    });

    function submitForm() {

        for (let i = 0; i < pins.length; i++) {
            if (!pins[i].value.length) {
                return;
            }
        }

        pinForm.submit();
    }
</script>
</body>
</html>
