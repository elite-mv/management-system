$(function() {
    setInterval(get_comment, 1500);
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

function get_comment() {
    $.ajax({
        url: "./php/get_group_message.php",
        method: "GET",
        success: function (data) {
            $('#chat_box_container').html(data);
        }
    });
}

$('#comment-form').on('submit', function(event) {
    event.preventDefault();
    const message = $('textarea[name="message"]').val();

    $.ajax({
        url: "./php/add_group_message.php",
        method: "POST",
        data: {
            message: message
        },
        success: function (data) {
            $('textarea[name="message"]').val('');
            get_comment();

            $.ajax({
                url: "./php/send_notification.php",
                method: "POST",
                data: {
                    message: data,
                    type: 'group'
                },
                success: function (data) {

                }
            });
        }
    });
})