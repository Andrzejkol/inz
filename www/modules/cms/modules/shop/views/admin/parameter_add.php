<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('parameter.add_parameter')
            ))->render(TRUE);
?>
<div id="admin_parameter_add">
    <?php echo form::open(null, array('id' => 'admin_parameter_add_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="parameter_name"><?php echo Kohana::lang('parameter.parameter_name'); ?></label>
                <span class="label_comment">Nazwa parametru. Pole wymagane.</span>
            </td>
            <td><input type="text" name="parameter_name" id="parameter_name" /></td>
            <td><div id="parameter_name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="position"><?php echo Kohana::lang('parameter.position'); ?></label>
            </td>
            <td>
                <input type="text" name="position" id="position" value="0" />
            </td>
            <td><div id="position_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="parameter_type"><?php echo Kohana::lang('parameter.parameter_type'); ?></label>
            </td>
            <td>
                <input type="radio" name="type" id="parameter_type_category" value="category" /> <label for="parameter_type_category">dla kategorii</label><br />
                <input type="radio" name="type" id="parameter_type_product" value="product" checked="checked" /> <label for="parameter_type_product">dla produktu</label>
            </td>
            <td><div id="position_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="parameter_values"><?php echo Kohana::lang('parameter.parameter_values'); ?></label>
                <span class="label_comment">Podaj oddzielone przecinkiem opcje atrubytu.<br />Możesz je póżniej edytować każde z osobna na karcie danego atrybuty.<br />Pierwsza opcja staje się opcją domyślną.</span>
            </td>
            <td>
                <textarea name="parameter_values" id="parameter_values" rows="2" cols="20"></textarea>
            </td>
            <td><div id="parameter_values_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('parameter.active'); ?></label>
                <span class="label_comment">Tylko aktywne parametry mogą być przydzielane do produktów.</span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active" />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="categories"><?php echo Kohana::lang('parameter.categories'); ?></label>
            </td>
            <td>
                <ul>
                    <?php foreach($oCategories as $c): ?>
                    <li><input type="checkbox" name="category[<?php echo $c->id_category; ?>]" id="category_<?php echo $c->id_category; ?>" /> <label for="category_<?php echo $c->id_category; ?>"><?php echo $c->category_name; ?></label></li>
                    <?php endforeach; ?>
                </ul>
            </td>
            <td><div id="categories_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('parameter.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>