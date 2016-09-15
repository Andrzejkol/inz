<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'edit',
            'sTitle' => 'Edytuj voucher'
        ))->render(TRUE);
?>
<div id="admin_rebate_group_add">
    <?php echo form::open_multipart(null, array('id' => 'admin_voucher_edit_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="voucher_code">Kod</label>
                <span class="label_comment">Kod vouchera musi zawierać myślnik</span>
            </td>
            <td><input type="text" name="voucher_code" id="voucher_code" value="<?php echo $oRebateCodeDetails->voucher_code; ?>" /></td>
            <td><div id="voucher_code_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="rebate">Wartość</label>
            </td>
            <td>
                <input type="text" name="voucher_value" id="voucher_value" value="<?php echo $oRebateCodeDetails->voucher_value; ?>" size="4" />
            </td>
            <td><div id="voucher_value_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="voucher_status">Status</label>
                <span class="label_comment"></span>
            </td>
            <td>
                <?php
                $aStatuses = array('0'=>'Nieaktywny', '1' => 'Aktywny', '2' => 'Użyty');
                echo form::dropdown('voucher_status', $aStatuses, (!empty($_POST['voucher_status'])?$_POST['voucher_status']:$oRebateCodeDetails->voucher_status));
                ?>
            </td>
            <td><div id="active_value_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('rebate_group.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.save'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>