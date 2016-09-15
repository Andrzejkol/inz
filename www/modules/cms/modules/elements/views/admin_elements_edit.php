<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('elements.edit_elements')
            ))->render(TRUE);
?>
<div id="admin_elements_view">
    <?php echo form::open_multipart(null, array('id'=>'form_edit_elements'));
    foreach($elements as $element) {
    ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('elements.name_element'); ?></td>
            <td><input type="text" name="name_element" id="add_elements_name_element" value="<?php if(!empty($_POST['name_element'])) { echo $_POST['name_element']; } else { echo $element->name_element; } ?>"  /></td>
            <td><div id="name_element_error" class="error_message"></div></td>

        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('elements.type'); ?></td>
            <td><?php echo form::dropdown(array('name'=>'type', 'id'=>'add_elements_type'),$elements_type, !empty($_POST['type']) ? $_POST['type'] : $element->type ); ?></td>
            <td><div id="type_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('elements.page_id'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'page_id[]', 'multiple'=>'multiple', 'id' => 'add_elements_page_id'),$pages, !empty($_POST['page_id']) ? $_POST['page_id'] : $select_pages ); ?></td>
            <td><div id="page_id_error" class="error_message"></div></td>
        </tr>

        <tr>
            <td>
                <?php //TODO: to wywalic jak CMS bedzie gotowy
                echo html::anchor('4dminix/elementy', '<input type="button" value="'.Kohana::lang('elements.back').'" name="back" class="ui-button ui-widget ui-state-default ui-corner-all" />');
                ?>
           </td>
           <td>
                <input type="submit" value="<?php echo Kohana::lang('elements.save_changes'); ?>" name="save_changes" class="ui-button ui-widget ui-state-default ui-corner-all" />
            </td>
        </tr>
    </table>
    <?php
    }
    echo form::close(); ?>
</div>