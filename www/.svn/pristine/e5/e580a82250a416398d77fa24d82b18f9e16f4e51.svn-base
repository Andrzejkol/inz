<div id="popup_add">
    <div id="element_title">
        <h2>Dodaj element</h2>
    </div>
    <?php echo form::open_multipart(null); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">Nazwa</td>
            <td><input type="text" name="title" id="popup_title" style="width: 350px" value="<?php echo (!empty($_POST['title']) ? $_POST['title'] : NULL); ?>" /></td>
            <td><div id="title_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">Nazwa przycisku</td>
            <td><input type="text" name="button_text" id="popup_button_text" style="width: 350px" value="<?php echo (!empty($_POST['button_text']) ? $_POST['button_text'] : NULL); ?>" /></td>
            <td><div id="button_text_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">Zawartość</td>
            <td><textarea name="content" id="popup_content" style="width: 350px; height:300px; resize:none;" class="tinyText"><?php echo (!empty($_POST['content']) ? $_POST['content'] : NULL); ?> </textarea></td>
            <td><div id="content_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">Typ elementu</td>
            <td>
                <select name="type_id" id="popup_type">
                    <option value="1" selected="selected">Popup</option>
                </select>
                <script>
                    $(document).ready(function () {
                        $('select#popup_type').val('<?php echo (!empty($_POST['popup_type']) ? $_POST['popup_type'] : ''); ?>');
                    });
                </script>
            </td>
            <td><div id="type_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">Link</td>
            <td><input type="text" name="link" id="popup_link" style="width: 350px" value="<?php echo (!empty($_POST['link']) ? $_POST['link'] : NULL); ?>" /></td>
            <td><div id="link_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">Aktywny</td>
            <td>
                <select name="active" id="popup_active">
                    <option value="0">Nie</option>
                    <option value="1" selected="selected">Tak</option>
                </select>
                <script>
                    $(document).ready(function () {
                        $('select#popup_active').val('<?php echo (!empty($_POST['active']) ? $_POST['active'] : '1'); ?>');
                    });
                </script>
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">Data od</td>
            <td><input type="date" name="date_start" min="<?php echo date('Y-m-d', time()); ?>" id="popup_date_start" style="width: 350px" value="<?php echo (!empty($_POST['date_start']) ? $_POST['date_start'] : date('Y-m-d', time())); ?>" /></td>
            <td><div id="date_start_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">Data do</td>
            <td><input type="date" name="date_end"  min="<?php echo date('Y-m-d', time()); ?>" id="popup_date_end" style="width: 350px" value="<?php echo (!empty($_POST['date_end']) ? $_POST['date_end'] : date('Y-m-d', time())); ?>" /></td>
            <td><div id="date_end_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td style="width: 200px">
                <input type="button" value="Wróć" name="back" class="ui-button ui-widget ui-state-default ui-corner-all back"/>
            </td>
            <td colspan="2">
                <input type="submit" value="Zapisz" name="submit" class="ui-button ui-widget ui-state-default ui-corner-all" />
                <input type="submit" value="Zapisz i wróć" name="submit_back" class="ui-button ui-widget ui-state-default ui-corner-all" />
            </td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>
