<div class="col-md-12 content-margin">
    <?php
    if (!empty($msg)) :
        echo $msg;
    endif;
    ?>
    <div id="customer_password_recover" class="customer_login customer-forms col-sm-6 col-sm-offset-3">
        <h2 class="title"><?php echo Kohana::lang('shop_app.customer.delete_account'); ?></h2>
        <p><?php echo Kohana::lang('shop_app.customer.account_delete_info'); ?></p><br/>
        <?php echo form::open(); ?>
        <div class="form-horizontal">
            <div class="form-group">
                <label for="customer_email" class="col-sm-4 control-label"><?php echo Kohana::lang('shop_app.customer.password'); ?>:</label>
                <div class="col-sm-6">
                    <input type="password"  class="form-control input-text" name="password" />
                </div>
            </div>
            <div class="form-group">
                <label for="customer_email" class="col-sm-4 control-label"><?php echo Kohana::lang('shop_app.customer.password_repeat'); ?>:</label>
                <div class="col-sm-6">
                    <input type="password"  class="form-control input-text" name="password_repeat" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <input type="submit" name="submit" value="<?php echo Kohana::lang('shop_app.customer.delete_account'); ?>" class="btn" />
            </div>
        </div>
        <?php echo form::close(); ?>
    </div>
</div>