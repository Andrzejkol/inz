<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('producer.add_producer')
            ))->render(TRUE);
?>
<div id="admin_producer_add">
    <?php echo form::open_multipart(null, array('id' => 'admin_producer_add_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="name"><?php echo Kohana::lang('producer.producer_name'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('producer.comments.producer_name'); ?></span>
            </td>
            <td><input type="text" name="producer_name" id="producer_name" /></td>
            <td><div id="producer_name_error" class="error_message"></div></td>
        </tr>
        <!--
        <tr>
            <td class="td_form_left">
                <label for="rebate"><?php echo Kohana::lang('producer.rebate'); ?></label>
            </td>
            <td>
                <input type="text" name="rebate" id="rebate" value="" size="4" /> %
            </td>
            <td><div id="rebate_error" class="error_message"></div></td>
        </tr>
        -->
        <tr>
            <td class="td_form_left">
                <label for="producer_logo"><?php echo Kohana::lang('producer.producer_logo'); ?></label>
            </td>
            <td>
                <input type="file" name="producer_logo" id="producer_logo" accept="image/gif, image/jpeg, image/png, image/pjpeg, image/x-png, image/bmp" />
            </td>
            <td><div id="producer_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('producer.active'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('producer.comments.active'); ?></span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active" />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('payment_type.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>