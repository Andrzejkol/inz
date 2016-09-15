if (getCookie("cookieclicked") == "set") {
        $('.popup-element.popup-hide .popup-button').animate({
            right: $('.popup-button').innerHeight() / 2 + 'px'
        });
    }
    $('.popup-element .popup-button').css('top',$('#slider').offset().top+$('.popup-button').outerHeight()+6);
    
    $('.popup-element .popup-button').click(function (e) {
        e.stopPropagation();
        $('.popup-element.popup-hide .popup-button').animate({
            right: -$('.popup-button').innerHeight() / 2 + 'px'
        });
        $(this).parents('.popup-element').removeClass('popup-hide');
        $('.popup-element .popup-wrapper').animate({
            right: '0px',
            opacity: '1'
        }, 500, function () {
            
        });
    });

    $('.popup-element').click(function (e) {
        e.stopPropagation();
        if (getCookie("cookieclicked") != "set") {
            setCookie("cookieclicked", "set", 1);
        }
        if (e.target !== this)
            return;

        $('.popup-element .popup-wrapper').animate({
            right: '-300%',
            opacity: '0'
        }, 500, function () {

            $(this).parents('.popup-element').addClass('popup-hide');
            $('.popup-element.popup-hide .popup-button').animate({
                right: $('.popup-button').innerHeight() / 2 + 'px'
            });
        });


    });
    $('.popup-element .popup-wrapper .popup-close').click(function (e) {
        e.stopPropagation();
        if (getCookie("cookieclicked") != "set") {
            setCookie("cookieclicked", "set", 1);
        }

        $('.popup-element .popup-wrapper').animate({
            right: '-300%',
            opacity: '0'
        }, 500, function () {
            $(this).parents('.popup-element').addClass('popup-hide');
            $('.popup-element.popup-hide .popup-button').animate({
                right: $('.popup-button').innerHeight() / 2 + 'px'
            });
        });
    });