<div id="admin-user-login">
	<div class="login-box">
    <h3><?php echo Kohana::lang('admin.user.login'); ?></h3>
    <?php echo form::open(null, array('method' => 'post')); ?>
        <table class="table_form" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                	<?php echo html::image('img/admin_default/user-login-black.png'); ?>
                	<label for="email"><?php echo Kohana::lang('admin.user.user'); ?></label>
                	<input type="text" name="email" id="email" value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : '' ?>"/>
                </td>
            </tr>
            <tr>
                <td><div>
                	<?php echo html::image('img/admin_default/user-pass-black.png'); ?>
                	<label for="password"><?php echo Kohana::lang('admin.user.password'); ?></label></div>
                	<input type="password" name="password" id="password" value="" />
                </td>
            </tr>
            <tr>                
                <td>
                    <input type="submit" name="submit" id="submit" value="<?php echo Kohana::lang('user.submit_login'); ?>" />
                </td>
            </tr>
        </table>
    <?php echo form::close(); ?>
    <p>
    <?php 
    	echo Kohana::lang('admin.user.forgot_password')."<br/>";
    	echo html::anchor('4dminix/przypomnij_haslo', Kohana::lang('admin.user.forgot_password_link')); 
    	echo Kohana::lang('admin.user.forgot_password_desc');
    ?>
    </p>
    </div>
</div>