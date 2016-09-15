<?php if (shop_config::getConfig('one_step_order') != 1): ?>
    <div class="cart-top-nav">
        <div class="step step1 active">1. Koszyk</div>
        <div class="arrow"></div>
        <div class="step step2">2. Twoje dane</div>
        <div class="arrow"></div>
        <div class="step step3">3. Podsumowanie</div>
        <div class="arrow"></div>
        <div class="step step4">4. Potwierdzenie</div>
    </div>
<?php endif; ?>
<div id="validation-popup"></div>
<?php
if (!empty($msg)) {
    echo $msg;
}
?>  
<?php if (!empty($oCartContent) && count($oCartContent) > 0): ?>
    <?php echo form::open(Kohana::lang('links.lang') . 'zamowienie/koszyk'); ?>

    <?php
    if (!empty($vOrderProductsDetails)) :
        echo $vOrderProductsDetails;
    endif;
    ?>

    <?php
    if (!empty($vOrderCustomerDetails) && !empty($aCartContent) && count($aCartContent) > 0) :
        echo $vOrderCustomerDetails;
    endif;
    ?>
    <?php
    if (!empty($vOrderOrderDetails) && !empty($aCartContent) && count($aCartContent) > 0) :
        echo $vOrderOrderDetails;
    endif;
    ?>

    <?php echo form::close(); ?>
<?php /*
    <div id="pop-up">
        <div class="customer_login customer-forms" id="login-popup">
            <?php echo form::open('logowanie'); ?>        
            
            <div class="clear"></div>
            <table class="customer_login_form customer_form site-form" >
                <tr>
                    <td>
                        <label for="customer_email"><?php echo Kohana::lang('shop_app.customer.email'); ?>:</label>
                    </td>
                    <td>
                        <input type="text" name="customer_email" class="input-text" id="customer_email" value="<?php
                        if (!empty($_POST['customer_email'])) {
                            echo $_POST['customer_email'];
                        }
                        ?>" />
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px">
                        <label for="customer_password"><?php echo Kohana::lang('shop_app.customer.password'); ?>:</label>
                    </td>
                    <td><input type="password" name="customer_password" class="input-text" id="customer_password" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="links">
                        <?php echo html::anchor(Kohana::lang('links.lang') . 'przypomnij_haslo', 'Wygeneruj nowe hasło'); ?><br/>
                        <?php echo html::anchor(Kohana::lang('links.lang') . 'rejestracja', 'Rejestracja'); ?>
                    </td>
                </tr>
                <tr>                
                    <td class="login-info" colspan="2">
                        <?php //echo html::anchor(Kohana::lang('links.lang').'przypomnij_haslo', Kohana::lang('app.recover_password'));   ?> 
                        <?php //echo html::anchor(Kohana::lang('links.lang').'rejestracja', Kohana::lang('app.register'));   ?>
                        <input type="hidden" name="fromorder" value="Y" />
                        <input type="submit" value="<?php echo Kohana::lang('shop_app.account.log_in'); ?>" name="login" class="btn" />

                    </td>
                </tr>
            </table>
            <?php echo form::close(); ?>        
        </div>
    </div>
*/ ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.link-privacy').hover(function() {
                $('.steps', this).show();
            }, function() {
                $('.steps', this).hide();
            });
        });
    </script>
<?php else: ?>
    <div class="row empty_cart_message">
        <p class="info col-md-12"><?php echo Kohana::lang('order.your_cart_is_empty_please_back_to_the_shop'); ?></p>
    </div>
<?php endif; ?>
