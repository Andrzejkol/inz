<div class="reservation-form">
    <?php echo form::open(NULL); ?>
    <ul id="reservation-form">
        <li class="half-form">
            <label for="r_from"><?php echo Kohana::lang('contact_form.r_from'); ?>:  <b>*</b></label>
            <input type="text" required="required" min="<?php echo date('Y-m-d'); ?>" name="r_from" id="r_from" class="form-input" value="<?php echo!empty($_POST['r_from']) ? $_POST['r_from'] : '' ?>" />
        </li>
        <li class="half-form">
            <label for="r_to"><?php echo Kohana::lang('contact_form.r_to'); ?>:  <b>*</b></label>
            <input type="text" required="required" min="<?php echo date('Y-m-d'); ?>" name="r_to" id="r_to" class="form-input" value="<?php echo!empty($_POST['r_to']) ? $_POST['r_to'] : '' ?>"/>
        </li>

        <li class="r_rooms half-form">
            <label for="r_rooms"><?php echo Kohana::lang('contact_form.r_rooms'); ?>:  <b>*</b></label>
            <select required="required" name="r_rooms" class="form-input r_rooms">
                <option><?php echo Kohana::lang('contact_form.r_select'); ?></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option> 
                <option value="1">6</option>
                <option value="2">7</option>
                <option value="3">8</option>
                <option value="4">9</option>
                <option value="5">10</option>
            </select>
        </li>

        <li>
            <label for="r_message"><?php echo Kohana::lang('contact_form.r_message'); ?>: </label>
            <textarea name="r_message" id="r_message" cols="32" rows="5" ><?php echo!empty($_POST['r_message']) ? $_POST['r_message'] : '' ?></textarea>
        </li>

        <li>
            <label for="r_name"><?php echo Kohana::lang('contact_form.r_name'); ?>:  <b>*</b></label>
            <input required="required" type="text" name="r_name" id="r_name" class="form-input" value="<?php echo!empty($_POST['r_name']) ? $_POST['r_name'] : '' ?>" />
        </li>
        <li>
            <label for="r_surname"><?php echo Kohana::lang('contact_form.r_surname'); ?>:  <b>*</b></label>
            <input required="required" type="text" name="r_surname" id="r_surname" class="form-input" value="<?php echo!empty($_POST['r_surname']) ? $_POST['r_surname'] : '' ?>" />
        </li>
        <li>
            <label for="r_email"><?php echo Kohana::lang('contact_form.r_email'); ?>:  <b>*</b></label>
            <input required="required" type="text" name="r_email" id="r_email" class="form-input" value="<?php echo!empty($_POST['r_email']) ? $_POST['r_email'] : '' ?>" />
        </li>
        <li>
            <label for="r_phone"><?php echo Kohana::lang('contact_form.r_phone'); ?>:  <b>*</b></label>
            <input required="required" type="text" name="r_phone" id="r_phone" class="form-input" value="<?php echo!empty($_POST['r_phone']) ? $_POST['r_phone'] : '' ?>" />
        </li>

        <li>
            <label for="r_personal_info" class="r_personal_info">
                <input required="required" type="checkbox" name="r_personal_info" id="r_personal_info" class="form-input" />
                <span><?php echo Kohana::lang('contact_form.r_personal_info'); ?></span> <b>*</b>
            </label>
        </li>
        <li>
            <label for="r_ads_info" class="r_ads_info">
                <input required="required" type="checkbox" name="r_ads_info" id="r_ads_info" class="form-input" />
                <span><?php echo Kohana::lang('contact_form.r_ads_info'); ?></span> <b>*</b>
            </label>
        </li>

        <li>
            <input type="hidden" name="element_id" id="element_id" value="<?php echo $iElementId; ?>" />
            <button type="submit" style="float:right;" value="reservation_form_submit" name="r_form_submit" class="btn btn-big form-submit"><?php echo Kohana::lang('contact_form.r_send_button') ?></button>
        </li>
    </ul>
    <?php echo form::close(); ?>

    <?php if (Kohana::lang('links.lang') == 'de/'): ?>
        <script type="text/javascript">
            $(document).ready(function () {

                $("#r_from").datepicker({
                    dateFormat: 'yy-mm-dd',
                    closeText: 'Zamknij',
                    firstDay: 1,
                    prevText: '&#x3c;zurück', prevStatus: '',
                    prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
                    nextText: 'Vor&#x3e;', nextStatus: '',
                    nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
                    currentText: 'heute', currentStatus: '',
                    todayText: 'heute', todayStatus: '',
                    clearText: '-', clearStatus: '',
                    closeText: 'schließen', closeStatus: '',
                    monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
                        'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
                    monthNamesShort: ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'],
                    dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
                    dayNamesShort: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
                    dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
                    numberOfMonths: 1,
                    onClose: function (selectedDate) {
                        $("#to").datepicker("option", "minDate", selectedDate);
                    }
                });
                $("#r_to").datepicker({
                    dateFormat: 'yy-mm-dd',
                    closeText: 'Zamknij',
                    firstDay: 1,
                    prevText: '&#x3c;zurück', prevStatus: '',
                    prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
                    nextText: 'Vor&#x3e;', nextStatus: '',
                    nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
                    currentText: 'heute', currentStatus: '',
                    todayText: 'heute', todayStatus: '',
                    clearText: '-', clearStatus: '',
                    closeText: 'schließen', closeStatus: '',
                    monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
                        'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
                    monthNamesShort: ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'],
                    dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
                    dayNamesShort: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
                    dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
                    numberOfMonths: 1,
                    onClose: function (selectedDate) {
                        $("#from").datepicker("option", "maxDate", selectedDate);
                    }
                });
            });</script>
    <?php elseif (Kohana::lang('links.lang') == 'en/'): ?>
        <script type="text/javascript">
            $(document).ready(function () {

                $("#r_from").datepicker({
                    dateFormat: 'yy-mm-dd',
                    numberOfMonths: 1,
                    onClose: function (selectedDate) {
                        $("#to").datepicker("option", "minDate", selectedDate);
                    }
                });
                $("#r_to").datepicker({
                    dateFormat: 'yy-mm-dd',
                    numberOfMonths: 1,
                    onClose: function (selectedDate) {
                        $("#from").datepicker("option", "maxDate", selectedDate);
                    }
                });
            });</script>
    <?php else: ?>
        <script type="text/javascript">
            $(document).ready(function () {

                $("#r_from").datepicker({
                    dateFormat: 'yy-mm-dd',
                    closeText: 'Zamknij',
                    firstDay: 1,
                    prevText: '&#x3c;Poprzedni',
                    nextText: 'Następny&#x3e;',
                    currentText: 'Dziś',
                    monthNames: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec',
                        'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
                    monthNamesShort: ['Sty', 'Lu', 'Mar', 'Kw', 'Maj', 'Cze',
                        'Lip', 'Sie', 'Wrz', 'Pa', 'Lis', 'Gru'],
                    dayNames: ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
                    dayNamesShort: ['Nie', 'Pn', 'Wt', 'Śr', 'Czw', 'Pt', 'So'],
                    dayNamesMin: ['N', 'Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'So'],
                    weekHeader: 'Tydz',
                    numberOfMonths: 1,
                    onClose: function (selectedDate) {
                        $("#to").datepicker("option", "minDate", selectedDate);
                    }
                });
                $("#r_to").datepicker({
                    dateFormat: 'yy-mm-dd',
                    closeText: 'Zamknij',
                    firstDay: 1,
                    prevText: '&#x3c;Poprzedni',
                    nextText: 'Następny&#x3e;',
                    currentText: 'Dziś',
                    monthNames: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec',
                        'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
                    monthNamesShort: ['Sty', 'Lu', 'Mar', 'Kw', 'Maj', 'Cze',
                        'Lip', 'Sie', 'Wrz', 'Pa', 'Lis', 'Gru'],
                    dayNames: ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
                    dayNamesShort: ['Nie', 'Pn', 'Wt', 'Śr', 'Czw', 'Pt', 'So'],
                    dayNamesMin: ['N', 'Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'So'],
                    weekHeader: 'Tydz',
                    numberOfMonths: 1,
                    onClose: function (selectedDate) {
                        $("#from").datepicker("option", "maxDate", selectedDate);
                    }
                });
            });</script>
    <?php endif; ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('select.r_rooms').change(function () {
                var i = 1;
                $('li.r_person_count').remove();
                $('li.r_room_type').remove();
                for (i = $(this).val(); i >= 1; i--) {
                    $('<li class="r_person_count half-form">' +
                            '<label for="r_person_count"><?php echo Kohana::lang('contact_form.r_person_count'); ?>' +
                            ' ' + i + ':<b>*</b> </label>' +
                            '<select name="r_person_count[]" class="form-input r_count_' + i + '" required="required">' +
                            '<option><?php echo Kohana::lang('contact_form.r_select'); ?></option>' +
                            '<option value="1">1</option>' +
                            '<option value="2">2</option>' +
                            '<option value="3">3</option>' +
                            '<option value="4">4</option>' +
                            '<option value="5">5</option>' +
                            '</select>' +
                            '</li>' +
                            '<li class="r_room_type half-form r_room_type-' + i + '">' +
                            '<label><?php echo Kohana::lang('contact_form.r_room_type'); ?> ' + i + ':<b>*</b></label>' +
                            '<select name="r_room_type[]" class="form-input r_type_' + i + '" required="required">' +
                            '<option><?php echo Kohana::lang('contact_form.r_select'); ?></option>' +
                            '<option value="1"><?php echo Kohana::lang('contact_form.r_type_normal'); ?></option>' +
                            '<option value="2"><?php echo Kohana::lang('contact_form.r_type_vip'); ?></option>' +
                            '</select>' +
                            '</li>' +
                            '').insertAfter('li.r_rooms');
                }
                $('.r_room_type select').on('change', function () {

                    if ($(this).val() == '2') {
                        $('.r_room_type select option[value="2"]').attr('disabled', 'disabled');
                        $(this).find('option[value="2"]').removeAttr('disabled');
                    } else
                    if ($(this).val() == '3') {
                        $('.r_room_type select option[value="3"]').attr('disabled', 'disabled');
                        $(this).find('option[value="3"]').removeAttr('disabled');
                    } else {
                        var count2 = 0;
                        var count3 = 0;
                        $('.r_room_type select').each(function () {
                            if ($(this).val() == '2') {
                                count2++;
                            }
                            if ($(this).val() == '3') {
                                count3++;
                            }
                        });
                        if (count2 == 0) {
                            $('.r_room_type select').each(function () {
                                $(this).find('option[value="2"]').removeAttr('disabled');
                            });
                        }
                        if (count3 == 0) {
                            $('.r_room_type select').each(function () {
                                $(this).find('option[value="3"]').removeAttr('disabled');
                            });
                        }
                    }
                });

            });
        });
    </script>

</div>