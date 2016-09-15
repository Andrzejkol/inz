<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('user.edit_user')
            ))->render(TRUE);
?>
<div id="admin_user_edit">
    <?php echo form::open_multipart(null, array('method' => 'post', 'id' => 'form_user_edit')); ?>
    <?php foreach($userDetails as $u) { ?>
    <table class="table_form">
    <?php if (!empty($u->filename)): // jesli jest foto dajemy mozliwosc jego usuniecia  ?>
        <tr>
            <td></td>
            <td>
            	<span id="user_image_<?php echo $u->id_image; ?>"><?php echo html::image('files/users/big/' . $u->filename); ?></span>
                <?php //echo html::image('img/icons/cross.png', array('alt' => Kohana::lang('user.delete'), 'id' => 'delete_user_image_' . $u->id_image, 'style' => 'cursor:pointer')); ?>
        	</td>
        </tr>
    <?php endif; ?>  
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('user.photo'); ?></td>
            <td>
                <input type="file" name="photo" id="add_user_photo" />
            </td>
            <td>
                <div id="error_photo" class="error_message"></div>
            </td>
        </tr>	
        <tr>
            <td class="td_form_left"><label for="first_name"><?php echo Kohana::lang('user.first_name'); ?></label></td>
            <td><?php echo form::input(array('type' => 'text', 'id' => 'first_name', 'name' => 'first_name', 'value' => $u->first_name)); ?></td>
            <td><div class="error_message" id="first_name_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="last_name"><?php echo Kohana::lang('user.last_name'); ?></label></td>
            <td><?php echo form::input(array('type' => 'text', 'id' => 'last_name', 'name' => 'last_name', 'value' => $u->last_name)); ?></td>
            <td><div class="error_message" id="last_name_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="email"><?php echo Kohana::lang('user.email'); ?></label></td>
            <td><?php echo form::input(array('type' => 'text', 'id' => 'email', 'name' => 'email', 'value' => $u->email)); ?></td>
            <td><div class="error_message" id="email_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="change_password"><?php echo Kohana::lang('user.change_password'); ?></label></td>
            <td><?php echo form::checkbox(array('value' => 'change_password', 'id' => 'change_password', 'name' => 'change_password', 'onchange' => "if($(this).is(':checked')) { $('#password').removeAttr('disabled'); $('#confirm_password').removeAttr('disabled'); } else { $('#password').attr('disabled', 'disabled'); $('#confirm_password').attr('disabled', 'disabled'); }")); ?></td>
            <td>&ensp;</td>
        </tr>
        <tr class="change_password_block">
            <td class="td_form_left"><label for="password"><?php echo Kohana::lang('user.password'); ?></label></td>
            <td><?php echo form::input(array('type' => 'password', 'id' => 'password', 'name' => 'password', 'disabled' => 'disabled')); ?></td>
            <td><div class="error_message" id="password_error"></div></td>
        </tr>
        <tr class="change_password_block">
            <td class="td_form_left"><label for="confirm_password"><?php echo Kohana::lang('user.confirm_password'); ?></label></td>
            <td><?php echo form::input(array('type' => 'password', 'id' => 'confirm_password', 'name' => 'confirm_password', 'disabled' => 'disabled')); ?></td>
            <td><div class="error_message" id="confirm_password_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="status"><?php echo Kohana::lang('user.user_status'); ?></label></td>
            <td>
                <select name="status" id="status">
                    <option value="Y"<?php echo $u->status=='Y'? ' selected="selected"' : ''; ?>><?php echo Kohana::lang('user.user_status_available'); ?></option>
                    <option value="N"<?php echo $u->status=='N'? ' selected="selected"' : ''; ?>><?php echo Kohana::lang('user.user_status_disable'); ?></option>
                </select>
            </td>
            <td>&ensp;</td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="role_id"><?php echo Kohana::lang('user.roles'); ?></label></td>
            <td>
                <select name="role_id" id="role_id">
                        <?php foreach($roles as $r) { ?>
                            <?php if($r->id_role != $u->role_id) { ?>
                    <option value="<?php echo $r->id_role; ?>"><?php echo $r->name; ?></option>
                                <?php } else { ?>
                    <option value="<?php echo $r->id_role; ?>" selected="selected"><?php echo $r->name; ?></option>
                                <?php } ?>
                            <?php } ?>
                </select>
            </td>
            <td><div class="error_message" id="role_id_error"></div></td>
        </tr>
        <tr>
            <td>
                    <?php echo html::anchor('4dminix/uzytkownicy', '<input type="button" value="'.Kohana::lang('admin.back').'" name="back" class="btn btn-back" />'); ?>
            </td>
            <td>
                <input type="submit" name="submit" value="<?php echo Kohana::lang('user.save'); ?>" class="btn btn-save"  />
                <input type="submit" name="submit_back" value="<?php echo Kohana::lang('user.save_back'); ?>" class="btn btn-save-and-back"  />
            </td>
            <td>&ensp;</td>
        </tr>
    </table>
        <?php } ?>
    <?php echo form::close(); ?>
</div>