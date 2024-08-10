$(function() {
    $('#signin_form').find('input[name="email"]').focus();

    document.addEventListener('keydown', function(event) {
        const audio = new Audio('src/sound/type_any_key.mp3');
        audio.play();
    });
});

$('#signin_form').find('input[name="email"]').on('input', function() {
    if ($(this).val().trim() !== '') {

    	$('#wrong-email').css({
    		'visibility': 'hidden'
    	});

        $(this).siblings('span').css({
            'transform': 'translateX(-10px) translateY(-25px)',
            'padding': '1px 6px',
            'background': '#fff',
            'letter-spacing': '0em',
            'border': '1px solid #000'
        });
    } else {
        $(this).siblings('span').css({
            'transform': '',
            'padding': '',
            'background': '',
            'letter-spacing': '',
            'border': ''
        });
    }
});

$('#signin_form').find('input[name="password"]').on('input', function() {
    if ($(this).val().trim() !== '') {

    	$('#wrong-password').css({
    		'visibility': 'hidden'
    	});

        $(this).siblings('span').css({
            'transform': 'translateX(-10px) translateY(-25px)',
            'padding': '1px 6px',
            'background': '#fff',
            'letter-spacing': '0em',
            'border': '1px solid #000'
        });
    } else {
        $(this).siblings('span').css({
            'transform': '',
            'padding': '',
            'background': '',
            'letter-spacing': '',
            'border': ''
        });
    }
});

function encryptData(message, key) {
    
    const keyUtf8 = CryptoJS.enc.Utf8.parse(key.padEnd(32, ' '));
    const iv = CryptoJS.lib.WordArray.random(16);
    const encrypted = CryptoJS.AES.encrypt(message, keyUtf8, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    });

    return {
        iv: CryptoJS.enc.Base64.stringify(iv),
        ciphertext: encrypted.toString()
    };
}

$('#signin_form').on('submit', function(event) {
    event.preventDefault();

    var email = $(this).find('input[name="email"]').val();
    var password = $(this).find('input[name="password"]').val();
    var key = 'tiramisucakejocelynMhelvoi072024';

    const encryptedPassword = encryptData(password, key);

    $.ajax({
        url: "./php/login.php",
        method: "POST",
        data: {
            email: email,
            iv: encryptedPassword.iv,
            password: encryptedPassword.ciphertext
        },
        success: function (data) {
            data = data.trim();

            let soundFile = '';
            let showError = false;

            switch (data) {
                case 'EMAIL':
                    soundFile = 'src/sound/wrong_email.mp3';
                    $('#wrong-email').css('visibility', 'visible');
                    break;
                case 'PASSWORD':
                    soundFile = 'src/sound/wrong_password.mp3';
                    $('#wrong-password').css('visibility', 'visible');
                    break;
                case 'SUCCESS':
                    soundFile = 'src/sound/welcome.mp3';
                    break;
                default:
                    soundFile = 'src/sound/unexpected_error.mp3';
                    $('#wrong-email').css('visibility', 'visible');
                    $('#wrong-password').css('visibility', 'visible');
                    break;
            }

            if (soundFile) {
                var audio = new Audio(soundFile);
                audio.addEventListener('canplaythrough', function() {
                    audio.play();
                });

                if (data === 'SUCCESS') {
                    audio.addEventListener('ended', function() {
                        window.localStorage.removeItem('verified');
                        window.location.href = "security.php";
                    });
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            var audio = new Audio('src/sound/unexpected_error.mp3');
            audio.addEventListener('canplaythrough', function() {
                audio.play();
            });
        }
    });
});

$('#username_span').on('click, mouseover', function() {
    $('#signin_form').find('input[name="email"]').focus();
})

$('#password_span').on('click, mouseover', function() {
    $('#signin_form').find('input[name="password"]').focus();
})

$('#signin_form').find('input[name="password"]').on('mouseover', function() {
    $(this).focus();
})

$('#signin_form').find('input[name="email"]').on('mouseover', function() {
    $(this).focus();
})

function toggle_password(element) {
    var icon = $(element);
    if (icon.hasClass('far fa-eye')) {
        icon.removeClass('far fa-eye').addClass('fas fa-eye-slash');
        $(element).prev('input').attr('type', 'text');
    } else {
        icon.removeClass('fas fa-eye-slash').addClass('far fa-eye');
        $(element).prev('input').attr('type', 'password');
    }
}