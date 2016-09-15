<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>'Dodawanie boksu'
            ))->render(TRUE);
?>
<div class="admin_box_edit">
    <?php echo form::open_multipart(); ?>
    <input type="hidden" name="boxes_set_id" value="<?php echo $boxes_set_id; ?>" />        
    <table class="table_form">
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('boxes.add_photo'); ?>
                    <span class="label_comment"><?php echo Kohana::lang('boxes.box_photo_dimensions').' ('.boxes::BIGWIDTH.'px x '.boxes::BIGHEIGHT.'px)';?></span>
            </td>
            <td><input type="file" name="photo" id="add_news_photo" /></td>
            <td><div id="photo_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('boxes.name'); ?></td>
            <td><input type="text" name="name" value="" />*</td>
            <td><div id="name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('boxes.title'); ?></td>
            <td><input type="text" name="title" value="" />*</td>
            <td><div id="title_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('boxes.status'); ?></td>
            <td><input type="checkbox" name="active" /></td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('boxes.link'); ?></td>
            <td>
                <input type="text" name="link" value="" />
            </td>
            <td><div id="link_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">Treść</td>
            <td>
                <textarea name="contents" class="tinyText" cols="30" rows="5"></textarea>
            </td>
            <td><div id="link_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.lang'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'lang', 'id' => 'add_pages_language'), $languages, !empty($_POST) ? $_POST['lang'] : ''); ?></td>
            <td><div id="lang_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td>
                <input type="button" value="<?php echo Kohana::lang('admin.back'); ?>" name="back" class="btn btn-back" />
            </td>
            <td>
                <input type="submit" value="<?php echo Kohana::lang('admin.add'); ?>" name="submit" class="btn btn-save" />                    
            </td>
            <td></td>
        </tr>
    </table>    
    <?php echo form::close(); ?>
</div>