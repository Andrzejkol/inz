<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('newsletter.add_group')
            ))->render(TRUE);
?>
<div id="admin_newsletter_group_add">

    <?php echo form::open_multipart(null, array('method' => 'post', 'id' => 'form_newsletter_group_add')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><label for="name"><?php echo Kohana::lang('newsletter.group_name'); ?></label></td>
            <td class="ta_left">
                <?php echo form::input(array('type' => 'text', 'id' => 'name', 'name' => 'name')); ?>
                <div class="error_message" id="name_error"></div>
            </td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="default_group"><?php echo Kohana::lang('newsletter.is_default'); ?></label>
				<span class="label_comment"><?php echo Kohana::lang('newsletter.comments.is_default') ?></span>
			</td>
            <td class="ta_left">
                Tak <?php echo form::radio(array('type' => 'radio', 'id' => 'default_group1', 'name' => 'default_group', 'value'=>1)); ?>&nbsp;&nbsp;
                Nie <?php echo form::radio(array('type' => 'radio', 'id' => 'default_group2', 'name' => 'default_group', 'value'=>0, 'checked'=>'checked')); ?>
                <div class="error_message" id="default_group_error"></div>
            </td>
        </tr>
		<tr>
            <td class="td_form_left"><label for="lang"><?php echo Kohana::lang('newsletter.language'); ?></label></td>
            <td class="ta_left">
                <?php echo form::dropdown(array('name' => 'lang', 'id' => 'lang'), $languages, (!empty($_POST) ? $_POST['lang'] : 'Polski')); ?>
                <div class="error_message" id="lang_error"></div>
            </td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="description"><?php echo Kohana::lang('newsletter.group_description'); ?></label></td>
            <td class="ta_left">
                <textarea id="description" name="description" rows="3" cols="40"></textarea>
                <div class="error_message" id="description_error"></div>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo html::anchor('4dminix/newsletter_grupy', '<input type="button" value="'.Kohana::lang('admin.back').'" name="back" class="btn btn-back" />'); ?>
            </td>
            <td>
                <input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save"  />
                <input type="submit" name="submit_back" value="<?php echo Kohana::lang('admin.add_back'); ?>" class="btn btn-save-and-back"  />
            </td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>