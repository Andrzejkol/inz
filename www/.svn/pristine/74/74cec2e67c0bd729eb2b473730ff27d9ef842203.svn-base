<div id="order_step1">
    <div id="shopping_cart" class="productform step_1">
        <div id="your_shopping_cart">
            <div id="items">
                <div class="cart-tab">

                    <span id="current_currency" class="hidden"><?php echo currency::GetCurrency(); ?></span>
                    <div class="row cart-header">                      
                        <div class="col-sm-5 order_img_cnt"><strong><?php echo Kohana::lang('shop_app.product.product'); ?></strong></div>
                        <div class="col-sm-2"><strong><?php echo Kohana::lang('shop_app.product.price'); ?></strong></div>
                        <div class="col-sm-3"><strong><?php echo Kohana::lang('shop_app.product.quantity'); ?></strong></div>
                        <div class="col-sm-2"><strong><?php echo Kohana::lang('shop_app.product.all_price'); ?></strong></div>          
                    </div>
                    <?php $i = 1; ?>
                    <?php foreach ($oCartContent as $key => $item): ?>
                        <div class="row cart-item">

                            <div class="col-sm-5 order_img_cnt">
                                <div class="cart_img">
                                    <div class="cart_img_wrapper">
                                        <?php echo html::image(shop::XSMALL_PATH . $item['filename']); ?>
                                    </div>
                                </div>

                                <div class="product-name">
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
                                    if (!empty($item['settings']) && count($item['settings']) > 0) {
                                        echo '<p class="prod-attr">' . $item['settings'] . '</p>';
                                    }
                                    if (!empty($item['product_text']) && count($item['product_text']) > 0) {
                                        echo '<p class="prod-attr">Tekst: <br/>' . $item['product_text'] . '</p>';
                                    }
                                    ?>
                                </div>
                                <?php /*   </div>
                                  </div> */ ?>
                            </div>

                            <div class="col-sm-2 price item_title">
                                <span class="price">
                                    <?php $item['product_attitude_price'] = (!empty($item['product_attitude_price']) ? $item['product_attitude_price'] : 0); ?>
                                    <?php $Price = $item['price']; ?> 
                                    <?php
                                    if (isset($_SESSION['_customer']['customer_type'])) {
                                        if ($_SESSION['_customer']['customer_type'] == '0') {
                                            echo $Price . ' zł';
                                        } else {
                                            echo number_format(($Price) / 1.23, 2, ',', '') . 'zł + 23% VAT';
                                        }
                                    } else {
                                      echo shop::Price($Price, currency::GetCurrency()); 
                                    }
                                    // echo shop::Price($Price, currency::GetCurrency()); 
                                    ?> 

                                </span> 
                            </div>  <?php echo html::anchor(Kohana::lang('links.lang') . 'zamowienie/usun/' . $key, ''); ?>
                            <div class="col-sm-3 count"><span class="mobile-only">Ilość: </span>
                                <?php
                                echo form::input(array('name' => 'count[' . $key . ']', 'class' => 'count', 'size' => 3, 'maxlength' => 2, 'id' => 'count_' . $key, 'value' => (!empty($_POST['count'][$item['id_product']]) ? ($_POST['count'][$item['id_product']] < 0) ? '0' : ($_POST['count'][$item['id_product']] > 99) ? '99' : $_POST['count'][$item['id_product']]  : $item['count'])));
                                ?>
                                <span class="moreless"><?php echo html::image('img/pm.png', array('usemap' => '#map_' . $key)) ?></span>
                                <map name="map_<?php echo $key; ?>" id="map_<?php echo $key; ?>">
                                    <area shape="rect" coords="0,0,14,12"  alt="more" href="javascript:more2('<?php echo $key; ?>');">
                                    <area shape="rect" coords="14,0,28,12" alt="less" href="javascript:less2('<?php echo $key; ?>');">
                                </map>
                                <span style="display:none;" id="product_price_<?php echo $key; ?>"><?php
                                    $val = shop::ShowAlterCurrency($item['price'], false);

                                    if (!empty($val)) {
                                        echo shop::ShowAlterCurrency($item['price'], false);
                                    } else {
                                        echo $item['price'];
                                    }
                                    ?></span>
                            </div>
                            <div class="col-sm-2 price_all"><span class="mobile-only">Cena: </span>
                                <span class="price"><span id="product_summary_<?php echo $key; ?>">
                                        <?php
                                        $item['product_attitude_price'] = (!empty($item['product_attitude_price']) ? $item['product_attitude_price'] : 0);
                                        if (!empty($val)) {
                                            echo number_format(($item['count'] * $val) + $item['product_attitude_price'], 2, '.', '');
                                        } else {
                                            echo number_format(($item['count'] * $item['price']) + $item['product_attitude_price'], 2, '.', '');
                                        }
                                        ?>
                                    </span> <?php echo currency::GetCurrency(); ?></span>
                                        <?php echo html::anchor(Kohana::lang('links.lang') . 'zamowienie/usun/' . $key, html::image('img/xdel.png'), array('class' => 'item_del')); ?>
                            </div>
                            <input type="hidden" value="<?php echo $item['product_attitude_price']; ?>" id="product_attitude_price_<?php echo $key; ?>" />
                        </div>

    <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
                <div id="cart-add" class="row">
                    <div class="col-md-4 col-sm-4">
                        <div id="delivery_method" class="row">
                            <div class="col-sm-12 cart-add-top"><strong><?php echo Kohana::lang('shop_app.cart.choose_delivery_method'); ?></strong></div>
                            <div class="col-sm-12">
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
                                           <?php echo form::radio(array('name' => 'delivery_options', 'price' => $do->delivery_price, 'text' => $do->delivery_type, 'id' => 'do_' . $do->id_delivery_type, 'onchange' => "javascript:SetDeliveyType(this, " . $do->id_delivery_type . ");"), $do->id_delivery_type, ((!empty($_POST['delivery_options']) && $_POST['delivery_options'] == $do->id_delivery_type) ? TRUE : ((!empty($_SESSION['__delivery_type']) && $_SESSION['__delivery_type'] == $do->id_delivery_type && empty($_POST['payment_options'])) ? TRUE : ''))); ?>
                                        <?php
                                        $sv = shop::ShowPriceWithCurrency($do->delivery_price, false);
                                        echo form::label(array('for' => 'do_' . $do->id_delivery_type, 'class' => string::prepareURL($do->delivery_type)), $do->delivery_type . ': <span class="price">' . $sv . '</span>');
                                        ?>
                                    </div>
                                    <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div id="payment_method" class="row">
                            <div class="col-sm-12 cart-add-top"><strong><?php echo Kohana::lang('app.choose_payment_method'); ?></strong></div>
                            <div class="col-sm-12">
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
                                    <div class="payment_option">
                                           <?php echo form::radio(array('name' => 'payment_options', 'id' => 'po_' . $po->id_payment_type, 'onchange' => "javascript:SetPaymentType(this, " . $po->id_payment_type . ");"), $po->id_payment_type, ((!empty($_POST['payment_options']) && $_POST['payment_options'] == $po->id_payment_type) ? TRUE : ((!empty($_SESSION['__payment_type']) && $_SESSION['__payment_type'] == $po->id_payment_type && empty($_POST['payment_options'])) ? TRUE : ''))); ?>
                                        <?php
                                        // TODO: chyba brak tu waluty
                                        if (!empty($po->payment_cost) && $po->payment_cost > 0) {
                                            echo form::label('po_' . $po->id_payment_type, $po->payment_type_name . ': ' . $po->payment_cost) . ' zł';
                                        } else {
                                            echo form::label(array('for' => 'po_' . $po->id_payment_type, 'class' => string::prepareURL($po->payment_type_name)), $po->payment_type_name);
                                        }
                                        ?>
                                    </div>
                                    <div class="clear"></div>
<?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div id="rebate_form" class="row">
                            <div class="col-sm-12 cart-add-top"><strong><?php echo Kohana::lang('rebate_codes.rebate_code'); ?></strong></div>
                            <div class="">
<?php echo rebate_codes::RebateCodeForm(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row order-cost">

                    <div class="col-sm-4 col-xs-12">
                        <div id="protection">
                            <div class="col-sm-12 cart-add-top"><strong>Ubezpieczenie</strong></div>
                            <div class="col-sm-12 text-left">
                                <label>
                                    <input type="checkbox" name="protection"/>
                                    Ubezpieczenie urządzenia </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-9 col-lg-6 col-md-9 col-xs-12 pull-right">
<?php if (!empty($fTotalPrice)): ?>
                            <div class="cost-summary row">
                                <div class="price_all_items">
                                    <span class="price_all_items col-sm-8 col-xs-7 text-right"><?php echo Kohana::lang('order.order_value'); ?></span>
                                    <span class="value col-sm-4 col-xs-5">
                                        <span id="cart_total_recount">
    <?php echo number_format($fTotalPrice, 2, '.', ''); ?>
                                        </span> <?php echo currency::GetCurrency(); ?>
                                    </span>
                                </div>
                            </div>
<?php endif; ?>
                        <?php echo rebate_codes::BasketRebateInfo(); ?>
                        <?php echo rebate_codes::BasketCustomerRebateInfo(); ?>
                        <div class="cost-summary row">
                            <div class="delivery_type">
                                <span class="col-sm-8 col-xs-7 text-right"><?php echo Kohana::lang('order.transport_type'); ?></span>
                                <span class="value col-sm-4 col-xs-5">
                                    <span>

                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="cost-summary row">
                            <div class="delivery_cost">
                                <span class="col-sm-8 col-xs-7 text-right"><?php echo Kohana::lang('order.transport_cost'); ?></span>
                                <span class="value col-sm-4 col-xs-5">
                                    <span>

                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="cost-summary row">
                            <div class="payment_type">
                                <span class="col-sm-8 col-xs-7 text-right"><?php echo Kohana::lang('order.payment_type'); ?>:</span>
                                <span class="value col-sm-4 col-xs-5">
                                    <span>

                                    </span>
                                </span>
                            </div>
                        </div>
<?php if (!empty($fTotalPrice)): ?>
                            <?php /*
                              <div id="price_all_items">
                              <strong><span class="price_all_items"><?php echo Kohana::lang('app.price_all_items'); ?>:</span></strong>
                              <span class="value"><span id="cart_total_recount"><?php echo number_format($fTotalPrice, 2, '.', ''); ?></span> zł</span>
                              </div> */ ?>
                            <div id="price_with_shipping" class="row">

                                <span class="price_with_shipping col-sm-8 col-xs-7 text-right"><?php echo Kohana::lang('order.order_total_cost'); ?></span>
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
                                <span class="value col-sm-4 col-xs-5">
                                    <span id="total_cost"><?php echo number_format($fTotalPrice, 2, '.', ''); ?></span> <?php echo currency::GetCurrency(); ?>
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
                        <?php endif; ?>
                    </div>

                </div>
<?php if (shop_config::getConfig('one_step_order') == 0): ?>
                    <div class="row buttons">
                        <div class="col-xs-6">
                            <span class="back"><a class="btn btn-gray btn-big" href="<?php echo $_SESSION['referer']; ?>"><?php echo Kohana::lang('shop_app.cart.continue_shopping'); ?></a></span>
                        </div>
                        <div class="col-xs-6 text-right">
    <?php /* ?> <input type="submit" name="recount" id="recount-order" class="btn" value="<?php echo Kohana::lang('shop_app.cart.recount'); ?>" /> <?php */ ?>
                            <span class="goto_step2 btn btn-big"><?php echo Kohana::lang('shop_app.cart.next'); ?> &raquo;</span>
                        </div>
                    </div>
<?php endif; ?>
            </div>        
        </div>
    </div>
</div>