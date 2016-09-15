<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'edit',
            'sTitle' => 'Edytuj kod rabatowy'
        ))->render(TRUE);
?>
<div id="admin_rebate_group_add">
    <?php echo form::open_multipart(null, array('id' => 'admin_rebate_group_edit_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="rebate_code">Kod rabatowy</label>
            </td>
            <td><input type="text" name="rebate_code" id="rebate_code" value="<?php echo $oRebateCodeDetails->rebate_code; ?>" /></td>
            <td><div id="rebate_code_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="rebate"><?php echo Kohana::lang('rebate_group.rebate'); ?></label>
            </td>
            <td>
                <input type="text" name="rebate" id="rebate" value="<?php echo $oRebateCodeDetails->rebate; ?>" size="4" /> %
            </td>
            <td><div id="rebate_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="rebate_start">Rabat aktywny od:</label>
            </td>
            <td>
                <input type="text" name="rebate_start" id="rebate_start" class="datepicker2" value="<?php echo (!empty($_POST['rebate_start'])) ? $_POST['rebate_start'] : (!empty($oRebateCodeDetails->rebate_start) ? date('Y-m-d', strtotime($oRebateCodeDetails->rebate_start)) : NULL); ?>" /> 
            </td>
            <td><div id="rebate_start_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="rebate_end">Rabat aktywny do:</label>
            </td>
            <td>
                <input type="text" name="rebate_end" id="rebate_end" class="datepicker2" value="<?php echo (!empty($_POST['rebate_end'])) ? $_POST['rebate_end'] : (!empty($oRebateCodeDetails->rebate_end) ? date('Y-m-d', strtotime($oRebateCodeDetails->rebate_end)) : NULL); ?>" />
            </td>
            <td><div id="rebate_end_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active">Aktywny</label>
                <span class="label_comment"></span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active"<?php if($oRebateCodeDetails->active == 1){echo ' checked="checked"';} ?> value="1" />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <?php $aProducts = array(); ?>
                <?php if(!empty($oProducts) && $oProducts->count()>0): ?>
                    <?php foreach($oProducts as $oP): ?>
                        <?php $aProducts[$oP->id_product] = $oP->product_name; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                Wskaż produkty, które będą objęte tym rabatem.
                <span class="label_comment">Aby zaznaczyć więcej przytrzymaj CTRL.</span>
            </td>
            <td>
                <?php echo form::dropdown(array('name' => 'products[]', 'multiple' => 'multiple', 'size' => 10, 'class'=>'multi'), $aProducts, (!empty($_POST['products']) ? $_POST['products'] : $aSelectedProducts)); ?><br/>
                <span class="multi_add_all">Dodaj wszystkie</span> | <span class="multi_delete_all">Wyłącz wszystkie</span>
            </td>
            <td><div id="salon_country_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('rebate_group.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.save'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>