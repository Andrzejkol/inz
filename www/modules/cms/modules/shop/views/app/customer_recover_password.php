<div class="row content-margin">
    <?php
    if (!empty($msg)) :
        echo $msg;
    endif;
    ?>
    <div id="customer_password_recover" class="customer_login customer-forms col-md-6 col-md-offset-3 customer-info">
        <h2 class="title"><?php echo Kohana::lang('shop_app.customer.forgot_password'); ?></h2>
        <p><?php echo Kohana::lang('shop_app.customer.password_recovery'); ?></p><br/>
        <?php echo form::open(null, array('class' => 'form-horizontal')); ?>
        <div class="form-group">
            <label for="customer_email" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.email'); ?>:</label>
            <div class="col-sm-6">
                <input type="text" name="customer_email" id="customer_email" class="form-control input-text" value="<?php
                if (!empty($_POST['customer_email'])) {
                    echo $_POST['customer_email'];
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <input type="submit" value="<?php echo Kohana::lang('shop_app.send'); ?>" name="password_recover" class="btn" />
            </div>
        </div>
        <?php echo form::close(); ?>
        <div id="password_recover_info">
        </div>
    </div>
</div>