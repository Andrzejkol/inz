<div id="orderSummary"  class="login-content">
    <h3><?php echo Kohana::lang('order.transaction_detail'); ?></h3>
	<div class="order_details_content">
    <?php if (!empty($oOrder)) : ?>
		
        <p style="font-size: 13px; font-weight: bold; color: #929292; padding-bottom: 15px;">
            <?php echo Kohana::lang('order.summary.summary'); ?>:
        </p>
		<?php // var_dump($oOrder); ?>
        <p><strong><?php echo Kohana::lang('order.summary.orderno'); ?>:</strong> <?php echo $oOrder->order_number ?></p>
        <p><strong><?php echo Kohana::lang('order.summary.orderdate'); ?>:</strong> <?php printf("%02d-%02d-%04d", $oOrder->current_number_day, $oOrder->current_number_month, $oOrder->current_number_year); ?></p>
		<p><strong><?php echo Kohana::lang('order.order_status'); ?>:</strong> <span style="font-weight: bold; color: #929292;"><?php echo Kohana::lang('order.order_status'.$oOrder->id_order_status); ?><span></p>
		
        <p style="margin-top: 15px;"><strong><?php echo Kohana::lang('order.summary.clientdetails'); ?>:</strong> <br />
            <?php echo $oOrder->customer_first_name . ' ' . $oOrder->customer_last_name . '<br />' . $oOrder->customer_address . '<br />' . $oOrder->customer_zip . ' ' . $oOrder->customer_city . '<br />' . $oOrder->customer_phoneno . '<br />' . $oOrder->customer_faxno; ?>
        </p>
        <p style="margin-top: 15px;"><strong><?php echo Kohana::lang('order.summary.deliveryaddress'); ?>:</strong><br />
            <?php
            if ($oOrder->delivery == 'Y') {
                echo $oOrder->delivery_first_name . ' ' . $oOrder->delivery_last_name . '<br />' . $oOrder->delivery_address . '<br />' . $oOrder->delivery_zip . ' ' . $oOrder->delivery_city . '<br /' . $oOrder->delivery_phoneno . '<br />' . $oOrder->delivery_faxno;
            } else {
                echo $oOrder->customer_first_name . ' ' . $oOrder->customer_last_name . '<br />' . $oOrder->customer_address . '<br />' . $oOrder->customer_zip . ' ' . $oOrder->customer_city . '<br />' . $oOrder->customer_phoneno . '<br />' . $oOrder->customer_faxno;
            }
            ?>
        </p>
        <?php if ($oOrder->invoice == 'Y') : ?>
		
		
            <p><strong>Dane do faktury:</strong><br />
                <?php echo $oOrder->invoice_first_name . ' ' . $oOrder->invoice_last_name . '<br />' . $oOrder->invoice_address . '<br />' . $oOrder->invoice_zip . ' ' . $oOrder->invoice_city . '<br />' . $oOrder->invoice_phoneno . '<br />' . $oOrder->invoice_faxno; ?>
            </p>
        <?php endif; ?>
        <p style="margin-top: 15px;"><strong><?php echo Kohana::lang('order.summary.delivery'); ?>:</strong> <?php echo $oOrder->delivery_type ?></p>
        <p>
            <strong><?php echo Kohana::lang('order.summary.deliverycost'); ?>:</strong> <?php echo (!empty($oOrder->delivery_cost)) ? $oOrder->delivery_cost : '' ?> zł
        </p>
        <p><strong><?php echo Kohana::lang('order.summary.totalcost'); ?>:</strong> <?php echo $oOrder->products_cost ?> zł</p>
        <?php if (!empty($oOrder->customer_rebate) && $oOrder->customer_rebate != 0) : ?>
            <p>
                <strong>Rabat:</strong> <strong style="font-size: 110%;"><?php echo $oOrder->customer_rebate; ?> %</strong> 
            </p>
        <?php endif; ?>
        <p>
            <strong><?php echo Kohana::lang('order.summary.overalcost'); ?>:</strong> <span style="font-size: 110%;"><?php echo (!empty($oOrder->order_cost)) ? $oOrder->order_cost : '' ?> zł</span> 
        </p>
    <?php endif; ?>


    <div class="content">
        <?php if (!empty($oOrderProducts) && $oOrderProducts->count() > 0): ?>
        
        
        
        
            <div id="your_shopping_cart">

                <div id="items">
                    <table>
                    <tr>    
                        <th width="25%"></th>
                        <th width="35%" style="text-align: left;"><?php echo Kohana::lang('product.product'); ?></th>
                        <th width="15%"><?php echo Kohana::lang('app.quantity'); ?></th>
                        <th width="20%"><?php echo Kohana::lang('app.price'); ?></th>
                        <th width="5%"><?php echo Kohana::lang('app.delete'); ?></th> 
                    </tr>                  
                    
                    <?php foreach ($oOrderProducts as $oProduct): 
//     var_dump($oOrderProducts);
//                    exit;
                        ?>
                    <tr>                    
                            <td>
                                <div class="cart_img">
        <?php echo html::image(Product_Model::PRODUCT_IMG_SMALL . $oProduct->filename); ?>
                                </div>
                            </td>
                            <td class="product">
                                <span class="nazwa_produktu"><?php
        echo $oProduct->product_name;        
        ?></span>
                                <?php 
//                                if(!empty($item['attributes']) && count($item['attributes']) > 0) {
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
//                                }
                                ?>

                            </td>
                            <td class="price_per_item">
                            <?php echo number_format($oProduct->product_price, 2, '.', ''); ?> zł
                            </td>
                            <td class="count">
        <?php
        echo $oProduct->product_count;
        ?>                        
                            </td>

                        
                        <td class="price item_title">
                            <?php echo number_format($oProduct->product_count * $oProduct->product_price, 2, '.', ''); ?> zł
                        </td>
                        

                        </tr>
                    
                    
                    
                    
                    
                    
                        
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
		
			<?php  if(empty($_GET['confirm_string'])){ ?>
    <div id="options">
        <div id="go_back" >
          <span class="back button_arrow" style="color: #929292; font-size: 17px;">  <?php echo Kohana::lang('app.back'); ?></span>
        </div>
        <div class="clear"></div>
    </div>
		<?php } ?>
    <?php echo form::close(); ?>
	</div>
</div>
<div class="clear"></div>
