<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('attribute.add_attribute_value')
            ))->render(TRUE);
?>
<div id="admin_attribute_value_add">
    <?php echo form::open_multipart(null, array('id' => 'admin_attribute_value_add_form', 'method' => 'post')); ?>
    <input type="hidden" name="attribute_id" value="<?php echo $iAttributeId; ?>" />
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="attribute_value"><?php echo Kohana::lang('attribute.attribute_value'); ?></label>
                <span class="label_comment">Podaj opcję do atrybutu</span>
            </td>
            <td><input type="text" name="attribute_value" id="attribute_value" /></td>
            <td><div id="attribute_value_error" class="error_message"></div></td>
        </tr>
        <?php //if($iAttributeId == 3) : ?>
        <tr>
            <td class="td_form_left">
                <label for="attribute_color"><?php echo Kohana::lang('attribute.attribute_color'); ?></label>
                <span class="label_comment">Dodaj kolor do atrybutu</span>
            </td>
            <td><input type="text" name="attribute_color" id="attribute_color" class="color" /></td>
            <td><div id="attribute_value_error" class="error_message"></div></td>
        </tr>      
        <tr>
            <td class="td_form_left">
                <label for="attribute_color"><?php echo Kohana::lang('attribute.if_pattern'); ?></label>
                <span class="label_comment">Pattern zamiast koloru</span>
            </td>
            <td><input type="checkbox" name="attribute_if_pattern" id="attribute_if_pattern" value="Y" /></td>
            <td><div id="attribute_value_error" class="error_message"></div></td>
        </tr>      
        
        <tr id="patt-dialog">
            <td class="td_form_left">
                <label for="attribute_pattern"><?php echo Kohana::lang('attribute.attribute_pattern'); ?></label>
                <span class="label_comment">Dodaj kolor do atrybutu</span>
            </td>
            <td><input type="file" name="attribute_pattern" id="attribute_pattern" /></td>
            <td><div id="attribute_value_error" class="error_message"></div></td>
        </tr>
        <?php //endif; ?>
        <tr>
            <td class="td_form_left">
                <label for="position"><?php echo Kohana::lang('attribute.position'); ?></label>
                <span class="label_comment">Im większy numer tym opcja będzie wyżej na liście</span>
            </td>
            <td>
                <input type="text" name="position" id="position" value="0" />
            </td>
            <td><div id="position_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('attribute.active'); ?></label>
                <span class="label_comment">Tylko aktywne opcje są widoczne dla klientów</span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active" />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="default"><?php echo Kohana::lang('attribute.default'); ?></label>
                <span class="label_comment">Opcja ta zostanie wybrana w momencie, gdy klient pominie wybór tego atrybutu przed dodaniem produktu do koszyka. W koszyku natomiast będzie miał możliwość zmiany domyślnej wartości na swoją</span>
            </td>
            <td>
                <input type="checkbox" name="default" id="default" />
            </td>
            <td><div id="default_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('attribute.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save" /></td>
            <td></td>
    </table>
    <?php echo form::close(); ?>
</div>