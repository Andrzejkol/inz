<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'add',
            'sTitle' => 'Dodaj voucher'
        ))->render(TRUE);
?>
<div id="admin_rebate_group_add">
    <?php echo form::open_multipart(null, array('id' => 'admin_voucher_add_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="rebate_code">Automatycznie generuj vouchery</label>
            </td>
            <td><input type="checkbox" name="automatically_generate" id="automatically_generate"/>
                Podaj liczbę voucherów: <input id="quantity_codes" type="number" name="quantity_codes" min="1" max="100" style="width:95px;" value="1" disabled/>
            </td>
            <td><div id="rebate_code_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="rebate_code">Kod</label>
                <span class="label_comment">Kod vouchera musi zawierać myślnik</span>
            </td>
            <td><input type="text" name="voucher_code" id="voucher_code" value="<?php if (!empty($_POST['voucher_code'])) echo $_POST['voucher_code']; ?>" /></td>
            <td><div id="rebate_code_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="voucher_value">Wartość</label>
            </td>
            <td>
                <input type="text" name="voucher_value" id="voucher_value" value="<?php if (!empty($_POST['voucher_value'])) echo $_POST['voucher_value']; ?>" size="4" />
            </td>
            <td><div id="rebate_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="voucher_status">Status</label>
                <span class="label_comment"></span>
            </td>
            <td>
                <?php
                $aStatuses = array('0'=>'Nieaktywny', '1' => 'Aktywny', '2' => 'Użyty');
                echo form::dropdown('voucher_status', $aStatuses, (!empty($_POST['voucher_status'])?$_POST['voucher_status']:'1'));
                ?>
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