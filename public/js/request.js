const uploadImageForm = document.querySelector('#requestItemImageForm');
const uploadImageInput = document.querySelector('#requestItemImageInput');
const uploadImageItemId = document.querySelector('#requestItemImageId');

$(window).on('load', function() {
    $(".loader").fadeOut('slow');
    show_request_cart();
});


function show_request_cart() {
    $.ajax({
        url: "/api/request-item",
        method: "GET",
        success: function (data) {
            data = data.trim();
            $('#request_cart').html(data);
            show_total();
        }
    });
}


function edit_request_cart(data) {
    if (data) {
        $.ajax({
            url: `/api/request-item/${data}`,
            method: "GET",
            success: function (data) {
                console.log(data);
                // data = data.trim();
                // var detail = data.split("@");

                $('#request_items').find("input[name='qty']").val(data.item.quantity);
                $('#request_items').find("select[name='uom']").val(data.item.measurement_id);
                $('#request_items').find("select[name='job_order']").val(data.item.job_order_id);
                $('#request_items').find("input[name='description']").val(data.item.description);
                $('#request_items').find("input[name='unit_cost']").val(data.item.cost);
                $('#request_items').find("input[name='id']").val(data.item.id);
                $('#request_items').find("input[name='total']").val(data.item.total);

                uploadImageItemId.value = data.item.id;

                document.querySelector('#add_image').classList.toggle('d-none');

                // $('#request_items').find('#add_image').fadeIn('slow');

                // for (var i = 7; i < detail.length; i++) {
                //     const thumbnail = $('<div>').append(
                //         $('<img>').attr('src', detail[i]).addClass('uploaded-img')
                //     );
                //     $('#image_container').append(thumbnail);
                // }

                $('#request_items').find("button[name='update']").prop('disabled', false);
                $('#request_items').find("button[name='delete']").prop('disabled', false);
                
                $('#request_items').find('#uploaded_image').fadeIn('slow');
            }
        });
    }
}

function show_total() {

    $.ajax({
        url: "/api/request-item/total",
        method: "GET",
        dataType: 'json',
        success: function (data) {

            console.log(data);
            
            $('#final_request').find("input[name='total']").val(data.total);
        }
    });
}

$('#request_items').find("input[name='qty']").on('input', function() {
    if ($(this).val() <= 0) {
        $(this).val('1');
    } else {
        $('#request_items').find("input[name='total']").val($(this).val() * $('#request_items').find("input[name='unit_cost']").val());
    }
});

$('#request_items').find("input[name='unit_cost']").on('input', function() {
    if ($(this).val() <= 0) {
        $(this).val('1');
    } else {
        $('#request_items').find("input[name='total']").val($(this).val() * $('#request_items').find("input[name='qty']").val());
        if ($('#request_items').find("input[name='total']").val() > 0) {
            if ($('#request_items').find("input[name='id']").val()) {
                $('#request_items').find("button[name='add']").prop('disabled', true);
            } else {
                $('#request_items').find("button[name='add']").prop('disabled', false);
            }
        } else {
            $('#request_items').find("button[name='add']").prop('disabled', true);
        }
    }
})

$('#request_items').find("input[name='description']", "input[name='qyt']", "input[name='unit_cost']").on('input', function() {
    if ($('#request_items').find("input[name='total']").val() > 0 && $('#request_items').find("input[name='description']").val()) {
        if ($('#request_items').find("input[name='id']").val()) {
            $('#request_items').find("button[name='add']").prop('disabled', true);
        } else {
            $('#request_items').find("button[name='add']").prop('disabled', false);
        }
    } else {
        $('#request_items').find("button[name='add']").prop('disabled', true);
    }
})

$('#request_items').find("button[name='add']").on('click', function() {
    $.ajax({
        url: "/api/request-item",
        method: "POST",
        data: {
            quantity: $('#request_items').find("input[name='qty']").val(),
            measurement: $('#request_items').find("select[name='uom']").val(),
            jobOrder: $('#request_items').find("select[name='job_order']").val(),
            description: $('#request_items').find("input[name='description']").val(),
            cost: $('#request_items').find("input[name='unit_cost']").val(),
        },
        success: function (data) {
            $('#request_items').find("input[name='qty']").val('');
            $('#request_items').find("input[name='description']").val('');
            $('#request_items').find("input[name='unit_cost']").val('');
            $('#request_items').find("input[name='total']").val('');
            $('#request_items').find("button[name='add']").prop('disabled', true);

            // var audio = new Audio('src/sound/item_added.mp3');
            // audio.play();
            show_request_cart();
        }
    });
})

$('#request_items').find("button[name='unselect']").on('click', function() {
    var audio = new Audio('src/sound/item_unselected.mp3');
    audio.play();
    $('#request_items').find("input[name='qty']").val('');
    $('#request_items').find("input[name='description']").val('');
    $('#request_items').find("input[name='unit_cost']").val('');
    $('#request_items').find("input[name='total']").val('');
    $('#request_items').find("input[name='id']").val('');
    $('#request_items').find("button[name='add']").prop('disabled', true);
    $('#request_items').find("button[name='update']").prop('disabled', true);
    $('#request_items').find("button[name='delete']").prop('disabled', true);
    $('#request_items').find('#add_item').fadeIn('slow');
    $('#request_items').find('#add_image').hide();
    $('#request_items').find("input[name='image']").val('');
    $('#request_items').find('#uploaded_image').hide();
    $('#image_container').empty();
})

$('#request_items').find("button[name='delete']").on('click', function() {
    $.ajax({
        url: `/api/request-item/${$('#request_items').find("input[name='id']").val()}`,
        method: "DELETE",
        success: function (data) {
            $('#request_items').find("input[name='qty']").val('');
            $('#request_items').find("input[name='description']").val('');
            $('#request_items').find("input[name='unit_cost']").val('');
            $('#request_items').find("input[name='total']").val('');
            $('#request_items').find("input[name='id']").val('');
            $('#request_items').find("button[name='add']").prop('disabled', true);
            $('#request_items').find("button[name='update']").prop('disabled', true);
            $('#request_items').find("button[name='delete']").prop('disabled', true);
            $('#request_items').find('#add_item').fadeIn('slow');
            $('#request_items').find('#add_image').hide();
            $('#request_items').find("input[name='image']").val('');
            $('#request_items').find('#uploaded_image').hide();
            $('#image_container').empty();
            
            // var audio = new Audio('src/sound/item_deleted.mp3');
            // audio.play();
            show_request_cart();

        }
    });
})


uploadImageInput.addEventListener('change',async ()=>{

    let formData = new FormData(uploadImageForm);

    try{
        let result = await fetch(`/api/request-item/file`,{
            method: "POST",
            body: formData,
        })

        if(result.ok){

            let files = await result.json();

            console.log(files);

            files.images.forEach(src => {

                let imageSrc = (src.split('/'))[1];

                const thumbnail = $('<div>').append($('<img>').attr('src', '/storage/' + imageSrc).addClass('uploaded-img imageModal'));
                $('#image_container').append(thumbnail);
            });
            
            reloadImageModal();
        }
    }catch(error){
        console.error('item file upload failed!')
    }finally{
        uploadImageInput.value = null;
    }

})



let new_logo;

// $('#request_items').find("input[name='image']").on('change', function(e) {
    
//     const files = e.target.files; // Assuming e.target.files is a FileList
//     if (files && files.length > 0) {
//         for (let i = 0; i < files.length; i++) {
//             const file = files[i];
//             const reader = new FileReader();
//             reader.onload = function (event) {
//                 const fileUrl = event.target.result;
//                 const FileDataWithoutPrefix = fileUrl.split(',')[1];
//                 const mime = file.type;
//                 $.ajax({
//                     url: "./php/add_temp_image.php",
//                     method: "POST",
//                     data: {
//                         File: FileDataWithoutPrefix,
//                         Mime: mime
//                     },
//                     success: function (data) {
//                         if (data) {
//                             if (new_logo) {
//                                 new_logo =  new_logo + '@' + data;
//                             } else {
//                                 new_logo =  data;
//                             }

//                             const thumbnail = $('<div>').append(
//                                 $('<img>').attr('src', data).addClass('uploaded-img')
//                             );
//                             $('#image_container').append(thumbnail);
//                         }
//                     }
//                 });
//             };
//             reader.readAsDataURL(file);
//         }
//     }
// })

$('#request_items').find("button[name='update']").on('click', function() {
    $.ajax({
        url: `/api/request-item/${$('#request_items').find("input[name='id']").val()}`,
        method: "PUT",
        data: {

            quantity: $('#request_items').find("input[name='qty']").val(),
            measurement: $('#request_items').find("select[name='uom']").val(),
            jobOrder: $('#request_items').find("select[name='job_order']").val(),
            description: $('#request_items').find("input[name='description']").val(),
            cost: $('#request_items').find("input[name='unit_cost']").val(),
        },
        success: function (data) {
            
            $('#request_items').find("input[name='qty']").val('');
            $('#request_items').find("input[name='description']").val('');
            $('#request_items').find("input[name='unit_cost']").val('');
            $('#request_items').find("input[name='total']").val('');
            $('#request_items').find("input[name='id']").val('');
            $('#request_items').find("button[name='add']").prop('disabled', true);
            $('#request_items').find("button[name='update']").prop('disabled', true);
            $('#request_items').find("button[name='delete']").prop('disabled', true);
            $('#request_items').find('#add_item').fadeIn('slow');
            $('#request_items').find('#add_image').hide();
            $('#request_items').find("input[name='image']").val('');
            $('#request_items').find('#uploaded_image').hide();
            $('#image_container').empty();

            new_logo = '';
            
            // var audio = new Audio('src/sound/item_updated.mp3');
            // audio.play();
            show_request_cart();

        }
    });
})



$('#final_request').find("button[name='submit']").on('click', function() {
  
    let company = $("input[name='checkbox']:checked").val();
    let supplier = $('#request_details').find("input[name='supplier']").val();
    let paidTo = $('#request_details').find("input[name='paid_to']").val();
    let requestedBy  = $('#request_details').find("input[name='requested_by']").val();
    let priorityLevel  = $('#request_details').find("input[name='priority_level']").val();
    let priority  = $('#request_details').find("input[name='priority']").val();

    let formData = new FormData();

    formData.append('company', company);
    formData.append('supplier', supplier);
    formData.append('paidTo', paidTo);
    formData.append('requestedBy', requestedBy);
    // formData.append('priorityLevel', priorityLevel.value);
    // formData.append('priority', priority.value);

    // for (var pair of formData.entries()) {
    //     console.log(pair[0]+ ', ' + pair[1]); 
    // }
    fetch('/request',{
        method: 'POST',
        body: formData,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    }).then(data =>{
        if(data.ok){
            return data.json();
        }
    }).then(data =>{
        console.log(data);
        speek('item has been added');
    }).catch(error => {
        console.log(error)
    })
    
    // if ($("input[name='checkbox']:checked").length > 0) {
    //     if (requested_by) {
    //         if (total) {
    //             $.ajax({
    //                 url: "./php/add_final_request.php",
    //                 method: "POST",
    //                 data: {
    //                     supplier: supplier,
    //                     paid_to: paid_to,
    //                     requested_by: requested_by,
    //                     entity: entity,
    //                     total: total,
    //                     priority: priority,
    //                     check2: Check2
    //                 },
    //                 success: function (data) {
    //                     $(".loader").show();
    //                     $.ajax({
    //                         url: "./php/send_notification.php",
    //                         method: "POST",
    //                         data: {
    //                             priority: priority,
    //                             type: 'request'
    //                         },
    //                         success: function (data) {

    //                             var audio = new Audio('src/sound/request_successful.mp3');

    //                             audio.addEventListener('canplaythrough', function() {
    //                                 audio.play();
    //                             });

    //                             audio.addEventListener('ended', function() {
    //                                 window.location.href = 'my_request.php';
    //                             });
                                
    //                         }
    //                     });

                        
    //                 }
    //             });

    //         } else {
    //             var audio = new Audio('src/sound/add_items.mp3');

    //             audio.addEventListener('canplaythrough', function() {
    //                 audio.play();
    //                 alert('Please add items that you would like to request before submitting.');
    //             });

    //             audio.addEventListener('ended', function() {
    //                 return;
    //             });
    //         }

    //     } else {
    //         $('html, body').animate(
    //             {
    //                 scrollTop: 0
    //             },
    //             500,
    //             'linear'
    //         );

    //         var audio = new Audio('src/sound/requested_by.mp3');

    //         audio.addEventListener('canplaythrough', function() {
    //             audio.play();
    //             alert('Please fill up the requested by field before submitting.');
    //         });

    //         audio.addEventListener('ended', function() {
    //             return;
    //         });
    //     }
    // } else {
    //     $('html, body').animate(
    //         {
    //             scrollTop: 0
    //         },
    //         500,
    //         'linear'
    //     );

    //     var audio = new Audio('src/sound/add_entity.mp3');

    //     audio.addEventListener('canplaythrough', function() {
    //         audio.play();
    //         alert('Please select an entity before submitting.');
    //     });

    //     audio.addEventListener('ended', function() {
    //         return;
    //     });
        
    // }
    
})

$('#final_request').find('input[name="priority"]').on('click', function() {
    if ($(this).prop('checked') === true) {
        if (confirm('By checking this, the request would be prioritize and managed by VP Finance. Do you wish to continue?')) {
            $(this).prop('checked', true);
        } else {
            $(this).prop('checked', false);
        }
    }
})