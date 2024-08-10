$(function() {
    Fill_Projects();
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

function Fill_Projects() {
    $.ajax({
        url: "./php/get_projects_database.php",
        method: "GET",
        success: function (data) {
            data = data.trim();
            $("#job_order_database").html(data);

            const datatablesSimple = document.getElementById('job_order_database');
            if (datatablesSimple) {

                datatablesSimple.SimpleDataTable = new simpleDatatables.DataTable(datatablesSimple);

                const columnWidths = ['28%', '28%', '28%', '16%'];
                const headers = datatablesSimple.querySelectorAll('th');

                headers.forEach((header, index) => {
                    header.style.width = columnWidths[index];
                    if (header.textContent.trim() === 'NUMBER' ||
                        header.textContent.trim() === 'NAME' ||
                        header.textContent.trim() === 'CLIENT' ||
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

function edit_job_order(data) {

    $.ajax({
        url: "./php/get_edit_job_order.php",
        method: "GET",
        data: {
            id: data
        },
        success: function (data) {
            data = data.trim();
            $('#edit_job_order_container').html(data);
            $('html, body').animate(
                {
                    scrollTop: 0
                },
                500,
                'linear'
            );
            $('#edit_job_order').fadeIn('slow');
        }
    });

}

function close_edit_job_order() {

    $('html, body').animate(
        {
            scrollTop: 0
        },
        500,
        'linear'
    );
    $('#edit_job_order').fadeOut('slow');

}

function delete_job_order(data) {
    if (confirm('Are you sure you want to delete this project?') === true) {
        $.ajax({
            url: "./php/delete_job_order.php",
            method: "GET",
            data: {
                id: data
            },
            success: function (data) {
                var audio = new Audio('src/sound/delete_project_successful.mp3');
                audio.play();
                Fill_Projects();
            }
        });
    }
}

function submit_edit_job_order(data) {

    if (confirm('Are you sure you want to edit this project?') === true) {
        var number = $('#edit_job_order_pop').find("input[name='number']").val();
        var name = $('#edit_job_order_pop').find("input[name='name']").val();
        var client = $('#edit_job_order_pop').find("input[name='client']").val();

        if (!number) {
            alert('Project number cannot be empty.');
            return;
        }

        if (!name) {
            alert('Project name cannot be empty.');
            return;
        }

        if (!client) {
            alert('Client name cannot be empty.');
            return;
        }

        $.ajax({
            url: "./php/update_job_order.php",
            method: "POST",
            data: {
                id: data,
                number: number,
                name: name,
                client: client
            },
            success: function (data) {
                $('#edit_job_order').fadeOut('slow');
                var audio = new Audio('src/sound/update_project_successful.mp3');
                audio.play();
                Fill_Projects();
            }
        });
    }
}

function open_add_job_order() {
    $('html, body').animate(
        {
            scrollTop: 0
        },
        500,
        'linear'
    );
    $('#add_job_order').fadeIn('slow');
}

function close_add_job_order() {
    $('#add_job_order').fadeOut('slow');
}

$('#submit_add_job_order').on('submit', function (event) {
    event.preventDefault();

    var number = $(this).find("input[name='number']").val();
    var name = $(this).find("input[name='name']").val();
    var client = $(this).find("input[name='client']").val();

    $.ajax({
        url: "./php/add_job_order.php",
        method: "POST",
        data: {
            number: number,
            name: name,
            client: client
        },
        success: function (data) {
            $('#add_job_order').fadeOut('slow');
            var audio = new Audio('src/sound/add_project_successful.mp3');
            audio.play();
            Fill_Projects();
        }
    });

})