<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('attribute.edit_attribute')
            ))->render(TRUE);
?>
<div id="admin_attribute_add">
    <?php echo form::open(null, array('id' => 'admin_attribute_edit_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="attribute_name"><?php echo Kohana::lang('attribute.attribute_name'); ?></label>
                <span class="label_comment">Nazwa atrybutu. Pole wymagane.</span>
            </td>
            <td><input type="text" name="attribute_name" id="attribute_name" value="<?php echo $oAttributeDetails->attribute_name; ?>" /><br /><?php /*<span class="translate_to">echo Kohana::lang('language.translate_to'); ?>: <?php echo Kohana::lang('language.english'); </span>*/?>
            <?php echo languages::ShowTranslationBox('attribute', $oAttributeDetails->id_attribute, 'input');?>
            </td>
            <td><div id="name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="position"><?php echo Kohana::lang('attribute.position'); ?></label>
            </td>
            <td>
                <input type="text" name="position" id="position" value="<?php echo $oAttributeDetails->position; ?>" />
            </td>
            <td><div id="position_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('attribute.active'); ?></label>
                <span class="label_comment">Tylko aktywne atrybuty mogą być przydzielane do produktów.</span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active"<?php if($oAttributeDetails->active == 'Y'){echo ' checked="checked"';}?> />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="options">
                    <?php echo html::anchor('4dminix/dodaj_wartosc_atrybutu/'.$oAttributeDetails->id_attribute, html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('attribute.add_attribute_value'), 'class'=>'add_button'))); ?>
                    <?php echo html::anchor('4dminix/dodaj_wartosc_atrybutu/'.$oAttributeDetails->id_attribute, Kohana::lang('attribute.add_attribute_value'), array('class'=>'add_text', 'id'=>'add_news_button')); ?>
                </div>
                <?php if($oAttributeValues->count() > 0): ?>
                <table class="table_view" id="attribute_value_list">
                    <tr>
                        <th>#</th>
                        <th><?php echo Kohana::lang('attribute.attribute_value'); ?></th>
                        <th><?php echo Kohana::lang('attribute.default'); ?></th>
                        <th><?php echo Kohana::lang('attribute.active'); ?></th>
                        <th><?php echo Kohana::lang('attribute.actions'); ?></th>
                    </tr>
                    <?php
                        foreach($oAttributeValues as $av):
                    ?>
                    <tr>
                        <td><?php echo $av->id_attribute_value; ?></td>
                        <td><?php echo strip_tags($av->attribute_value); ?></td>
                        <td><?php echo $av->default == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('attribute.default'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('attribute.nodefault'))); ?></td>
                        <td><?php echo $av->active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('attribute.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('attribute.disabled'))); ?></td>
                        <td>
							
							<?php echo html::anchor('4dminix/edytuj_wartosc_atrybutu/' . $av->id_attribute_value . '/' . $av->attribute_value_language, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 

							echo html::anchor('4dminix/uusun_wartosc_atrybutu/' . $oAttributeDetails->id_attribute . '/' . $av->id_attribute_value, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete')));?>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    ?>
                </table>
                <?php
                else : ?>
                    <div class="info"><?php echo Kohana::lang('attribute.no_attributes'); ?></div>
                <?php endif;
                ?>
            </td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('attribute.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.save'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>