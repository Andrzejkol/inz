<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('rebate_group.add_rebate_group')
            ))->render(TRUE);
?>
<div id="admin_rebate_group_add">
    <?php echo form::open_multipart(null, array('id' => 'admin_rebate_group_add_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="group_name"><?php echo Kohana::lang('rebate_group.group_name'); ?></label>
            </td>
            <td><input type="text" name="group_name" id="group_name" /></td>
            <td><div id="group_name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="rebate"><?php echo Kohana::lang('rebate_group.rebate'); ?></label>
            </td>
            <td>
                <input type="text" name="rebate" id="rebate" value="" size="4" /> %
            </td>
            <td><div id="rebate_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('rebate_group.active'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('rebate_group.comments.active'); ?></span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active" />
            </td>
            <td><div id="active_value_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('rebate_group.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>