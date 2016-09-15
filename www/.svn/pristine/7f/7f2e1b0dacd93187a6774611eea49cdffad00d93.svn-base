/**
 *
 *  Javascript trim, ltrim, rtrim
 *  http://www.webtoolkit.info/
 *
 **/
function trim(str, chars) {
    return ltrim(rtrim(str, chars), chars);
}

function ltrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}

function rtrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}

function showLoader(loaderImgId) {
    $(loaderImgId).show();
}

function hideLoader(loaderImgId) {
    $(loaderImgId).hide();
}
function countNettoPrice() {
    $('#netto_price').val(($('#price').val().replace(',', '.') / (1 + ($('#tax_id').val() / 100.00))).toFixed(2));
}
function countBruttoPrice() {
    $('#price').val(($('#netto_price').val().replace(',', '.') * (1 + ($('#tax_id').val() / 100.00))).toFixed(2));
}

$(document).ready(function () {

    $('#price').on('keyup', function () {
        countNettoPrice();
    });

    $('#netto_price').on('keyup', function () {
        countBruttoPrice();
    });
    
    $('#tax_id').on('change', function() {
        countNettoPrice();
    });

    var PaymentType = $('#payment_type_method option').filter(':selected').attr('value');
    if (PaymentType == 'dotpay') {
        $("#auth_login").removeAttr("disabled");
        $("#auth_code").removeAttr("disabled");
        $("#auth_url").removeAttr("disabled");
        $(".auth_row").show();
        $(".desc_row").hide();
        $("#description").attr("disabled", "disabled");
        if ($("#auth_url").val() == '') {
            $("#auth_url").val(payment_url[PaymentType]);
        }
    }
    else {
        $(".auth_row").hide();
        $("#auth_login").attr("disabled", "disabled");
        $("#auth_code").attr("disabled", "disabled");
        $("#auth_url").attr("disabled", "disabled");
        $("#description").removeAttr("disabled");
        $(".desc_row").show();
    }

    $('.multi').multiselectable();

    $('.multi_add_all').click(function () {
        $('#m-selectable').find('option').attr('selected', 'selected');
        $('.multiselectable').find('.multis-right').trigger('click');
    });

    $('.multi_delete_all').click(function () {
        $('#m-selected').find('option').attr('selected', 'selected');
        $('.multiselectable').find('.multis-left').trigger('click');
    });

    $(".show-transbox").click(function () {
        var lang = $(".tr_lang", this).text();
        var id = $(".tr_id", this).text();
        var table = $(".tr_table", this).text();
        var input = $(".tr_input", this).text();
        var flag_clicked = $(this);

        $("#trans-pop-up").remove();
        var popBody = '';
        var input_name = $(this).siblings(input).attr("name");
        var value = '';

        $.post(urlBase + "languages/ajax_get", {id: id, table: table, lang: lang, input_name: input_name}).done(function (data) {
            value = data;
            popBody += '<div id="trans-pop-up">';
            popBody += '<form action="" id="form_result" method="post">';
            popBody += '<label for="' + input_name + '">Przetłumacz:</label><br />';
            if (input == 'input') {
                popBody += '<input type="text" name="' + input_name + '" value="' + value + '" />';
            }
            else if (input == 'textarea') {
                popBody += '<textarea name="' + input_name + '" cols="60" rows="5"></textarea>';
            }

            popBody += '<input type="hidden" name="table" value="' + table + '" />';
            popBody += '<input type="hidden" name="lang" value="' + lang + '" />';
            popBody += '<input type="hidden" name="id" value="' + id + '" />';
            popBody += '<span class="send-form">Wyślij</span>';
            popBody += '<span class="close-form">X</span>';
            popBody += '</form>';
            popBody += '</div>';
            flag_clicked.after(popBody);
        });
    });


    $("#payment_type_method").change(function () {
        var PaymentType = $('#payment_type_method option').filter(':selected').attr('value');
        if (PaymentType == 'dotpay')
        {
            $("#auth_login").removeAttr("disabled");
            $("#auth_code").removeAttr("disabled");
            $("#auth_url").removeAttr("disabled");
            $(".auth_row").show();
            $(".desc_row").hide();
            $("#description").attr("disabled", "disabled");
            if ($("#auth_url").val() == '')
            {
                $("#auth_url").val(payment_url[PaymentType]);
            }
        }
        else
        {
            $(".auth_row").hide();
            $("#auth_login").attr("disabled", "disabled");
            $("#auth_code").attr("disabled", "disabled");
            $("#auth_url").attr("disabled", "disabled");
            $("#description").removeAttr("disabled");
            $(".desc_row").show();
        }
    });






    $(".close-form").live('click', function () {
        $("#trans-pop-up").remove();
    });







    $(".send-form").live('click', function () {

        var url = urlBase + "languages/ajax"; // the script where you handle the form input.

        $.ajax({
            type: "POST",
            url: url,
            data: $("#form_result").serialize(), // serializes the form's elements.
            success: function (data)
            {

            }
        });
        return false; // avoid to execute the actual submit of the form.
    });


    if ($('#attribute_if_pattern').prop('checked')) {
        $('#attribute_color').attr('disabled', 'disabled');
        $('#patt-dialog').css('display', 'table-row');
        $('#attribute_pattern').prop('disabled', false);
        $('#attribute_color').css('background-color', '#DBDBDB');
    }
    else {
        $('#attribute_color').prop('disabled', false);
        $('#patt-dialog').css('display', 'none');
        $('#attribute_pattern').prop('disabled', true);
        $('#attribute_color').css('background-color', '#FFFFFF');
    }

    $('#attribute_if_pattern').change(function () {
        if ($('#attribute_if_pattern').prop('checked')) {
            $('#attribute_color').prop('disabled', true);
            $('#attribute_color').css('background-color', '#DBDBDB');
            $('#patt-dialog').show("slow");
            $('#attribute_pattern').prop('disabled', false);
        }
        else {
            $('#attribute_color').prop('disabled', false);
            $('#patt-dialog').hide("slow");
            $('#attribute_pattern').prop('disabled', true);
            $('#attribute_color').css('background-color', '#FFFFFF');
        }
    });

    $("#news-link, #news-link2").css("display", "block");
    $("#news-title, #news-title2").css("display", "none");

    if ($("#or_link").is(":checked"))
    {
        $("#news-link").css("display", "none");
        $("#news-title").css("display", "block");
    }
    else {
        $("#news-link").css("display", "block");
        $("#news-title").css("display", "none");
    }

    if ($("#or_link2").is(":checked"))
    {
        $("#news-link2").css("display", "none");
        $("#news-title2").css("display", "block");
    }
    else {
        $("#news-link2").css("display", "block");
        $("#news-title2").css("display", "none");
    }

    if ($("#or_link3").is(":checked"))
    {
        $("#news-link3").css("display", "none");
        $("#news-title3").css("display", "block");
    }
    else {
        $("#news-link3").css("display", "block");
        $("#news-title3").css("display", "none");
    }

    $("#or_link").click(function () {
        if ($("#or_link").is(":checked"))
        {
            $("#news-link").hide("fast");
            $("#news-title").show("fast");
        }
        else
        {
            $("#news-title").hide("fast");
            $("#news-link").show("fast");
        }
    });

    $("#or_link2").click(function () {
        if ($("#or_link2").is(":checked"))
        {
            $("#news-link2").hide("fast");
            $("#news-title2").show("fast");
        }
        else
        {
            $("#news-title2").hide("fast");
            $("#news-link2").show("fast");
        }
    });

    $("#or_link3").click(function () {
        if ($("#or_link3").is(":checked"))
        {
            $("#news-link3").hide("fast");
            $("#news-title3").show("fast");
        }
        else
        {
            $("#news-title3").hide("fast");
            $("#news-link3").show("fast");
        }
    });

    $.datepicker.regional['pl'] = {
        closeText: 'Zamknij',
        prevText: '&#x3c;Poprzedni',
        nextText: 'Następny&#x3e;',
        currentText: 'Dziś',
        monthNames: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec',
            'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
        monthNamesShort: ['Sty', 'Lu', 'Mar', 'Kw', 'Maj', 'Cze',
            'Lip', 'Sie', 'Wrz', 'Pa', 'Lis', 'Gru'],
        dayNames: ['Niedziela', 'Poniedzialek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
        dayNamesShort: ['Nie', 'Pn', 'Wt', 'Śr', 'Czw', 'Pt', 'So'],
        dayNamesMin: ['N', 'Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'So'],
        weekHeader: 'Tydz',
        dateFormat: 'dd-mm-yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['pl']);


    $('.datepicker').datepicker({
        //dateFormat: 'dd-mm-yy'
    });

    $('.datepicker2').datepicker({
        dateFormat: 'yy-mm-dd'
    });






    $('.info, .warning, .error, .success').click(function () {
        $(this).fadeOut('slow');
    });

    $("#admin_edit_page_content").tabs();


    $("#admin_edit_product").tabs();

    // pages
    $('.show_page_details').click(function () {
        $('#page_details').slideToggle('slow');
    });

    $('input[name=back]').click(function () {
        history.go(-1);
    });

    $('.delete_button, .btn-delete').live("click", function () {
        if ($(this).attr("title")) {
            var answer = confirm($(this).attr("title"));
            return answer;
        }
    });

    //$('.help').tooltip();


    $('.check_all').click(function () {
        if ($(this).is(':checked')) {
            $('.check').each(function () {
                $(this).attr('checked', true);
            });
        } else {
            $('.check').each(function () {
                $(this).attr('checked', false);
            });
        }
    });


    /**
     * Funkcja dla uzupełniania treści (np selectow).
     *  @param String DataString (string dla POST)
     *  @param String ControllerLink (Link do kontrolera)
     *  @param String OutputId (miejsce gdzie wklejony bedzie serverResponse)
     *  @return Bool
     */
    function GetAjax(DataString, ControllerLink, OutputId) {
        try {
            $.ajax({
                type: "POST",
                url: urlBase + ControllerLink,
                data: DataString,
                async: false,
                success: function (serverResponse) {
                    if (OutputId != null) {
                        $(OutputId).html(serverResponse);
                    }
                    return true;
                }
            });
            return true;
        } catch (e) {
            alert(e);
            return false;
        }
    }

    $('#form_newsletter_add #language').live('change', function () {
        var dataString = 'lang=' + encodeURIComponent($(this).val());
        var ControllerLink = 'newsletters_ajax/get_groups_for_lang';
        var outputId = '#newsletter_groups';
        GetAjax(dataString, ControllerLink, outputId);
        return true;
    });
    $('#form_newsletter_edit #language').live('change', function () {
        var dataString = 'lang=' + encodeURIComponent($(this).val()) + '&id=' + encodeURIComponent($('#newsletter_edit_id').val());
        var ControllerLink = 'newsletters_ajax/get_groups_for_lang';
        var outputId = '#newsletter_groups';
        GetAjax(dataString, ControllerLink, outputId);
        return true;
    });

    $('.language_check').live('change', function () {
//        var dataString = 'lang=' + encodeURIComponent($(this).val());
//        var ControllerLink = 'pages_ajax/get_pages_for_lang';
//        var outputId = '.page_check';
//        GetAjax(dataString, ControllerLink, outputId);
        $('.page_check').load(urlBase + 'pages_ajax/get_pages_for_lang', {lang: encodeURIComponent($(this).val())});
        return true;
    });


    $('.news_language_check').live('change', function () {
        var dataString = 'lang=' + encodeURIComponent($(this).val());
        var ControllerLink = 'news_ajax/get_news_categories_for_lang';
        var outputId = '.news_category_check';
        GetAjax(dataString, ControllerLink, outputId);
        return true;
    });

    $('#add_gallery_language').live('change', function () {
        var dataString = 'lang=' + encodeURIComponent($(this).val());
        var ControllerLink = 'pages_ajax/get_pages_for_lang';
        var outputId = '#add_elements_page_id';
        GetAjax(dataString, ControllerLink, outputId);
        return true;
    });
    $('#add_poll_language').live('change', function () {
        var dataString = 'lang=' + encodeURIComponent($(this).val());
        var ControllerLink = 'polls/get_polls_for_lang';
        var outputId = '#polls_categories_for_language';
        GetAjax(dataString, ControllerLink, outputId);
        return true;
    });

    $('#page_search').keyup(PageSearch);
    $('#pages_in_language').change(PageSearch);

    function PageSearch() {
        var dataString = 'page_search=' + encodeURIComponent($('#page_search').val()) + '&language=' + encodeURIComponent($('#pages_in_language').val());
        var ControllerLink = 'pages_ajax/page_search';
        var outputId = '#pages_list';
        GetAjax(dataString, ControllerLink, outputId);
        return true;
    }

    $('#category_search').keyup(CategorySearch);

    function CategorySearch() {
        var dataString = 'category_search=' + encodeURIComponent($('#category_search').val());
        var ControllerLink = 'admin_products_categories/search_categories';
        var outputId = '#product_category_list';
        GetAjax(dataString, ControllerLink, outputId);
        return true;
    }

    $('#users_search').keyup(UserSearch);
    $('#users_in_role').change(UserSearch);

    function UserSearch() {
        var dataString = 'email=' + encodeURIComponent($('#users_search').val()) + '&role_id=' + encodeURIComponent($('#users_in_role').val());
        var ControllerLink = 'users_ajax/user_search';
        var outputId = '#user_list';
        GetAjax(dataString, ControllerLink, outputId);
        return true;
    }


    $('#admin_orders_index #order_number').keyup(OrdersSearch);
    $('#orders_status_search').change(OrdersSearch);

    function OrdersSearch() {
        var dataString = 'order_number=' + encodeURIComponent($('#order_number').val()) + '&status_id=' + encodeURIComponent($('#orders_status_search').val());
        var ControllerLink = 'orders_ajax/search_order';
        var outputId = '#orders_list';
        GetAjax(dataString, ControllerLink, outputId);
        return true;
    }



    // dla galerii dodawania walidacja... zabrzmialo jak YODA
    //    $('#form_add_gallery, #form_edit_gallery').submit(function() {
    //        try {
    //            $('.error_message').hide();
    //            var dataString = 'name=' + $('#add_gallery_name').val() + '&langs=' + $('#add_gallery_language').val();
    //            $.ajax({
    //                type: "POST",
    //                url: urlBase+"galleries_ajax/validate_gallery_add",
    //                data: dataString,
    //                async: false,
    //                success: function(serverResponse) {
    //                    var valid = serverResponse.getElementsByTagName('validation');
    //                    var errorsCount = valid[0].getAttribute('counter');
    //                    if(errorsCount > 0) {
    //                        var mainElement = serverResponse.getElementsByTagName('error');
    //                        for(i = 0 ; i < mainElement.length ; ++i) {
    //                            var att = mainElement[i].getAttribute('id');
    //                            att = '#'+att+'_error';
    //                            $(att).html(mainElement[i].firstChild.nodeValue);
    //                            $(att).show();
    //                        }
    //                    } else {
    //                        retValue = true;
    //                    }
    //                }
    //            });
    //            return retValue;
    //        } catch(e) {
    //            alert(e);
    //            return false;
    //        }
    //    });



    /*
     *  Funkcja dla ajaxowej walidacji
     *  @param Object FormId
     *  @param String DataString (string dla POST)
     *  @param String ControllerLink (Link do kontrolera)
     *  @return Bool retValue
     */
    var retValue = false;
    function AjaxValidate(FormId, DataString, ControllerLink) {
        try {
            $('.error_message').hide();
            $.ajax({
                type: "POST",
                url: urlBase + ControllerLink,
                data: DataString,
                async: false,
                success: function (serverResponse) {
                    var valid = serverResponse.getElementsByTagName('validation');
                    var errorsCount = valid[0].getAttribute('counter');
                    if (errorsCount > 0) {
                        var mainElement = serverResponse.getElementsByTagName('error');
                        for (i = 0; i < mainElement.length; ++i) {
                            var att = mainElement[i].getAttribute('id');
                            att = '#' + att + '_error';
                            $(att, FormId).html(mainElement[i].firstChild.nodeValue);
                            $(att, FormId).show();
                        }
                    } else {
                        retValue = true;
                    }
                }
            });
            return retValue;
        } catch (e) {
            alert(e);
            return false;
        }
    }


    $('#form_add_page_content, [id^="form_edit_page_content"]').submit(function () {
        var FormId = $(this);
        var opis = tinyMCE.get('add_page_content_content', this).getContent();
        var DataString = 'title=' + encodeURIComponent($('#add_page_content_title', this).val()) + '&content=' + encodeURIComponent(opis)
                + '&page_id=' + encodeURIComponent($('#add_page_content_pages_ids', this).val());
        var ControllerLink = "page_content_ajax/validate_page_content_add";
        return AjaxValidate(FormId, DataString, ControllerLink)
    });

    $('#form_add_gallery, #form_edit_gallery').submit(function () {
        var FormId = $(this);
        var DataString = 'name=' + encodeURIComponent($('#add_gallery_name').val()) + '&langs=' + encodeURIComponent($('#add_gallery_language').val()) + '&page_id=' + encodeURIComponent($('#add_elements_page_id').val());
        var ControllerLink = 'galleries_ajax/validate_gallery_add';
        return AjaxValidate(FormId, DataString, ControllerLink);
    });

    $('#form_add_news_category, #form_edit_news_category').submit(function () {
        var FormId = $(this);
        var DataString = 'title=' + encodeURIComponent($('#news_category_name').val()) + '&lang=' + encodeURIComponent($('#news_category_language').val()) + '&page_id=' + encodeURIComponent($('#news_category_pages_ids').val());
        var ControllerLink = 'news_ajax/validate_news_category_add';
        return AjaxValidate(FormId, DataString, ControllerLink);
    });


    $('#form_add_contact_form, #form_edit_contact_form').submit(function () {
        var FormId = $(this);
        var DataString = 'title=' + encodeURIComponent($('#title', this).val()) + '&sender_email=' + encodeURIComponent($('#sender_email', this).val())
                + '&receiver_email=' + encodeURIComponent($('#receiver_email', this).val())
                + '&page_id=' + encodeURIComponent($('#pages_id', this).val());
        var ControllerLink = "contact_forms_ajax/validate_contact_form";
        return AjaxValidate(FormId, DataString, ControllerLink)
    });

    $('#form_newsletter_group_add, #form_newsletter_group_edit').submit(function () {
        var FormId = $(this);
        var DataString = 'name=' + encodeURIComponent($('#name', this).val());
        var ControllerLink = "newsletters_ajax/validate_group";
        return AjaxValidate(FormId, DataString, ControllerLink)
    });



    /* SHOP */

    $("#admin_customer_edit_table").tabs();


    $("#sale_date_start").datepicker();
    $("#sale_date_end").datepicker();
    $("#product_of_the_day_date").datepicker();
    $("#date_expire").datepicker();
    $("#promotion_date_start").datepicker();
    $("#promotion_date_end").datepicker();


    $('#admin_payment_type_add_form, #admin_payment_type_edit_form').submit(function () {
        var FormId = $(this);
        var DataString = 'payment_type=' + encodeURIComponent($('#payment_type').val()) + '&payment_cost=' + encodeURIComponent($('#payment_cost').val());
        var ControllerLink = 'admin_payment_types/ajax_validate_payment_type';
        return AjaxValidate(FormId, DataString, ControllerLink);
    });

    $('#admin_delivery_type_add_form, #admin_delivery_type_edit_form').submit(function () {
        var FormId = $(this);
        var DataString = 'delivery_type=' + encodeURIComponent($('#delivery_type').val()) + '&delivery_cost=' + encodeURIComponent($('#delivery_cost').val());
        var ControllerLink = 'admin_delivery_types/ajax_validate_delivery_type';
        return AjaxValidate(FormId, DataString, ControllerLink);
    });

    $('#admin_tax_add_form, #admin_tax_edit_form').submit(function () {
        var FormId = $(this);
        var DataString = 'tax_name=' + encodeURIComponent($('#tax_name').val()) + '&tax_value=' + encodeURIComponent($('#tax_value').val())
                + '&tax_id=' + encodeURIComponent($('#tax_id').val());
        var ControllerLink = 'admin_taxes/ajax_validate_taxes';
        return AjaxValidate(FormId, DataString, ControllerLink);
    });

    $('#admin_product_status_add_form, #admin_product_status_edit_form').submit(function () {
        var FormId = $(this);
        var DataString = 'product_status_name=' + encodeURIComponent($('#product_status_name').val());
        var ControllerLink = 'admin_products_statuses/ajax_validate_product_status';
        return AjaxValidate(FormId, DataString, ControllerLink);
    });

    $('#admin_rebate_group_add_form, #admin_rebate_group_edit_form').submit(function () {
        var FormId = $(this);
        var DataString = 'group_name=' + encodeURIComponent($('#group_name').val()) + '&rebate=' + encodeURIComponent($('#rebate').val());
        var ControllerLink = 'admin_rebates_groups/ajax_validate_rebates_groups';
        return AjaxValidate(FormId, DataString, ControllerLink);
    });

    $('#admin_producer_add_form, #admin_producer_edit_form').submit(function () {
        var FormId = $(this);
        var DataString = 'producer_name=' + encodeURIComponent($('#producer_name').val()) + '&rebate=' + encodeURIComponent($('#rebate').val());
        var ControllerLink = 'admin_producers/ajax_validate_producers';
        return AjaxValidate(FormId, DataString, ControllerLink);
    });

    $('#admin_parameter_add_form').submit(function () {
        var FormId = $(this);
        var DataString = 'parameter_name=' + encodeURIComponent($('#parameter_name').val());
        //DataString = DataString + '&parameter_values=' + encodeURIComponent($('#parameter_values').val());
        var countCategories = $('input[id^=category_]:checked').length;
        DataString = DataString + '&countCategories=' + encodeURIComponent(countCategories);
        var ControllerLink = 'admin_parameters/ajax_validate_parameters';
        return AjaxValidate(FormId, DataString, ControllerLink);
    });

    $('#admin_parameter_edit_form').submit(function () {
        var FormId = $(this);
        var DataString = 'parameter_name=' + encodeURIComponent($('#parameter_name').val());
        var ControllerLink = 'admin_parameters/ajax_validate_edit_parameters';

        /*
         var countParameterValues = 0;
         $('input[id^=parameter_values_]').each(function(){
         if ($.trim($(this).val()) != ''){
         countParameterValues++;
         }            
         });
         $('input[name^=new_parameter_value]').each(function(){
         if ($.trim($(this).val()) != ''){
         countParameterValues++;
         }
         });
         DataString = DataString + '&countParameterValues=' + encodeURIComponent(countParameterValues);
         */
        var countCategories = $('input[id^=category_]:checked').length;
        DataString = DataString + '&countCategories=' + encodeURIComponent(countCategories);
        return AjaxValidate(FormId, DataString, ControllerLink);
    });

    $('#admin_attribute_add_form, #admin_attribute_edit_form').submit(function () {
        var FormId = $(this);
        var DataString = 'attribute_name=' + encodeURIComponent($('#attribute_name').val());
        var ControllerLink = 'admin_attributes/ajax_validate_attributes';
        return AjaxValidate(FormId, DataString, ControllerLink);
    });

    $('#admin_attribute_value_add_form, #admin_attribute_value_edit_form').submit(function () {
        var FormId = $(this);
        var DataString = 'attribute_value=' + encodeURIComponent($('#attribute_value').val());
        var ControllerLink = 'admin_attributes/ajax_validate_attributes_values';
        return AjaxValidate(FormId, DataString, ControllerLink);
    });

    var newParameterValues = 0;
    $('#add_parameter_value').click(function () {
        newParameterValues++;
        $('#parameter_values').append('<li><input type="text" name="new_parameter_value[' + newParameterValues + ']" /></li>');
    });

    //    $('.order_status_check').change(function() {
    //        var iOrderName = $(this).attr('name');
    //        var iOrderId = iOrderName.split('-');
    //        var dataString = 'id_order=' + encodeURIComponent(iOrderId[1]) + '&status_id=' + encodeURIComponent($(this).val());
    //        var ControllerLink = 'orders_ajax/change_status';
    //        var outputId = null;
    //        GetAjax(dataString, ControllerLink, outputId);
    //        return true;
    //    });

    $('.order_status_check').click(function () {
        var imgId = $(this).attr('id');
        imgId = imgId.split('-');
        var dataString = 'id_order=' + encodeURIComponent(imgId[1]) + '&status_id=' + encodeURIComponent($('#orders_status_check-' + imgId[1]).val());
        var ControllerLink = 'orders_ajax/change_status';
        var outputId = null;
        if (GetAjax(dataString, ControllerLink, outputId) == true) {
            alert('Zmieniono status zamówienia.');
        }
        return true;
    });

    $('#customer_name').keyup(CustomerSearch);

    function CustomerSearch() {
        var dataString = 'last_name=' + encodeURIComponent($('#customer_name').val());
        var ControllerLink = 'admin_customers/ajax_customer_search';
        var outputId = '#customers_list';
        GetAjax(dataString, ControllerLink, outputId);
        return true;
    }



    /* SHOP END */

    $('#form_add_news, #form_edit_news').submit(function () {
        try {
            $('.error_message').hide();
            var formId = $(this);
            var dataString = 'title=' + encodeURIComponent($('[id^="add_news_title"]', formId).val()) +
                    '&description=' + encodeURIComponent(tinyMCE.get('add_news_description').getContent()) +
                    '&lang=' + encodeURIComponent($('[id^="add_news_language"]', formId).val()) +
                    //'&elements=' + encodeURIComponent($('#add_news_name_elements').val()) +
                    '&news_start_date=' + encodeURIComponent($('#news_start_date').val()) +
                    '&news_end_date=' + encodeURIComponent($('#news_end_date').val()) +
                    '&news_categories=' + encodeURIComponent($('#add_news_news_categories').val());
            $.ajax({
                type: "POST",
                url: urlBase + "news_ajax/validate_news_add",
                data: dataString,
                async: false,
                success: function (serverResponse) {
                    var valid = serverResponse.getElementsByTagName('validation');
                    var errorsCount = valid[0].getAttribute('counter');
                    if (errorsCount > 0) {
                        var mainElement = serverResponse.getElementsByTagName('error');
                        for (i = 0; i < mainElement.length; ++i) {
                            var att = mainElement[i].getAttribute('id');
                            att = '#' + att + '_error';
                            $(att, formId).html(mainElement[i].firstChild.nodeValue);
                            $(att, formId).show();
                        }
                    } else {
                        retValue = true;
                    }
                }
            });
            return retValue;
        } catch (e) {
            alert(e);
            return false;
        }
    });

    $('#form_add_elements, #form_edit_elements').submit(function () {
        try {
            //alert('form_add_elements');
            //alert($('#add_page_content_content').html());
            $('.error_message').hide();
            var elementType = $('#add_elements_type').val();
            var dataString = '';
            dataString += 'name_element=' + encodeURIComponent($('#add_elements_name_element').val()) + '&type=' + encodeURIComponent($('#add_elements_type').val()) + '&pageId=' + encodeURIComponent($('#add_elements_page_id').val());
            switch (elementType) {
                case "page_content":
                    //dataString += '&title=' + $('#add_page_content_title').val() + '&content=' + $('#add_page_content_content').html();
                    dataString += '&title=' + encodeURIComponent($('#add_page_content_title').val()) + '&content=' + encodeURIComponent(tinyMCE.get('add_page_content_content').getContent());
                    break;
                case "galleries":
                    dataString += '&name=' + encodeURIComponent($('#add_gallery_name').val());
                    break;
            }

            $.ajax({
                type: "POST",
                url: urlBase + "elements_ajax/validate_elements_add",
                data: dataString,
                async: false,
                success: function (serverResponse) {
                    var valid = serverResponse.getElementsByTagName('validation');
                    var errorsCount = valid[0].getAttribute('counter');
                    if (errorsCount > 0) {
                        var mainElement = serverResponse.getElementsByTagName('error');
                        for (i = 0; i < mainElement.length; ++i) {
                            var att = mainElement[i].getAttribute('id');
                            att = '#' + att + '_error';
                            $(att).html(mainElement[i].firstChild.nodeValue);
                            $(att).show();
                        }
                    } else {
                        retValue = true;
                    }
                }
            });
            return retValue;
        } catch (e) {
            alert(e);
            return false;
        }
    });

    //    $('#form_edit_elements').submit(function() {
    //        try {
    //            $('.error_message').hide();
    //            var dataString = 'name_element=' + $('#add_elements_name_element').val() + '&type=' + $('#add_elements_type').val();
    //            $.ajax({
    //                type: "POST",
    //                url: urlBase+"elements_ajax/validate_elements_add",
    //                data: dataString,
    //                async: false,
    //                success: function(serverResponse) {
    //                    var valid = serverResponse.getElementsByTagName('validation');
    //                    var errorsCount = valid[0].getAttribute('counter');
    //                    if(errorsCount > 0) {
    //                        var mainElement = serverResponse.getElementsByTagName('error');
    //                        for(i = 0 ; i < mainElement.length ; ++i) {
    //                            var att = mainElement[i].getAttribute('id');
    //                            att = '#'+att+'_error';
    //                            $(att).html(mainElement[i].firstChild.nodeValue);
    //                            $(att).show();
    //                        }
    //                    } else {
    //                        retValue = true;
    //                    }
    //                }
    //            });
    //            return retValue;
    //        } catch(e) {
    //            alert(e);
    //            return false;
    //        }
    //    });

    $('#form_add_pages, #form_edit_pages').submit(function () {
        try {
            $('.error_message').hide();
            var formId = $(this);
            var dataString = 'name_page=' + $('[id^="add_pages_name_page"]', formId).val() + '&lang=' + $('[id^="add_pages_language"]', formId).val();
            $.ajax({
                type: "POST",
                url: urlBase + "pages_ajax/validate_pages_add",
                data: dataString,
                async: false,
                success: function (serverResponse) {
                    var valid = serverResponse.getElementsByTagName('validation');
                    var errorsCount = valid[0].getAttribute('counter');
                    if (errorsCount > 0) {
                        var mainElement = serverResponse.getElementsByTagName('error');
                        for (i = 0; i < mainElement.length; ++i) {
                            var att = mainElement[i].getAttribute('id');
                            att = '#' + att + '_error';
                            $(att, formId).html(mainElement[i].firstChild.nodeValue);
                            $(att, formId).show();
                        }
                    } else {
                        retValue = true;
                    }
                }
            });
            return retValue;
        } catch (e) {
            alert(e);
            return false;
        }
    });



    //    $('[id^="form_edit_page_content"]').submit(function() {
    //        try {
    //            $('.error_message').hide();
    //            var dataString = 'title=' + $('[id^="add_page_content_title"]', this).val() + '&content=' + encodeURIComponent($('[id^="add_page_content_content"]').html());     //$('[id^="add_page_content_content"]', this).val()
    //            var formId = $(this);
    //            $.ajax({
    //                type: "POST",
    //                url: urlBase+"page_content_ajax/validate_page_content_add",
    //                data: dataString,
    //                async: false,
    //                success: function(serverResponse) {
    //                    var valid = serverResponse.getElementsByTagName('validation');
    //                    var errorsCount = valid[0].getAttribute('counter');
    //                    if(errorsCount > 0) {
    //                        var mainElement = serverResponse.getElementsByTagName('error');
    //                        for(i = 0 ; i < mainElement.length ; ++i) {
    //                            var att = mainElement[i].getAttribute('id');
    //                            att = '#'+att+'_error';
    //
    //                            $(att, formId).html(mainElement[i].firstChild.nodeValue);
    //                            $(att, formId).show();
    //                        }
    //                    } else {
    //                        retValue = true;
    //                    }
    //                }
    //            });
    //            return retValue;
    //        } catch(e) {
    //            alert(e);
    //            return false;
    //        }
    //    });
    /*
     $('#form_newsletter_add').submit(function() {
     try {
     var dataString = 'title=' + encodeURIComponent($('#add_news_title').val()) + '&description=' + encodeURIComponent($('#add_news_description').val());
     $.ajax({
     type: "POST",
     url: urlBase+"newsletter_ajax/validate_newsletter_add",
     data: dataString,
     async: false,
     success: function(serverResponse) {
     var valid = serverResponse.getElementsByTagName('validation');
     var errorsCount = valid[0].getAttribute('counter');
     if(errorsCount > 0) {
     var mainElement = serverResponse.getElementsByTagName('error');
     for(i = 0 ; i < mainElement.length ; ++i) {
     var att = mainElement[i].getAttribute('id');
     att = '#'+att+'_error';
     $(att).html(mainElement[i].firstChild.nodeValue);
     $(att).show();
     }
     } else {
     retValue = true;
     }
     }
     });
     return retValue;
     } catch(e) {
     alert(e);
     return false;
     }
     });
     */
    //$('.checkboxForm').checkbox();
//boxy
    $('[id^=delete_box_image]').live('click', function () {
        var dataString = 'id=' + $(this).attr("id");
        $.ajax({
            type: "POST",
            url: urlBase + "boxes_ajax/delete_box_image",
            data: dataString,
            async: false,
            success: function (serverResponse) {
                if (serverResponse != false) {
                    $('#box_image_' + serverResponse).html('');
                    $('#delete_box_image_' + serverResponse).html('');
                }
            }
        });
    });

    // newsy
    $('[id^=delete_news_image]').live('click', function () {
        var dataString = 'id=' + $(this).attr("id");
        $.ajax({
            type: "POST",
            url: urlBase + "news_ajax/delete_news_image",
            data: dataString,
            async: false,
            success: function (serverResponse) {
                if (serverResponse != false) {
                    $('#news_image_' + serverResponse).html('');
                    $('#delete_news_image' + serverResponse).html('');
                }
            }
        });
    });

    // newsy
    $('#delete_product_category_image').live('click', function () {
        var dataString = 'id=' + $(this).attr("class");
        $.ajax({
            type: "POST",
            url: urlBase + "admin_products_categories/delete_product_category_image",
            data: dataString,
            async: false,
            success: function (serverResponse) {
                $('div#category_img').html(serverResponse);
            }
        });
    });

    $('#delete_product_category_banner').live('click', function () {
        var dataString = 'id=' + $(this).attr("class");
        $.ajax({
            type: "POST",
            url: urlBase + "admin_products_categories/delete_product_category_banner",
            data: dataString,
            async: false,
            success: function (serverResponse) {
                $('div#category_banner').html(serverResponse);
            }
        });
    });






    // elements

    // po wybraniu typu wyswietlamy odpowiedni formularz
    $('[id^="add_elements_type"]').change(function () {
        try {
            $('#form_for_type').slideUp('slow');
            var dataString = 'type=' + $(this).val();
            $.ajax({
                type: "POST",
                url: urlBase + "elements_ajax/get_element_form",
                data: dataString,
                async: true,
                success: function (serverResponse) {
                    $('#form_for_type').html(serverResponse);
                    $('#form_for_type').slideDown('slow')
                }
            });
        } catch (e) {
            alert(e);
            return false;
        }
    });






    $('#add_pages_language').live('change', function () {
        try {
            var dataString = 'lang=' + $(this).val();
            $.ajax({
                type: "POST",
                url: urlBase + "pages_ajax/get_parent_pages_for_lang",
                data: dataString,
                async: true,
                success: function (serverResponse) {
                    $('#add_pages_pages').html(serverResponse)
                }
            });
        } catch (e) {
            alert(e);
            return false;
        }
    });





    // po wybraniu dodaj lub edytuj newsa wyswietlamy odpowiedni formularz
    //    $('[id^="edit_news_button"]').live("click", function() {
    //        try {
    //            $('#form_action').slideUp('slow');
    //            var dataString = 'id=' + $(this).attr('id');
    //            $.ajax({
    //                type: "POST",
    //                url: urlBase+"news_ajax/get_form_edit/",
    //                data: dataString,
    //                async: true,
    //                success: function(serverResponse) {
    //                    $('#form_action').html(serverResponse);
    //                    $('#form_action').slideDown('slow')
    //                }
    //            });
    //        } catch(e) {
    //            alert(e);
    //            return false;
    //        }
    //    });



    $('#admin_news_view .pagination span').live('click', function () {
        try {
            var dataString;
            $.ajax({
                type: "POST",
                url: $(this).attr("title"),
                data: dataString,
                async: false,
                success: function (serverResponse) {
                    $('#news_table').html(serverResponse);
                    return false;
                },
                error: function () {
                    //alert('zle');
                    return false;
                }
            });
        } catch (e) {
            alert(e);
            return false;
        }
    });

    $('#admin_polls_index .pagination span').live('click', function () {
        try {
            var dataString;
            $.ajax({
                type: "POST",
                url: $(this).attr("title"),
                data: dataString,
                async: false,
                success: function (serverResponse) {
                    $('#polls_table').html(serverResponse);
                    return false;
                },
                error: function () {
                    //alert('zle');
                    return false;
                }
            });
        } catch (e) {
            alert(e);
            return false;
        }
    });



    // walidacja dodawania użytkownika
    $('#form_user_add').submit(function () {
        var retValue = false;
        try {
            $('.error_message').hide();
            $('.loader').hide();
            var dataString = 'email=' + encodeURIComponent($('#email').val()) + '&password=' + encodeURIComponent($('#password').val()) + '&confirm_password=' + encodeURIComponent($('#confirm_password').val()) + '&first_name=' + encodeURIComponent($('#first_name').val()) + '&last_name=' + encodeURIComponent($('#last_name').val());
            $.ajax({
                type: "POST",
                url: urlBase + "users_ajax/validate_user_add",
                data: dataString,
                async: false,
                success: function (serverResponse) {
                    var valid = serverResponse.getElementsByTagName('validation');
                    var errorsCount = valid[0].getAttribute('counter');
                    if (errorsCount > 0) {
                        var mainElement = serverResponse.getElementsByTagName('error');
                        for (i = 0; i < mainElement.length; ++i) {
                            var att = mainElement[i].getAttribute('id');
                            att = '#' + att + '_error';
                            $(att).html(mainElement[i].firstChild.nodeValue);
                            $(att).show();
                        }
                    } else {
                        retValue = true;
                    }
                }
            });
            return retValue;
        } catch (e) {
            alert(e);
            return false;
        }
    });

    // walidacja edycji użytkownika
    $('#form_user_edit').submit(function () {
        var retValue = false;
        try {
            $('.error_message').hide();
            $('.loader').hide();
            var dataString = 'email=' + encodeURIComponent($('#email').val()) + '&first_name=' + encodeURIComponent($('#first_name').val()) + '&last_name=' + encodeURIComponent($('#last_name').val());
            if ($('#change_password').is(':checked')) {
                dataString += '&change_password=' + encodeURIComponent($('#change_password').val()) + '&password=' + encodeURIComponent($('#password').val()) + '&confirm_password=' + encodeURIComponent($('#confirm_password').val());
            }
            $.ajax({
                type: "POST",
                url: urlBase + "users_ajax/validate_user_edit",
                data: dataString,
                async: false,
                success: function (serverResponse) {
                    var valid = serverResponse.getElementsByTagName('validation');
                    var errorsCount = valid[0].getAttribute('counter');
                    if (errorsCount > 0) {
                        var mainElement = serverResponse.getElementsByTagName('error');
                        for (i = 0; i < mainElement.length; ++i) {
                            var att = mainElement[i].getAttribute('id');
                            att = '#' + att + '_error';
                            $(att).html(mainElement[i].firstChild.nodeValue);
                            $(att).show();
                        }
                    } else {
                        retValue = true;
                    }
                }
            });
            return retValue;
        } catch (e) {
            alert(e);
            return false;
        }
    });

    // walidacja dodawania roli
    $('#form_role_add, #form_role_edit').submit(function () {
        var retValue = false;
        try {
            $('.error_message').hide();
            $('.loader').hide();
            var dataString = 'name=' + encodeURIComponent($('#name').val());
            //dataString = dataString + '&' + $('input[name^=permission]').serialize();
            $.ajax({
                type: "POST",
                url: urlBase + "users_ajax/validate_role_add",
                data: dataString,
                async: false,
                success: function (serverResponse) {
                    var valid = serverResponse.getElementsByTagName('validation');
                    var errorsCount = valid[0].getAttribute('counter');
                    if (errorsCount > 0) {
                        var mainElement = serverResponse.getElementsByTagName('error');
                        for (i = 0; i < mainElement.length; ++i) {
                            var att = mainElement[i].getAttribute('id');
                            att = '#' + att + '_error';
                            $(att).html(mainElement[i].firstChild.nodeValue);
                            $(att).show();
                        }
                    } else {
                        retValue = true;
                    }
                }
            });
            return retValue;
        } catch (e) {
            alert(e);
            return false;
        }
    });

    /*
     // pobieranie podkategorii dla kategorii wyświetlanej w liście kategorii
     $('#categories_index tr').live('click', function() {
     try {
     var addContent = false;
     var domElement = $(this);
     var aCollapsedIds = $('#collapsed').val();
     var iClickedId = parseInt($(domElement.children(':first')).html());
     var dataString = 'id_product_category=' + encodeURIComponent(iClickedId);
     $.ajax({
     type: "POST",
     url: urlBase+"products_categories_ajax/get_subcategories",
     data: dataString,
     async: false,
     success: function(serverResponse) {
     if($('#collapsed').val() == '') {
     addContent = true;
     $('#collapsed').val( $('#collapsed').val() + $(domElement.children(':first')).html());
     } else {
     if($('#collapsed').val().indexOf(iClickedId) == -1) {
     addContent = true;
     $('#collapsed').val( $('#collapsed').val() + ','+ $(domElement.children(':first')).html());
     } else {
     addContent = false;
     $('#collapsed').val( $('#collapsed').val() + ','+ $(domElement.children(':first')).html());
     }
     }
     if(addContent) {
     domElement.after(serverResponse);
     }
     }
     });
     } catch(e) {
     alert(e);
     return '';
     }
     });
     */

    $('#admin_product_add #lang, #admin_product_edit #lang').change(function () {
        try {
            var dataString = 'lang=' + encodeURIComponent($('#lang').val());
            $.ajax({
                type: "POST",
                url: urlBase + "products_ajax/get_categories",
                data: dataString,
                async: false,
                success: function (serverResponse) {
                    $('#product_category_id').html(serverResponse);
                }
            });
        } catch (e) {
            alert(e);
            return '';
        }
    });

    $('#product_category_add #lang, #product_category_edit #lang').change(function () {
        try {
            var dataString = 'lang=' + encodeURIComponent($('#lang').val());
            $.ajax({
                type: "POST",
                url: urlBase + "products_ajax/get_categories",
                data: dataString,
                async: false,
                success: function (serverResponse) {
                    $('#parent_product_category_id').html(serverResponse);
                }
            });
        } catch (e) {
            alert(e);
            return '';
        }
    });

    $('#main_product_category_add #lang, #main_product_category_edit #lang').change(function () {
        try {
            var dataString = 'lang=' + encodeURIComponent($('#lang').val());
            $.ajax({
                type: "POST",
                url: urlBase + "products_ajax/get_categories",
                data: dataString,
                async: false,
                success: function (serverResponse) {
                    $('#parent_product_category_id').html(serverResponse);
                }
            });
        } catch (e) {
            alert(e);
            return '';
        }
    });


    $('#product_search').keyup(function () {
        try {
            var dataString = 'product_search=' + encodeURIComponent($('#product_search').val());
            $.ajax({
                type: "POST",
                url: urlBase + "products_ajax/search_products",
                data: dataString,
                async: true,
                success: function (serverResponse) {
                    $('#product_list').html(serverResponse);
                }
            });
        } catch (e) {
            alert(e);
            return '';
        }
    });


    $('#element_search').keyup(function () {
        try {
            var dataString = 'element_search=' + encodeURIComponent($('#element_search').val());
            $.ajax({
                type: "POST",
                url: urlBase + "elements_ajax/element_search",
                data: dataString,
                async: true,
                success: function (serverResponse) {
                    $('#elements_list').html(serverResponse);
                }
            });
        } catch (e) {
            alert(e);
            return '';
        }
    });

    $('[class^="pagesParentId"]').click(function () {
        var sClass = $(this).attr('class');
        var aCatId = sClass.split('-');
        $('#pagesTree-' + aCatId[1]).slideToggle('slow');
        if ($(this).html() == 'rozwiń') {
            $(this).html('zwiń');
        }
        else {
            $(this).html('rozwiń');
        }
    });

    $('#updateZ500').click(function () {
        $('#updateLoader').show();
        $.ajax({
            type: "POST",
            url: urlBase + "z500/update",
            async: true,
            success: function (serverResponse) {
                alert('Pobrano projekty z Z500.');
                $('#debug').html(serverResponse);
            }
        });
        $('#updateLoader').hide();
        return false;
    });

    $("#z500_index table.z500ProjectsList tr:odd").css("background-color", "#E8EDFF");
});

$('[id^=delete_attr_image]').live('click', function () {
    var dataString = 'id=' + $(this).attr("id");
    $.ajax({
        type: "POST",
        url: urlBase + "ajax/delete_attr_image",
        data: dataString,
        async: false,
        success: function (serverResponse) {
            if (serverResponse != false) {
                $('#attr_image_' + serverResponse).html('');
                $('#delete_attr_image_' + serverResponse).html('');
            }
        }
    });
});

function showI18nDialog(dlg, lngId, pId) {
    lngId += 0;
    pId += 0;
    try {
        var dataString = 'cmd=get&dlg=' + encodeURIComponent(dlg) + '&lngId=' + encodeURIComponent(lngId) + '&pId=' + encodeURIComponent(pId);
        var fld = '';
        fld = dlg.substr(0, dlg.indexOf('_dialog'));
        $.ajax({
            type: 'POST',
            url: urlBase + "admin_products/translate",
            data: dataString,
            async: true,
            success: function (serverResponse) {
                $("#" + dlg).dialog({
                    minHeight: 100,
                    minWidth: 100,
                    resizable: false,
                    buttons: {
                        'Ok': function () {
                            saveI18nDialog(dlg, lngId, pId, $('#' + fld).val() || $('#' + fld).html());
                            $(this).dialog('close');
                        }
                    }
                });
                $('#' + dlg).val(serverResponse);
            }
        });
    } catch (e) {
        alert(e);
        return '';
    }
}

function saveI18nDialog(dlg, lngId, pId, val) {
    lngId += 0;
    pId += 0;
    try {
        var dataString = 'cmd=set&dlg=' + encodeURIComponent(dlg) + '&lngId=' + encodeURIComponent(lngId) + '&pId=' + encodeURIComponent(pId) + '&val=' + encodeURIComponent(val);
        $.ajax({
            type: 'POST',
            url: urlBase + "admin_products/translate",
            data: dataString,
            async: true,
            success: function (serverResponse) {
                alert(serverResponse);
            },
            error: function () {
                alert('Błąd podczas tłumaczenia.');
            }
        });
    } catch (e) {
        alert(e);
        return '';
    }
}

function resizeLogin()
{
    var loginDiv = document.getElementById('admin-user-login');
    if (loginDiv !== null) {
        var headerDiv = document.getElementById('header');
        var footerDiv = document.getElementById('footer');
        var bodyH = $(document).height();

        //console.log(bodyH);
        //console.log(headerDiv.clientHeight);
        //console.log(footerDiv.clientHeight);

        var viewPortHeight = (bodyH - headerDiv.clientHeight) - footerDiv.clientHeight;
        var height = Math.max(viewPortHeight, loginDiv.clientHeight) + 'px';

        //console.log(viewPortHeight);
        //console.log(height);

        $('div#admin-user-login').css('height', height);
        $('div#admin-user-login').css('min-height', height);
        $('#content_wrapper').css('background-color', '#2a2929');
    }

}

function resizeMenu()
{
    var menuDiv = document.getElementById('main_left');
    if (menuDiv !== null) {
        var headerDiv = document.getElementById('header');
        var footerDiv = document.getElementById('footer');
        var bodyH = $(document).height();

        //console.log(bodyH);
        //console.log(headerDiv.clientHeight);
        //console.log(footerDiv.clientHeight);

        var viewPortHeight = (bodyH - headerDiv.clientHeight) - footerDiv.clientHeight;
        var height = Math.max(viewPortHeight, menuDiv.clientHeight) + 'px';

        //console.log(viewPortHeight);
        //console.log(height);

        $('div#main_left').css('min-height', height);
    }

}


$(document).ready(function () {

    resizeMenu()
    resizeLogin()




    $('div.ui-tabs ul li a').click(function ()
    {
        var menuDiv = document.getElementById('main_left');
        if (menuDiv !== null) {
            var headerDiv = document.getElementById('header');
            var footerDiv = document.getElementById('footer');
            var bodyH = $(document).height();

            console.log(bodyH);
            //console.log(headerDiv.clientHeight);
            //console.log(footerDiv.clientHeight);

            var viewPortHeight = (bodyH - headerDiv.clientHeight) - footerDiv.clientHeight;
            var height = Math.max(viewPortHeight, menuDiv.clientHeight) + 'px';

            //console.log(viewPortHeight);
            //console.log(height);

            $('div#main_left').css('min-height', height);
        }

    });

});

function showLangPopUp(lang, id, table, input) {
    $("#trans-pop-up").remove();
    var popBody = '';
    var input_name = $('.show-' + lang).siblings(input).attr("name");
    var value = '';

    $.post(urlBase + "languages/ajax_get", {id: id, table: table, lang: lang, input_name: input_name}).done(function (data) {
        value = data;
        popBody += '<div id="trans-pop-up">';
        popBody += '<form action="" id="form_result" method="post">';
        popBody += '<label for="' + input_name + '">Przetłumacz:</label><br />';
        if (input == 'input') {
            popBody += '<input type="text" name="' + input_name + '" value="' + value + '" />';
        }
        else if (input == 'textarea') {
            popBody += '<textarea name="' + input_name + '" cols="60" rows="5"></textarea>';
        }

        popBody += '<input type="hidden" name="table" value="' + table + '" />';
        popBody += '<input type="hidden" name="lang" value="' + lang + '" />';
        popBody += '<input type="hidden" name="id" value="' + id + '" />';
        popBody += '<span class="send-form">Wyślij</span>';
        popBody += '<span class="close-form">X</span>';
        popBody += '</form>';
        popBody += '</div>';
        $('.show-' + lang).after(popBody);
    });

}

$(function () {
    $('#automatically_generate').click(function () {
        if ($(this).is(':checked')) {
            $('#rebate_code').attr('disabled', 'disabled');
        } else {
            $('#rebate_code').removeAttr('disabled');
        }
    });
});

$(function () {
    $('#automatically_generate').click(function () {
        if ($(this).is(':checked')) {
            $('#quantity_codes').removeAttr('disabled');
        } else {
            $('#quantity_codes').attr('disabled', 'disabled');
        }
    });
});



$(document).ready(function () {

    $('.update_photo').click(function () {
        var photoAlt = $(this).parent().find('.photo_alt').val();
        var photoId = $(this).parent().find('.photo_id').val();
        $.post(urlBase + "4dminix/galeria/edytuj_zdjecie", {id_image: photoId, alt: photoAlt}, function (data) {
            $('#main_content').prepend(data);
            $('#photo_alt_' + photoId).html(photoAlt);
            $('#photo_alt_' + photoId).next().next().hide(
                    "drop",
                    {direction: "down"},
            "slow"
                    );
        });
    });


    $('[id^="add_image_button"]').click(function () {
        $(this).parent().parent().find('[id^="add_gallery_image"]').show("slide", {direction: "up"}, 1000);
    });

    $("#close").click(function () {
        $("#add_gallery_image").hide(
                "drop",
                {direction: "down"},
        "slow"
                );
    });

    $(".admin_edit_image_alt").click(function () {
        $(this).next().show("slide", {direction: "up"}, 1000);
    });
});




