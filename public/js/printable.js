$(function() {
    $('#requested_item').hide();
    $('#logs').hide();
    var currentURL = window.location.href;
    if (currentURL !== "https://management-system.free.nf/printable.php" && currentURL !== "localhost/management-system/printable.php") {
        var id = new URLSearchParams(currentURL).get('id');
        window.localStorage.setItem('id', id);
        view();
    } else {
        view();
    }
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

function view() {
    $.ajax({
        url: "./php/get_printable.php",
        method: "POST",
        data: {
            id: window.localStorage.getItem('id')
        },
        success: function (data) {
            $('#printable').html(data);

            var check = $('#CHECK').val();
            if (check) {
                var valueArray = check.split(',');
                for (var i = 0; i < valueArray.length; i++) {
                    $('#printable').find("input[name='" + valueArray[i] + "']").prop('checked', true);
                }
            }

            var check2 = $('#CHECK2').val();
            if (check2) {
                var checkArray = check2.split(',');
                for (var i = 0; i < checkArray.length; i++) {
                    $('#printable').find("input[name='"+ checkArray[i] +"']").prop('checked', true);
                }
            }

            var value = $('#VALUE').val();
            if (value) {
                var valueArray = value.split('@');
                let number = '';
                for (var i = 0; i < valueArray.length; i++) {
                    number = i + 1;
                    $('#printable').find("select[name='type_" + number + "r']").val(valueArray[i]);
                }
            }

            var value2 = $('#VALUE2').val();
            if (value2) {
                var valueArray2 = value2.split(',');
                $('#printable').find("input[name='vat_1']").val(valueArray2[0]);
                $('#printable').find("input[name='vat_2']").val(valueArray2[1]);
                $('#printable').find("input[name='po']").val(valueArray2[2]);
                $('#printable').find("input[name='invoice']").val(valueArray2[3]);
                $('#printable').find("input[name='bill']").val(valueArray2[4]);
                $('#printable').find("input[name='or']").val(valueArray2[5]);
                $('#printable').find("input[name='type_13r']").val(valueArray2[6]);
            }

            if ($('#BANK_NAME').val()) {
                $('#printable').find('select[name="BANK_NAME"]').val($('#BANK_NAME').val());
            }

            if ($('#BANK_CODE').val()) {
                $('#printable').find('select[name="BANK_CODE"]').val($('#BANK_CODE').val());
            }

            $('#printable').find('input[name="CHECK_NUMBER"]').val($('#CHECK_NUMBER').val());

            $('#printable').find('img[name="thumbnail"]').on('mouseover', function() {
                const thumbnail = $('<img src="' + $(this).attr('src') + '" id="thumbnail" style="display: none;">');
                $('body').append(thumbnail);

                var height = $(this).height() * 25;

                $('#thumbnail').css({
                    'position': 'absolute',
                    'z-index': 9999,
                    'top': ($(this).offset().top - height) + 'px',
                    'left': ($(this).offset().left + $(this).width()) + 'px',
                    'height': height + 'px',
                    'width': 'auto',
                    'border': 3 + 'px solid #000'
                }).fadeIn('slow');
            }).on('mouseout', function() {
                $('#thumbnail').fadeOut('slow', function() {
                    $(this).attr('src', '');
                    $(this).remove();
                });
            });

            get_comment();
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

function download_print() {
    var element = document.getElementById('printable');
    html2pdf(element, {
        margin: 0,
        filename: 'Expense_Request_Form.pdf',
        image: { type: 'jpg', quality: 1.0 },
        html2canvas: { scale: 1 },
        jsPDF: { 
            unit: 'mm', 
            format: 'a3', 
            orientation: 'portrait',
        },
        pagebreak: { mode: 'avoid-all' },
        html2pdf: {
            margin: 0,
            jsPDF: { 
                unit: 'mm', 
                format: 'a3', 
                orientation: 'portrait',
            }
        },
    });
}

function get_requested_item(data) {
    $('html, body').animate(
        {
            scrollTop: 0
        },
        500,
        'linear'
    );

    $.ajax({
        url: "./php/get_requested_item.php",
        method: "GET",
        data: {
            id: data
        },
        success: function (data) {
            $('#requested_item').fadeIn('');
            $('#requested_item_container').html(data);

            $('#requested_item_container').on('mouseleave', function() {
                $('#requested_item').fadeOut('slow');
            })

            $('#requested_item_container').find('input[name="update_image"]').on('change', function(e) {
                const files = e.target.files;
                if (files && files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
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
                                    if (data) {
                                        const thumbnail = $('<div>').append(
                                            $('<img>').attr('src', data).addClass('uploaded-img')
                                        );
                                        $('#requested_item_container').find('#uploads').append(thumbnail);
                                        
                                        $.ajax({
                                            url: "./php/update_thumbnail.php",
                                            method: "GET",
                                            data: {
                                                id: $('#requested_item_container').find('input[name="id"]').val(),
                                                thumbnail: data
                                            },
                                            success: function (data) {
                                                view();
                                            }
                                        });
                                    }
                                }
                            });
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
        }
    });
}

function get_comment() {
    $.ajax({
        url: "./php/get_comment.php",
        method: "GET",
        data: {
            id: window.localStorage.getItem('id')
        },
        success: function (data) {
            data = data.trim();
            $('#comment').html(data);

            $('#comment-form').on('submit', function(event) {
                event.preventDefault();
                const reference = $('#comment-form').find('input[name="reference"]').val();
                const message = $('#comment-form').find('textarea[name="message"]').val();

                $.ajax({
                    url: "./php/add_comment.php",
                    method: "GET",
                    data: {
                        reference: reference,
                        message: message
                    },
                    success: function (data) {
                        
                        $('#comment-form').find('textarea[name="message"]').val('');
                        get_comment();

                        $.ajax({
                            url: "./php/send_notification.php",
                            method: "POST",
                            data: {
                                id: window.localStorage.getItem('id'),
                                message: data,
                                type: 'comment'
                            },
                            success: function (data) {

                            }
                        });
                    }
                });
            })
        }
    });
}

function show_logs() {
    if ($('#logs').is(':hidden')) {
        $.ajax({
            url: "./php/get_logs.php",
            method: "GET",
            data: {
                id: window.localStorage.getItem('id')
            },
            success: function (data) {
                $('#logs_container').html(data);
                $('#logs').fadeIn('slow');

                $('#logs_container').on('mouseleave', function() {
                    $('#logs').fadeOut('slow');
                });
            }
        });
    } else {
        $('#logs').fadeOut('slow');
    }
}