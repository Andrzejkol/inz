<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('gallery.edit_gallery')
            ))->render(TRUE);
?>
<div id="admin_gallery_view">
    <?php echo form::open_multipart(null, array('id'=>'form_edit_gallery'));

    foreach($gallery as $gal) {
    ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('gallery.name'); ?></td>
            <td><input name="name"  id="add_gallery_name" value="<?php if(!empty($_POST['name'])) { echo $_POST['name']; } else { echo $gal->name; } ?>" /></td>
            <td><div id="name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('gallery.language'); ?></td>
            <td><?php echo form::dropdown(array('name'=>'lang', 'id'=>'add_gallery_language'),$languages, !empty($_POST['lang']) ? $_POST['lang'] : $gal->lang); ?></td>
            <td><div id="langs_error" class="error_message"></div></td>
        </tr>

        <?php
            if(!request::is_ajax()) {
        ?>

        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('elements.page_id'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'page_id[]', 'multiple'=>'multiple', 'style' => 'width:255px;', 'id' => 'add_elements_page_id'),$pages, !empty($_POST['page_id']) ? $_POST['page_id'] : $aSelectedPages); ?></td>
            <td><div id="page_id_error" class="error_message"></div></td>
        </tr>
            <?php
            }
            ?>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('page_content.show_title_on_site'); ?></td>
            <td><input type="checkbox" value="N" name="show_title" <?php if((!empty($_POST['show_title']) && $_POST['show_title']=='N') || (!empty($gal->show_title) && $gal->show_title=='N')) { echo 'checked="checked"'; } ?> /></td>
            <td><div id="show_title_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('gallery.description'); ?></td>
            <td><textarea name="description" cols="40" rows="5" id="add_gallery_description"><?php if(!empty($_POST['description'])) { echo $_POST['description']; } else { echo $gal->description; } ?></textarea></td>
            <td><div id="description_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td>
                <?php //TODO: to wywalic jak CMS bedzie gotowy
                echo html::anchor('4dminix/galerie', '<input type="button" value="'.Kohana::lang('gallery.back').'" name="back" class="btn btn-back" />');
                ?>
            </td>
            <td>
                <input type="submit" value="<?php echo Kohana::lang('gallery.save'); ?>" name="submit" class="btn btn-save" />
                <input type="submit" value="<?php echo Kohana::lang('gallery.save_back'); ?>" name="submit_back" class="btn btn-save-and-back" />
            </td>
            <td></td>
        </tr>
    </table>
    <?php
    }
    echo form::close(); ?>
</div>
