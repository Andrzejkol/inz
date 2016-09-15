<div id="contact_form_big" <?php
if (!empty($msg)) :
    echo 'style="display:block"';
endif;
?> ></div>
<div id="contact_form" <?php
     if (!empty($msg)) :
         echo 'style="display:block"';
     endif;
?>>
    <h3>Formularz kontaktowy</h3>
    <table class="contact_form_big_main" cellpadding="0" cellspacing="0">
        <tr>
            <td class="tresc">
                <div class="contact-form">
                    <?php echo form::open_multipart('kontakt#contact_form', array('id' => 'big_contact_form')); ?>
                    <?php
                    if (!empty($msg)) :
                        echo $msg;
                    endif;
                    ?>
                    <label for="contact-form-imie">Imię i nazwisko:</label>
                    <input name="name" type="text" id="contact-form-imie" value="<?php echo!empty($_POST) ? $_POST['name'] : '' ?>" />
                    <span class="form_validation" id="imie_error" ></span>
                    <br />
                    <label for="contact-form-email" class="email-label">E-mail:</label>
                    <input name="email" type="text" id="contact-form-email" maxlength="100" value="<?php echo!empty($_POST) ? $_POST['email'] : '' ?>" />
                    <span class="form_validation" id="email_error" ></span>
                    <label for="contact-form-telefon" class="phone-label">Telefon:</label>
                    <input name="phone" type="text" id="contact-form-telefon" value="<?php echo!empty($_POST) ? $_POST['phone'] : '' ?>" />
                    <span class="form_validation" id="telefon_error" ></span>
                    <br />
                    <label for="customer_state">Województwo:</label>
                    <select name="customer_state" id="customer_state">
                        <?php foreach ($aStates as $stateKey => $stateValue): ?>
                        <?php if (!empty($_POST['customer_state'])) : ?>
                        <?php echo $_POST['customer_state']; ?>
                            <option value="<?php echo $stateValue ?>" <?php echo ($_POST['customer_state'] == $stateValue) ? 'selected="selected"' : '' ?>><?php echo $stateValue; ?></option>
                        <?php else : ?>
                            <option value="<?php echo $stateValue; ?>"><?php echo $stateValue; ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        </select><br />

                        <label for="contact-form-city">Miasto:</label>
                        <input type="text" id="contact-form-city" name="city" value="<?php echo!empty($_POST) ? $_POST['city'] : '' ?>" /><br />

                        <label class="message-label" for="contact-form-message">Wiadomość: </label><br />
                        <textarea name="message" id="contact-form-message" cols="40" rows="6" ><?php echo!empty($_POST) ? $_POST['message'] : '' ?></textarea>
                        <span class="form_validation" id="message_error" ></span>
                        <br />
                            <div id="s3capcha"><?php echo $s3Capcha; ?> </div><br />
                            <div class="clear"></div>
                            <span class="form_validation" id="s3capcha_error" style="display:inline;" ></span>
                            <input name="temat" type="hidden" value="<?php
                            if (!empty($form_title)) :
                                echo $form_title . '- Zapytanie ze strony '.config::getConfig('page_name');
                            else:
                                echo 'Zapytanie ze strony '.config::getConfig('page_name');
                            endif; ?>" />
                    <input class="submit" name="contact_form_big_submit" id="contact_form_big_submit" type="submit" value="WYŚLIJ" align="middle" /><br />
                    <?php echo form::close(); ?>
                </div>
            </td>
            <td class="contact_form_border_r"></td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#s3capcha').s3Capcha();
    });
</script>

