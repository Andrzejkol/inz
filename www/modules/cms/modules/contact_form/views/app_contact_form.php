<div class="contact-form">
    <?php echo form::open(NULL); ?>
    <ul class="form">
        <li>
            <label for="name"><?php echo Kohana::lang('contact_form.name'); ?>: </label>
            <input type="text" name="name" id="name" class="form-input" value="<?php echo!empty($_POST['name']) ? $_POST['name'] : '' ?>" />
        </li>
        <li>
            <label for="phone"><?php echo Kohana::lang('contact_form.phone'); ?>: </label>
            <input type="text" name="phone" id="phone" class="form-input" value="<?php echo!empty($_POST['phone']) ? $_POST['phone'] : '' ?>"/>
        </li>
        <li>
            <label for="email"><?php echo Kohana::lang('contact_form.email'); ?>: </label>
            <input type="text" name="email" id="email" class="form-input" value="<?php echo!empty($_POST['email']) ? $_POST['email'] : '' ?>" />
        </li>
        <li>
            <label for="topic"><?php echo Kohana::lang('contact_form.topic'); ?>: </label>
            <input type="text" name="topic" id="topic" class="form-input" value="<?php echo!empty($_POST['topic']) ? $_POST['topic'] : '' ?>" />
        </li>
        <li>
            <label for="message"><?php echo Kohana::lang('contact_form.message'); ?>: </label>
            <textarea name="message" id="message" cols="32" rows="5" ><?php echo!empty($_POST['message']) ? $_POST['message'] : '' ?></textarea>
        </li>
        <?php if (!empty($contact_form) && !empty($contact_form[0]->has_captcha) && $contact_form[0]->has_captcha == 'Y') : ?>
            <li><div id="captcha"><?php echo $captcha->render(TRUE); ?></div></li>
            <li>
                <label for="captcha_code"><?php echo Kohana::lang('contact_form.captcha'); ?>: </label>
                <input type="text" name="captcha_code" class="form-input" id="captcha_code" maxlength="6" />
            </li>
        <?php endif; ?>
        <li>
            <input type="hidden" name="element_id" id="element_id" value="<?php echo $iElementId; ?>" />
            <button type="submit" style="float:right;" value="contact_form_submit" name="contact_form_submit" class="btn btn-big form-submit"><?php echo Kohana::lang('contact_form.send_button') ?></button>
        </li>
    </ul>
    <?php echo form::close(); ?>
</div>