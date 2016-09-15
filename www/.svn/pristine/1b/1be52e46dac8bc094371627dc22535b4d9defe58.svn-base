<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('news.add_news')
            ))->render(TRUE);
?>
<div id="admin_news_view">
    <?php echo form::open_multipart(null, array('id'=>'form_add_news')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.add_photo') ; ?> główne</td>
            <td><input type="file" name="mainphoto"  id="add_news_photo" /></td>
            <td><div id="error_photo" class="error_message"></div></td>
        </tr>
        <tr style="display:none;">
            <td class="td_form_left"><?php echo Kohana::lang('news.add_photo'); ?> dodatkowe</td>
            <td><input type="file" name="photo[]" multiple id="add_news_photo" /></td>
            <td><div id="error_photo" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.add_photo_alt'); ?></td>
            <td><input type="text" name="alt" id="add_photo_alt" value="<?php if(!empty($_POST)) { echo $_POST['alt']; } ?>" /></td>
            <td><div id="error_photo" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.title'); ?></td>
            <td><input name="title" id="add_news_title" value="<?php if(!empty($_POST)) { echo $_POST['title']; } ?>"></td>
            <td><div id="title_error" class="error_message"></div></td>
        </tr>
        <?php if(!request::is_ajax()) { ?>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.language'); ?></td>
            <td><?php echo form::dropdown(array('standard'=>'standard', 'name'=>'lang', 'id'=>'add_news_language', 'class'=>'news_language_check'),$languages, (!empty($_POST) ? $_POST['lang'] : $oCategoryDetails)); ?></td>
            <td><div id="lang_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.news_categories'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'news_categories[]', 'multiple'=>'multiple','id' => 'add_news_news_categories', 'class'=>'news_category_check'),$aNewsCategories, !empty($_POST) ? $_POST['news_categories'] : $iNewsCategoryId); ?>*</td>
            <td><div id="news_categories_error" class="error_message"></div></td>
        </tr>
        <?php } ?>
        
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.description'); ?></td>
            <td><textarea class="tinyText" name="description" cols="40" rows="5" id="add_news_description"><?php if(!empty($_POST)) { echo $_POST['description']; } ?></textarea></td>
            <td><div  id="description_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">Dodatkowy Opis</td>
            <td><textarea class="tinyText" name="short_description" cols="40" rows="5" id="add_news_short_description"><?php if(!empty($_POST)) { echo $_POST['short_description']; } ?></textarea></td>
            <td><div id="short_description_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.available'); ?></td>
            <td>
                <select name="available">
                    <option value="1" <?php if(isset($_POST['available']) && $_POST['available']==1) { echo 'selected="selected"'; } ?>><?php echo Kohana::lang('news.available_true'); ?></option>
                    <option value="0" <?php if(isset($_POST['available']) && $_POST['available']==0) { echo 'selected="selected"'; } ?>><?php echo Kohana::lang('news.available_false'); ?></option>
                </select>
            </td>
            <td><div id="available_error" class="error_message"></div></td>
        </tr>
		
		  <tr>
            <td class="td_form_left"><?php echo "Wyświetlana data dodania"; ?></td>
            <td><input type="text" name="date_added" id="date_added" class="datepicker" value="<?php if(!empty($_POST)) { echo $_POST['date_added']; } ?>" /></td>
            <td><div id="news_start_date_error" class="error_message"></div></td>
        </tr>
		
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.news_start_date'); ?></td>
            <td><input type="text" name="news_start_date" id="news_start_date" class="datepicker" value="<?php if(!empty($_POST)) { echo $_POST['news_start_date']; } ?>" /></td>
            <td><div id="news_start_date_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('news.news_end_date'); ?></td>
            <td><input type="text" name="news_end_date" id="news_end_date" class="datepicker" value="<?php if(!empty($_POST)) { echo $_POST['news_end_date']; } ?>" /></td>
            <td><div id="news_end_date_error" class="error_message"></div></td>
        </tr>
        <tr>
           	<td class="td_form_left">
           		<label for="url"><?php echo Kohana::lang('pages.url'); ?></label>
           		<span class="label_comment"><?php echo Kohana::lang('pages.comments.url'); ?></span>
           	</td>
               <td>
               	<input type="text" name="url" id="add_news_url" value="<?php if(!empty($_POST['url'])) { echo $_POST['url']; } ?>" />
               </td>
           	<td><div id="error_url" class="error_message"></div></td>
        </tr>
        <tr>
           	<td class="td_form_left">
           		<label for="meta_title"><?php echo Kohana::lang('pages.meta_title'); ?></label>
           		<span class="label_comment"><?php echo Kohana::lang('pages.comments.meta_title'); ?></span>
           	</td>
               <td>
               	<input type="text" name="meta_title" id="add_pages_meta_title" value="<?php if(!empty($_POST['meta_title'])) { echo $_POST['meta_title']; } ?>" />
               </td>
           	<td><div id="error_meta_title" class="error_message"></div></td>
           </tr>
        <tr>
           	<td class="td_form_left">
               	<label for="meta_keywords"><?php echo Kohana::lang('pages.meta_keywords'); ?></label>
               	<span class="label_comment"><?php echo Kohana::lang('pages.comments.meta_keywords'); ?></span>
           	</td>
           	<td>
           		<textarea name="meta_keywords" cols="40" rows="5" id="add_pages_meta_keywords" ><?php if(!empty($_POST['meta_keywords'])) { echo $_POST['meta_keywords']; } ?></textarea>
           	</td>
           	<td><div id="error_meta_kewords" class="error_message"></div></td>
        </tr>
        <tr>
           	<td class="td_form_left">
               	<label for="meta_description"><?php echo Kohana::lang('pages.meta_description'); ?></label>
               	<span class="label_comment"><?php echo Kohana::lang('pages.comments.meta_description'); ?></span>
           	</td>
           	<td>
           		<textarea name="meta_description" cols="40" rows="5" id="add_pages_meta_description" ><?php if(!empty($_POST['meta_description'])) { echo $_POST['meta_description']; } ?></textarea>
           	</td>
           	<td><div id="error_meta_description" class="error_message"></div></td>
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