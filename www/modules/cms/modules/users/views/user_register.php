<div id="admin_user_register">
    <fieldset>
        <legend><?php echo Kohana::lang('user.register'); ?></legend>
        <?php echo form::open(null, array('method' => 'post')); ?>
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <th><label for="email"><?php echo Kohana::lang('user.email'); ?></label></th>
                    <td><input type="text" name="email" id="email" /></td>
                </tr>
                <tr>
                    <th><label for=""><?php echo Kohana::lang('user.password'); ?></label></th>
                    <td><input type="password" name="password" id="password" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" name="submit" id="submit" value="submit"><?php echo Kohana::lang('user.submit_login'); ?></button>
                    </td>
                </tr>
            </table>
        <?php echo form::close(); ?>
    </fieldset>
</div>