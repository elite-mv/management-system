$(function() {
    Fill_Exp();
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

function Fill_Exp() {
    $.ajax({
        url: "./php/get_exp_database.php",
        method: "GET",
        success: function (data) {
            data = data.trim();
            $("#exp_database").html(data);
            
            const datatablesSimple = document.getElementById('exp_database');
            if (datatablesSimple) {

                datatablesSimple.SimpleDataTable = new simpleDatatables.DataTable(datatablesSimple);

                const columnWidths = ['60%', '20%', '20%'];
                const headers = datatablesSimple.querySelectorAll('th');

                headers.forEach((header, index) => {
                    header.style.width = columnWidths[index];
                    if (header.textContent.trim() === 'DESCRIPTION' ||
                        header.textContent.trim() === 'REFERENCE' ||
                        header.textContent.trim() === 'EMAIL') {
                        header.style.fontWeight = 'bold';
                    } else {
                        header.style.fontWeight = 'normal';
                    }
                });
            }
        }
    });
}