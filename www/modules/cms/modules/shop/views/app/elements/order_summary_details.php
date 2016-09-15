<?php
if (!empty($oOrder)) :
    if (isset($bFromEmail))
        echo '<div id="orderSummary" class="orderfromemail">';
    ?>

    <div id="shopping_cart" class="final">
        <h3 class="title"><?php echo Kohana::lang('shop_app.summary.order'); ?></h3>
        <div id="items">
            <?php if (!empty($oOrderProducts) && count($oOrderProducts) > 0): ?>
                <div class="cart-tab">
                    <div class="row cart-header">                      
                        <div class="col-sm-6 col-xs-4 order_img_cnt"><strong><?php echo Kohana::lang('shop_app.product.product'); ?></strong></div>
                        <div class="col-sm-2 hidden-xs text-center"><strong><?php echo Kohana::lang('shop_app.product.price'); ?></strong></div>
                        <div class="col-sm-2 col-xs-4 text-center"><strong><?php echo Kohana::lang('shop_app.product.quantity'); ?></strong></div>
                        <div class="col-sm-2 col-xs-4 text-center"><strong><?php echo Kohana::lang('shop_app.product.all_price'); ?></strong></div>          
                    </div>


                    <?php $i = 1; ?>
                    <?php foreach ($oOrderProducts as $item):
                        ?>
                        <div class="row cart-item">   
                            <div class="col-sm-6">
                                    <div class="cart_img">
                                        <div class="cart_img_wrapper">
                                            <?php echo html::image(shop::XSMALL_PATH . $item->filename); ?>
                                        </div>
                                    </div>
                                <div class="product-name">
                                    <span class="nazwa_produktu"><?php
                                        echo html::anchor(Kohana::lang('links.lang') . 'produkt/' . $item->product_id . '/' . string::prepareURL($item->product_name), $item->product_name);
                                        
                                        if(!empty($item->order_product_id)) {
                                            Voucher_Model::VoucherInfo($item->order_product_id);
                                        }
                                        ?>
                                    </span>
                                    <?php
                                    if (!empty($item->product_attributes) && count($item->product_attributes) > 0) {
                                        $aAttrs = explode(';', $item->product_attributes);

                                        echo '<p class="prod-attr">(';
                                        foreach ($aAttrs as $aA) {
                                            $aAttrValue = explode(':', $aA);
                                            echo $aAttrValue[1];
                                        }
                                        echo ')</p>';
                                    }
                                    if (!empty($item->product_settings)) {
                                        echo '<p class="prod-attr">' . $item->product_settings . '</p>';
                                    }
                                    if (!empty($item->product_text)) {
                                        echo '<p class="prod-attr">' . $item->product_text . '</p>';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="col-sm-2 col-xs-1 text-center price item_title"><?php echo shop::Price($item->product_price, $oOrder->currency) ?></div>
                            <div class="col-sm-2 col-xs-2 text-center count"><span class="mobile-only">Ilość: </span><?php echo $item->product_count; ?></div>
                            <?php /* ?> <td class="count"><?php echo $item->product_rebate + 0; ?>%</td> <?php */ ?>
                            <div class="col-sm-2 col-xs-5 text-center price_all">
                                <span class="price">
                                    <span class="mobile-only">Cena: </span>
                                    <?php $Price = (((float) $item->product_price - ((((float) $item->product_rebate + 0) / 100) * $item->product_price)) * (int) $item->product_count); ?>
                                    <?php echo shop::Price($Price, $oOrder->currency); ?>
                                </span> 
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>        
    </div>
    <div class="login-content row">
        <div class="customer-info col-sm-6">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title">
                        <?php echo Kohana::lang('shop_app.summary.summary'); ?>
                    </h3>
                </div>
                <div class="col-xs-6 text-bold"><?php echo Kohana::lang('shop_app.customer.first_name'); ?>:</div>
                <div class="col-xs-6"><?php echo $oOrder->customer_first_name; ?></div>

                <div class="col-xs-6 text-bold"><?php echo Kohana::lang('shop_app.customer.last_name'); ?>:</div>
                <div class="col-xs-6"><?php echo $oOrder->customer_last_name; ?></div>

                <div class="col-xs-6 text-bold"><?php echo Kohana::lang('shop_app.customer.email'); ?>:</div>
                <div class="col-xs-6"><?php echo $oOrder->customer_email; ?></div>

                <div class="col-xs-6 text-bold"><?php echo Kohana::lang('shop_app.summary.orderno'); ?>:</div>
                <div class="col-xs-6"><?php echo $oOrder->order_number ?></div>

                <div class="col-xs-6 text-bold"><?php echo Kohana::lang('shop_app.summary.orderdate'); ?>:</div>
                <div class="col-xs-6"><?php printf("%02d-%02d-%04d", $oOrder->current_number_day, $oOrder->current_number_month, $oOrder->current_number_year); ?></div>
                 <div class="col-xs-6 text-bold"><?php echo Kohana::lang('shop_app.summary.protection'); ?>:</div>
                <div class="col-xs-6"><?php echo $oOrder->protection=='1'?'Tak':'Nie'; ?></div>
            </div>
        </div>
        <div class="customer_login delivery-address col-sm-6">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title">
                        <?php echo Kohana::lang('shop_app.summary.deliveryaddress'); ?>
                    </h3>
                </div>
                <div class="col-xs-6 text-bold"><?php echo Kohana::lang('shop_app.customer.first_name'); ?>:</div>
                <div class="col-xs-6"><?php echo $oOrder->customer_first_name; ?></div>

                <div class="col-xs-6 text-bold"><?php echo Kohana::lang('shop_app.customer.last_name'); ?>:</div>
                <div class="col-xs-6"><?php echo $oOrder->customer_last_name; ?></div>

                <div class="col-xs-6 text-bold"><?php echo Kohana::lang('shop_app.customer.adres'); ?>:</div>
                <div class="col-xs-6"><?php echo $oOrder->customer_address; ?></div>

                <div class="col-xs-6 text-bold"><?php echo Kohana::lang('shop_app.customer.city'); ?>:</div>
                <div class="col-xs-6"><?php echo $oOrder->customer_city; ?></div>

                <div class="col-xs-6 text-bold"><?php echo Kohana::lang('shop_app.customer.postcode'); ?>:</div>
                <div class="col-xs-6"><?php echo $oOrder->customer_zip; ?></div>

                <div class="col-xs-6 text-bold"><?php echo Kohana::lang('shop_app.customer.phone_no'); ?>:</div>
                <div class="col-xs-6"><?php echo $oOrder->customer_phoneno ?></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="row">
        <div class="order_summary_delivery delivery col-sm-6">
            <h3 class="title"><?php echo Kohana::lang('shop_app.summary.delivery-method'); ?></h3>
            <p><?php echo $oOrder->delivery_type . ' - ' . $oOrder->delivery_cost; ?> zł</p>
        </div>
        <?php if (!empty($oOrder->payment_type)): ?>
            <div class="order_summary_delivery payment col-sm-6">
                <h3 class="title"><?php echo Kohana::lang('shop_app.summary.payment-method'); ?></h3>
                <?php if (!empty($oOrder->payment_cost) && $oOrder->payment_cost > 0): ?>
                    <p><?php echo $oOrder->payment_type_name . ' - ' . $oOrder->payment_cost; ?> <?php echo $oOrder->currency; ?></p>
                <?php else: ?>
                    <p><?php echo $oOrder->payment_type_name; ?></p>
                <?php endif; ?>
            </div>
            <?php if (!empty($sPaymentInfo)): ?>
                <div class="order_summary_delivery bank col-sm-6">
                    <h3 class="title"><?php echo Kohana::lang('shop_app.summary.payment-method-info'); ?></h3>
                    <p class="payment"><?php echo $sPaymentInfo; ?></p>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="order_summary_delivery ordervalue col-sm-6">
            <h3 class="title"><?php echo Kohana::lang('shop_app.summary.ordercost'); ?></h3>
            <p><?php echo Kohana::lang('shop_app.summary.totalcost') . ' - ' . $oOrder->products_cost; ?> <?php echo $oOrder->currency; ?></p>
            <p><?php echo Kohana::lang('shop_app.summary.overalcost') . ' - ' . $oOrder->order_cost; ?> <?php echo $oOrder->currency; ?></p>
        </div>
    </div>
    <?php
    if (isset($bFromEmail))
        echo '</div>';

endif;
?>

