<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('admin.boxes.add_block')
            ))->render(TRUE);
?>
<div class="admin_box_edit">
    <?php echo form::open_multipart(null, array('id'=>'form_add_boxes')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.name'); ?></td>
            <td><input name="name" id="add_boxes_name" value="<?php if(!empty($_POST['name'])) { echo $_POST['name'];} ?>" /></td>
            <td><div id="name_error" class="error_message"></div></td>
        </tr>
                <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.lang'); ?></td>
            <td><?php echo form::dropdown(array('name'=>'lang', 'id'=>'add_boxes_language'), $languages, !empty($_POST['lang']) ? $_POST['lang'] : ''); ?></td>
            <td><div id="lang_error" class="error_message"></div></td>
        </tr>

        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.page'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'page_id', 'multiple'=>'multiple','id' => 'add_boxes_page_id'), $pages, !empty($_POST['page_id']) ? $_POST['page_id'] : $iPageId); ?></td>
            <td><div id="page_id_error" class="error_message"></div></td>
        </tr>

        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.show_title_on_site'); ?></td>
            <td><input type="checkbox" value="N" name="show_title" <?php if(!empty($_POST['show_title']) && $_POST['show_title']=='N') { echo 'checked="checked"'; } ?> /></td>
            <td><div id="show_title_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.desc'); ?></td>
            <td><textarea name="description" rows="5" id="add_boxes_description"><?php if(!empty($_POST['description'])) {echo $_POST['description'];} ?></textarea></td>
            <td><div id="description_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td>
                <input type="button" value="<?php echo Kohana::lang('admin.back'); ?>" name="back" class="btn btn-back" />
            </td>
            <td>
                <input type="submit" value="<?php echo Kohana::lang('admin.add'); ?>" name="submit" class="btn btn-save" />
                <input type="submit" value="<?php echo Kohana::lang('admin.add_back'); ?>" name="submit_back" class="btn btn-save-and-back" />
            </td>
            <td></td>          

        </tr>
    </table>    
    <?php echo form::close(); ?>
</div>