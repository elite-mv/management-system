$(function() {
    Fill_UOM();
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

function Fill_UOM() {
    $.ajax({
        url: "./php/get_uom_database.php",
        method: "GET",
        success: function (data) {
            data = data.trim();
            $("#uom_database").html(data);
            
            const datatablesSimple = document.getElementById('uom_database');
            if (datatablesSimple) {

                datatablesSimple.SimpleDataTable = new simpleDatatables.DataTable(datatablesSimple);

                const columnWidths = ['50%', '35%', '15%'];
                const headers = datatablesSimple.querySelectorAll('th');

                headers.forEach((header, index) => {
                    header.style.width = columnWidths[index];
                    if (header.textContent.trim() === 'MEASUREMENT' ||
                        header.textContent.trim() === 'PRIORITY' ||
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

function edit_uom(data) {

    $.ajax({
        url: "./php/get_edit_uom.php",
        method: "GET",
        data: {
            id: data
        },
        success: function (data) {
            data = data.trim();
            $('#edit_uom_container').html(data);
            $('html, body').animate(
                {
                    scrollTop: 0
                },
                500,
                'linear'
            );
            $('#edit_uom').fadeIn('slow');
        }
    });

}

function close_edit_uom() {

    $('html, body').animate(
        {
            scrollTop: 0
        },
        500,
        'linear'
    );
    $('#edit_uom').fadeOut('slow');

}

function submit_edit_uom(data) {

    var priority = $('#edit_uom_pop').find("input[name='priority']").val();
    var measurement = $('#edit_uom_pop').find("input[name='measurement']").val();

    if (!priority) {
        alert('Priority cannot be empty.');
        return;
    }

    if (!measurement) {
        alert('Measurement cannot be empty.');
        return;
    }

    $.ajax({
        url: "./php/update_uom.php",
        method: "POST",
        data: {
            id: data,
            priority: priority,
            measurement: measurement
        },
        success: function (data) {
            $(".loader").fadeIn('slow');

            var audio = new Audio('src/sound/update_measurement_successful.mp3');

            audio.addEventListener('canplaythrough', function() {
                audio.play();
            });

            audio.addEventListener('ended', function() {
                window.location.href = 'uom.php';
            });
        }
    });

}

function delete_uom(data) {
    $.ajax({
        url: "./php/delete_uom.php",
        method: "GET",
        data: {
            id: data
        },
        success: function (data) {

            $(".loader").fadeIn('slow');

            var audio = new Audio('src/sound/delete_measurement_successful.mp3');

            audio.addEventListener('canplaythrough', function() {
                audio.play();
            });

            audio.addEventListener('ended', function() {
                window.location.href = 'uom.php';
            });

        }
    });
}

function open_add_uom() {
    $('html, body').animate(
        {
            scrollTop: 0
        },
        500,
        'linear'
    );
    $('#add_uom').fadeIn('slow');
}

function close_add_uom() {
    window.location.href = 'uom.php';
}

$('#submit_add_uom').on('submit', function (event) {
    event.preventDefault();

    var priority = $(this).find('input[name="priority"]').val();
    var measurement = $(this).find('input[name="measurement"]').val();

    $.ajax({
        url: "./php/add_uom.php",
        method: "POST",
        data: {
            priority: priority,
            measurement: measurement
        },
        success: function (data) {
            $(".loader").fadeIn('slow');

            var audio = new Audio('src/sound/add_measurement_successful.mp3');

            audio.addEventListener('canplaythrough', function() {
                audio.play();
            });

            audio.addEventListener('ended', function() {
                window.location.href = 'uom.php';
            });
        }
    });

})