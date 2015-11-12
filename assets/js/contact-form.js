(function ($) {

    "use strict";

    $("#contact").validate();

    /* =================================
    ===  CONTACT FORM               ====
    =================================== */
    $("#contact").submit(function (e) {
        e.preventDefault();
        var name = $("#form-name").val();
        var email = $("#form-email").val();
        var subject = $("#form-subject").val();
        var message = $("#form-message").val();

        function validEmail(emailAddress) {
            var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
            return pattern.test(emailAddress);
        };



        if (validEmail(email) && (message.length > 1) && (name.length > 1)) {
            /*
            $.ajax({
                type: "POST",
                url: "contact.php",
                data: $('#contact').serialize(),
                success: function (data) {
                    console.log(data);

                }
            });
            //*/

            $.post("contact.php", $('#contact').serialize(), function( data ) {
            })
              .success(function(data){
                if(data[0]['status'] == "success"){
                  $('.errorContent').fadeOut(500);
                  $('.successContent').fadeIn(1000);
                  $('#contact')[0].reset();
                  grecaptcha.reset();
                } else {
                  $('.errorContent').fadeIn(1000);
                  $('.successContent').fadeOut(500);
                  grecaptcha.reset();
                }
              })
              .fail(function(data){
                $('.errorContent').fadeIn(1000);
                $('.successContent').fadeOut(500);
                grecaptcha.reset();
              })
              .always(function(data){
                if(data[0]['status'] == "success"){
                  console.log(data[0]['response']);
                } else {
                  console.error(data[0]['response']);
                }
              });

        } else {
            $('.errorContent').fadeIn(1000);
            $('.successContent').fadeOut(500);
        }
        return false;
    });




})(jQuery);
