
<?php
    foreach($oCategories as $oCategory) {
?>
        <?php
    View::factory('admin/elements/form_header')
            ->set(array(
                'sIco' => 'edit',
                'sTitle' => Kohana::lang('poll.edit_poll_category')
            ))->render(TRUE);
    ?>
    <div id="polls_category_edit">
    <?php echo form::open_multipart(null, array('id'=>'form_edit_poll_category')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('poll.category_name'); ?></td>
            <td><input type="text" name="category_name" id="add_category_name" value="<?php echo !empty($_POST) ? $_POST['category_name'] : $oCategory->category_name; ?>" /></td>
            <td><div id="category_name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('poll.language'); ?></td>
            <td><?php echo form::dropdown(array('name'=>'lang', 'style' => 'width: 150px;', 'id'=>'add_gallery_language'),$languages, !empty($_POST['lang']) ? $_POST['lang'] : $oCategory->lang); ?></td>
            <td><div id="langs_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('elements.page_id'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'page_id[]', 'multiple'=>'multiple', 'style' => 'width:255px;', 'id' => 'add_elements_page_id'),$pages, !empty($_POST['page_id']) ? $_POST['page_id'] : $aSelectedPages); ?></td>
            <td><div id="page_id_error" class="error_message"></div></td>
        </tr>

        <tr>
            <td style="width: 200px">
                <input type="button" value="<?php echo Kohana::lang('poll.back'); ?>" name="back" class="btn btn-back"/>
            </td>
            <td>
                <input type="submit" value="<?php echo Kohana::lang('poll.save'); ?>" name="submit" class="btn btn-save" />
                <input type="submit" value="<?php echo Kohana::lang('poll.save_back'); ?>" name="submit_back" class="btn btn-save-and-back" />
            </td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>
<?php } ?>