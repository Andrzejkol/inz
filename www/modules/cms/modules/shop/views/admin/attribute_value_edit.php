<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('attribute.edit_attribute_value')
            ))->render(TRUE);
?>
<div id="admin_attribute_value_edit">
    <?php echo form::open_multipart(null, array('id' => 'admin_attribute_value_edit_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="attribute_value"><?php echo Kohana::lang('attribute.attribute_value_name'); ?></label>
                <span class="label_comment">Nazwa opcji. Pole wymagane.</span>
            </td>
            <td><input type="text" name="attribute_value" id="attribute_value" value="<?php echo $oAttributeValue->attribute_value; ?>" />
            <?php echo languages::ShowTranslationBox('attribute_value', $oAttributeValue->id_attribute_value, 'input');?>
            </td>
            <td><div id="attribute_value_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="attribute_color"><?php echo Kohana::lang('attribute.attribute_color'); ?></label>
                <span class="label_comment">Dodaj kolor do atrybutu</span>
            </td>
            <td><input type="text" name="attribute_color" id="attribute_color" class="color" <?php echo ((!empty($oAttributeValue->attribute_color) && $oAttributeValue->attribute_color != '') ? 'value="'.$oAttributeValue->attribute_color.'"' : '')?> /></td>
            <td><div id="attribute_value_error" class="error_message"></div></td>
        </tr>        
        <tr>
            <td class="td_form_left">
                <label for="attribute_if_pattern"><?php echo Kohana::lang('attribute.if_pattern'); ?></label>
                <span class="label_comment">Pattern zamiast koloru</span>
            </td>
            <td><input type="checkbox" name="attribute_if_pattern" id="attribute_if_pattern" value="Y" <?php if(!empty($oAttributeValue->attribute_pattern) && $oAttributeValue->attribute_pattern != '') { echo 'checked="checked"';}?> /></td>
            <td><div id="attribute_value_error" class="error_message"></div></td>
        </tr>   
        <?php if(!empty($oAttributeValue->attribute_pattern) && $oAttributeValue->attribute_pattern != '') { ?>
        <tr>
            <td class="td_form_left">
                <label for="image"><?php echo Kohana::lang('attribute.image'); ?></label>
            </td>
            <td>
                <span id="attr_image_<?php echo $oAttributeValue->id_attribute_value; ?>"><?php echo html::image(shop::ATTR_MEDIUM_PATH.$oAttributeValue->attribute_pattern); ?></span>
                <?php echo html::image('img/icons/cross.png', array('id' => 'delete_attr_image_' . $oAttributeValue->id_attribute_value, 'style' => 'cursor:pointer')); ?>
            </td>
        </tr>
        <?php } ?>
        <tr id="patt-dialog">
            <td class="td_form_left">
                <label for="attribute_pattern"><?php echo Kohana::lang('attribute.attribute_pattern'); ?></label>
                <span class="label_comment">Dodaj kolor do atrybutu</span>
            </td>
            <td><input type="file" name="attribute_pattern" id="attribute_pattern" /></td>
            <td><div id="attribute_value_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="position"><?php echo Kohana::lang('attribute.position'); ?></label>
            </td>
            <td>
                <input type="text" name="position" id="position" value="<?php echo $oAttributeValue->position; ?>" />
            </td>
            <td><div id="position_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('attribute.active'); ?></label>
                <span class="label_comment">Tylko aktywne atrybuty mogą być przydzielane do produktów.</span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active"<?php if($oAttributeValue->active=='Y'){echo ' checked="checked"';}?> />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="default"><?php echo Kohana::lang('attribute.default'); ?></label>
                <span class="label_comment">Tylko aktywne atrybuty mogą być przydzielane do produktów.</span>
            </td>
            <td>
                <input type="checkbox" name="default" id="default"<?php if($oAttributeValue->default=='Y'){echo ' checked="checked"';}?> />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('attribute.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.save'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>