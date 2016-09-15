<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('contact_form.edit_contact_form')
            ))->render(TRUE);
?>
<div id="admin_contact_form_edit">
    <?php echo form::open(null, array('id' => 'form_edit_contact_form')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('contact_form.contact_form_name'); ?></td>
            <td><input name="title" id="contact_form_name" value="<?php if(!empty($_POST)) { echo $_POST['title']; } elseif( !empty($contact_form[0]->title)) {echo $contact_form[0]->title;} ?>" />*</td>
            <td><div id="title_error" class="error_message"></div></td>
        </tr>
        
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('contact_form.language'); ?></td>
            <td><?php echo form::dropdown(array('standard'=>'standard', 'name'=>'language', 'id'=>'news_category_language', 'class'=>'language_check'),$languages, ((!empty($_POST['lang'])) ? $_POST['lang']: (!empty($contact_form[0]->language)) ? $contact_form[0]->language : '')); ?>*</td>
            <td><div id="lang_error" class="error_message"></div></td>
        </tr>
        
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('contact_form.pages'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'page_id[]', 'multiple'=>'multiple','id' => 'news_category_pages_ids', 'class'=>'page_check'), $pages, ((!empty($_POST['page_id'])) ? $_POST['page_id']: ((!empty($aSelectedPages)) ? $aSelectedPages : ''))); ?>*</td>
            <td><div id="page_id_error" class="error_message"></div></td>
        </tr>
		<tr>
            <td class="td_form_left"><?php echo Kohana::lang('contact_form.show_title'); ?></td>
            <td><?php echo form::checkbox(array('name' => 'show_title', 'id' => 'show_title', 'class' => 'show_title_check'), 'Y', (!empty($_POST['show_title']) && $_POST['show_title'] == 'Y' ? 'Y' : ((!empty($_POST) && empty($_POST['show_title'])) ? '' : ((!empty($contact_form[0]->show_title) && $contact_form[0]->show_title == 'Y' ? 'Y' : ''))))) ?></td>
            <td><div id="show_title_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="has_captcha"><?php echo Kohana::lang('contact_form.show_captcha'); ?></label></td>
            <td><?php echo form::checkbox(array('name' => 'has_captcha', 'id' => 'has_captcha', 'class' => 'has_captcha_check'), 'Y', (!empty($_POST['has_captcha']) && $_POST['has_captcha'] == 'Y' ? 'Y' : ((!empty($_POST) && empty($_POST['has_captcha'])) ? '' : ((!empty($contact_form[0]->has_captcha) && $contact_form[0]->has_captcha == 'Y' ? 'Y' : ''))))) ?></td>
            <td><div id="has_captcha_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('contact_form.sender_email'); ?></td>
            <td><input name="sender_email" id="sender_email" value="<?php if(!empty($_POST)) { echo $_POST['sender_email']; } elseif( !empty($contact_form[0]->sender_email)) {echo $contact_form[0]->sender_email;} ?>" />*</td>
            <td><div id="sender_email_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('contact_form.receiver_email'); ?>
				<span class="label_comment"><?php echo Kohana::lang('contact_form.comments.receiver_email') ?></span>
			</td>
            <td><textarea name="receiver_email" id="receiver_email"><?php if(!empty($_POST)) { echo $_POST['receiver_email']; } elseif( !empty($contact_form[0]->receiver_email)) {echo $contact_form[0]->receiver_email;} ?></textarea>*</td>
            <td><div id="receiver_email_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('admin.back'); ?>" name="back" class="btn btn-back" /></td>
            <td>
                <input type="submit" value="<?php echo Kohana::lang('admin.save'); ?>" name="add_contact_form" class="btn btn-save" />
				<input type="submit" value="<?php echo Kohana::lang('admin.save_back'); ?>" name="submit_back" class="btn btn-save-and-back" />
            </td>
            <td></td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>