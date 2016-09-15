<div id="order_step2">
    <div id="login-options" class="row">                    
        <?php if (empty($_SESSION['_customer']['logged_in'])) { ?>
            <div class="col-sm-6 col-xs-12">
                <span class="title">
                    Jestem nowym klientem
                </span>
                <span id="orderwithregister">
                    <?php /* <input type="checkbox" name="customer_register_inorder" class="input-checkbox" style="display:none;" id="customer_register_inorder" value="1" <?php if (!empty($_POST['customer_register_inorder']) == '1') {
                      echo 'checked="checked"';
                      } ?> /> */ ?>
                    <label for="customer_register_inorder" class="btn btn-big btn-gray"><?php echo Kohana::lang('shop_app.account.register'); ?></label>
                </span>
                <span id="no-login" >
                    <label class="btn btn-all-yellow btn-big pull-right">
                        <?php echo Kohana::lang('shop_app.cart.orderwithoutregister'); ?>
                    </label>
                </span>
            </div>
            <div class="col-sm-6 col-xs-12">
                <span class="title">
                    Posiadam już konto
                </span>
                <?php /* GDY JEST LoginPopup   <div class="login-btn">
                  <span id="basket-login" class="btn btn-big logbutton"><?php echo Kohana::lang('shop_app.customer.login'); ?></span>
                  </div> */ ?>
                <div class="customer_login customer-forms" id="login-popup">
                    <?php //echo form::open('logowanie'); ?>        

                    <div class="customer_login_form customer_form site-form" >
                        <div class="form-group">
                            <label for="customer_email"><?php echo Kohana::lang('shop_app.customer.email'); ?>:</label>
                            <input type="text" name="customer_email" class="input-text" id="customer_email" value="<?php
                            if (!empty($_POST['customer_email'])) {
                                echo $_POST['customer_email'];
                            }
                            ?>" />
                        </div>
                        <div class="form-group">
                            <label for="customer_password"><?php echo Kohana::lang('shop_app.customer.password'); ?>:</label>
                            <input type="password" name="customer_password" class="input-text" id="customer_password" />
                        </div>
                        <div class="form-group login-buttons">
                            <?php echo html::anchor(Kohana::lang('links.lang') . 'przypomnij_haslo', Kohana::lang('app.recover_password'), array('class' => 'passrecover')); ?> 
                            <?php //echo html::anchor(Kohana::lang('links.lang').'rejestracja', Kohana::lang('app.register'));   ?>
                            <input type="hidden" name="fromorder" value="Y" />
                            <button type="button" value="login" name="login" class="btn login-button"><?php echo Kohana::lang('shop_app.account.log_in'); ?></button>
                        </div>
                        <?php //echo form::close(); ?>        
                    </div>
                </div>
            </div>

        <?php } else {
            ?>
            <div class="col-sm-12">
            </div>
        <?php } ?>
    </div>
    <div id="shopping_cart" class="orderform row">
        <div id="customer_account"  class="customer-forms" style="padding:0px;">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <?php
            //echo form::open('zamowienie/podsumowanie', array('method' => 'post'));
            echo form::open();
            ?>
            <div id="customer_delivery_address">

                <div class="site-form" style="text-align:left;">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="customer_first_name"><?php echo Kohana::lang('shop_app.customer.first_name'); ?>:<span class="red">*</span></label>
                                <input type="text" class="form-control" name="customer_first_name" required="required" id="customer_first_name" value="<?php
                                if (isset($_POST['customer_first_name'])) {
                                    echo $_POST['customer_first_name'];
                                } else if (!empty($_SESSION['_customer']['first_name'])) {
                                    echo $_SESSION['_customer']['first_name'];
                                } elseif (!empty($oCustomerDetails->customer_first_name)) {
                                    echo $oCustomerDetails->customer_first_name;
                                }
                                ?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="customer_last_name"><?php echo Kohana::lang('shop_app.customer.last_name'); ?>:<span class="red">*</span></label>
                                <input type="text" class="form-control" name="customer_last_name" required="required" id="customer_last_name" value="<?php
                                if (isset($_POST['customer_last_name'])) {
                                    echo $_POST['customer_last_name'];
                                } else if (!empty($_SESSION['_customer']['last_name'])) {
                                    echo $_SESSION['_customer']['last_name'];
                                } elseif (!empty($oCustomerDetails->customer_last_name)) {
                                    echo $oCustomerDetails->customer_last_name;
                                }
                                ?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="customer_email"><?php echo Kohana::lang('shop_app.customer.email'); ?>:<span class="red">*</span></label>
                                <input type="text" class="form-control" name="customer_email" required="required" id="customer_email" value="<?php
                                if (isset($_POST['customer_email'])) {
                                    echo $_POST['customer_email'];
                                } else if (!empty($_SESSION['_customer']['customer_email'])) {
                                    echo $_SESSION['_customer']['customer_email'];
                                } elseif (!empty($oCustomerDetails->customer_email)) {
                                    echo $oCustomerDetails->customer_email;
                                }
                                ?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="customer_phoneno"><?php echo Kohana::lang('shop_app.customer.phone_no'); ?>:<span class="red">*</span></label>
                                <input type="text" class="form-control" name="customer_phoneno" id="customer_phoneno" required="required" value="<?php
                                if (isset($_POST['customer_phoneno'])) {
                                    echo $_POST['customer_phoneno'];
                                } else if (!empty($_SESSION['_customer']['customer_phoneno'])) {
                                    echo $_SESSION['_customer']['customer_phoneno'];
                                } elseif (!empty($oCustomerDetails->customer_phoneno)) {
                                    echo $oCustomerDetails->customer_phoneno;
                                }
                                ?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="customer_city"><?php echo Kohana::lang('shop_app.customer.city'); ?>:<span class="red">*</span></label>
                                <input type="text" class="form-control" name="customer_city" required="required" id="customer_city" value="<?php
                                if (isset($_POST['customer_city'])) {
                                    echo $_POST['customer_city'];
                                } else if (!empty($_SESSION['_customer']['customer_city'])) {
                                    echo $_SESSION['_customer']['customer_city'];
                                } elseif (!empty($oCustomerDetails->customer_city)) {
                                    echo $oCustomerDetails->customer_city;
                                }
                                ?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="customer_zip"><?php echo Kohana::lang('shop_app.customer.zip'); ?>:<span class="red">*</span></label>
                                <input type="text" class="form-control" name="customer_zip" required="required" id="customer_zip" value="<?php
                                if (isset($_POST['customer_zip'])) {
                                    echo $_POST['customer_zip'];
                                } else if (!empty($_SESSION['_customer']['customer_zip'])) {
                                    echo $_SESSION['_customer']['customer_zip'];
                                } elseif (!empty($oCustomerDetails->customer_zip)) {
                                    echo $oCustomerDetails->customer_zip;
                                }
                                ?>" />
                            </div>
                        </div>




                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="customer_address"><?php echo Kohana::lang('shop_app.customer.address'); ?>:<span class="red">*</span></label>
                                <input type="text" class="form-control" name="customer_address" required="required" id="customer_address" value="<?php
                                if (isset($_POST['customer_address'])) {
                                    echo $_POST['customer_address'];
                                } else if (!empty($_SESSION['_customer']['customer_address'])) {
                                    echo $_SESSION['_customer']['customer_address'];
                                } elseif (!empty($oCustomerDetails->customer_address)) {
                                    echo $oCustomerDetails->customer_address;
                                }
                                ?>" />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="customer_country"><?php echo Kohana::lang('shop_app.customer.country'); ?>:</label>
                                <input type="text" class="form-control" name="customer_country" id="customer_country" value="<?php
                                if (isset($_POST['customer_country'])) {
                                    echo $_POST['customer_country'];
                                } elseif (!empty($oCustomerDetails->customer_country)) {
                                    echo $oCustomerDetails->customer_country;
                                } else {
                                    
                                }
                                ?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="customer_type"><?php echo Kohana::lang('shop_app.customer.type'); ?>:<span class="red">*</span></label>
                                <select class="form-control" name="customer_type" required="required" id="customer_type" >
                                    <option value="0">Klient indywidualny</option>
                                    <option value="1">Klient biznesowy</option>
                                </select>
                                <script type="text/javascript">
                                <?php if (!empty($oCustomerDetails->customer_type)) : ?>
                                        $('#customer_type').val("<?php echo $oCustomerDetails->customer_type; ?>");
                                 <?php
                                    endif;
                                ?>
                                </script>
                            </div>
                        </div>
                        <?php if (empty($_SESSION['_customer']['logged_in'])) : ?>
                            <div class="col-sm-12 register-inorder">
                                <div class="form-group options-register checkbox">
                                    <label for="customer_register_inorder">
                                        <input type="checkbox" name="customer_register_inorder"  class="input-checkbox" id="customer_register_inorder" value="1" <?php
                                        if (!empty($_POST['customer_register_inorder']) == '1') {
                                            echo 'checked="checked"';
                                        }
                                        ?> />
                                        Zarejestruj mnie</label>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div id="password-hide">
                            <?php if (empty($_SESSION['_customer']['logged_in'])) : ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customer_password">Hasło:<span class="red">*</span></label>
                                        <input type="password" name="customer_password" class="input-text form-control" id="customer_password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customer_password_repeat">Powtórz hasło:<span class="red">*</span></label>
                                        <input type="password" name="customer_password_repeat" class="input-text form-control" id="customer_password_repeat">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="customer_note"><?php echo Kohana::lang('shop_app.customer.order_notes'); ?>:</label>
                            <textarea cols="30" rows="7" class="form-control" name="customer_note" ><?php
                                if (!empty($_SESSION['__customer_note'])) {
                                    echo $_SESSION['__customer_note'];
                                } else if (!empty($_POST['customer_note'])) {
                                    echo $_POST['customer_note'];
                                }
                                ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div>
    <div id="customer_note" class="row">
        <?php if (!empty($_SESSION['_customer']['logged_in']) && $_SESSION['_customer']['logged_in'] == true) : ?>
            <script>
                $(document).ready(function () {
                    $('.orderform').fadeIn('slow');
                    $('#order_step2 #customer_note .note_checkboxes').fadeIn('slow');
                    $('#order_step2 #customer_note .note_btns .goto_step3').show('slow');
                });
            </script>
            <input type="hidden" name="customer_reg_accept" class="input-checkbox" id="customer_reg_accept" checked="checked" value="confirmed" />
            <input type="hidden" name="customer_reg_accept2" class="input-checkbox" id="customer_privacy_accept" checked="checked" value="confirmed" />
            <?php /* 	 <input type="hidden" name="customer_accept3" class="input-checkbox" id="customer_accept3" value="confirmed" /> */ ?>
        <?php else: ?>
            <div class="col-xs-12 note_checkboxes">
                <div class="checkbox order_accept_reg_nologin">
                    <label>
                        <input type="checkbox" name="customer_reg_accept" class="input-checkbox" id="customer_reg_accept" required="required" value="confirmed" />
                        <?php echo Kohana::lang('shop_app.customer.reg_accept'); ?> 
                        <?php echo html::anchor(Kohana::lang('links.lang') . Kohana::lang('links.regulations'), Kohana::lang('shop_app.regulations'), array("target" => "blank")); ?>
                        <?php echo Kohana::lang('shop_app.customer.and'); ?> <?php echo html::anchor(Kohana::lang('links.lang') . Kohana::lang('links.privacy'), Kohana::lang('shop_app.privacy'), array("target" => "blank")); ?> <span class="red">*</span> 
                    </label>
                </div>
                <div class="checkbox register-user">
                    <label>
                        <input type="checkbox" name="customer_reg_accept2" class="input-checkbox" id="customer_privacy_accept" required="required" value="confirmed" />
                        <?php echo Kohana::lang('shop_app.order.accept_rules2'); ?> (...) <span class="red">*</span>
                        <div id="steps" class="steps">
                            <?php echo Kohana::lang('shop_app.order.accept_rules2_step'); ?>
                        </div>
                    </label>
                </div>
                <span class="red">* -	<?php echo Kohana::lang('shop_app.customer.field_required'); ?></span>
            </div>
        <?php endif; ?>
        <div class="col-xs-12 note_btns">
            <div id="order-sub" class="row">
                <div class="col-xs-6 text-left">
                    <span class="btn btn-big goto_step1">Wstecz</span>
                </div>
                <div class="col-xs-6 text-right">
                    <input type="hidden" name="lang" value="<?php echo $_SESSION['lang']; ?>" />
                    <input type="hidden" name="currency" value="<?php echo currency::GetCurrency(); ?>" />
                    <?php /*    <input type="submit" class="btn" name="confirm_order" id="confirm_order" value="<?php echo Kohana::lang('shop_app.cart.order'); ?>" /> */ ?>
                    <span  class="goto_step3 btn btn-big" ><?php echo Kohana::lang('shop_app.cart.next'); ?></span>
                </div>
            </div>
        </div>
    </div>

</div>