<div id="shopping_cart" class="orderform">
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_first_name"><?php echo Kohana::lang('shop_app.customer.first_name'); ?>:<span class="red">*</span></label>
                        <input type="text" class="form-control" name="customer_first_name" id="customer_first_name" value="<?php
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_last_name"><?php echo Kohana::lang('shop_app.customer.last_name'); ?>:<span class="red">*</span></label>
                        <input type="text" class="form-control" name="customer_last_name" id="customer_last_name" value="<?php
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_email"><?php echo Kohana::lang('shop_app.customer.email'); ?>:<span class="red">*</span></label>
                        <input type="text" class="form-control" name="customer_email" id="customer_email" value="<?php
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_phoneno"><?php echo Kohana::lang('shop_app.customer.phone_no'); ?>:<span class="red">*</span></label>
                        <input type="text" class="form-control" name="customer_phoneno" id="customer_phoneno" value="<?php
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_city"><?php echo Kohana::lang('shop_app.customer.city'); ?>:<span class="red">*</span></label>
                        <input type="text" class="form-control" name="customer_city" id="customer_city" value="<?php
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_zip"><?php echo Kohana::lang('shop_app.customer.zip'); ?>:<span class="red">*</span></label>
                        <input type="text" class="form-control" name="customer_zip" id="customer_zip" value="<?php
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




                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_address"><?php echo Kohana::lang('shop_app.customer.address'); ?>:<span class="red">*</span></label>
                        <input type="text" class="form-control" name="customer_address" id="customer_address" value="<?php
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
                <div class="col-md-6">
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
                <?php if (empty($_SESSION['_customer']['logged_in'])) : ?>
                    <div class="col-md-6 col-md-offset-6 register-inorder">
                        <div class="form-group options-register checkbox">
                            <label for="customer_register_inorder">
                                <input type="checkbox" name="customer_register_inorder" class="input-checkbox" id="customer_register_inorder" value="1" <?php
                                if (!empty($_POST['customer_register_inorder']) == '1') {
                                    echo 'checked="checked"';
                                }
                                ?> />
                                Zarejestruj mnie</label>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (empty($_SESSION['_customer']['logged_in'])) : ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer_password">Hasło:<span class="red">*</span></label>
                            <input type="password" name="customer_password" class="input-text form-control" id="customer_password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer_password_repeat">Powtórz hasło:<span class="red">*</span></label>
                            <input type="password" name="customer_password_repeat" class="input-text form-control" id="customer_password_repeat">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-md-6">
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