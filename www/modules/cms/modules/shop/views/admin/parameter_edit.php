<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('parameter.edit_parameter')
            ))->render(TRUE);
?>
<div id="admin_parameter_edit">
    <?php echo form::open(null, array('id' => 'admin_parameter_edit_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="parameter_name"><?php echo Kohana::lang('parameter.parameter_name'); ?></label>
                <span class="label_comment">Nazwa parametru. Pole wymagane.</span>
            </td>
            <td><input type="text" name="parameter_name" id="parameter_name" value="<?php echo $oParameterDetails->parameter_name; ?>" /></td>
            <td><div id="parameter_name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="position"><?php echo Kohana::lang('parameter.position'); ?></label>
            </td>
            <td>
                <input type="text" name="position" id="position" value="<?php echo $oParameterDetails->position ; ?>" />
            </td>
            <td><div id="position_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="parameter_type"><?php echo Kohana::lang('parameter.parameter_type'); ?></label>
            </td>
            <td>
                <input type="radio" name="type" id="parameter_type_category" value="category"<?php if($oParameterDetails->type=='category'){echo ' checked="checked"';} ?> /> <label for="parameter_type_category">dla kategorii</label><br />
                <input type="radio" name="type" id="parameter_type_product" value="product"<?php if($oParameterDetails->type=='product'){echo ' checked="checked"';} ?> /> <label for="parameter_type_product">dla produktu</label>
            </td>
            <td><div id="position_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('parameter.active'); ?></label>
                <span class="label_comment">Tylko aktywne parametry mogą być przydzielane do produktów.</span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active"<?php if($oParameterDetails->active=='Y'){echo ' checked="checked"';} ?> />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left td_form_top">
                <label for="parameter_values"><?php echo Kohana::lang('parameter.parameter_values'); ?></label>
                <span class="label_comment">Wartości parametrów.</span>
                <p><span id="add_parameter_value" class="os-link">+ Dodaj wartość parametru</span></p>
            </td>
            <td>
                <ul id="parameter_values">
                    <?php foreach($oParameterValues as $pv): ?>
                    <li><input type="text" name="parameter_values[<?php echo $pv->id_parameter_value; ?>]" id="parameter_values_<?php echo $pv->id_parameter_value; ?>" value="<?php echo $pv->parameter_value; ?>" /></li>
                    <?php endforeach; ?>
                </ul>
            </td>
            <td><div id="parameter_values_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left td_form_top">
                <label for="categories"><?php echo Kohana::lang('parameter.categories'); ?></label>
            </td>
            <td>
                <ul>
                    <?php foreach($oCategories as $c): ?>
                    <?php if(in_array($c->category_id, $aCurrentCategories)): ?>
                    <li><input type="checkbox" name="category[<?php echo $c->id_category; ?>]" id="category_<?php echo $c->id_category; ?>" checked="checked" /> <label for="category_<?php echo $c->id_category; ?>"><?php echo $c->category_name; ?></label></li>
                    <?php else: ?>
                    <li><input type="checkbox" name="category[<?php echo $c->id_category; ?>]" id="category_<?php echo $c->id_category; ?>" /> <label for="category_<?php echo $c->id_category; ?>"><?php echo $c->category_name; ?></label></li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </td>
            <td><div id="categories_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('parameter.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('parameter.save'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>