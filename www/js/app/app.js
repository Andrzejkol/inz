function validateMail() {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var address = $('#newsletter_email').val();
    if (reg.test(address) == false) {
        alert('Proszę wpisać poprawny adres email');
        return false;
    }
    if (document.getElementById('subscribe').checked == false && document.getElementById('unsubscribe').checked == false) {
        alert('Proszę zaznaczyć jedną z opcji');
        return false;
    }
    return true;
}

function setCookie(c_name, value, exdays)
{
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
    document.cookie = c_name + "=" + c_value;
}
function getCookie(c_name)
{
    var i, x, y, ARRcookies = document.cookie.split(";");
    for (i = 0; i < ARRcookies.length; i++)
    {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name)
        {
            return unescape(y);
        }
    }
}

$(document).ready(function () {


    if (getCookie("cookiechecked") == "set") {
        jQuery("#cookie-policy-banner").remove();
        //fadeOut('slow');
    }
    else {
        jQuery("#cookie-policy-banner").slideDown('slow');
    }

    $('#social .facebook').hover(function () {
        $(this).stop().animate({right: '0px'}, 500);
    }, function () {
        $(this).stop().animate({right: '-292px'}, 500);
    });

    jQuery('#cclose').click(function () {
        jQuery("#cookie-policy-banner").slideUp('slow');//fadeOut('slow');
        setCookie("cookiechecked", "set", 365);
    });

    $('.bxslider').bxSlider({
        auto: true,
        speed: 900,
        pause: 6000,
        controls: false
    });

    $('.gallery-slider').bxSlider({
        controls: true,
        infiniteLoop: true,
        responsive: true,
        pager: false,
        maxSlides: 4,
        minSlides: 4,
        moveSlides: 1,
        slideWidth: 210,
        slideMargin: 10
    });

    // drukowanie
    $('#print').click(function () {
        window.print();
        return false;
    });

    // Ladowanie prettyPhoto
    $('a[rel^="prettyPhoto[]"]').prettyPhoto({social_tools: false, show_title: false});
    $('a[rel^="prettyPhoto"]').prettyPhoto({social_tools: false, show_title: false});

    // wstecz
    $('.back').click(function () {
        history.go(-1);
    });


});

