<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('user.add_user')
            ))->render(TRUE);
?>
<div id="admin_user_add">
    <?php echo form::open_multipart(null, array('method' => 'post', 'id' => 'form_user_add')); ?>
    <table class="table_form">
    	<tr>
    		<td class="td_form_left"><?php echo Kohana::lang('boxes.add_photo'); ?><br/> 
            <?php echo Kohana::lang('boxes.box_photo_dimensions').'('.users::BIGWIDTH.' x '.users::BIGHEIGHT.')';?></td>
            <td><input type="file" name="photo" id="add_news_photo" /></td>
            <td><div id="photo_error" class="error_message"></div></td>
    	</tr>
        <tr>
            <td class="td_form_left"><label for="first_name"><?php echo Kohana::lang('user.first_name'); ?></label></td>
            <td><?php echo form::input(array('type' => 'text', 'id' => 'first_name', 'name' => 'first_name')); ?></td>
            <td><div class="error_message" id="first_name_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="last_name"><?php echo Kohana::lang('user.last_name'); ?></label></td>
            <td><?php echo form::input(array('type' => 'text', 'id' => 'last_name', 'name' => 'last_name')); ?></td>
            <td><div class="error_message" id="last_name_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="email"><?php echo Kohana::lang('user.email'); ?></label></td>
            <td><?php echo form::input(array('type' => 'text', 'id' => 'email', 'name' => 'email')); ?></td>
            <td><div class="error_message" id="email_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="password"><?php echo Kohana::lang('user.password'); ?></label></td>
            <td><?php echo form::input(array('type' => 'password', 'id' => 'password', 'name' => 'password')); ?></td>
            <td><div class="error_message" id="password_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="confirm_password"><?php echo Kohana::lang('user.confirm_password'); ?></label></td>
            <td><?php echo form::input(array('type' => 'password', 'id' => 'confirm_password', 'name' => 'confirm_password')); ?></td>
            <td><div class="error_message" id="confirm_password_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="status"><?php echo Kohana::lang('user.user_status'); ?></label></td>
            <td>
                <select name="status" id="status">
                    <option value="Y"><?php echo Kohana::lang('user.user_status_available'); ?></option>
                    <option value="N"><?php echo Kohana::lang('user.user_status_disable'); ?></option>
                </select>
            </td>
            <td><div class="error_message" id="status_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="role_id"><?php echo Kohana::lang('user.roles'); ?></label></td>
            <td>
                <select name="role_id" id="role_id">
                    <?php foreach($roles as $r) { ?>
                    <option value="<?php echo $r->id_role; ?>"><?php echo $r->name; ?></option>
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
                <input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save"  />
                <input type="submit" name="submit_back" value="<?php echo Kohana::lang('admin.add_back'); ?>" class="btn btn-save-and-back"  />
            </td>
            <td>&ensp;</td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>