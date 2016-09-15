<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'add',
            'sTitle' => Kohana::lang('tax.add_tax')
        ))->render(TRUE);
?>
<div id="admin_tax_add">
    <?php echo form::open_multipart(null, array('id' => 'admin_tax_add_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="tax_name"><?php echo Kohana::lang('tax.tax_name'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('tax.comments.tax_name'); ?></span>
            </td>
            <td><input type="text" name="tax_name" id="tax_name" /></td>
            <td><div id="tax_name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="tax_value"><?php echo Kohana::lang('tax.tax_value'); ?></label>
            </td>
            <td>
                <input type="text" name="tax_value" id="tax_value" value="" size="4" /> %
            </td>
            <td><div id="tax_value_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('tax.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save" /></td>
            <td>
                <input type="hidden" value="" name="tax_id" id="tax_id" />
            </td>
    </table>
    <?php echo form::close(); ?>
</div>