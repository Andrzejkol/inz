<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('newsletter.add_newsletter')
            ))->render(TRUE);
?>
<div id="admin_newsletter_add">
    <?php echo form::open_multipart(null, array('method' => 'post', 'id' => 'form_newsletter_add')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><label for="language"><?php echo Kohana::lang('newsletter.language'); ?></label></td>
            <td><?php echo form::dropdown(array('name' => 'language', 'id' => 'language'), $languages, (!$_POST) ? 'pl_PL' : $_POST['language']) ?>
				<?php /*
                <select name="language" id="language">
                    <?php foreach ($languages as $langKey => $langValue) { ?>
                        <option value="<?php echo $langKey; ?>"><?php echo $langValue; ?></option>
                    <?php } ?>
                </select> */ ?>
            </td>
            <td><div class="error_message" id="language_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="title"><?php echo Kohana::lang('newsletter.title'); ?></label></td>
            <td>
                <input type="text" id="title" name="title" value="<?php if (!empty($_POST['title'])) {
                        echo $_POST['title'];
                    } ?>" />
            </td>
            <td><div class="error_message" id="title_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="content"><?php echo Kohana::lang('newsletter.content'); ?></label></td>
            <td>
                <textarea cols="60" rows="10" name="content" id="newsletter_content">
<?php if (!empty($_POST['content'])) {
    echo $_POST['content'];
} ?>
                </textarea>
            </td>
            <td><div class="error_message" id="content_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="interval"><?php echo Kohana::lang('newsletter.interval'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('newsletter.interval_comment'); ?></span>
            </td>
            <td>
                <input type="text" id="interval" name="interval" value="<?php if (!empty($_POST['interval'])) {
    echo $_POST['interval'];
} else {
    echo '1';
} ?>" />
            </td>
            <td><div class="error_message" id="interval_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="bulk"><?php echo Kohana::lang('newsletter.bulk'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('newsletter.bulk_comment'); ?></span>
            </td>
            <td>
                <input type="text" id="bulk" name="bulk" value="<?php if (!empty($_POST['bulk'])) {
    echo $_POST['bulk'];
} else {
    echo '20';
} ?>" />
            </td>
            <td><div class="error_message" id="bulk_error"></div></td>
        </tr>
		<?php 
//		@TODO: Odkomentować, jeśli jest potrzeba dodawania zdjęć do newslettera
		/*
        <tr>
            <td class="td_form_left">
                <label for="bulk"><?php echo Kohana::lang('newsletter.images'); ?></label>
            </td>
            <td>
                <input type="file" id="file1" name="file1"  /><br/>
                <input type="file" id="file2" name="file2"  /><br/>
                <input type="file" id="file3" name="file3"  /><br/>
                <input type="file" id="file4" name="file4"  /><br/>
                <input type="file" id="file5" name="file5"  /><br/>
                <input type="file" id="file6" name="file6"  /><br/>
                <input type="file" id="file7" name="file7"  /><br/>
                <input type="file" id="file8" name="file8"  /><br/>
                <input type="file" id="file9" name="file9"  /><br/>
                <input type="file" id="file10" name="file10"  /><br/>
            </td>
            <td><div class="error_message" id="file_error"></div></td>
        </tr> */ ?>

        <tr>
            <td class="td_form_left"><label for="newsletter_groups"><?php echo Kohana::lang('newsletter.newsletter_email_groups'); ?></label></td>
            <td>
                <ul id="newsletter_groups">
					<?php
					if (!empty($allNewsletterGroups) && $allNewsletterGroups->count() > 0) :
						foreach ($allNewsletterGroups as $ng) : ?>
							<li>								
								<input type="checkbox" <?php if (!empty($_POST['newsletter_group'][$ng->id_newsletter_group])) {echo 'checked="checked"';} ?> name="newsletter_group[<?php echo $ng->id_newsletter_group; ?>]" id="newsletter_group_<?php echo $ng->id_newsletter_group; ?>" />
								<label for="newsletter_group_<?php echo $ng->id_newsletter_group; ?>"><?php echo $ng->name; ?></label>
							</li>
						<?php 
						endforeach;
					else : ?>
						<li>Brak zdefiniowanych grup dla wybranego języka.</li>
					<?php endif; ?>
                </ul>
            </td>
            <td><div class="error_message" id="newsletter_groups_error"></div></td>
        </tr>
        <tr>
            <td>
<?php
//TODO: to wywalic jak CMS bedzie gotowy
echo html::anchor('4dminix/newslettery', '<input type="button" value="' . Kohana::lang('admin.back') . '" name="back"  class="btn btn-back"/>');
?>
            </td>
            <td>
                <input class="btn btn-save" type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" />
                <input class="btn btn-save-and-back" type="submit" name="submit_back" value="<?php echo Kohana::lang('admin.add_back'); ?>" />
            </td>
            <td>&ensp;</td>
        </tr>
    </table>
<?php echo form::close(); ?>
</div>