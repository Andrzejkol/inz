<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'edit',
            'sTitle' => Kohana::lang('shop_admin.currencies.edit_currency')
        ))->render(TRUE);
?>
<div id="admin_currency_add">
    <?php echo form::open_multipart(null, array('id' => 'admin_currency_edit_form', 'method' => 'post')); ?>
    <?php 
    foreach($oCurrencyDetails as $currency): ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="currency_name"><?php echo Kohana::lang('shop_admin.currencies.currency_name'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('shop_admin.currencies.comments.currency_name'); ?></span>
            </td>
            <td><input type="text" name="currency_name" id="currency_name" value="<?php if(!empty($_POST['currency_name'])) { echo $_POST['currency_name']; } else { echo $currency->currency_name; } ?>" /></td>
            <td><div id="currency_name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="currency_code"><?php echo Kohana::lang('shop_admin.currencies.currency_code'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('shop_admin.currencies.comments.currency_code'); ?></span>
            </td>
            <td>
                <input type="text" name="currency_code" id="currency_code" value="<?php if(!empty($_POST['currency_code'])) { echo $_POST['currency_code']; } else { echo $currency->currency_code; } ?>" size="4" />
            </td>
            <td><div id="currency_code_error" class="error_message"></div></td>
        </tr>
        <?php /*
        <tr>
            <td class="td_form_left">
                <label for="currency_unit"><?php echo Kohana::lang('shop_admin.currencies.currency_unit'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('shop_admin.currencies.comments.currency_unit'); ?></span>
            </td>
            <td>
                <input type="text" name="currency_unit" id="currency_unit" value="<?php if(!empty($_POST['currency_unit'])) { echo $_POST['currency_unit']; } else { echo $currency->currency_unit; } ?>" />
            </td>
            <td><div id="currency_unit_error" class="error_message"></div></td>
        </tr>
         */ ?>
        <tr>
            <td class="td_form_left">
                <label for="currency_factor"><?php echo Kohana::lang('shop_admin.currencies.currency_factor'); ?></label>                
            </td>
            <td>
                <input type="text" name="currency_factor" id="currency_factor" value="<?php if(!empty($_POST['currency_factor'])) { echo $_POST['currency_factor']; } else { echo $currency->currency_factor; } ?>" /> zł
            </td>
            <td><div id="currency_factor_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="currency_active"><?php echo Kohana::lang('shop_admin.currencies.currency_active'); ?></label>                
            </td>            
            <td><input type="checkbox" value="Y" name="currency_active" <?php if(!empty($_POST['currency_active']) && $_POST['currency_active'] == 'Y') { echo 'checked="checked"'; } elseif($currency->currency_active == 'Y') { echo 'checked="checked"'; } ?>></td>   
            <td><div id="currency_active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('shop_admin.currencies.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('shop_admin.currencies.save'); ?>" class="btn btn-save" /></td>
            <td>
                <input type="hidden" value="<?php echo $currency->id_currency; ?>" name="id_currency" id="id_currency" />
            </td>
    </table>
    <?php 
    endforeach;
    echo form::close(); ?>
</div>