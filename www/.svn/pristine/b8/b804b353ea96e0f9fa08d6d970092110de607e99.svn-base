<?php
    foreach($page_content as $pc) {
    echo form::open_multipart(null, array('id'=>'form_edit_page_content_'.$pc->element_id));
?>

<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('admin.page_content.edit').(isset($pc) ? '"'.$pc->title.'"' : '')
            ))->render(TRUE);
?>
<div class="admin_page_content_view">    
    <table class="table_form">
        <?php if(empty($bNoSitesCheck)) { ?>
        <tr>
            <td  class="td_form_left"><?php echo Kohana::lang('page_content.language'); ?></td>
            <td><?php echo form::dropdown(array('name'=>'lang', 'id'=>'add_page_content_language', 'class'=>'language_check'),$languages, $pc->lang); ?></td>
            <td><div id="lang_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td  class="td_form_left"><?php echo Kohana::lang('page_content.pages'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'page_id[]', 'multiple'=>'multiple', 'id' => 'add_page_content_pages_ids', 'class'=>'page_check'),$pages, $aSelectedPages); ?></td>
            <td><div id="page_id_error" class="error_message"></div></td>
        </tr>
        <?php } ?>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('page_content.title'); ?></td>
            <td><input type="text" name="title" id="add_page_content_title" value="<?php if(!empty($_POST['title'])) { echo $_POST['title']; } else { echo $pc->title; } ?>" />*</td>
            <td><div id="title_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('page_content.show_title_on_site'); ?></td>
            <td><input type="checkbox" value="N" name="show_title" <?php if((!empty($_POST['show_title']) && $_POST['show_title']=='N') || (!empty($pc->show_title) && $pc->show_title=='N')) { echo 'checked="checked"'; } ?> /></td>
            <td><div id="show_title_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('page_content.content'); ?></td>
            <td><textarea name="content" class="tinyText" id="add_page_content_content_<?php echo $pc->element_id;?>" ><?php if(!empty($_POST['content'])) { echo $_POST['content']; } else { echo $pc->content; } ?></textarea>*</td>
            <td><div id="content_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td>
                <input type="button" value="<?php echo Kohana::lang('page_content.back'); ?>" name="back" class="btn btn-back" />
            </td>
            <td>
                <input type="hidden" value="<?php echo $pc->element_id; ?>" name="type_id" />
                <input type="hidden" value="<?php echo $pc->type; ?>" name="type_name" />
                <input type="submit" value="<?php echo Kohana::lang('page_content.save'); ?>" name="submit" class="btn btn-save" />
                <input type="submit" value="<?php echo Kohana::lang('page_content.save_back'); ?>" name="submit_back" class="btn btn-save-and-back" />
            </td>
            <td></td>
        </tr>
    </table>
    <?php
    }
    echo form::close(); ?>
</div>