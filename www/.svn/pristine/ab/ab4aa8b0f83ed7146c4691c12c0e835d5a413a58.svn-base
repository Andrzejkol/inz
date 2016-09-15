<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('elements.add_elements')
            ))->render(TRUE);
?>
<div id="admin_elements_view">
    <?php echo form::open_multipart(null, array('id'=>'form_add_elements')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('elements.name_element'); ?></td>
            <td><input type="text" name="name_element" id="add_elements_name_element" value="<?php if(!empty($_POST['name_element'])) { echo $_POST['name_element']; } ?>" />*</td>
            <td><div id="name_element_error" class="error_message"></div></td>

        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('elements.type'); ?></td>
            <td><?php echo form::dropdown(array('name'=>'type', 'id'=>'add_elements_type'),$elements_type, !empty($_POST['type']) ? $_POST['type'] : ''); ?>*</td>
            <td><div id="type_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('elements.page_id'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'page_id[]', 'multiple'=>'multiple','id' => 'add_elements_page_id'),$pages, !empty($_POST['page_id']) ? $_POST['page_id'] : ''); ?>*</td>
            <td><div id="page_id_error" class="error_message"></div></td>
        </tr>
        
        <tr>
            <td colspan="3">
                <div id="form_for_type">
                    <?php
                    if(!empty($form)) {
                        echo $form;
                    }
                    ?>
                </div>
            </td>
        </tr>
        
        <tr>
            <td>
                <input type="button" value="<?php echo Kohana::lang('elements.back'); ?>" name="back"  class="back ui-button ui-widget ui-state-default ui-corner-all"/>
            </td>
            <td>
                <input type="submit" value="<?php echo Kohana::lang('elements.add_elements'); ?>" name="add_elements" class="ui-button ui-widget ui-state-default ui-corner-all" />
            </td>
            <td></td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>