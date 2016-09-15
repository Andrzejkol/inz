<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('product_status.edit_product_status')
            ))->render(TRUE);
?>
<div id="admin_product_status_add">
    <?php echo form::open(null, array('id' => 'admin_product_status_edit_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="product_status_name"><?php echo Kohana::lang('product_status.product_status_name'); ?></label>
            </td>
            <td><input type="text" name="product_status_name" id="product_status_name" value="<?php echo $oProductStatusDetails->product_status_name; ?>" /></td>
            <td><div id="product_status_name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="allow_buy"><?php echo Kohana::lang('product_status.allow_buy'); ?></label>
            </td>
            <td>
                <input type="checkbox" name="allow_buy" id="allow_buy"<?php if($oProductStatusDetails->allow_buy=='Y'){echo ' checked="checked"';} ?> />
            </td>
            <td><div id="allow_buy_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('product_status.active'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product_status.comments.active'); ?></span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active"<?php if($oProductStatusDetails->active=='Y'){echo ' checked="checked"';} ?> />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('product_status.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('product_status.save'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>