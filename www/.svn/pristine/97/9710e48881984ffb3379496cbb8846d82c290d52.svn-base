<?php echo (!empty($msg)) ? $msg : ''; ?>
<h2 class="cufon">Newsletter</h2>
<?php echo form::open(); ?>
<div>
    <input type="radio" name="subscription" value="add_subscription" id="subscribe" <?php echo (empty($_POST) || (!empty($_POST) && !(empty($_POST['subscription'])) && $_POST['subscription'] == 'add_subscription')) ? 'checked="checked"' : '' ?>  /> <label for="subscribe" class="formLabel"><?php echo Kohana::lang('newsletter.app_subscribe') ?></label>
    <input type="radio" name="subscription" value="delete_subscription" id="unsubscribe" <?php echo (!empty($_POST) && !(empty($_POST['subscription'])) && $_POST['subscription'] == 'delete_subscription') ? 'checked="checked"' : '' ?> /> <label for="unsubscribe" class="formLabel"><?php echo Kohana::lang('newsletter.app_unsubscribe') ?></label>
</div>
<div>email: <br />
    <input type="text" name="newsletter_email" class="formTextbox" id="newsletter_email" maxlength="64" value="<?php echo (!empty($_POST['newsletter_email'])) ? $_POST['newsletter_email'] : '' ?>" />
</div>
<div><input type="submit" name="submit" class="formButton" id="submit" value="<?php echo Kohana::lang('newsletter.app_button') ?>" /></div>
<?php echo form::close(); ?>