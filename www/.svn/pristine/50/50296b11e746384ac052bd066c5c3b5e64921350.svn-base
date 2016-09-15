<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('newsletter.edit_email')
            ))->render(TRUE);
?>
<div id="admin_newsletter_email_edit">
    <?php foreach($oEmailDetails as $ed) { ?>
	<?php echo form::open_multipart(null, array('method' => 'post', 'id' => 'form_newsletter_email_add')); ?>
        <table class="table_form">
            <tr>
                <td class="td_form_left"><label for="name"><?php echo Kohana::lang('newsletter.name'); ?></label></td>
                <td>
                    <input type="text" id="name" name="name" value="<?php if(!empty($_POST['name'])) { echo $_POST['name']; } else { echo $ed->name; } ?>" />
                    <div class="error_message" id="name_error"></div>
                </td>
            </tr>
            <tr>
                <td class="td_form_left"><label for="email"><?php echo Kohana::lang('newsletter.email_address'); ?></label></td>
                <td>
                    <input type="text" id="email" name="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } else { echo $ed->email; } ?>" />
                    <div class="error_message" id="email_error"></div>
                </td>
            </tr>
            <tr>
                <td class="td_form_left"><label for="newsletter_email_active"><?php echo Kohana::lang('newsletter.newsletter_email_active'); ?></label></td>
                <td>
                    <ul>
                        <li><input type="checkbox" name="newsletter_email_active" id="newsletter_email_active" value="N" <?php if(!empty($_POST['newsletter_email_active']) && $_POST['newsletter_email_active']=='N') { echo 'checked="checked"'; } else if(!empty($ed->newsletter_email_active) && $ed->newsletter_email_active=='N') { echo 'checked="checked"'; } ?>  /></li>
                    </ul>
                    <div class="error_message" id="newsletter_email_active_error"></div>
                </td>
            </tr>
            <tr>
                <td class="td_form_left"><label for="newsletter_email_groups"><?php echo Kohana::lang('newsletter.email_groups'); ?></label></td>
                <td>
                    <ul>
                    <?php foreach($oNewsletterGroups as $ng) { ?>
                        <?php if(in_array($ng->id_newsletter_group, $aNewsletterEmailGroups)) { ?>
                        <li><input type="checkbox" name="newsletter_group[<?php echo $ng->id_newsletter_group; ?>]" checked="checked" id="newsletter_group_<?php echo $ng->id_newsletter_group; ?>" /> <label for="newsletter_group_<?php echo $ng->id_newsletter_group; ?>"><?php echo $ng->name; ?></label></li>
                        <?php } else { ?>
                        <li><input type="checkbox" name="newsletter_group[<?php echo $ng->id_newsletter_group; ?>]" id="newsletter_group_<?php echo $ng->id_newsletter_group; ?>" /> <label for="newsletter_group_<?php echo $ng->id_newsletter_group; ?>"><?php echo $ng->name; ?></label></li>
                        <?php } ?>
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
                    <input type="submit" name="submit" value="<?php echo Kohana::lang('newsletter.save'); ?>" class="btn btn-save" />
                    <input type="submit" name="submit_back" value="<?php echo Kohana::lang('newsletter.save_back'); ?>" class="btn btn-save-and-back" />
                </td>
            </tr>
        </table>
    <?php echo form::close(); ?>
    <?php } ?>
</div>