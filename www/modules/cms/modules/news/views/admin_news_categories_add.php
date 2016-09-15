<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'add',
            'sTitle' => Kohana::lang('news.add_news_category')
        ))->render(TRUE);
?>
<div id="admin_news_view">
    <?php echo form::open_multipart(null, array('id' => 'form_add_news_category')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.news_category_name'); ?></td>
            <td><input name="title" id="news_category_name" value="<?php if (!empty($_POST['title'])) {
        echo $_POST['title'];
    } ?>" />*</td>
            <td><div id="title_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.language'); ?></td>
            <td><?php echo form::dropdown(array('standard' => 'standard', 'name' => 'lang', 'id' => 'news_category_language', 'class' => 'language_check'), $languages, (!empty($_POST['lang']) ? $_POST['lang'] : (!empty($sLanguage) ? $sLanguage : ''))); ?>*</td>
            <td><div id="lang_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">Kategoria nadrzędna</td>
            <td> 
                <select id="maincategories" name="id_news_subcategory">
                    <option value="0" selected="selected">Brak</option>
                    <?php
                    foreach ($oCategories as $cat) {
                        echo '<option value="' . $cat->id_news_category . '">' . $cat->news_category_name . '</option>';
                    }
                    ?>
                </select>
            </td>
            <td><div id="id_news_subcategory_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.pages'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'page_id[]', 'multiple' => 'multiple', 'id' => 'news_category_pages_ids', 'class' => 'page_check'), $pages, !empty($_POST['page_id']) ? $_POST['page_id'] : $iPageId); ?>*</td>
            <td><div id="page_id_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('page_content.show_title_on_site'); ?></td>
            <td><input type="checkbox" value="N" name="show_title" <?php if (!empty($_POST['show_title']) && $_POST['show_title'] == 'N') {
                        echo 'checked="checked"';
                    } ?> /></td>
            <td><div id="show_title_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.show_comments'); ?></td>
            <td><input type="checkbox" value="1" name="comments" <?php if (!empty($_POST['comments']) && $_POST['comments'] == '1') {
                        echo 'checked="checked"';
                    } ?> /></td>
            <td><div id="show_title_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('news.back'); ?>" name="back" class="btn btn-back" /></td>
            <td>
                <input type="submit" value="<?php echo Kohana::lang('admin.add'); ?>" name="submit" class="btn btn-save" />
                <input type="submit" value="<?php echo Kohana::lang('admin.add_back'); ?>" name="submit_back" class="btn btn-save-and-back" />
            </td>
            <td></td>
        </tr>
    </table>
<?php echo form::close(); ?>
</div>