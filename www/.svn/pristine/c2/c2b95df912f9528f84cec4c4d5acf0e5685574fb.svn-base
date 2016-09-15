<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('delivery_type.add_delivery_type')
            ))->render(TRUE);
?>
<div id="admin_delivery_add">
    <?php echo form::open(null, array('id' => 'admin_delivery_type_add_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="name"><?php echo Kohana::lang('delivery_type.delivery_type_name'); ?></label>
            </td>
            <td><input type="text" name="delivery_type" id="delivery_type" value="" /></td>
            <td><div id="delivery_type_error" class="error_message"></div></td>
        </tr>
		
		
		
     <?php /*   <tr>
            <td class="td_form_left">
                <label for="rebate"><?php echo Kohana::lang('delivery_type.delivery_cost'); ?></label>
            </td>
            <td>
                <input type="text" name="delivery_cost" id="delivery_cost" value="" size="4" />
            </td>
            <td><div id="delivery_cost_error" class="error_message"></div></td>
        </tr> */ ?>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('pages.language'); ?></td>
            <td><?php echo form::dropdown(array('name'=>'lang', 'id'=>'add_pages_language'),$languages, !empty($_POST) ? $_POST['lang'] : ''); ?></td>
            <td><div id="lang_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('delivery_type.active'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('delivery_type.comments.active'); ?></span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active" />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
		   <tr>
            <td class="td_form_left">
                <label for="cash_on_delivery"><?php echo Kohana::lang('delivery_type.cash_on_delivery'); ?></label>
            </td>
            <td>
                <input type="checkbox" name="cash_on_delivery" id="cash_on_delivery" />
            </td>
            <td><div id="delivery_error" class="delivery_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('delivery_type.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>