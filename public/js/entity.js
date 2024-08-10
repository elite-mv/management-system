$(function() {
    Fill_Entity();
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

function Fill_Entity() {
    $.ajax({
        url: "./php/get_entity_database.php",
        method: "GET",
        success: function (data) {
            data = data.trim();
            $("#entity_database").html(data);

            const datatablesSimple = document.getElementById('entity_database');
            if (datatablesSimple) {

                datatablesSimple.SimpleDataTable = new simpleDatatables.DataTable(datatablesSimple);

                const columnWidths = ['10%', '40%', '35%', '15%'];
                const headers = datatablesSimple.querySelectorAll('th');

                headers.forEach((header, index) => {
                    header.style.width = columnWidths[index];
                    if (header.textContent.trim() === 'PRIORITY' ||
                        header.textContent.trim() === 'NAME' ||
                        header.textContent.trim() === 'LOGO' ||
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

function logo_size() {
    $('.img-fluid').each(function() {
        var $logo = $(this);
        
        var height = $logo.height();
        var width = $logo.width();

        if (height > width) {
            $logo.css({ height: '100px', width: 'auto' });
        } else if (width > height) {
            $logo.css({ height: 'auto', width: '100px' });
        }
    });
}
setInterval(logo_size, 1000);

function edit_entity(data) {

    $.ajax({
        url: "./php/get_edit_entity.php",
        method: "GET",
        data: {
            id: data
        },
        success: function (data) {
            data = data.trim();
            $('#edit_entity_container').html(data);
            $('html, body').animate(
                {
                    scrollTop: 0
                },
                500,
                'linear'
            );
            $('#edit_entity').fadeIn('slow');
        }
    });

}

function close_edit_entity() {

    $('html, body').animate(
        {
            scrollTop: 0
        },
        500,
        'linear'
    );
    $('#edit_entity').fadeOut('slow');

}

function delete_entity(data) {
    $.ajax({
        url: "./php/delete_entity.php",
        method: "GET",
        data: {
            id: data
        },
        success: function (data) {

            var audio = new Audio('src/sound/delete_entity_successful.mp3');
            audio.play();
            Fill_Entity();

        }
    });
}

let new_logo;

function temp_image(e) {
    const file = e.target.files[0];
    if (file) {
        $('#edit_entity_pop').find('button').prop('disabled', true);
        const reader = new FileReader();
        reader.onload = function (event) {
            const fileUrl = event.target.result;
            const FileDataWithoutPrefix = fileUrl.split(',')[1];
            const mime = file.type;
            $.ajax({
                url: "./php/add_temp_image.php",
                method: "POST",
                data: {
                    File: FileDataWithoutPrefix,
                    Mime: mime
                },
                success: function (data) {
                    new_logo = data;
                    $('#edit_entity_pop').find('button').prop('disabled', false);
                    $('#submit_add_entity').find('button').prop('disabled', false);
                }
            });
        }
        reader.readAsDataURL(file);
    }
}


function submit_edit_entity(data) {

    var priority = $('#edit_entity_pop').find("input[name='priority']").val();
    var name = $('#edit_entity_pop').find("input[name='name']").val();

    if (!priority) {
        alert('Priority cannot be empty.');
        return;
    }

    if (!name) {
        alert('Name cannot be empty.');
        return;
    }

    $.ajax({
        url: "./php/update_entity.php",
        method: "POST",
        data: {
            id: data,
            priority: priority,
            name: name,
            logo: new_logo
        },
        success: function (data) {
            
            var audio = new Audio('src/sound/update_entity_successful.mp3');
            audio.play();
            close_edit_entity()
            Fill_Entity();

        }
    });

}

function open_add_entity() {
    $('html, body').animate(
        {
            scrollTop: 0
        },
        500,
        'linear'
    );
    $('#add_entity').fadeIn('slow');
}

function close_add_entity() {
    $('html, body').animate(
        {
            scrollTop: 0
        },
        500,
        'linear'
    );
    $('#add_entity').fadeOut('slow');
}

$('#submit_add_entity').on('submit', function (event) {
    event.preventDefault();

    var priority = $(this).find('input[name="priority"]').val();
    var name = $(this).find('input[name="name"]').val();

    $.ajax({
        url: "./php/add_entity.php",
        method: "POST",
        data: {
            priority: priority,
            name: name,
            logo: new_logo
        },
        success: function (data) {
            
            var audio = new Audio('src/sound/add_entity_successful.mp3');
            audio.play();
            close_add_entity();
            Fill_Entity();

        }
    });

})