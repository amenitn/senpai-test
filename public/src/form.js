jQuery(document).ready(function ($) {

    $('#submit').on('click', function () {
        event.preventDefault();
        let name = $('#name').val();
        let email = $('#email').val();
        let phone = $('#phone').val();
        let message = $('#message').val();

        let settings = {
            "url": senpai_form_ajax_params.ajaxurl,
            "method": "POST",
            "data": {
                "nonce": senpai_form_ajax_params.nonce,
                "action": "senpai_public_form_ajax",
                "name": name,   
                "email": email,
                "phone": phone,
                "message": message,
            }
        }
        $.ajax(settings).done(function (response) {
           
        });
    });
    document.getElementById('myForm_public').reset();
    window.location.reload();
});