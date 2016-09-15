$(document).ready(function () {


    $('#burger').on('click', function (e) {
        e.stopPropagation();
        if (window.innerWidth < 768) {
            $('#header #nav').slideToggle('slow');
        }
    });
    $('#header li').on('click', function (e) {
        if ($(this).has('li')) {
            e.stopPropagation();
        }
    });
    $(document).on('click', function () {
        if (window.innerWidth < 768) {
            if ($('#header #nav').is(':visible')) {
                $('#header #nav').slideUp('slow');
            }
        }
    });
});

window.addEventListener("resize", function () {

    if (window.innerWidth >= 768) {
        $('#header #nav').show();
    } else {
        $('#header #nav').hide();
    }
    
}, false);