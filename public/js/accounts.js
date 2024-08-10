$(function() {
    Fill_Accounts();
});

function logout() {

    $(".loader").show();

    var audio = new Audio('src/sound/thankyou.mp3');

    audio.addEventListener('canplaythrough', function() {
        audio.play();
    });

    audio.addEventListener('ended', function() {
        window.location.href = './php/logout.php';
    });
    
}

function Fill_Accounts() {
    $.ajax({
        url: "./php/get_accounts.php",
        method: "GET",
        success: function (data) {
            data = data.trim();
            $("#accounts_database").html(data);
            
            const datatablesSimple = document.getElementById('accounts_database');
            if (datatablesSimple) {

                datatablesSimple.SimpleDataTable = new simpleDatatables.DataTable(datatablesSimple);
                
                const columnWidths = ['25%', '18%', '25%', '15%', '15%'];
                const headers = datatablesSimple.querySelectorAll('th');

                headers.forEach((header, index) => {
                    header.style.width = columnWidths[index];
                    if (header.textContent.trim() === 'EMAIL' ||
                        header.textContent.trim() === 'PASSWORD' ||
                        header.textContent.trim() === 'USERNAME' ||
                        header.textContent.trim() === 'ROLE' ||
                        header.textContent.trim() === 'OTP') {
                        header.style.fontWeight = 'bold';
                    } else {
                        header.style.fontWeight = 'normal';
                    }
                });

            }
        }
    });
}

function password(element) {
    var icon = $(element).find('i');
    if (icon.hasClass('far fa-eye')) {
        icon.removeClass('far fa-eye').addClass('fas fa-eye-slash');
        $(element).prev('input').attr('type', 'text');
    } else {
        icon.removeClass('fas fa-eye-slash').addClass('far fa-eye');
        $(element).prev('input').attr('type', 'password');
    }
}