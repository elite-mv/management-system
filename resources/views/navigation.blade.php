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
        }
    </style>
</head>
<body>

<div class="container">

    <div class="slide">
        <div class="item" style="background-image: url(https://i.ibb.co/qCkd9jS/img1.jpg);">
            <div class="content">
                <div class="name">SMS Blaster</div>
                <div class="des">Batch texting anywhere on the Philippines.</div>
                <button class="btn btn-danger rounded-0" id="sms_blaster">Proceed</button>
            </div>
        </div>
        <div class="item" style="background-image: url(images/expense_request.jpg);">
            <div class="content">
                <div class="name">Expense Request</div>
                <div class="des">Submit a new expense form, record a past expense record, manage a submitted expense requests and produce an expense report.</div>
                <a href="/expense/request" role="button" class="btn btn-danger rounded-0" id="expense_request">Proceed</a>
            </div>
        </div>
        <div class="item" style="background-image: url(https://i.ibb.co/NSwVv8D/img3.jpg);">
            <div class="content">
                <div class="name">Material Management</div>
                <div class="des">Monitor vehicle progress.</div>
                <button class="btn btn-danger rounded-0" id="material_management">Proceed</button>
            </div>
        </div>
        <div class="item" style="background-image: url(https://i.ibb.co/Bq4Q0M8/img4.jpg);">
            <div class="content">
                <div class="name">Payroll Management</div>
                <div class="des">Generate payroll summary and daily time records.</div>
                <button class="btn btn-danger rounded-0">Proceed</button>
            </div>
        </div>
        <div class="item" style="background-image: url(https://i.ibb.co/jTQfmTq/img5.jpg);">
            <div class="content">
                <div class="name">Payment Uploads</div>
                <div class="des">Compilations of receipt and generate monthly expenses.</div>
                <button class="btn btn-danger rounded-0">Proceed</button>
            </div>
        </div>
        <div class="item" style="background-image: url(https://i.ibb.co/RNkk6L0/img6.jpg);">
            <div class="content">
                <div class="name">Guntech</div>
                <div class="des">Automate generation of quotation, invoice and receipts.</div>
                <button class="btn btn-danger rounded-0">Proceed</button>
            </div>
        </div>

    </div>

    <div class="button">
        <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
        <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
    </div>

</div>
<script type="text/javascript">
    $(window).on('load', function() {
        $(".loader").fadeOut('slow');
    });

    let next = document.querySelector('.next')
    let prev = document.querySelector('.prev')

    next.addEventListener('click', function(){
        let items = document.querySelectorAll('.item')
        document.querySelector('.slide').appendChild(items[0])
    })

    prev.addEventListener('click', function(){
        let items = document.querySelectorAll('.item')
        document.querySelector('.slide').prepend(items[items.length - 1])
    })

</script>
</body>
</html>
