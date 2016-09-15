<div id="shopping_cart" class="productform">
    <?php
    if (!empty($msg)) {
        echo $msg;
    }
    ?>    
    <div id="your_shopping_cart">
        <div id="items">
            <?php if (!empty($oCartContent) && count($oCartContent) > 0): ?>
                <div class="row">
                    <div class="col-md-1"><strong><?php echo Kohana::lang('shop_app.cart.delete'); ?></strong></div>                         
                    <div class="col-md-5 order_img_cnt"><strong><?php echo Kohana::lang('shop_app.product.name'); ?></strong></div>
                    <div class="col-md-3"><strong><?php echo Kohana::lang('shop_app.product.quantity'); ?></strong></div>
                    <div class="col-md-3"><strong><?php echo Kohana::lang('shop_app.product.price'); ?></strong></div>          
                </div>
                <?php $i = 1; ?>
                <?php foreach ($oCartContent as $key => $item): ?>
                    <div class="row vertical-align">
                        <div class="col-md-1 item_del"><?php echo html::anchor(Kohana::lang('links.lang') . 'zamowienie/usun/' . $key, ''); ?></div>
                        <div class="col-md-5 order_img_cnt">
                            <div class="row  vertical-align">
                                <div class="col-md-5 cart_img">
                                    <?php echo html::image(Product_Model::PRODUCT_IMG_SMALL . $item['filename']); ?>
                                </div>

                                <div class="col-md-7 product">
                                    <span class="nazwa_produktu"><?php
                                        echo html::anchor(Kohana::lang('links.lang') . 'produkt/' . $item['id_product'] . '/' . string::prepareURL($item['product_name']), $item['product_name']);
                                        ?></span>
                                    <?php
                                    if (!empty($item['attributes']) && count($item['attributes']) > 0) {
                                        echo '<p class="prod-attr">' . implode('/', $item['attributes']) . '</p>';
//                                    echo '</br><span class="prod-attr">';                                    
//                                    $i=1;
//                                    foreach($item['attributes'] as $skey => $atr){
//                                        echo shop::GetAttrGroupName($skey). ': ';
//                                        echo $atr; 
//                                        if(count($item['attributes']) > 1 && count($item['attributes']) > $i){
//                                            echo ' <br /> ';
//                                        }
//                                        $i++;
//                                    }
//                                    echo '</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 count vertical-align">
                            <?php
                            echo form::input(array('name' => 'count[' . $key . ']', 'class' => 'count', 'size' => 3, 'maxlength' => 2, 'id' => 'count_' . $item['id_product'], 'value' => (!empty($_POST['count'][$item['id_product']]) ? ($_POST['count'][$item['id_product']] < 0) ? '0' : ($_POST['count'][$item['id_product']] > 99) ? '99' : $_POST['count'][$item['id_product']]  : $item['count'])));
                            ?>
                            <span style="display:none;" id="product_price_<?php echo $item['id_product']; ?>"><?php
                                $val = shop::ShowAlterCurrency($item['price'], false);
                                if (!empty($val)) {
                                    echo shop::ShowAlterCurrency($item['price'], false);
                                } else {
                                    echo $item['price'];
                                }
                                ?></span>
                        </div>
                        <div class="col-md-3 price item_title vertical-align">
                            <span class="price"><span id="product_summary_<?php echo $item['id_product']; ?>">
                                    <?php
                                    if (!empty($val)) {
                                        echo number_format($item['count'] * $val, 2, '.', '');
                                    } else {
                                        echo number_format($item['count'] * $item['price'], 2, '.', '');
                                    }
                                    ?>
                                </span> <?php echo currency::GetCurrency(); ?></span>
                        </div>  
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="row empty_cart_message">
                    <p class="info col-md-12"><?php echo Kohana::lang('order.your_cart_is_empty_please_back_to_the_shop'); ?></p>
                </div>
            <?php endif; ?>
            <div id="cart-add" class="row">
                <div class="col-sm-6">
                    <?php echo rebate_codes::RebateCodeForm(); ?>
                </div>
                <div class="col-sm-6">
                    <?php if (!empty($fTotalPrice)): ?>
                        <div class="cost-summary row">
                            <div class="price_all_items">
                                <span class="price_all_items col-sm-6 text-right"><strong><?php echo Kohana::lang('shop_app.cart.price_all_items'); ?></strong></span>
                                <span class="value col-sm-6">
                                    <span id="cart_total_recount">
                                        <?php echo shop::ShowPriceWithCurrency($fTotalPrice, false); ?>
                                    </span>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($oCartContent) && count($oCartContent) > 0): ?>
                        <div id="delivery_method" class="row">
                            <span class="col-sm-6 text-right"><strong><?php echo Kohana::lang('shop_app.cart.choose_delivery_method'); ?></strong></span>
                            <div class="col-sm-6">
                                <input type="hidden" name="delivery_type_id" id="delivery_type_id" value="<?php
                                if (!empty($_POST['delivery_type_id'])) {
                                    echo $_POST['delivery_type_id'];
                                } else if (!empty($_SESSION['__delivery_type'])) {
                                    echo $_SESSION['__delivery_type'];
                                }
                                ?>" />

                                <input type="hidden" name="delivery_cost" id="delivery_cost" value="<?php
                                if (!empty($_POST['delivery_cost'])) {
                                    echo $_POST['delivery_cost'];
                                } else if (isset($_SESSION['__delivery_cost'])) {
                                    echo $_SESSION['__delivery_cost'];
                                }
                                ?>" />
                                       <?php foreach ($oDeliveryOptions as $do): ?>
                                    <div class="delivery_option">
                                        <?php echo form::radio(array('name' => 'delivery_options', 'id' => 'do_' . $do->id_delivery_type, 'onchange' => "javascript:SetDeliveyType(this, " . $do->id_delivery_type . ");"), $do->id_delivery_type, ((!empty($_POST['delivery_options']) && $_POST['delivery_options'] == $do->id_delivery_type) ? TRUE : ((!empty($_SESSION['__delivery_type']) && $_SESSION['__delivery_type'] == $do->id_delivery_type && empty($_POST['payment_options'])) ? TRUE : ''))); ?>
                                        <?php
                                        $sv = shop::ShowPriceWithCurrency($do->delivery_price, false);
                                        echo form::label('do_' . $do->id_delivery_type, $do->delivery_type . ': <span class="price">' . $sv . '</span>');
                                        ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div id="payment_method" class="row">
                            <span class="col-sm-6 text-right"><strong><?php echo Kohana::lang('app.choose_payment_method'); ?></strong></span>
                            <div class="col-sm-6">
                                <input type="hidden" name="payment_type_id" id="payment_type_id" value="<?php
                                if (!empty($_POST['payment_type_id'])) {
                                    echo $_POST['payment_type_id'];
                                } else if (!empty($_SESSION['__payment_type'])) {
                                    echo $_SESSION['__payment_type'];
                                }
                                ?>" />
                                <input type="hidden" name="payment_cost" id="payment_cost" value="<?php
                                if (!empty($_POST['payment_cost'])) {
                                    echo $_POST['payment_cost'];
                                } else if (isset($_SESSION['__payment_cost'])) {
                                    echo $_SESSION['__payment_cost'];
                                }
                                ?>" />
                                       <?php foreach ($oPaymentOptions as $po): ?>
                                    <div class="delivery_option">
                                        <?php echo form::radio(array('name' => 'payment_options', 'id' => 'po_' . $po->id_payment_type, 'onchange' => "javascript:SetPaymentType(this, " . $po->id_payment_type . ");"), $po->id_payment_type, ((!empty($_POST['payment_options']) && $_POST['payment_options'] == $po->id_payment_type) ? TRUE : ((!empty($_SESSION['__payment_type']) && $_SESSION['__payment_type'] == $po->id_payment_type && empty($_POST['payment_options'])) ? TRUE : ''))); ?>
                                        <?php
                                        // TODO: chyba brak tu waluty
                                        if (!empty($po->payment_cost) && $po->payment_cost > 0) {
                                            echo form::label('po_' . $po->id_payment_type, $po->payment_type_name . ': ' . $po->payment_cost) . ' zł';
                                        } else {
                                            echo form::label('po_' . $po->id_payment_type, $po->payment_type_name);
                                        }
                                        ?>
                                    </div>
                                    <div class="clear"></div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <?php echo rebate_codes::BasketRebateInfo(); ?>
                        <?php echo rebate_codes::BasketCustomerRebateInfo(); ?>

                        <?php if (!empty($fTotalPrice)): ?>
                            <?php /*
                              <div id="price_all_items">
                              <strong><span class="price_all_items"><?php echo Kohana::lang('app.price_all_items'); ?>:</span></strong>
                              <span class="value"><span id="cart_total_recount"><?php echo number_format($fTotalPrice, 2, '.', ''); ?></span> zł</span>
                              </div> */ ?>


                            <div id="price_with_shipping" class="row">

                                <span class="price_with_shipping col-sm-6 text-right"><?php echo Kohana::lang('shop_app.cart.price_with_shipping'); ?></span>
                                <?php
                                if (!empty($_SESSION['__payment_cost'])) {
                                    $fTotalPrice = $fTotalPrice + $_SESSION['__payment_cost'];
                                }
                                if (!empty($_SESSION['__delivery_cost'])) {
                                    $fTotalPrice = $fTotalPrice + $_SESSION['__delivery_cost'];
                                }
                                if (!empty($_SESSION['__rebate_cost_summary'])) {
                                    $fTotalPrice = $fTotalPrice - $_SESSION['__rebate_cost_summary'];
                                }
                                ?>
                                <span class="value col-sm-6">
                                    <strong><span id="total_cost"><?php echo shop::ShowPriceWithCurrency($fTotalPrice, false); ?></span></strong>
                                </span>            
                            </div>
                            <div class="row">
                                <span class="col-sm-6">
                                    <span class="back"><a class="btn btn-default" href="<?php echo $_SESSION['referer']; ?>"><?php echo Kohana::lang('shop_app.cart.continue_shopping'); ?></a></span>
                                </span>
                                <span class="col-sm-6">
                                    <input type="submit" name="recount" id="recount-order" class="btn" value="<?php echo Kohana::lang('shop_app.cart.recount'); ?>" />
                                </span>
                            </div>  
                            <?php /*
                              <div id="options">
                              <div id="go_back" style="text-align: left;">
                              <span class="back"><a href="<?php echo $_SESSION['referer']; ?>"><?php echo Kohana::lang('app.continue_shopping'); ?></a></span>
                              </div>
                              ?>
                              -            <div id="go_next">
                              <input type="submit" name="to_step_two" id="submit" class="submit" value="<?php //echo Kohana::lang('app.delivery_address') . '&nbsp;&nbsp;&raquo;'; ?>" style="background: none;" />
                              </div>
                              <div class="clear"></div>
                              </div>
                             * *
                             */ ?>
                        <?php else: ?>
                            <div>
                                <?php echo Kohana::lang('shop_app.cart.your_cart_is_empty_please_back_to_the_shop', html::anchor('', Kohana::lang('shop_app.cart.goto_shop'))); ?>
                            </div>
                        <?php endif; ?>
                    </div>


                <?php endif; ?>
                <?php //echo form::close();    ?>
            </div>

        </div>        
    </div>
</div>
<div id="login-options" class="row">                    
    <?php if (empty($_SESSION['_customer']['logged_in'])) { ?>
        <div class="col-md-4">
            <span id="basket-login" class="black-btn logbutton"><?php echo Kohana::lang('shop_app.customer.login'); ?></span>
        </div>
        <div class="col-md-4">
            <span>
                <?php /* <input type="checkbox" name="customer_register_inorder" class="input-checkbox" style="display:none;" id="customer_register_inorder" value="1" <?php if (!empty($_POST['customer_register_inorder']) == '1') {
                  echo 'checked="checked"';
                  } ?> /> */ ?>
                <label for="customer_register_inorder" class="btn"><?php echo Kohana::lang('shop_app.customer.registerandorder'); ?></label>
            </span>
        </div>
        <div class="col-md-4">
            <span id="no-login" class="btn"><?php echo Kohana::lang('shop_app.customer.ordernoregister'); ?></span>
        </div>
    <?php } else {
        ?>
        <div class="col-md-12">
            <span id="no-login" class="btn"><?php echo Kohana::lang('shop_app.cart.order'); ?></span>
        </div>
    <?php } ?>
</div>