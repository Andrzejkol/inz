<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'add',
            'sTitle' => Kohana::lang('payment_type.add_payment_type')
        ))->render(TRUE);
?>
<div id="admin_payment_add">
    <?php echo form::open(null, array('id' => 'admin_payment_type_add_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="name"><?php echo Kohana::lang('payment_type.payment_type_name'); ?></label>
            </td>
            <td><input type="text" name="payment_type_name" id="payment_type_name" value="" /></td>
            <td><div id="payment_type_name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="rebate"><?php echo Kohana::lang('payment_type.payment_cost'); ?></label>
            </td>
            <td>
                <input type="text" name="payment_cost" id="payment_cost" value="" size="4" />
            </td>
            <td><div id="payment_cost_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('payment_type.active'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('payment_type.comments.active'); ?></span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active" />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr class="desc_row">
            <td class="td_form_left td_form_top">
                <label for="description"><?php echo Kohana::lang('payment_type.description'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('payment_type.comments.description'); ?></span>
            </td>
            <td>
                <textarea name="payment_type_info" class="tinyText" id="description" rows="5" cols="60"><?php
                    if (!empty($_POST['payment_type_info'])) {
                        echo $_POST['payment_type_info'];
                    } else {
                        echo '';
                    }
                    ?></textarea>
            </td>
            <td><div id="payment_type_info_error" class="error_message"></div></td>
        </tr>
        <tr class="auth_row">
            <td class="td_form_left">
                <label for="auth_login"><?php echo Kohana::lang('payment_type.auth_login'); ?></label>
            </td>
            <td><input type="text" name="auth_login" id="auth_login" value="" /></td>
            <td><div id="auth_login_error" class="error_message"></div></td>
        </tr>
        <tr class="auth_row">
            <td class="td_form_left">
                <label for="auth_code"><?php echo Kohana::lang('payment_type.auth_code'); ?></label>
            </td>
            <td>
                <input type="text" name="auth_code" id="auth_code" value="" />
            </td>
            <td><div id="auth_code_error" class="error_message"></div></td>
        </tr>
        <tr class="auth_row">
            <td class="td_form_left">
                <label for="auth_url"><?php echo Kohana::lang('payment_type.auth_url'); ?></label>
            </td>
            <td><input type="text" name="auth_url" id="auth_url" value="" /></td>
            <td><div id="auth_url_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('payment_type.language'); ?></td>
            <td><?php echo form::dropdown(array('standard'=>'standard', 'name'=>'payment_type_language', 'id'=>'payment_type_language', 'class'=>'news_language_check'),$languages, (!empty($_POST) ? $_POST['payment_type_language'] : "")); ?></td>
            <td><div id="lang_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('payment_type.method'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('payment_type.comments.method'); ?></span>
            </td>
            <td>
                <?php
                $aOptions = array(
                    '' => Kohana::lang('payment_type.transfer'),
                    'dotpay' => Kohana::lang('payment_type.dotpay')
                );
                echo '<script type="text/javascript">';
                echo 'var payment_url = [];';
                echo 'payment_url["dotpay"] = "https://ssl.dotpay.pl";';
                echo '</script>';
                echo form::dropdown('payment_type_method', $aOptions, (!empty($_POST['payment_type_method']) ? $_POST['payment_type_method'] : ""));
                ?>
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('admin.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>