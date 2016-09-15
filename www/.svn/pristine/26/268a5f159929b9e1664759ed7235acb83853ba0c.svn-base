<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('attribute.add_attribute')
            ))->render(TRUE);
?>
<div id="admin_attribute_add">
    <?php echo form::open(null, array('id' => 'admin_attribute_add_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="attribute_name"><?php echo Kohana::lang('attribute.attribute_name'); ?></label>
                <span class="label_comment">Nazwa atrybutu. Pole wymagane.</span>
            </td>
            <td><input type="text" name="attribute_name" id="attribute_name" /></td>
            <td><div id="attribute_name_error" class="error_message"></div></td>
        </tr>
        <!--
        <tr>
            <td class="td_form_left"><label for="display_as"><?php echo Kohana::lang('attribute.display_as'); ?></label></td>
            <td>
                <select id="display_as" name="display_as">
                    <option value="dropdownlist">Lista rozwijana</option>
                    <option value="radiogrouplist">Lista radio</option>
                </select>
            </td>
            <td><div id="display_as_error" class="error_message"></div></td>
        </tr>
        -->
        <tr>
            <td class="td_form_left">
                <label for="position"><?php echo Kohana::lang('attribute.position'); ?></label>
            </td>
            <td>
                <input type="text" name="position" id="position" value="0" />
            </td>
            <td><div id="position_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="options"><?php echo Kohana::lang('attribute.options'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('attribute.comments.options'); ?></span>
            </td>
            <td>
                <textarea name="options" id="options" rows="2" cols="20"></textarea>
            </td>
            <td><div id="options_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('attribute.active'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('attribute.comments.active'); ?></span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active" />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('attribute.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>