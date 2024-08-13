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