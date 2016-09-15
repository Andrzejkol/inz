<?php echo form::open();
?>


<div id="shopping_cart" class="productform">
    <h2>Podsumowanie</h2>
    <?php
    if (!empty($msg)) {
        echo $msg;
    }
    ?>    
    <div id="your_shopping_cart">
        <div id="items">
            <?php if (!empty($oCartContent) && count($oCartContent) > 0): ?>
                <table>
                    <tr>                         
                        <th width="40%" colspan="2" class="order_img_cnt"><?php echo Kohana::lang('shop_app.product.name'); ?></th>
                        <th width="20%"><?php echo Kohana::lang('shop_app.product.price'); ?></th>     
                        <th width="20%"><?php echo Kohana::lang('shop_app.product.quantity'); ?></th>
                        <th width="20%"><?php echo Kohana::lang('shop_app.product.all'); ?></th>                  
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($oCartContent as $key => $item): ?>
                        <tr>
                            <td class="order_img_cnt">
                                <div class="cart_img">
                                    <?php echo html::image(Product_Model::PRODUCT_IMG_XXMEDIUM . $item['filename']); ?>
                                </div>
                            </td>
                            <td class="product">
                                <span class="nazwa_produktu"><?php
                                    echo html::anchor(Kohana::lang('links.lang') . 'produkt/' . $item['id_product'] . '/' . string::prepareURL($item['product_name']), $item['product_name']);
                                    ?></span>
                                <?php
                                if (!empty($item['attributes']) && count($item['attributes']) > 0) {
                                    echo '<p class="prod-attr">' . implode('/', $item['attributes']) . '</p>';
                                }

                                if (!empty($item['product_text']) && count($item['product_text']) > 0) {
                                    echo '<p class="prod-attr">'.Kohana::lang('product_calc.text').': <br/>' . $item['product_text'] . '</p>';
                                }
                                ?>
                            </td>
                            <td class="price item_title">
                                <span style="display:none;" id="product_price_<?php echo $key; ?>"><?php
                                    $val = shop::ShowAlterCurrency($item['price'], false);
                                    if (!empty($val)) {
                                        echo shop::ShowAlterCurrency($item['price'], false);
                                    } else {
                                        echo $item['price'];
                                    }
                                    ?></span>
                                <span class="price">
                                    <?php echo $item['price']; ?> zł
                                </span> 
                            </td>
                            <td class="count">
                                <?php
                                echo (!empty($_POST['count'][$item['id_product']]) ? ($_POST['count'][$item['id_product']] < 0) ? '0' : ($_POST['count'][$item['id_product']] > 99) ? '99' : $_POST['count'][$item['id_product']]  : $item['count']);
                                ?>      
                            </td>

                            <td class="price item_title">
                                <span class="price"><span id="product_summary_<?php echo $key; ?>">
                                        <?php
                                        if (!empty($val)) {
                                            echo number_format($item['count'] * $val, 2, '.', '');
                                        } else {
                                            echo number_format($item['count'] * $item['price'], 2, '.', '');
                                        }
                                        ?>
                                    </span> zł</span>
                            </td>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                </table>
            <?php else: ?>
                <div class="empty_cart_message">
                    <p class="info"><?php echo Kohana::lang('order.your_cart_is_empty_please_back_to_the_shop'); ?></p>
                </div>
            <?php endif; ?>
        </div>        
    </div>

    <div id="cart-add" class="row">
        <div class="col-sm-6 col-sm-offset-6">
            <?php if (!empty($fTotalPrice)): ?>
                <div class="cost-summary row">
                    <div class="price_all_items">
                        <span class="price_all_items col-sm-6 text-right"><strong><?php echo Kohana::lang('shop_app.cart.price_all_items'); ?>:</strong></span>
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
                    <span class="col-sm-6 text-right"><strong>Sposób dostawy:</strong></span>
                    <div class="col-sm-6">
                        <?php foreach ($oDeliveryOptions as $do): ?>
                            <?php if ((!empty($_POST['delivery_type_id']) && $_POST['delivery_type_id'] == $do->id_delivery_type)): ?>
                                <div class="delivery_option">
                                    <?php
                                    $sv = shop::ShowPriceWithCurrency($do->delivery_price, false);
                                    $_POST['delivery_cost'] = $do->delivery_price;
                                    echo form::label('do_' . $do->id_delivery_type, $do->delivery_type . ': <span class="price">' . $sv . '</span>');
                                    ?>

                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div id="payment_method" class="row">
                    <span class="col-sm-6 text-right"><strong>Sposób płatności:</strong></span>
                    <div class="col-sm-6">
                        <?php foreach ($oPaymentOptions as $po): ?>
                            <?php if ((!empty($_POST['payment_type_id']) && $_POST['payment_type_id'] == $po->id_payment_type)): ?>
                                <div class="delivery_option">
                                    <?php
                                    // TODO: chyba brak tu waluty
                                    if (!empty($po->payment_cost) && $po->payment_cost > 0) {
                                        echo form::label('po_' . $po->id_payment_type, $po->payment_type_name . ': ' . $po->payment_cost) . ' zł';
                                    } else {
                                        echo form::label('po_' . $po->id_payment_type, $po->payment_type_name);
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                            <div class="clear"></div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php echo rebate_codes::BasketRebateInfo(); ?>
                <?php echo rebate_codes::BasketCustomerRebateInfo(); ?>

                <?php if (!empty($fTotalPrice)): ?>
                    <div id="price_with_shipping" class="row">

                        <span class="price_with_shipping col-sm-6 text-right"><strong><?php echo Kohana::lang('shop_app.cart.price_with_shipping'); ?>:</strong></span>
                        <?php
                        if (!empty($_POST['payment_cost'])) {
                            $fTotalPrice = $fTotalPrice + $_POST['payment_cost'];
                        }
                        if (!empty($_POST['delivery_cost'])) {
                            $fTotalPrice = $fTotalPrice + $_POST['delivery_cost'];
                        }
                        if (!empty($_POST['rebate_cost_summary'])) {
                            $fTotalPrice = $fTotalPrice - $_POST['rebate_cost_summary'];
                        }
                        ?>
                        <span class="value col-sm-6">
                            <strong><span id="total_cost"><?php echo shop::ShowPriceWithCurrency($fTotalPrice, false); ?></span></strong>
                        </span>            
                    </div>
                <?php else: ?>
                    <div>
                        <?php echo Kohana::lang('shop_app.cart.your_cart_is_empty_please_back_to_the_shop', html::anchor('', Kohana::lang('shop_app.cart.goto_shop'))); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<div id="shopping_cart" class="orderform shopping_cart_confirm" style="display: block;">
    <div class="content">
        <div id="customer_account"  class="customer-forms" style="padding:0px;">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <?php
            echo form::open();
            ?>
            <div id="customer_delivery_address">
                <div class="site-form" style="text-align:left;">
                    <div class="row">
                        <div class="col-md-3">
                            <?php echo Kohana::lang('shop_app.customer.first_name'); ?>:
                        </div>
                        <div class="col-md-9">
                            <?php
                            if (isset($_POST['customer_first_name'])) {
                                echo $_POST['customer_first_name'];
                            } else if (!empty($_SESSION['_customer']['first_name'])) {
                                echo $_SESSION['_customer']['first_name'];
                            } elseif (!empty($oCustomerDetails->customer_first_name)) {
                                echo $oCustomerDetails->customer_first_name;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?php echo Kohana::lang('shop_app.customer.last_name'); ?>:
                        </div>
                        <div class="col-md-9">
                            <?php
                            if (isset($_POST['customer_last_name'])) {
                                echo $_POST['customer_last_name'];
                            } else if (!empty($_SESSION['_customer']['last_name'])) {
                                echo $_SESSION['_customer']['last_name'];
                            } elseif (!empty($oCustomerDetails->customer_last_name)) {
                                echo $oCustomerDetails->customer_last_name;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?php echo Kohana::lang('shop_app.customer.email'); ?>:
                        </div>
                        <div class="col-md-9">
                            <?php
                            if (isset($_POST['customer_email'])) {
                                echo $_POST['customer_email'];
                            } else if (!empty($_SESSION['_customer']['customer_email'])) {
                                echo $_SESSION['_customer']['customer_email'];
                            } elseif (!empty($oCustomerDetails->customer_email)) {
                                echo $oCustomerDetails->customer_email;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?php echo Kohana::lang('shop_app.customer.phone_no'); ?>:
                        </div>
                        <div class="col-md-9">
                            <?php
                            if (isset($_POST['customer_phoneno'])) {
                                echo $_POST['customer_phoneno'];
                            } else if (!empty($_SESSION['_customer']['customer_phoneno'])) {
                                echo $_SESSION['_customer']['customer_phoneno'];
                            } elseif (!empty($oCustomerDetails->customer_phoneno)) {
                                echo $oCustomerDetails->customer_phoneno;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?php echo Kohana::lang('shop_app.customer.city'); ?>:
                        </div>
                        <div class="col-md-9">
                            <?php
                            if (isset($_POST['customer_city'])) {
                                echo $_POST['customer_city'];
                            } else if (!empty($_SESSION['_customer']['customer_city'])) {
                                echo $_SESSION['_customer']['customer_city'];
                            } elseif (!empty($oCustomerDetails->customer_city)) {
                                echo $oCustomerDetails->customer_city;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?php echo Kohana::lang('shop_app.customer.zip'); ?>:
                        </div>
                        <div class="col-md-9">
                            <?php
                            if (isset($_POST['customer_zip'])) {
                                echo $_POST['customer_zip'];
                            } else if (!empty($_SESSION['_customer']['customer_zip'])) {
                                echo $_SESSION['_customer']['customer_zip'];
                            } elseif (!empty($oCustomerDetails->customer_zip)) {
                                echo $oCustomerDetails->customer_zip;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?php echo Kohana::lang('shop_app.customer.address'); ?>:
                        </div>
                        <div class="col-md-9">
                            <?php
                            if (isset($_POST['customer_address'])) {
                                echo $_POST['customer_address'];
                            } else if (!empty($_SESSION['_customer']['customer_address'])) {
                                echo $_SESSION['_customer']['customer_address'];
                            } elseif (!empty($oCustomerDetails->customer_address)) {
                                echo $oCustomerDetails->customer_address;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?php echo Kohana::lang('shop_app.customer.country'); ?>:
                        </div>
                        <div class="col-md-9">
                            <?php
                            if (isset($_POST['customer_country'])) {
                                echo $_POST['customer_country'];
                            } elseif (!empty($oCustomerDetails->customer_country)) {
                                echo $oCustomerDetails->customer_country;
                            } else {
                                
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row" style="display:block;">
                        <div class="col-md-3">
                            <?php echo Kohana::lang('shop_app.customer.order_notes'); ?>:
                        </div>
                        <div class="col-md-9">
                            <?php
                            if (!empty($_SESSION['__customer_note'])) {
                                echo $_SESSION['__customer_note'];
                            } else if (!empty($_POST['customer_note'])) {
                                echo $_POST['customer_note'];
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row" style="margin-top:10px;">
    <div id="order-sub" class="col-md-6" style="">
        <?php echo html::anchor('zamowienie/koszyk', 'Wróć', array('class' => 'btn')); ?>
    </div>
    <div id="order-sub" class="col-md-6" style="text-align: right;">
        <input type="submit" class="btn" name="confirm_order" id="confirm_order" value="Zamawiam z obowiązkiem zapłaty" />
    </div>
</div>
<?php echo form::close();
?>