<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <meta name="author" content="MHEL VOI A. BERNABE">
    <link rel="apple-touch-icon" sizes="180x180" href="src/general/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="src/general/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="src/general/favicon-16x16.png">

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

</head>
<body>
<main class="container-fluid p-0">

    <form id="pinForm" method="POST" action="/pin">

        <div id="pin" class="mx-auto"
             style="width: 80%; height: 100vh; display: flex; align-items: center; justify-content: center; flex-direction: column; margin: 0; padding: 0;">
            <div>
                <small><h1>ENTER YOUR 5 SECRET PIN</h1></small>
            </div>
            <div style="display: flex; flex-direction: row; align-items: center; justify-content: center; gap: 0 15px;">

                @csrf
                <div style="width: 50px; height: 50px;">
                    <input class="pin" type="text" minlength="1" maxlength="1" style="width: 50px; height: 50px; text-align: center;"
                           name="otp1">
                </div>
                <div style="width: 50px; height: 50px;">
                    <input class="pin" type="text" minlength="1" maxlength="1" style="width: 50px; height: 50px; text-align: center;"
                           name="otp2">
                </div>
                <div style="width: 50px; height: 50px;">
                    <input class="pin" type="text" minlength="1" maxlength="1" style="width: 50px; height: 50px; text-align: center;"
                           name="otp3">
                </div>
                <div style="width: 50px; height: 50px;">
                    <input class="pin" type="text" maxlength="1" style="width: 50px; height: 50px; text-align: center;"
                           name="otp4">
                </div>
                <div style="width: 50px; height: 50px;">
                    <input class="pin" type="text" minlength="1" maxlength="1" style="width: 50px; height: 50px; text-align: center;"
                           name="otp5">
                </div>
            </div>
        </div>
    </form>

</main>
<script>


    const pins = document.querySelectorAll('.pin');
    const pinForm = document.querySelector('#pinForm');

    pins.forEach((pin, index) => {
        pin.addEventListener('input', () => {

            if (index + 1 < pins.length) {
                pins[index + 1].focus();
            }

            submitForm();
        })
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
