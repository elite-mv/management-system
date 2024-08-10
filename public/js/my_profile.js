$(function() {
    get_profile();
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

function get_profile() {
    $.ajax({
        url: "./php/get_my_profile.php",
        method: "GET",
        success: function (data) {
            data = data.trim();
            $("#profile_container").html(data);

            $('#username').on('click', function() {
                const username = $("#profile_container").find('input[name="username"]').val();

                $.ajax({
                    url: "./php/update_username.php",
                    method: "GET",
                    data:{
                        username: username
                    },
                    success: function (data) {
                        $("#profile_container").find('input[name="username"]').val('');
                        window.location.href = 'my_profile.php';
                    }
                });
            })

            $('#password').on('submit', function(event) {
                event.preventDefault();
                const password = $("#profile_container").find('input[name="password"]').val();
                const confirm_password = $("#profile_container").find('input[name="confirm_password"]').val();

                if (password !== confirm_password) {
                    alert('Password and Confirm Password does not match.');
                    $("#profile_container").find('input[name="confirm_password"]').val('');
                    return;
                }

                $.ajax({
                    url: "./php/update_password.php",
                    method: "GET",
                    data:{
                        password: password
                    },
                    success: function (data) {
                        $("#profile_container").find('input[name="password"]').val('');
                        $("#profile_container").find('input[name="confirm_password"]').val('');
                        window.location.href = 'my_profile.php';
                    }
                });
            })
        }
    });
}