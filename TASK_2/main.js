$('.success-msg').hide();

$('.invalid-feedback').hide();

$(':button[type="submit"]').prop('disabled', true);

$("#email").keyup(function () {

    if (validateNoEmail()) {
        $('#no-email-error').show();
    } else {
        $('#no-email-error').hide();
    }

    if (validateEmailRegex()) {
        $('#invalid-email-error').show();
    } else {
        $('#invalid-email-error').hide();
    }

    if (validateColombiaEmail()) {
        $('#colombia-email-error').show();
    } else {
        $('#colombia-email-error').hide();
    }

    buttonState();
});

$('#terms').click(function () {

    if (validateTos()) {
        $('#tos-error').show();
    } else {
        $('#tos-error').hide();
    }

    buttonState();
});

function buttonState() {
    if (!validateNoEmail() && !validateEmailRegex() && !validateColombiaEmail() && !validateTos()) {
        $(':button[type="submit"]').prop('disabled', false);
    } else {
        $(':button[type="submit"]').prop('disabled', true);
    }
}

function validateNoEmail() {
    if ($('#email').val() === '') {
        return true;
    } else {
        return false;
    }
}

function validateEmailRegex() {
    var emailRegex = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
    // var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

    if (!emailRegex.test($('#email').val())) {
        return true;
    } else {
        return false;
    }
}

function validateColombiaEmail() {
    var domain = $('#email').val().slice(-3);
    if (domain === '.co') {
        return true;
    } else {
        return false;
    }
}

function validateTos() {
    if ($('#terms').prop('checked') === false) {
        return true;
    } else {
        return false;
    }
}

$('.needs-validation').submit(function (event) {
    $('.main-heading').hide();
    $('.main-subheading').hide();
    $('.subscribtion-form').hide();
    $('.h-line').hide();
    $('.social-media-ic').hide();
    $('.success-msg').show();
    event.preventDefault();
});