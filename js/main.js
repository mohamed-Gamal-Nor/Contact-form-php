$(function() {
    "use strict";
    let userError = true,
        emailError = true,
        phoneError = true,
        msgError = true;

    function badResult(element) {
        element
            .css("border", "1px solid #f00")
            .parent()
            .find(".custom-alert")
            .fadeIn(200)
            .end()
            .find(".astrisx")
            .text("*");
    }

    function goodResult(element) {
        element
            .css("border", "1px solid #080")
            .parent()
            .find(".custom-alert")
            .fadeOut(200)
            .end()
            .find(".astrisx")
            .text("")
            .append('<i class="fas fa-check"></i>');
    }
    $(".username").blur(function() {
        if ($(this).val().length < 4) {
            badResult($(this));
            userError = true;
        } else {
            goodResult($(this));
            userError = false;
        }
    });
    $(".email").blur(function() {
        if ($(this).val() === "") {
            badResult($(this));
            emailError = true;
        } else {
            goodResult($(this));
            emailError = false;
        }
    });
    $(".phone").blur(function() {
        if ($(this).val() === "") {
            badResult($(this));
            phoneError = true;
        } else {
            goodResult($(this));
            phoneError = false;
        }
    });
    $(".message").blur(function() {
        if ($(this).val().length < 11) {
            badResult($(this));
            msgError = true;
        } else {
            goodResult($(this));
            msgError = false;
        }
    });
    $(".contact-form").submit(function(e) {
        if (
            userError === true ||
            emailError === true ||
            msgError === true ||
            phoneError === true
        ) {
            e.preventDefault();
            $(".username, .email,.phone,.message").blur();
        } else {}
    });
});