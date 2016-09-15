<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('newsletter.add_email')
            ))->render(TRUE);
?>
<div id="admin_newsletter_email_add">
    <?php echo form::open_multipart(null, array('method' => 'post', 'id' => 'form_newsletter_email_add')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><label for="name"><?php echo Kohana::lang('newsletter.name'); ?></label></td>
            <td>
                <?php echo form::input(array('type' => 'text', 'id' => 'name', 'name' => 'name', 'value'=>(isset($_POST['name']) ? $_POST['name']:''))); ?>
                <div class="error_message" id="name_error"></div>
            </td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="email"><?php echo Kohana::lang('newsletter.email_address'); ?></label>
                <span class="label_comment">Możesz podać więcej adresów email, wstawiając każdy w nowej linii</span>
            </td>
            <td>
                <?php //echo form::input(array('type' => 'text', 'id' => 'email', 'name' => 'email', 'value'=>(isset($_POST['email']) ? $_POST['email']:''))); ?>
                <textarea name="email"></textarea>
                <div class="error_message" id="email_error"></div>
            </td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="newsletter_email_active"><?php echo Kohana::lang('newsletter.newsletter_email_active'); ?></label></td>
            <td>
                <ul>
                    <li><input type="checkbox" name="newsletter_email_active" id="newsletter_email_active" value="N" /></li>
                </ul>
                <div class="error_message" id="newsletter_email_active_error"></div>
            </td>
        </tr>
        <tr>
            <td class="td_form_left"><label><?php echo Kohana::lang('newsletter.email_groups'); ?></label></td>
            <td>
                <ul>
                    <?php foreach($oNewsletterGroups as $ng) { ?>
                    <li><input type="checkbox" name="newsletter_group[<?php echo $ng->id_newsletter_group; ?>]" id="newsletter_group_<?php echo $ng->id_newsletter_group; ?>" <?php  ?> /> <label for="newsletter_group_<?php echo $ng->id_newsletter_group; ?>"><?php echo $ng->name; ?></label></li>
                        <?php } ?>
                </ul>
                <div class="error_message" id="email_error"></div>
            </td>
        </tr>

        <tr>
            <td>
                <?php //TODO: to wywalic jak CMS bedzie gotowy
                echo html::anchor('4dminix/emaile', '<input type="button" value="'.Kohana::lang('newsletter.back').'" name="back"  class="btn btn-back"/>');
                ?>
            </td>
            <td>
                <input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>"  class="btn btn-save"/>
                <input type="submit" name="submit_back" value="<?php echo Kohana::lang('admin.add_back'); ?>"  class="btn btn-save-and-back"/>
            </td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>