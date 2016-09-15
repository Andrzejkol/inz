<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'add',
            'sTitle' => Kohana::lang('shop_admin.currencies.add_currency')
        ))->render(TRUE);
?>
<div id="admin_currency_add">
    <?php
    if (!empty($msg)) {
        echo $msg;
    }
    ?>
    <?php echo form::open_multipart(null, array('id' => 'admin_currency_add_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="currency_name"><?php echo Kohana::lang('shop_admin.currencies.currency_name'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('shop_admin.currencies.comments.currency_name'); ?></span>
            </td>
            <td><input type="text" name="currency_name" id="currency_name" /></td>
            <td><div id="currency_name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="currency_code"><?php echo Kohana::lang('shop_admin.currencies.currency_code'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('shop_admin.currencies.comments.currency_code'); ?></span>
            </td>
            <td>
                <input type="text" name="currency_code" id="currency_code" value="" size="4" />
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
          <input type="text" name="currency_unit" id="currency_unit" value="" />
          </td>
          <td><div id="currency_unit_error" class="error_message"></div></td>
          </tr>
         */ ?>
        <tr>
            <td class="td_form_left">
                <label for="currency_factor"><?php echo Kohana::lang('shop_admin.currencies.currency_factor'); ?></label>                
            </td>
            <td>
                <input type="text" name="currency_factor" id="currency_factor" value="" /> zł
            </td>
            <td><div id="currency_factor_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="currency_active"><?php echo Kohana::lang('shop_admin.currencies.currency_active'); ?></label>                
            </td>
            <td><input type="checkbox" value="Y" name="currency_active" checked="checked"></td>   
            <td><div id="currency_active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('shop_admin.currencies.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save" /></td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>