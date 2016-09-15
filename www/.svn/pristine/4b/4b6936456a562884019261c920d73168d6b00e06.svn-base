<div id="admin-user-login">
    <div class="login-box">
        <h3><?php echo Kohana::lang('user.email_recovering'); ?></h3>
        <?php echo form::open(null, array('method' => 'post')); ?>
        <table class="table_form" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <?php echo html::image('img/admin_default/user-login-black.png'); ?>
                    <label for="email"><?php echo Kohana::lang('user.email'); ?></label>
                    <input type="text" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
                </td>
            </tr>
            <tr>                
                <td>
                    <input type="submit" name="submit" value="Wyślij" /></li>
                </td>
            </tr>
        </table>
        <?php echo form::close(); ?>
        <p>
            Wróć do <?php echo html::anchor('4dminix', 'Logowania'); ?>
        </p>
    </div>
</div>