<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'edit',
            'sTitle' => Kohana::lang('producer.edit_producer')
        ))->render(TRUE);
?>
<div id="admin_producer_edit">
    <?php echo form::open_multipart(null, array('id' => 'admin_producer_edit_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="name"><?php echo Kohana::lang('producer.producer_name'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('producer.comments.producer_name'); ?></span>
            </td>
            <td><input type="text" name="producer_name" id="producer_name" value="<?php echo $oProducerDetails->producer_name; ?>" /></td>
            <td><div id="producer_name_error" class="error_message"></div></td>
        </tr>
        <!--
        <tr>
            <td class="td_form_left">
                <label for="rebate"><?php echo Kohana::lang('producer.rebate'); ?></label>
            </td>
            <td>
                <input type="text" name="rebate" id="rebate" value="<?php echo $oProducerDetails->rebate; ?>" size="4" /> %
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
                <?php
                if (!empty($oProducerDetails->producer_logo)) {
                    echo html::image(Producer_Model::PRODUCER_LOGO_THUMBSPATH . $oProducerDetails->producer_logo, array('style' => 'border: 1px solid #afafaf; padding: 2px;'));
                }
                ?>
            </td>
            <td><div id="producer_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('producer.active'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('producer.comments.active'); ?></span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active"<?php echo $oProducerDetails->active == 'Y' ? ' checked="checked"' : ''; ?> />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('payment_type.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.save'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>