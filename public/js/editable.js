$(function() {
    $('#requested_item').hide();
    $('#check_writer').hide();
    $('#logs').hide();
    view();
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
        url: "./php/get_editable.php",
        method: "POST",
        data: {
            id: window.localStorage.getItem('id')
        },
        success: function (data) {
            $('#printable').html(data);

            // $('#pagination').find('input[name="id"]').val($('#REFERENCE').val());

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

            $('#printable').find('select[name="status"]').on('change', function() {
                $.ajax({
                    url: "./php/update_status.php",
                    method: "POST",
                    data: {
                        id: window.localStorage.getItem('id'),
                        status: $(this).val()
                    },
                    success: function (data) {
                        
                    }
                });
            })

            $('#printable').find('input[name="supplier"]').on('change', function() {
                $.ajax({
                    url: "./php/update_supplier.php",
                    method: "POST",
                    data: {
                        id: window.localStorage.getItem('id'),
                        supplier: $(this).val()
                    },
                    success: function (data) {
                        
                    }
                });
            })

            $('#printable').find('input[name="paid_to"]').on('change', function() {
                $.ajax({
                    url: "./php/update_paid_to.php",
                    method: "POST",
                    data: {
                        id: window.localStorage.getItem('id'),
                        paid_to: $(this).val()
                    },
                    success: function (data) {
                        
                    }
                });
            })

            $('#printable').find('input[name="terms"]').on('change', function() {
                $.ajax({
                    url: "./php/update_terms.php",
                    method: "POST",
                    data: {
                        id: window.localStorage.getItem('id'),
                        terms: $(this).val()
                    },
                    success: function (data) {
                        
                    }
                });
            })

            $('#printable').find('select[name="payment_type"]').on('change', function() {
                $.ajax({
                    url: "./php/update_payment_type.php",
                    method: "POST",
                    data: {
                        id: window.localStorage.getItem('id'),
                        payment_type: $(this).val()
                    },
                    success: function (data) {
                        view();
                    }
                });
            })

            $('#printable').find('input[name="Low"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="Medium"]').prop('checked', false);
                    $('#printable').find('input[name="High"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="Medium"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="Low"]').prop('checked', false);
                    $('#printable').find('input[name="High"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="High"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="Low"]').prop('checked', false);
                    $('#printable').find('input[name="Medium"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="Complete"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="Incomplete"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="Incomplete"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="Complete"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="Yes"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="No"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="No"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="Yes"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="With"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="Without"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="Without"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="With"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="OPEX"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="NON OPEX"]').prop('checked', false);
                }
                update_deparment()
            });

            $('#printable').find('input[name="NON OPEX"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="OPEX"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="Official Receipt VAT"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="Delivery Receipt"]').prop('checked', false);
                    $('#printable').find('input[name="None"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="Delivery Receipt"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="Official Receipt VAT"]').prop('checked', false);
                    $('#printable').find('input[name="None"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="None"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#printable').find('input[name="Official Receipt VAT"]').prop('checked', false);
                    $('#printable').find('input[name="Delivery Receipt"]').prop('checked', false);
                }
                update_deparment();
            });

            $('#printable').find('input[name="type_1l"]').on('click', function() {
                update_deparment();
            });

            $('#printable').find('input[name="type_2l"]').on('click', function() {
                update_deparment();
            });

            $('#printable').find('input[name="type_3l"]').on('click', function() {
                update_deparment();
            });

            $('#printable').find('input[name="type_4l"]').on('click', function() {
                update_deparment();
            });

            $('#printable').find('input[name="type_5l"]').on('click', function() {
                update_deparment();
            });
            
            $('#printable').find('input[name="type_6l"]').on('click', function() {
                update_deparment();
            });
            
            $('#printable').find('input[name="type_7l"]').on('click', function() {
                update_deparment();
            });
            
            $('#printable').find('input[name="type_8l"]').on('click', function() {
                update_deparment();
            });
            
            $('#printable').find('input[name="type_9l"]').on('click', function() {
                update_deparment();
            });
            
            $('#printable').find('input[name="type_10l"]').on('click', function() {
                update_deparment();
            });
            
            $('#printable').find('input[name="type_11l"]').on('click', function() {
                update_deparment();
            });
            
            $('#printable').find('input[name="type_12l"]').on('click', function() {
                update_deparment();
            });

            $('#printable').find('input[name="type_13l"]').on('click', function() {
                update_deparment();
            });

            $('#printable').find('select[name="type_1r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('select[name="type_2r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('select[name="type_3r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('select[name="type_4r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('select[name="type_5r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('select[name="type_6r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('select[name="type_7r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('select[name="type_8r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('select[name="type_9r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('select[name="type_10r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('select[name="type_11r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('select[name="type_12r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('input[name="type_13r"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('input[name="vat_1"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('input[name="vat_2"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('input[name="po"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('input[name="invoice"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('input[name="bill"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('input[name="or"]').on('change', function() {
                update_deparment();
            });

            $('#printable').find('select[name="BANK_NAME"]').on('change', function() {
                $.ajax({
                    url: "./php/update_bank_name.php",
                    method: "POST",
                    data: {
                        id: window.localStorage.getItem('id'),
                        bank_name: $(this).val()
                    },
                    success: function (data) {
                        view();
                    }
                });
            });

            $('#printable').find('select[name="BANK_CODE"]').on('change', function() {
                $.ajax({
                    url: "./php/update_bank_code.php",
                    method: "POST",
                    data: {
                        id: window.localStorage.getItem('id'),
                        bank_code: $(this).val()
                    },
                    success: function (data) {
                        view();
                    }
                });
            });

            $('#printable').find('input[name="CHECK_NUMBER"]').on('change', function() {
                $.ajax({
                    url: "./php/update_check_number.php",
                    method: "POST",
                    data: {
                        id: window.localStorage.getItem('id'),
                        check_number: $(this).val()
                    },
                    success: function (data) {
                        view();
                    }
                });
            });

            $('#printable').find('select[name="bk_status"]').on('change', function() {
                status($(this).val());
            });

            $('#printable').find('select[name="acc_status"]').on('change', function() {
                status($(this).val());
            });

            $('#printable').find('select[name="fin_status"]').on('change', function() {
                status($(this).val());
            });

            $('#printable').find('select[name="aud_status"]').on('change', function() {
                status($(this).val());
            });

            if ($('#BANK_NAME').val() && $('#BANK_CODE').val() && $('#CHECK_NUMBER').val() && ($('#PAYMENT_TYPE').val() === 'CHECK')) {
                $('#check_writer').fadeIn('slow');
                ShowCanvas();
            }

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

            $('#requested_item_container').find('select[name="status"]').on('change', function() {
                update_requested_item();
            })

            $('#requested_item_container').find('textarea[name="remarks"]').on('change', function() {
                update_requested_item();
            })

            $('#requested_item_container').find("input[name='quantity']").on('input', function() {
                let unit_cost = $('#requested_item_container').find("input[name='unit_cost']").val();
                let quantity = $('#requested_item_container').find("input[name='quantity']").val();
                quantity = quantity.replace(/,/g, '');
                unit_cost = unit_cost.replace(/,/g, '');
                if (unit_cost.indexOf('₱') !== -1) {
                    unit_cost = unit_cost.substring(1);
                }
                let total = (quantity * unit_cost).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                if ($(this).val() <= 0) {
                    $(this).val('1');
                    $('#requested_item_container').find("input[name='total']").val('₱' + total);
                } else {
                    $('#requested_item_container').find("input[name='total']").val('₱' + total);
                }
            });

            $('#requested_item_container').find("input[name='quantity']").on('change', function() {
                update_requested_item();
            });

            $('#requested_item_container').find("input[name='unit_cost']").on('input', function() {
                let unit_cost = $('#requested_item_container').find("input[name='unit_cost']").val();
                let quantity = $('#requested_item_container').find("input[name='quantity']").val();
                quantity = quantity.replace(/,/g, '');
                unit_cost = unit_cost.replace(/,/g, '');
                if (unit_cost.indexOf('₱') !== -1) {
                    unit_cost = unit_cost.substring(1);
                }
                let total = (quantity * unit_cost).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                if (unit_cost <= 0) {
                    $(this).val('₱1.00');
                    $('#requested_item_container').find("input[name='total']").val('₱' + total);
                } else {
                    $('#requested_item_container').find("input[name='total']").val('₱' + total);
                }
            });

            $('#requested_item_container').find("input[name='unit_cost']").on('input', function() {
                update_requested_item();
            });

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

function update_requested_item() {
    var quantity = $('#requested_item_container').find("input[name='quantity']").val();
    var unit_cost = $('#requested_item_container').find("input[name='unit_cost']").val();
    var total = $('#requested_item_container').find("input[name='total']").val();
    var status = $('#requested_item_container').find("select[name='status']").val();
    var remarks = $('#requested_item_container').find("textarea[name='remarks']").val();
    var id = $('#requested_item_container').find("input[name='id']").val();

    if (quantity) {
        quantity = quantity.replace(/,/g, '');
    }

    if (unit_cost) {
        if (unit_cost.indexOf('₱') !== -1) {
            unit_cost = unit_cost.substring(1);
            unit_cost = unit_cost.replace(/,/g, '');
        }
    }
    
    if (total) {
        if (total.indexOf('₱') !== -1) {
            total = total.substring(1);
        }
    }
    
    $.ajax({
        url: "./php/update_requested_item.php",
        method: "POST",
        data: {
            id: id,
            status: status,
            remarks: remarks,
            quantity: quantity,
            unit_cost: unit_cost,
            total: total
        },
        success: function (data) {

            var audio = new Audio('src/sound/update_item.mp3');
            audio.play();
            view();

        }
    });
}

function update_deparment() {
    let Check = '';
    let Check2 = '';
    let Value = '';
    let Value2 = '';

    if ($('#printable').find("input[name='Low']:checked").length > 0) {
        Check2 += 'Low,';
    }

    if ($('#printable').find("input[name='Medium']:checked").length > 0) {
        Check2 += 'Medium,';
    }

    if ($('#printable').find("input[name='High']:checked").length > 0) {
        Check2 += 'High,';
    }

    if ($('#printable').find("input[name='Complete']:checked").length > 0) {
        Check2 += 'Complete,';
    }

    if ($('#printable').find("input[name='Incomplete']:checked").length > 0) {
        Check2 += 'Incomplete,';
    }

    if ($('#printable').find("input[name='Yes']:checked").length > 0) {
        Check2 += 'Yes,';
    }

    if ($('#printable').find("input[name='No']:checked").length > 0) {
        Check2 += 'No,';
    }

    if ($('#printable').find("input[name='With']:checked").length > 0) {
        Check2 += 'With,';
    }

    if ($('#printable').find("input[name='Without']:checked").length > 0) {
        Check2 += 'Without,';
    }

    if ($('#printable').find("input[name='OPEX']:checked").length > 0) {
        Check2 += 'OPEX,';
    }

    if ($('#printable').find("input[name='NON OPEX']:checked").length > 0) {
        Check2 += 'NON OPEX,';
    }

    if ($('#printable').find("input[name='Official Receipt VAT']:checked").length > 0) {
        Check2 += 'Official Receipt VAT,';
    }

    if ($('#printable').find("input[name='Delivery Receipt']:checked").length > 0) {
        Check2 += 'Delivery Receipt,';
    }

    if ($('#printable').find("input[name='None']:checked").length > 0) {
        Check2 += 'None,';
    }

    if ($('#printable').find("input[name='type_1l']:checked").length > 0) {
        Check += 'type_1l,';
    }

    if ($('#printable').find("input[name='type_2l']:checked").length > 0) {
        Check += 'type_2l,';
    }

    if ($('#printable').find("input[name='type_3l']:checked").length > 0) {
        Check += 'type_3l,';
    }

    if ($('#printable').find("input[name='type_4l']:checked").length > 0) {
        Check += 'type_4l,';
    }

    if ($('#printable').find("input[name='type_5l']:checked").length > 0) {
        Check += 'type_5l,';
    }

    if ($('#printable').find("input[name='type_6l']:checked").length > 0) {
        Check += 'type_6l,';
    }

    if ($('#printable').find("input[name='type_7l']:checked").length > 0) {
        Check += 'type_7l,'
    }

    if ($('#printable').find("input[name='type_8l']:checked").length > 0) {
        Check += 'type_8l,';
    }

    if ($('#printable').find("input[name='type_9l']:checked").length > 0) {
        Check += 'type_9l,';
    }

    if ($('#printable').find("input[name='type_10l']:checked").length > 0) {
        Check += 'type_10l,'
    }

    if ($('#printable').find("input[name='type_11l']:checked").length > 0) {
        Check += 'type_11l,';
    }

    if ($('#printable').find("input[name='type_12l']:checked").length > 0) {
        Check += 'type_12l,';
    }

    if ($('#printable').find("input[name='type_13l']:checked").length > 0) {
        Check += 'type_13l,';
    }

    if ($('#printable').find("input[name='Complete']:checked").length > 0) {
        Check += 'Complete,';
    }

    if ($('#printable').find("input[name='Incomplete']:checked").length > 0) {
        Check += 'Incomplete,';
    }

    if ($('#printable').find("input[name='Yes']:checked").length > 0) {
        Check += 'Yes,';
    }

    if ($('#printable').find("input[name='No']:checked").length > 0) {
        Check += 'No,';
    }

    Value += $('#printable').find("select[name='type_1r']").val() + '@';
    Value += $('#printable').find("select[name='type_2r']").val() + '@';
    Value += $('#printable').find("select[name='type_3r']").val() + '@';
    Value += $('#printable').find("select[name='type_4r']").val() + '@';
    Value += $('#printable').find("select[name='type_5r']").val() + '@';
    Value += $('#printable').find("select[name='type_6r']").val() + '@';
    Value += $('#printable').find("select[name='type_7r']").val() + '@';
    Value += $('#printable').find("select[name='type_8r']").val() + '@';
    Value += $('#printable').find("select[name='type_9r']").val() + '@';
    Value += $('#printable').find("select[name='type_10r']").val() + '@';
    Value += $('#printable').find("select[name='type_11r']").val() + '@';
    Value += $('#printable').find("select[name='type_12r']").val();

    Value2 += $('#printable').find("input[name='vat_1']").val() + ',';
    Value2 += $('#printable').find("input[name='vat_2']").val() + ',';
    Value2 += $('#printable').find("input[name='po']").val() + ',';
    Value2 += $('#printable').find("input[name='invoice']").val() + ',';
    Value2 += $('#printable').find("input[name='bill']").val() + ',';
    Value2 += $('#printable').find("input[name='or']").val() + ',';
    Value2 += $('#printable').find("input[name='type_13r']").val();

    $.ajax({
        url: "./php/update_department.php",
        method: "GET",
        data: {
            id: window.localStorage.getItem('id'),
            check: Check,
            check2: Check2,
            value: Value,
            value2: Value2
        },
        success: function (data) {
            view();
        }
    });
}

function ShowCanvas() {
    const canvas = new fabric.Canvas('canvas', { isDrawingMode: false });
    const canvasWidth = 8.66 * fabric.DPI;
    const canvasHeight = 4.33 * fabric.DPI;
    canvas.setWidth(canvasWidth);
    canvas.setHeight(canvasHeight);
    canvas.setBackgroundColor('white', canvas.renderAll.bind(canvas));

    const bank = $('#BANK_NAME').val();
    let backgroundImageSrc = '';

    switch (bank) {
        case 'SECURITY BANK':
            backgroundImageSrc = 'src/cheque/security_bank_gti.jpg';
            break;
        case 'METRO BANK':
            backgroundImageSrc = 'src/cheque/metro_bank_gti.jpg';
            break;
        case 'BDO':
            backgroundImageSrc = 'src/cheque/bdo_nov.jpg';
            break;
        case 'AUB':
            backgroundImageSrc = 'src/cheque/aub_bsm.jpg';
            break;
        default:
            backgroundImageSrc = 'src/cheque/bdo_nov.jpg';
            break;
    }

    fabric.Image.fromURL(backgroundImageSrc, function(img) {
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
    });

    var number = $('#NUMBER').val() + 'xxx';

    const pesonumber = new fabric.Text(number, {
        left: (canvas.width * 0.71),
        top: (canvas.height * 0.26),
        fontSize: 12,
        fontFamily: 'Arial',
        fill: 'black',
        fontWeight: 'bold'
    });

    var word = '***' + $('#WORD').val() + '***';

    const pesoword = new fabric.Text(word, {
        left: (canvas.width * 0.1),
        top: (canvas.height * 0.37),
        fontSize: 12,
        fontFamily: 'Arial',
        fill: 'black',
        fontWeight: 'bold'
    });

    var paid_to = '***' + $('#PAID_TO').val() + '***';

    const check_paid_to = new fabric.Text(paid_to, {
        left: (canvas.width * 0.14),
        top: (canvas.height * 0.27),
        fontSize: 12,
        fontFamily: 'Arial',
        fill: 'black',
        fontWeight: 'bold'
    });

    var stamp = $('#STAMP').val();
    stamp = stamp.replace(/\\n/g, '\n');

    var lines = stamp.split('\n');

    var topPosition = canvas.height * 0.58;
    var lineHeight = 25;

    var textObjects = lines.map(function(line, index) {
        var text = new fabric.Text(line, {
            left: canvas.width * 0.35,
            top: topPosition + index * lineHeight,
            fontSize: 12,
            fontFamily: 'Arial',
            fill: 'red',
            fontWeight: 'bold'
        });
        return text;
    });

    textObjects.forEach(function(obj) {
        canvas.add(obj);
    });

    canvas.add(pesonumber, pesoword, check_paid_to);
    
    $('#check_writer').find('input[name="date"]').on('input', function() {
        var date = $('#check_writer').find('input[name="date"]').val();
        var arrange = date.split('-');
        var [part_one1, part_one2] = arrange[1].split('');
        var [part_one3, part_one4] = arrange[2].split('');
        var [part_one5, part_one6, part_one7, part_one8,] = arrange[0].split('');
        var formatDate = part_one1 + ' ' + part_one2 + '      ' + part_one3 + ' ' + part_one4 + '       ' + part_one5 + ' ' + part_one6 + ' ' + part_one7 + ' ' + part_one8;

        const textObjects = canvas.getObjects('text');

        if (textObjects.length > 6) {
            const lastIndex = textObjects.length - 1;
            const lastTextObject = textObjects[lastIndex];
            canvas.remove(lastTextObject);
        }

        const text = new fabric.Text(formatDate, {
            left: (canvas.width * 0.745),
            top: (canvas.height * 0.15),
            fontSize: 12,
            fontFamily: 'Arial',
            fill: 'black',
            fontWeight: 'bold'
        });

        canvas.add(text);
    })

    $('#check_writer').find('#check_writer_generate').on('click', function() {
        $('#generated_check_container').fadeIn('slow');
        canvas.setBackgroundImage(null, canvas.renderAll.bind(canvas));
        $('#generated_check').attr('src', canvas.toDataURL('image/png', 1.0));
        const bank = $('#BANK_NAME').val();
        let backgroundImageSrc = '';

        switch (bank) {
            case 'SECURITY BANK':
                backgroundImageSrc = 'src/cheque/security_bank_gti.jpg';
                break;
            case 'METRO BANK':
                backgroundImageSrc = 'src/cheque/metro_bank_gti.jpg';
                break;
            case 'BDO':
                backgroundImageSrc = 'src/cheque/bdo_nov.jpg';
                break;
            case 'AUB':
                backgroundImageSrc = 'src/cheque/aub_bsm.jpg';
                break;
            default:
                backgroundImageSrc = 'src/cheque/bdo_nov.jpg';
                break;
        }

        fabric.Image.fromURL(backgroundImageSrc, function(img) {
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
        });
    })
}

function download_check() {
    var element = document.getElementById('generated_check');
    html2pdf(element, {
        margin: 0,
        filename: 'CHECK_'+ $('#REFERENCE').val() +'.pdf',
        image: { type: 'jpg', quality: 1.0 },
        html2canvas: { scale: 1 },
        jsPDF: { 
            unit: 'mm', 
            format: 'dl', 
            orientation: 'landscape',
        },
        pagebreak: { mode: 'avoid-all' },
        html2pdf: {
            margin: 0,
            jsPDF: { 
                unit: 'mm', 
                format: 'dl', 
                orientation: 'landscape',
            }
        },
    });

    $.ajax({
        url: "./php/add_log.php",
        method: "GET",
        data: {
            id: window.localStorage.getItem('id')
        },
        success: function (data) {
            
        }
    });
}

function status(data) {
    if (confirm("Are you sure that you want to change the status of this request?") === true) {
        var status = data;
        $.ajax({
            url: "./php/update_role_status.php",
            method: "GET",
            data: {
                id: window.localStorage.getItem('id'),
                status: status
            },
            success: function (data) {

                $.ajax({
                    url: "./php/send_notification.php",
                    method: "POST",
                    data: {
                        id: window.localStorage.getItem('id'),
                        message: data,
                        type: 'status'
                    },
                    success: function (data) {

                        if (status === 'Approve') {
                            var audio = new Audio('src/sound/request_approved.mp3');
                            audio.addEventListener('canplaythrough', function() {
                                audio.play();
                            });

                            audio.addEventListener('ended', function() {
                                window.history.back();
                            });
                        } else if (status === 'Disapprove') {
                            var audio = new Audio('src/sound/request_disapproved.mp3');
                            audio.play();
                            view();
                        } else {
                            view();
                        }
                        
                    }
                });

            }
        });
    }
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