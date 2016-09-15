<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'edit',
            'sTitle' => Kohana::lang('admin.boxes.edit_box')
        ))->render(TRUE);
?>
<div class="admin_box_edit">
    <?php
    //$i=0;
    //var_dump($oBoxes);
    echo form::open_multipart();

    foreach ($oBoxes as $oBox) {
        //echo "Element:".$i++."<br>";
        ?>


        <table class="table_form">
            <?php if (!empty($oBox->filename)): // jesli jest foto dajemy mozliwosc jego usuniecia  ?>
                <tr>
                    <td></td>
                    <td>           
                        <span id="box_image_<?php echo $oBox->id_boxes; ?>"><?php echo html::image('files/boxes/big/' . $oBox->filename); ?></span>
                        <?php echo html::image('img/icons/cross.png', array('alt' => Kohana::lang('news.delete'), 'id' => 'delete_box_image_' . $oBox->id_boxes, 'style' => 'cursor:pointer')); ?>
                    </td>
                </tr>
            <?php endif; ?>  
            <tr>
                <td class="td_form_left">
                    <?php echo Kohana::lang('boxes.photo'); ?>
                    <span class="label_comment"><?php echo Kohana::lang('boxes.box_photo_dimensions') . ' (' . boxes::BIGWIDTH . 'px x ' . boxes::BIGHEIGHT . 'px)'; ?></span>
                </td>
                <td>
                    <input type="file" name="photo" id="add_news_photo" />
                </td>
                <td>
                    <div id="error_photo" class="error_message"></div>
                </td>
            </tr>

            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('boxes.name'); ?></td>
                <td>
                    <input type="text" name="name" value="<?php
                    if (!empty($_POST['name'])) {
                        echo $_POST['name'];
                    } else {
                        echo $oBox->name;
                    }
                    ?>" />
                    *
                </td>
                <td><div id="name_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('boxes.title'); ?></td>
                <td><input type="text" name="title" value="<?php
                    if (!empty($_POST['title'])) {
                        echo $_POST['title'];
                    } else {
                        echo $oBox->title;
                    }
                    ?>" />
                    *</td>
                <td><div id="title_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('boxes.status'); ?></td>
                <td><input type="checkbox" name="active" <?php
                    if (!empty($_POST['active'])) {
                        echo 'checked="checked"';
                    } else {
                        echo ($oBox->active == 1) ? 'checked="checked"' : '';
                    }
                    ?> />
                </td>
                <td><div id="active_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('boxes.link'); ?></td>
                <td>
                    <input type="text" name="link" value="<?php
                    if (!empty($_POST['link'])) {
                        echo $_POST['link'];
                    } else {
                        echo $oBox->link;
                    }
                    ?>" />
                </td>
                <td><div id="link_error" class="error_message"></div></td>
            </tr>
            <tr>
            <td class="td_form_left">Treść</td>
            <td>
                <textarea name="contents" class="tinyText" cols="30" rows="5"><?php
                    if (!empty($_POST['contents'])) {
                        echo $_POST['contents'];
                    } else {
                        echo $oBox->contents;
                    }
                    ?></textarea>
            </td>
            <td><div id="link_error" class="error_message"></div></td>
        </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('admin.lang'); ?></td>
                <td><?php echo form::dropdown(array('name' => 'lang', 'id' => 'add_pages_language'), $languages, !empty($_POST) ? $_POST['lang'] : $oBox->lang ); ?></td>
                <td><div id="lang_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td>
                    <?php
                    //TODO: to wywalic jak CMS bedzie gotowy
                    echo html::anchor('4dminix/boxes/', '<input type="button" value="' . Kohana::lang('admin.back') . '" name="back" class="btn btn-back" />');
                    ?>
                </td>
                <td>
                    <input type="submit" value="<?php echo Kohana::lang('page_content.save'); ?>" name="submit" class="btn btn-save" />
                    <input type="submit" value="<?php echo Kohana::lang('page_content.save_back'); ?>" name="submit_back" class="btn btn-save-and-back" />
                </td>
                <td></td>
            </tr>
        </table>
        <?php
    }
    echo form::close();
    ?>
</div>