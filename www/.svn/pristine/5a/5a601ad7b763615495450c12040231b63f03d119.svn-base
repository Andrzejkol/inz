function GetAjax(DataString, ControllerLink, OutputId) {
    try {
        $.ajax({
            type: "POST",
            url: urlBase + ControllerLink,
            data: DataString,
            async: true,
            success: function (serverResponse) {
                if (OutputId != null) {
                    $(OutputId).html(serverResponse);
                }
                return true;
            }
        });
        return true;
    } catch (e) {
        //alert(e);
        return false;
    }
}


function RecountCart() {
    try {
        var pp = new Array();
        var pi = $("span[id^='product_price_']");
        var pc = $("input[id^='count_']");
        var fPp = 0.00;
        for (i = 0; i < pi.length; i++) {
            var v = parseFloat($(pi[i]).html()) * parseInt($(pc[i]).val());
            v = parseFloat(v);
            if (v > 0.00) {
                fPp += v;
            }
            var id = $(pi[i]).attr('id');
            var productId = id.split('item_');
            $('#product_summary_' + productId[1]).html(v);
        }
        $('#cart_total_recount').html(fPp.toFixed(2));
        var TotalCost = fPp;
        if ($('#delivery_cost').val() != null && $('#delivery_cost').val() != undefined && $('#delivery_cost').val() != '') {
            TotalCost = TotalCost + parseFloat($('#delivery_cost').val());
        }
        if ($('#payment_cost').val() != null && $('#payment_cost').val() != undefined && $('#payment_cost').val() != '') {
            TotalCost = TotalCost + parseFloat($('#payment_cost').val());
        }
        $('#total_cost').html();
        $('#total_cost').html(TotalCost.toFixed(2));
        // $('#cart_total_recount').number(true, 2, ',', ' ');
    } catch (e) {
    }
}
;

function more2(id) {
    $('input[name="count[' + id + ']"').attr('value', parseInt($('input[name="count[' + id + ']"').val()) + 1);
    $('input[name="count[' + id + ']"').keyup();

    var order_price = 0;
    order_price = Number($('#order_step1 .count #product_price_' + id).text()) * Number($('input[name="count[' + id + ']"').attr('value'));

    $('#order_step1 .price_all #product_summary_' + id).text(order_price.toFixed(2));
    // $('#order_step1 #price_with_shipping #total_cost').text(order_price.toFixed(2) + " " + $('#order_step1 #current_currency').text());
    RecountCart();
}
function less2(id) {
    if ($('input[name="count[' + id + ']"').val() > 1) {
        $('input[name="count[' + id + ']"').attr('value', parseInt($('input[name="count[' + id + ']"').val()) - 1);
        $('input[name="count[' + id + ']"').keyup();
    }
    var order_price = 0;
    order_price = Number($('#order_step1 .count #product_price_' + id).text()) * Number($('input[name="count[' + id + ']"').attr('value'));


    $('#order_step1 .price_all #product_summary_' + id).text(order_price.toFixed(2));
    // $('#order_step1 #price_with_shipping #total_cost').text(order_price.toFixed(2) + " " + $('#order_step1 #current_currency').text());
    RecountCart();
}
$(document).ready(function () {

    $('#order_step1 .count input.count').on('keyup', function () {
        var id = $(this).attr('id');
        input_id = id.split('count_');
        id = input_id[1].toString();
        $('input[name="count[' + id + ']"').attr('value', $('input[name="count[' + id + ']"').val());
        order_price = Number($('#order_step1 .count #product_price_' + id).text()) * Number($('input[name="count[' + id + ']"').val());
        $('#order_step1 .price_all #product_summary_' + id).text(order_price.toFixed(2));
        RecountCart();
    });


    $('input[type="checkbox"]').checkator();
    $('#orders_history .transaction').on('click', function () {
        window.location = $(this).find('a').attr('href');
    });
    $('#order_step1 input.count').on('keypress', function () {
        //todo
    });

    askdialog = $("#askForProductPopup").dialog({
        autoOpen: false,
        title: 'Zapytaj o produkt',
        width: 400,
        modal: true,
        hide: 'explode',
        show: 'explode',
        resizable: false,
        buttons: {
            "Wyślij": function () {
                $.post(urlBase + 'ajax/ask_for_product', $("#askForProductForm").serialize(), function (data) {
                    if (data.type == 4) {
                        var sType = 'success';
                    } else {
                        var sType = 'error';
                    }
                    $('#ask-validate').html('<div class="' + sType + '">' + data.msg + '</div>');
                    if (data.type == 'success') {
                        setInterval(function () {
                            $('#ask-validate').html('');
                            $("#askForProductForm textarea").html('');
                            $("#askForProductForm input").val('');
                            $('#askForProductPopup').dialog("close");
                        }, 3000);
                    }
                }, 'json');
            }
        }
    });
    calcdialog = $("#calc-popup").dialog({
        autoOpen: false,
        title: 'Oblicz raty',
        width: 400,
        modal: true,
        hide: 'explode',
        show: 'explode',
        resizable: false,
    });
    $("#calc").click(function () {
        calcdialog.dialog("open");
    });

    $("#delete-popup").hide();
    $("#price_user").inputmask("9{1,18}", {clearIncomplete: true, numericInput: true, placeholder: '0'});

    /*
     dialogbasketlogin = $("#login-popup").dialog({
     autoOpen: false,
     width: 450,
     title: 'Zaloguj się',
     modal: true,
     resizable: false
     });*/
    alertdialog = $("#validation-popup").dialog({
        autoOpen: false,
        title: 'Wystąpił błąd',
        width: 350,
        modal: true,
        hide: 'explode',
        show: 'explode',
        resizable: false
    });

    deletedialog = $("#delete-popup").dialog({
        autoOpen: false,
        resizable: false,
        hide: 'explode',
        show: 'explode',
        width: 350,
        modal: true,
        buttons: {
            "Tak": function () {
                if ($("#deletedialog_key").val() != '0')
                {
                    $.post($("#deletedialog_url").val(), {iKey: $("#deletedialog_url").val()}, function (data) {
                        if (data == 'success') {
                            $("#prod_" + $("#deletedialog_key").val()).remove();
                            RecountCart();
                        }
                    });
                }
                else
                {
                    $(location).attr('href', $("#deletedialog_url").val());
                }
                //alert($("#deletedialog_url").val());
                //$(location).attr('href', $("#deletedialog_url").val());
                $(this).dialog("close");
            },
            "Nie": function () {
                $(this).dialog("close");
            }
        }
    });

    $("#basket-login").on("click", function () {
        dialogbasketlogin.dialog("open");
    });
    $('.ask-for-product').click(function () {
        askdialog.dialog("open");
    });

    $(".item_del").on("click", function () {
        $("#deletedialog_url").val($(this).attr('data_go'));
        $("#deletedialog_key").val($(this).attr('data_key'));
        deletedialog.dialog("open");
    });

    $("#order_step2 .options-register").on("click", function () {
        $("#order_step2 #password-hide").fadeIn();
    });


    $('.login-button').click(function () {
        $.post(urlBase + 'ajax/login', {
            customer_password: $('#login-popup #customer_password').val(),
            customer_email: $('#login-popup #customer_email').val()
        }, function (data) {
            if (data.type == 4) {
                $('#customer_first_name').val(data.user.first_name);
                $('#customer_last_name').val(data.user.customer_last_name);
                $('#customer_delivery_address #customer_email').val(data.user.customer_email);
                $('#customer_phoneno').val(data.user.first_name);
                $('#customer_city').val(data.user.customer_city);
                $('#customer_zip').val(data.user.customer_zip);
                $('#customer_address').val(data.user.customer_address);
                $('#customer_country').val(data.user.customer_country);
                $('#customer_type').val(data.user.customer_type);
                $('#login-options').html('<div class="col-sm-12"></div>');
                $('.orderform').fadeIn('slow');
                $('#customer_note').fadeIn('slow');
                $('.register-pass, .register-inorder').hide();
                $('#order_step2 #customer_note .note_checkboxes').hide();
                $('#order_step2 #customer_note .note_btns .goto_step3').fadeIn('slow');
                $('#customer_reg_accept').attr('checked', 'checked');
                $('#customer_privacy_accept').attr('checked', 'checked');
                $('.user-menu').fadeOut('fast', function () {
                    $('.user-menu').html('<a href="' + urlBase + 'twoje_konto">' + data.user.customer_email + '</a> <a href="' + urlBase + 'wyloguj" class="red">Wyloguj</a>');
                    $('.user-menu').fadeIn('slow');
                });
                $('html, body').stop().animate({
                    scrollTop: $("#customer_delivery_address").offset().top
                }, 2000);
            } else {
                $('.cart-top-nav').after(data.msg);
            }
        }, 'json');
    });

    if (basket_mode == 1) {
        $('#order_step2').show();
        $('.cart .shop_view form').on('submit', function () {
            RecountCart();
            return true;
        });

        $('.goto_step3').on('click', function () {

            $("#validation-popup").html('');
            if ($(' #order_step2 #hide').is(':hidden') && $('#order_step2 #customer_account #customer_email').val().length === 0) {
                $(' #order_step2 #hide').fadeIn();
            } else {
                if ($(' #order_step2 #customer_first_name').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź Imię</span><br>');
                    alert = true;

                }
                if ($('#order_step2 #customer_account #customer_email').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź email</span><br>');
                    alert = true;

                }
                if ($(' #order_step2 #customer_city').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź miejscoswość</span><br>');
                    alert = true;

                }
                if ($(' #order_step2 #customer_address').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź adres</span><br>');
                    alert = true;

                }
                if ($(' #order_step2 #customer_last_name').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź nazwisko</span><br>');
                    alert = true;

                }
                if ($(' #order_step2 #customer_phoneno').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź numer telefonu</span><br>');
                    alert = true;

                }
                if ($(' #order_step2 #customer_zip').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź kod pocztowy</span><br>');
                    alert = true;

                }
                if ($(' #order_step2 #customer_register_inorder').prop('checked')) {
                    if ($('#order_step2 #customer_account #customer_password').val() != $('#order_step2 #customer_account #customer_password_repeat').val()) {
                        $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadzone hasła nie są jednakowe</span><br>');
                        alert = true;
                    }
                    if ($('#order_step2 #customer_account #customer_password').val().lenght === 0 || $('#order_step2 #customer_account #customer_password_repeat').val().lenght === 0) {
                        $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź hasło</span><br>');
                        alert = true;
                    }

                }
                if (!$(' #order_step2 #customer_reg_accept').prop('checked')) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Zaakceptuj regulamin</span><br>');
                    alert = true;

                }
                if (!$(' #order_step2 #customer_privacy_accept').prop('checked')) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Zaakceptuj zgodę na przetwarzanie danych osobowych</span><br>');
                    alert = true;

                }
                if (alert) {
                    alertdialog.dialog("open");
                    alert = false;

                }
                else {
                    RecountCart();
                    alert = false;
                    $("#validation-popup").html('');
                    $('body, html').animate({
                        scrollTop: 0
                    }, 500, function () {
                        $('#order_step1').hide();
                        $('#order_step2').hide();
                        $('#order_step3').fadeIn();
                        $('.cart-top-nav .step3').addClass('active');
                    });


                    $('#order_step3 .cart-tab').html($('#order_step1 .cart-tab').html());
                    $('#order_step3 #prices-summary #summary-cost span').html($('#order_step1 #cart_total_recount').html());
                    $('#order_step3 #prices-summary #summary-delivery-type span').html($('#order_step1 .delivery_type .value span').html());
                    $('#order_step3 #prices-summary #summary-delivery-cost span').html($('#order_step1 .delivery_cost .value span').html());
                    $('#order_step3 #prices-summary #summary-payment span').html($('#order_step1 .payment_type .value span').html());
                    $('#order_step3 #prices-summary #summary-total span').html($('#order_step1 #cart_total_recount').html());

                    $('#order_step3 #delivery-summary #name span').html($('#order_step2 #customer_first_name').val() + " " + $('#order_step2 #customer_last_name').val());
                    $('#order_step3 #delivery-summary #street span').html($('#order_step2  #customer_address').val());
                    $('#order_step3 #delivery-summary #city span').html($('#order_step2  #customer_zip').val() + " " + $('#order_step2  #customer_city').val());
                    $('#order_step3 #delivery-summary #email span').html($('#order_step2 #customer_account #customer_email').val());
                    $('#order_step3 #delivery-summary #phone span').html($('#order_step2  #customer_phoneno').val());
                    var protectchecked = '';
                    if ($('#order_step1  #protection input[type="checkbox"]').is(":checked")) {
                        protectchecked = 'Tak';
                    } else {
                        protectchecked = 'Nie';
                    }
                    $('#order_step3 #delivery-summary #protect span').html(protectchecked);
                    $('#order_step3 #shopping_cart input.count').attr('disabled', 'disabled');



                }
            }
            //$('#order_step3 #summary-total span').number(true, 0, ',', ' ');
        });
        $('#order_step1 .delivery_option input').on('change', function () {
            $('#order_step1 .cost-summary .delivery_type .value span').html($(this).attr('text'));
            $('#order_step1 .cost-summary .delivery_cost .value span').html($(this).attr('price'));
            var order_price = 0;
            $('#order_step1 .price_all .price span').each(function () {
                order_price = order_price + Number($(this).text());
            });
            order_price = order_price + Number($(this).attr('price'));
            $('#order_step1 #price_with_shipping #total_cost').text(order_price.toFixed(2));

        });
        $('#order_step1 #payment_method input').on('change', function () {
            $('#order_step1 .cost-summary .payment_type .value span').html($(this).next('label').html());
        });

        $('#order_step2 #no-login').click(function () {
            $('#order_step2 #hide').slideDown();
        });
        $('#order_step2 #orderwithregister').click(function () {
            $('#order_step2 #hide').slideDown();
        });

        $('.cart .delivery_option input[type="radio"]').attr('checked', 'checked').trigger('click');
        $('.cart .payment_option input[type="radio"]').attr('checked', 'checked').trigger('click');

    } else {
        $('.goto_step1').on('click', function () {
            $('body, html').animate({
                scrollTop: 0
            }, 500, function () {
                $('#order_step2').hide();
                $('#order_step1').fadeIn();
                $('.cart-top-nav .step2').removeClass('active');
            });

        });


        var alert = false;
        $('.goto_step2').on('click', function () {
            $("#validation-popup").html('');
            if (!$(' #order_step1 #delivery_method input[type="radio"]').is(':checked')) {
                $("#validation-popup").html('<span class="red">Wybierz sposób dostawy</span><br>');
                alert = true;

            }
            if (!$(' #order_step1 #payment_method input[type="radio"]').is(':checked')) {
                $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wybierz sposób płatności</span>');
                alert = true;

            }

            if (alert) {
                alertdialog.dialog("open");
                alert = false;

            }
            else {
                alert = false;
                $("#validation-popup").html('');
                $('body, html').animate({
                    scrollTop: 0
                }, 500, function () {
                    $('#order_step3').hide();
                    $('#order_step1').hide();
                    $('#order_step2').fadeIn();
                    $('.cart-top-nav .step3').removeClass('active');
                    $('.cart-top-nav .step2').addClass('active');
                });
            }
        });
        $('.goto_step3').on('click', function () {

            $("#validation-popup").html('');
            if ($(' #order_step2 #hide').is(':hidden') && $(' #order_step2 #customer_account #customer_email').val().length === 0) {
                $(' #order_step2 #hide').fadeIn();
            } else {
                if ($(' #order_step2 #customer_first_name').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź Imię</span><br>');
                    alert = true;

                }
                if ($('#order_step2 #customer_account #customer_email').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź email</span><br>');
                    alert = true;

                }
                if ($(' #order_step2 #customer_city').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź miejscoswość</span><br>');
                    alert = true;

                }
                if ($(' #order_step2 #customer_address').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź adres</span><br>');
                    alert = true;

                }
                if ($(' #order_step2 #customer_last_name').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź nazwisko</span><br>');
                    alert = true;

                }
                if ($(' #order_step2 #customer_phoneno').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź numer telefonu</span><br>');
                    alert = true;

                }
                if ($(' #order_step2 #customer_zip').val().length === 0) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź kod pocztowy</span><br>');
                    alert = true;

                }
                if ($('#order_step2 #customer_register_inorder').prop('checked')) {
                    if ($('#order_step2 #customer_account #customer_password').val() != $('#order_step2 #customer_account  #customer_password_repeat').val()) {
                        $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadzone hasła nie są jednakowe</span><br>');
                        alert = true;
                    }
                    if ($('#order_step2 #customer_account  #customer_password').val().lenght === 0 || $('#order_step2 #customer_account  #customer_password_repeat').val().lenght === 0) {
                        $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Wprowadź hasło</span><br>');
                        alert = true;
                    }

                }
                if (!$(' #order_step2 #customer_reg_accept').prop('checked')) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Zaakceptuj regulamin</span><br>');
                    alert = true;

                }
                if (!$(' #order_step2 #customer_privacy_accept').prop('checked')) {
                    $("#validation-popup").html($("#validation-popup").html() + '<span class="red">Zaakceptuj zgodę na przetwarzanie danych osobowych</span><br>');
                    alert = true;

                }
                if (alert) {
                    alertdialog.dialog("open");
                    alert = false;

                }
                else {
                    alert = false;
                    $("#validation-popup").html('');
                    $('body, html').animate({
                        scrollTop: 0
                    }, 500, function () {
                        $('#order_step2').hide();
                        $('#order_step3').fadeIn();
                        $('.cart-top-nav .step3').addClass('active');
                    });


                    $('#order_step3 .cart-tab').html($('#order_step1 .cart-tab').html());
                    $('#order_step3 #prices-summary #summary-cost span').html($('#order_step1 #cart_total_recount').html());
                    $('#order_step3 #prices-summary #summary-delivery-type span').html($('#order_step1 .delivery_type .value span').html());
                    $('#order_step3 #prices-summary #summary-delivery-cost span').html($('#order_step1 .delivery_cost .value span').html());
                    $('#order_step3 #prices-summary #summary-payment span').html($('#order_step1 .payment_type .value span').html());
                    $('#order_step3 #prices-summary #summary-total span').html($('#order_step1 #cart_total_recount').html());

                    $('#order_step3 #delivery-summary #name span').html($('#order_step2 #customer_first_name').val() + " " + $('#order_step2 #customer_last_name').val());
                    $('#order_step3 #delivery-summary #street span').html($('#order_step2  #customer_address').val());
                    $('#order_step3 #delivery-summary #city span').html($('#order_step2  #customer_zip').val() + " " + $('#order_step2  #customer_city').val());
                    $('#order_step3 #delivery-summary #email span').html($('#order_step2 #customer_account #customer_email').val());
                    $('#order_step3 #delivery-summary #phone span').html($('#order_step2  #customer_phoneno').val());
                    var protectchecked = '';
                    if ($('#order_step1 #protection input[type="checkbox"]').is(':checked')) {
                        protectchecked = 'Tak';
                    } else {
                        protectchecked = 'Nie';
                    }
                    $('#order_step3 #delivery-summary #protect span').html(protectchecked);
                    $('#order_step3 #shopping_cart input.count').attr('disabled', 'disabled');



                }
            }
            //$('#order_step3 #summary-total span').number(true, 0, ',', ' ');
        });

        $('#order_step1 .delivery_option input').on('change', function () {
            $('#order_step1 .cost-summary .delivery_type .value span').html($(this).attr('text'));
            $('#order_step1 .cost-summary .delivery_cost .value span').html($(this).attr('price'));
            var order_price = 0;
            $('#order_step1 .price_all .price span').each(function () {
                order_price = order_price + Number($(this).text());
            });
            order_price = order_price + Number($(this).attr('price'));
            $('#order_step1 #price_with_shipping #total_cost').text(order_price.toFixed(2));

        });
        $('#order_step1 #payment_method input').on('change', function () {
            $('#order_step1 .cost-summary .payment_type .value span').html($(this).next('label').html());
        });

        $('#order_step2 #no-login').click(function () {
            $('#order_step2 #hide').slideDown();
        });
        $('#order_step2 #orderwithregister').click(function () {
            $('#order_step2 #hide').slideDown();
        });

        $('.cart .delivery_option input[type="radio"]').attr('checked', 'checked').trigger('click');
        $('.cart .payment_option input[type="radio"]').attr('checked', 'checked').trigger('click');
    }




    $('.add-to-basket').click(function (event) {
        var sProductId = $(this).attr('id');
        var aProductId = sProductId.split('-');
        var sQuantity = parseInt($('#quantity_' + aProductId[1]).val());
        event.preventDefault();
        var basketcount = parseInt($('.count-basket').text()) + sQuantity;
        $.post($(this).attr('href'), {id_product: aProductId[1], count: sQuantity, add_to_basket: 1}, function (data) {
            if (data != 0) {
                $('.count-basket').text(basketcount);
                $('.product-add').each(function ()
                {
                    if ($(this).attr('data-cat') != data)
                    {
                        $(this).hide();
                    }
                });
            } else {
                $('.error, .warning, .info, .success').remove();
                $('#main_content').prepend(data);
            }
        });
        $('#basket_popup').fadeIn('slow', function () {

            setTimeout(function () {
                $('#basket_popup').stop().fadeOut('slow');
            }, 1500);
        });
    });


    $("#cbx_delivery_address").click(function () {
        if ($("#cbx_delivery_address").is(":checked"))
        {
            $("#other_delivery_address").css('display', 'table');
        }
        else
        {
            $("#other_delivery_address").css('display', 'none');
            ;
        }
    });
    $("#cbx_invoice_address").click(function () {
        if ($("#cbx_invoice_address").is(":checked"))
        {
            $("#other_invoice_address2").css('display', 'table');
        }
        else
        {
            $("#other_invoice_address2").css('display', 'none');
            ;
        }
    });

    if ($("#customer_inny_adres").is(":checked"))
    {
        $("#delivery_address").removeAttr('disabled');
        $("#delivery_zip").removeAttr('disabled');
        $("#delivery_city").removeAttr('disabled');
        $("#delivery_country").removeAttr('disabled');
    }

    $("#customer_inny_adres").click(function () {
        if ($("#customer_inny_adres").is(":checked"))
        {
            $("#delivery_address").removeAttr('disabled');
            $("#delivery_zip").removeAttr('disabled');
            $("#delivery_city").removeAttr('disabled');
            $("#delivery_country").removeAttr('disabled');
        }
        else
        {
            $("#delivery_address").attr('disabled', 'disabled');
            $("#delivery_zip").attr('disabled', 'disabled');
            $("#delivery_city").attr('disabled', 'disabled');
            $("#delivery_country").attr('disabled', 'disabled');
        }
    });


    $('#payment').change(function () {
        $('#kwota').val($('#payment').val());
    });

    $('.back').click(function () {
        history.go(-1);
    });

    $('.more').bind("click", function () {
        var Id = $(this).attr('id');
        var i = Id.split('-');
        var Count = parseInt($('#count_' + i[1]).val()) + 1;
        //alert (Count);
        //alert($('#product_price_'+i[1]).text());
        if (Count < 1) {
            Count = 1;
        }
        if (Count > 99) {
            Count = 99;
        }
        $('#product_summary_' + i[1]).html(parseFloat(Count * $('#product_price_' + i[1]).text()).toFixed(2));
        $('#count_' + i[1]).val(Count);
    });

    $('.less').bind("click", function () {
        var Id = $(this).attr('id');
        var i = Id.split('-');
        var Count = parseInt($('#count_' + i[1]).val()) - 1;
        if (Count < 1) {
            Count = 1;
        }
        if (Count > 99) {
            Count = 99;
        }
        $('#product_summary_' + i[1]).html(parseFloat(Count * $('#product_price_' + i[1]).text()).toFixed(2));
        $('#count_' + i[1]).val(Count);
    });

    /* 
     * $('.count').bind("keyup", function () {
     var Id = $(this).attr('id');
     var i = Id.split('_');
     if ($(this).val() == '') {
     
     }
     else {
     var Count = parseInt($(this).val());
     if (isNaN(Count)) {
     Count = 1;
     $('#count_' + i[1]).val(Count);
     }
     $('#product_summary_' + i[1]).html(parseFloat(Count * $('#product_price_' + i[1]).text()).toFixed(2));
     
     //$('#count_'+i[1]).val(Count);
     }
     });
     
     $('.count').bind("focusout", function () {
     var Id = $(this).attr('id');
     var i = Id.split('_');
     var Count = parseInt($(this).val());
     if (isNaN(Count)) {
     Count = 1;
     $('#count_' + i[1]).val(Count);
     }
     });
     */

    $('.attribute-color').mouseover(function () {
        $(this).find('.zoomer').show();
    }).mouseout(function () {
        $('.zoomer').hide();
    });

    $('[id^="attrid_"]').on('change', function () {
        var iAttrId = $(this).attr('id').split('_');
        var Selected = $('.select_attributes option:selected').map(function () {
            return this.value;
        }).get().join(",");
        var iAttrVal = $('option:selected', this).attr('class').split('_');
        $.post(urlBase + 'ajax/attributes', {select: Selected, product_id: $('#id_product_attr').val(), attr_id: iAttrId[1], attr_val: iAttrVal[1], lang: Lang}, function (data) {
            $('#attributes-selector').html(data);
        });
    });

    $('.attribute-color').on('click', function () {
        $('.select_attributes option').removeAttr('selected');
        $(this).parent().parent().find('.attr-active').removeClass('attr-active');
        $(this).parent().addClass('attr-active');
        var sToSelect = $(this).attr('id');
        $(this).next('.select_attributes').children('option').removeAttr('selected');
        $(this).parent().parent().find('.select_attributes').children('option.' + sToSelect).attr('selected', 'selected');

    });

    $('.prod-desc > div > h4').click(function () {
        if (!$(this).parent().hasClass('active')) {
            var oThis = $(this);
            var oActive = $(this).parent().parent().find('.active');
            oActive.find('.product-description').slideUp(400, function () {
                oActive.removeClass('active');
                oThis.parent().addClass('active');
                oThis.next('.product-description').slideDown();
            });
        }

        $(this).parent().hasClass('active').removeClass('active');
        $(this).parent().parent()
    });

    $('.basket').hover(function () {
        $('#cart-drop', this).show();
    }, function () {
        $('#cart-drop', this).hide();
    });


    $('.logbutton').click(function () {
        $("#pop-up ").fadeIn('slow');
        $("#login-popup ").fadeIn('slow');
    });
    $('.logexit').click(function () {
        $("#pop-up ").fadeOut('slow');
        $("#login-popup ").fadeOut('slow');
    });
    $('.logexit2').click(function () {
        $("#pop-up ").fadeOut('slow');
        $("#login-popup ").fadeOut('slow');
    });

    $('#customer_register_inorder, #customer_register_inorder2').click(function () {
        if (this.checked) {
            $('.register-pass').fadeIn('slow');
            $('.orderform').fadeIn('slow');
            $('#customer_note').fadeIn('slow');
            $('#order_step2 #customer_note .note_checkboxes').fadeIn('slow');
            $('#order_step2 #customer_note .note_btns .goto_step3').show('slow');
            $('html, body').stop().animate({
                scrollTop: $("#customer_delivery_address").offset().top
            }, 2000);
        }
        else {
            $('.register-pass').fadeOut('slow');
            $('html, body').stop().animate({
                scrollTop: $("#customer_delivery_address").offset().top
            }, 2000);
        }

    });

    $('#no-login').click(function () {
        $('.register-pass').fadeOut('slow');
        $('#customer_register_inorder').prop('checked', false);
        if ($('.orderform').is(':hidden')) {
            $('.orderform').fadeIn('slow');
            $('#order_step2 #customer_note .note_checkboxes').fadeIn('slow');
            $('#order_step2 #customer_note .note_btns .goto_step3').show('slow');
            $('#customer_note').fadeIn('slow');
        }
        $('html, body').stop().animate({
            scrollTop: $("#customer_delivery_address").offset().top
        }, 2000);
    });

    $('.ajax_next a').on('click', function () {
        var oObject = $(this);
        $.post($(this).attr('href'), {page: $(this).attr('class')}, function (data) {
            $('#products').append(data);
            oObject.closest('.pagination').remove();
        });

        return false;
    });

    $('ul#sub_slider li').hover(function () {
        $('.hover-img', this).show();
    }, function () {
        $('.hover-img', this).hide();
    });
});
function Recount() {
    if (parseInt($('#count').val()) > 99) {
        $('#count').val(99);
    }
    var count = parseInt($('#count').val()) * parseFloat($('#product_price').val())
    $('#recounted_price').html(count.toFixed(2));
}



function SetDeliveyType(elm, dtId) {
    try {
        $.ajax({
            type: "POST",
            url: urlBase + "app_products/get_delivery_cost",
            data: 'id_delivery_type=' + encodeURIComponent(dtId),
            async: false,
            success: function (serverResponse) {
                $('#delivery_type_id').val(dtId);
                $('#delivery_cost').val(serverResponse);
            }
        });
    } catch (e) {

    }
}

function SetPaymentType(elm, ptId) {
    try {
        $.ajax({
            type: "POST",
            url: urlBase + "app_products/get_payment_cost",
            data: 'id_payment_type=' + encodeURIComponent(ptId),
            async: false,
            success: function (serverResponse) {
                $('#payment_type_id').val(ptId);
                $('#payment_cost').val(serverResponse);
            }
        });
    } catch (e) {
    }
}



    