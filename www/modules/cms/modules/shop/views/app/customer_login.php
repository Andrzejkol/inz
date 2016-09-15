<div class="login-content">
    <div class="row">
        <?php
        if (!empty($msg)) {
            echo $msg;
        }
        ?>
        <?php /* <h3><span class="cufon_chapa"><?php echo Kohana::lang('app.login'); ?></span></h3> */ ?>
        <div class="customer-info col-sm-6">
            <h2 class="title"><?php echo Kohana::lang('shop_app.account.register'); ?></h2>
            <p><?php echo Kohana::lang('shop_app.account.register_info'); ?></p>
            <div class="register-btn"><?php echo html::anchor(Kohana::lang('links.lang') . 'rejestracja', Kohana::lang('shop_app.account.register'), array('class' => 'black-btn btn')); ?></div>

            <h2 class="title" style="margin:40px 0px 10px"><?php echo Kohana::lang('shop_app.customer.forgot_password'); ?>?</h2>
            <p><?php echo Kohana::lang('shop_app.account.forgot_password_info'); ?></p>
            <div class="register-btn"><?php echo html::anchor(Kohana::lang('links.lang') . 'przypomnij_haslo', Kohana::lang('shop_app.account.recover_password'), array('class' => 'black-btn btn')); ?></div>

        </div>
        <div class="customer_login customer-forms col-sm-6">
            <?php echo form::open(); ?>
            <h2 class="title"><?php echo Kohana::lang('shop_app.account.login'); ?></h2>
            <p><?php echo Kohana::lang('shop_app.account.login_info'); ?></p>
            <div class="form-group">
                <label for="customer_email"><?php echo Kohana::lang('shop_app.customer.email'); ?>:</label>
                <input type="text" name="customer_email" class="form-control" id="customer_email" value="<?php
                if (!empty($_POST['customer_email'])) {
                    echo $_POST['customer_email'];
                }
                ?>" />
            </div>
            <div class="form-group">
                <label for="customer_password"><?php echo Kohana::lang('shop_app.customer.password'); ?>:</label>
                <input type="password" name="customer_password" class="form-control" class="input-text" id="customer_password" />
            </div>
            <input type="submit" value="<?php echo Kohana::lang('shop_app.account.log_in'); ?>" name="login" class="btn" />
            <?php
            echo form::close();
            ?>
        </div>
    </div>
</div>