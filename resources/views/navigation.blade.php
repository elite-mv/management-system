<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="apple-touch-icon" sizes="180x180" href="src/general/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="src/general/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="src/general/favicon-16x16.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>

    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            position: relative;
            overflow-x: hidden;
        }

        /* body{
            background: #eaeaea;
            overflow: hidden;
        }

        .container{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 1000px;
            height: 600px;
            background: #f5f5f5;
            box-shadow: 0 30px 50px #dbdbdb;
        }

        .container .slide .item{
            width: 200px;
            height: 300px;
            position: absolute;
            top: 50%;
            transform: translate(0, -50%);
            border-radius: 20px;
            box-shadow: 0 30px 50px #505050;
            background-position: 50% 50%;
            background-size: cover;
            display: inline-block;
            transition: 0.5s;
        }

        .slide .item:nth-child(1),
        .slide .item:nth-child(2){
            top: 0;
            left: 0;
            transform: translate(0, 0);
            border-radius: 0;
            width: 100%;
            height: 100%;
        }


        .slide .item:nth-child(3){
            left: 50%;
        }
        .slide .item:nth-child(4){
            left: calc(50% + 220px);
        }
        .slide .item:nth-child(5){
            left: calc(50% + 440px);
        }

        .slide .item:nth-child(n + 6){
            left: calc(50% + 660px);
            opacity: 0;
        }

        .item .content{
            position: absolute;
            top: 50%;
            left: 100px;
            width: 300px;
            text-align: left;
            color: #eee;
            transform: translate(0, -50%);
            font-family: system-ui;
            display: none;
        }


        .slide .item:nth-child(2) .content{
            display: block;
        }


        .content .name{
            font-size: 40px;
            text-transform: uppercase;
            font-weight: bold;
            opacity: 0;
            animation: animate 1s ease-in-out 1 forwards;
            text-shadow: 2px 3px 0 #000;
        }

        .content .des{
            margin-top: 10px;
            margin-bottom: 20px;
            opacity: 0;
            animation: animate 1s ease-in-out 0.3s 1 forwards;
            text-shadow: 3px 4px 0 #000;
        }

        .content button{
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            opacity: 0;
            animation: animate 1s ease-in-out 0.6s 1 forwards;
        }


        @keyframes animate {
            from{
                opacity: 0;
                transform: translate(0, 100px);
                filter: blur(33px);
            }

            to{
                opacity: 1;
                transform: translate(0);
                filter: blur(0);
            }
        }

        .button{
            width: 100%;
            text-align: center;
            position: absolute;
            bottom: 20px;
        }

        .button button{
            width: 40px;
            height: 35px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            margin: 0 5px;
            border: 1px solid #000;
            transition: 0.3s;
        }

        .button button:hover{
            background: #ababab;
            color: #fff;
        } */
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
<body style="background-image: repeating-linear-gradient(0deg, rgb(41, 41, 41) 0px, rgb(41, 41, 41) 1px,transparent 1px, transparent 21px),repeating-linear-gradient(90deg, rgb(41, 41, 41) 0px, rgb(41, 41, 41) 1px,transparent 1px, transparent 21px),linear-gradient(90deg, hsl(87,0%,9%),hsl(87,0%,9%));">

    <div class="container-fluid">
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
        <div class="row m-0 p-1 gap-2">
            <div class="col-sm-12 col-md-6 mx-auto m-0 p-4 position-relative overflow-hidden" style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 5px 0; margin-top: 15px; position: relative;
                background-color: rgba(255, 255, 255, 0.4);
                box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.5);
                border-right: 1px solid rgba(255, 255, 255, 0.2);
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 7px;">
                <div style="position: absolute; top: 30px; left: -200px; transform: rotate(-45deg); transform-origin: center center; width: 500px;" class="bg-warning px-3 rounded-0 py-1 text-center">
                    <b class="text-white">PENDING</b>
                </div>
                <div class="w-100 h-100 p-5" style="border-radius: 7px; background-image: url(https://i.ibb.co/qCkd9jS/img1.jpg); background-size: cover;">
                    <b class="text-white" style="text-shadow: 2px 3px 0 #000;">SMS Blaster</b><br>
                    <small class="text-white" style="text-shadow: 3px 4px 0 #000;">Batch texting anywhere on the Philippines.</small><br>
                    <a class="mt-4 btn btn-danger rounded-pill px-5" href="">Proceed</a>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mx-auto m-0 p-4 position-relative overflow-hidden" style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 5px 0; margin-top: 15px; position: relative;
                background-color: rgba(255, 255, 255, 0.4);
                box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.5);
                border-right: 1px solid rgba(255, 255, 255, 0.2);
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 7px;">
                <div style="position: absolute; top: 30px; left: -200px; transform: rotate(-45deg); transform-origin: center center; width: 500px;" class="bg-danger px-3 rounded-0 py-1 text-center">
                    <b class="text-white">DONE</b>
                </div>
                <div class="w-100 h-100 p-5" style="border-radius: 7px; background-image: url(images/expense_request.jpg); background-size: cover;">
                    <b class="text-white" style="text-shadow: 2px 3px 0 #000;">Expense Request</b><br>
                    <small class="text-white" style="text-shadow: 3px 4px 0 #000;">Expense Request</small><br>
                    <a class="mt-4 btn btn-danger rounded-pill px-5" href="/expense/request">Proceed</a>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mx-auto m-0 p-4 position-relative overflow-hidden" style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 5px 0; margin-top: 15px; position: relative;
                background-color: rgba(255, 255, 255, 0.4);
                box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.5);
                border-right: 1px solid rgba(255, 255, 255, 0.2);
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 7px;">
                <div style="position: absolute; top: 30px; left: -200px; transform: rotate(-45deg); transform-origin: center center; width: 500px;" class="bg-warning px-3 rounded-0 py-1 text-center">
                    <b class="text-white">PENDING</b>
                </div>
                <div class="w-100 h-100 p-5" style="border-radius: 7px; background-image: url(https://i.ibb.co/NSwVv8D/img3.jpg); background-size: cover;">
                    <b class="text-white" style="text-shadow: 2px 3px 0 #000;">Sales & Purchasing</b><br>
                    <small class="text-white" style="text-shadow: 3px 4px 0 #000;">Generate quotation, invoice, PO and JO.</small><br>
                    <a class="mt-4 btn btn-danger rounded-pill px-5" href="">Proceed</a>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mx-auto m-0 p-4 position-relative overflow-hidden" style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 5px 0; margin-top: 15px; position: relative;
                background-color: rgba(255, 255, 255, 0.4);
                box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.5);
                border-right: 1px solid rgba(255, 255, 255, 0.2);
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 7px;">
                <div style="position: absolute; top: 30px; left: -200px; transform: rotate(-45deg); transform-origin: center center; width: 500px;" class="bg-warning px-3 rounded-0 py-1 text-center">
                    <b class="text-white">PENDING</b>
                </div>
                <div class="w-100 h-100 p-5" style="border-radius: 7px; background-image: url(https://i.ibb.co/Bq4Q0M8/img4.jpg); background-size: cover;">
                    <b class="text-white" style="text-shadow: 2px 3px 0 #000;">Payroll</b><br>
                    <small class="text-white" style="text-shadow: 3px 4px 0 #000;">Generate payroll and summary of daily time records.</small><br>
                    <a class="mt-4 btn btn-danger rounded-pill px-5" href="">Proceed</a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(window).on('load', function() {
            $(".loader").fadeOut('slow');
        });

        // let next = document.querySelector('.next')
        // let prev = document.querySelector('.prev')

        // next.addEventListener('click', function(){
        //     let items = document.querySelectorAll('.item')
        //     document.querySelector('.slide').appendChild(items[0])
        // })

        // prev.addEventListener('click', function(){
        //     let items = document.querySelectorAll('.item')
        //     document.querySelector('.slide').prepend(items[items.length - 1])
        // })

    </script>
</body>
</html>
