<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('configuration.configuration')
            ))->render(TRUE);
?>
<div id="admin_product_add">
    <?php echo form::open_multipart(null, array('id' => 'admin_configuration_form', 'method' => 'post')); ?>

    <table class="table_form">
        <?php foreach ($oConfigurations as $cfg): ?>
            <tr>
                <td class="td_form_left">
                    <label for="<?php echo $cfg->key; ?>">
                        <?php echo $cfg->name; ?>
                    </label>
                    <span class="label_comment">
                        <?php echo $cfg->desc; ?>
                    </span>
                </td>
                <td>
                    <?php if (!empty($cfg->type) && $cfg->type === 'image'): ?>
                        <input type="file" name="<?php echo $cfg->key; ?>" id="<?php echo $cfg->key; ?>" />
                        <br /> 
                        <?php echo html::image($cfg->value);  ?>
                    <?php elseif (!empty($cfg->type) && $cfg->type === 'textarea'): ?>
                        <textarea name="<?php echo $cfg->key; ?>" id="<?php echo $cfg->key; ?>" style="width:400px;height:300px" class="tinyText"><?php echo $cfg->value; ?></textarea>
                    <?php else: ?>
                        <input type="text" name="<?php echo $cfg->key; ?>" id="<?php echo $cfg->key; ?>" value="<?php echo $cfg->value; ?>" />
                    <?php endif; ?>
                </td>
                <td>
                    <div id="<?php echo $cfg->key; ?>_error" class="error_message"></div>
                </td>
            </tr>        
        <?php endforeach; ?>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="submit" value="<?php echo Kohana::lang('configuration.save'); ?>" class="btn btn-save"  />
            </td>
            <td>&nbsp;</td>
        </tr>

    </table>

    <?php echo form::close(); ?>
</div>