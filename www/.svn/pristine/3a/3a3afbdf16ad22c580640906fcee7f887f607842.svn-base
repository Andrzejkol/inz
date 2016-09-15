<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('page_content.add_page_content')
            ))->render(TRUE);
?>
<div id="admin_page_content_view">
    <?php
        echo form::open_multipart(null, array('id'=>'form_add_page_content'));
    ?>
    <table class="table_form">
        <?php /*
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('page_content.logo'); ?></td>
            <td><input type="file" name="photo" id="add_page_content_photo" /></td>
            <td><div id="photo_error" class="error_message"></div></td>
        </tr>
         *
         */?>
        <tr>
            <td  class="td_form_left"><?php echo Kohana::lang('page_content.language'); ?></td>
            <td><?php echo form::dropdown(array('name'=>'lang', 'id'=>'add_page_content_language', 'class'=>'language_check'),$languages, !empty($_POST['lang']) ? $_POST['lang'] : ''); ?></td>
            <td><div id="lang_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td  class="td_form_left"><?php echo Kohana::lang('page_content.pages'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'page_id[]', 'multiple'=>'multiple', 'id' => 'add_page_content_pages_ids', 'class'=>'page_check'),$pages, !empty($_POST['page_id']) ? $_POST['page_id'] : $iPageId); ?></td>
            <td><div id="page_id_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td  class="td_form_left"><?php echo Kohana::lang('page_content.title'); ?></td>
            <td><input type="text" name="title" id="add_page_content_title" value="<?php if(!empty($_POST['title'])) { echo $_POST['title']; } ?>" /></td>
            <td><div id="title_error" class="error_message"></div></td>

        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('page_content.show_title_on_site'); ?></td>
            <td><input type="checkbox" value="N" name="show_title" <?php if(!empty($_POST['show_title']) && $_POST['show_title']=='N') { echo 'checked="checked"'; } ?> /></td>
            <td><div id="show_title_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td  class="td_form_left"><?php echo Kohana::lang('page_content.content'); ?></td>
            <td><textarea name="content" class="tinyText" cols="30" rows="5" id="add_page_content_content" ><?php if(!empty($_POST['content'])) { echo $_POST['content']; } ?></textarea></td>
            <td><div id="content_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td>
                <input type="button" value="<?php echo Kohana::lang('page_content.back'); ?>" name="back" class="btn btn-back" />
            </td>
            <td>
                <input type="submit" value="<?php echo Kohana::lang('admin.add'); ?>" name="submit" class="btn btn-save" />
                <input type="submit" value="<?php echo Kohana::lang('admin.add_back'); ?>" name="submit_back" class="btn btn-save-and-back" />
            </td>
            <td></td>
        </tr>
    </table>
    <?php 
    echo form::close();
    ?>
</div>