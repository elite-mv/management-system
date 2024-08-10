$(function() {
    Fill_My_Request();
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

function Fill_My_Request() {
    $.ajax({
        url: "./php/get_my_request.php",
        method: "GET",
        success: function (data) {
            data = data.trim();
            $("#my_request_database").html(data);
            
            const datatablesSimple = document.getElementById('my_request_database');
            if (datatablesSimple) {

                datatablesSimple.SimpleDataTable = new simpleDatatables.DataTable(datatablesSimple);
                
                const columnWidths = ['15%', '20%', '10%', '11%', '11%', '11%', '12%'];
                const headers = datatablesSimple.querySelectorAll('th');

                headers.forEach((header, index) => {
                    header.style.width = columnWidths[index];
                    if (header.textContent.trim() === 'REFERENCE' ||
                        header.textContent.trim() === 'DURATION' ||
                        header.textContent.trim() === 'ENTITY' ||
                        header.textContent.trim() === 'REQUESTED BY' ||
                        header.textContent.trim() === 'STATUS' ||
                        header.textContent.trim() === 'TOTAL' ||
                        header.textContent.trim() === 'ACTION') {
                        header.style.fontWeight = 'bold';
                    } else {
                        header.style.fontWeight = 'normal';
                    }
                });

            }
        }
    });
}

function view_my_request(data) {
    window.localStorage.setItem('id', data);
    window.location.href = 'printable.php';
}