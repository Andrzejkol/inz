<div id="admin_product_comment_edit">
    <div id="product_comment_edit_title">
        <h2><?php echo Kohana::lang('product.edit_comment'); ?></h2>
    </div>
    <?php echo form::open(null, array('method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="nick"><?php echo Kohana::lang('product.product_comment_nick'); ?></label>
                <span class="label_comment">Nazwa parametru. Pole wymagane.</span>
            </td>
            <td><input type="text" name="nick" id="nick" value="<?php echo $oComment->nick; ?>" /></td>
            <td><div id="nick_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="ip"><?php echo Kohana::lang('product.product_comment_ip'); ?></label>
                <span class="label_comment">Nazwa parametru. Pole wymagane.</span>
            </td>
            <td><input type="text" name="ip" id="ip" value="<?php echo $oComment->ip; ?>" /></td>
            <td><div id="ip_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="email"><?php echo Kohana::lang('product.product_comment_email'); ?></label>
                <span class="label_comment">Nazwa parametru. Pole wymagane.</span>
            </td>
            <td><input type="text" name="email" id="email" value="<?php echo $oComment->email; ?>" /></td>
            <td><div id="email_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="www"><?php echo Kohana::lang('product.product_comment_www'); ?></label>
            </td>
            <td>
                <input type="text" name="www" id="www" value="<?php echo $oComment->www ; ?>" />
            </td>
            <td><div id="www_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('parameter.active'); ?></label>
                <span class="label_comment">Tylko aktywne atrybuty mogą być przydzielane do produktów.</span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active"<?php if($oComment->active=='Y'){echo ' checked="checked"';} ?> />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>