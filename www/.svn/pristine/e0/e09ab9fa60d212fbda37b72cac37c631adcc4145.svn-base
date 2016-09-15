<?php
if(!empty($oOrder->_aOrderCustomer['lang'])) {
    Kohana::config_set('locale.language', $oOrder->_aOrderCustomer['lang']);
}
?>
<p style="font-weight: bold; font-size:16px;"><?php echo Kohana::lang('shop_app.email.hello');?></p>
<p><?php echo Kohana::lang('shop_app.email.to');?>: <?php echo (!empty($oOrder->_aOrderCustomer)) ? $oOrder->_aOrderCustomer['customer_first_name'] . ' ' . $oOrder->_aOrderCustomer['customer_last_name'] . ' (' . $oOrder->_aOrderCustomer['customer_email'] . ')' : '' ?></p>

<p><?php echo Kohana::lang('shop_app.email.orderstatus');?>:<strong> <?php echo string::uppercase($oOrder->_aStatus['status']) ?></strong></p>
<p><?php echo Kohana::lang('shop_app.email.link_to_order');?>:<strong> <?php echo 'http://'.$_SERVER['HTTP_HOST'].url::base().Kohana::lang('links.lang').'szczegoly_zamowienia/' . $oOrder->_iOrderId . '?confirm_string=' . $oOrder->_sConfirmString; ?> </strong></p>

	<?php if(!empty($orderComments)){ echo '<p>'.Kohana::lang('shop_app.order.comments_edit') . $orderComments.'</p>'; } ?>

<p><?php echo Kohana::lang('shop_app.summary.orderno');?>:<strong> <?php echo $oOrder->_aOrderCustomer['order_number'] ?></strong></p>
<p><?php echo Kohana::lang('shop_app.summary.orderdate');?>:<strong> <?php echo date(config::DATE_FORMAT, $oOrder->_iOrderDate + 0) ?></strong></p>

<?php if (!empty($bUserAddress) && $bUserAddress == true) : ?>
	<p style="margin-top: 15px; font-weight: bold;"><?php echo Kohana::lang('shop_app.summary.clientdetails');?>: <br />
        </p>
        <p>
			<?php echo $oOrder->_aOrderCustomer['customer_first_name'] . ' ' . $oOrder->_aOrderCustomer['customer_last_name'] . '<br />' . $oOrder->_aOrderCustomer['customer_address'] . '<br />' . $oOrder->_aOrderCustomer['customer_zip'] . ' ' . $oOrder->_aOrderCustomer['customer_city'] . '<br />' . $oOrder->_aOrderCustomer['customer_phoneno'] . '<br />' . $oOrder->_aOrderCustomer['customer_faxno']; ?>
	</p>
<?php endif; ?>
<?php if (!empty($bDeliveryAddress) && $bDeliveryAddress == true) : ?>
	<p style="margin-top: 15px; font-weight: bold;"><?php echo Kohana::lang('shop_app.summary.deliveryaddress');?>:<br /> </p>
        <p>
		<?php if ($oOrder->_aOrderCustomer['delivery'] == 'Y') {
			echo $oOrder->_aOrderCustomer['delivery_company_name'] . '<br />' .$oOrder->_aOrderCustomer['delivery_first_name'] . ' ' . $oOrder->_aOrderCustomer['delivery_last_name'] . '<br />' . $oOrder->_aOrderCustomer['delivery_address'] . '<br />' . $oOrder->_aOrderCustomer['delivery_zip'] . ' ' . $oOrder->_aOrderCustomer['delivery_city'] . '<br />' . $oOrder->_aOrderCustomer['delivery_phoneno'] . '<br />' . /*$oOrder->_aOrderCustomer['delivery_faxno'] . '<br />' .*/ $oOrder->_aOrderCustomer['delivery_country'];
		} else {
			echo $oOrder->_aOrderCustomer['customer_first_name'] . ' ' . $oOrder->_aOrderCustomer['customer_last_name'] . '<br />' . $oOrder->_aOrderCustomer['customer_address'] . '<br />' . $oOrder->_aOrderCustomer['customer_zip'] . ' ' . $oOrder->_aOrderCustomer['customer_city'] . '<br />' . $oOrder->_aOrderCustomer['customer_phoneno'] . '<br />' . $oOrder->_aOrderCustomer['customer_faxno'];
		}
		?>
	</p>
<?php endif;?>
	
	
	
<?php if ($oOrder->_aOrderCustomer['invoice'] == 'Y' && !empty($bInvoiceData) && $bInvoiceData == true) : ?>
	<p style="font-weight: bold;"><?php echo Kohana::lang('shop_app.summary.invoicedetails');?>:<br /> </p>
        <p>
		<?php echo $oOrder->_aOrderCustomer['invoice_company_name'] . ' <br/>' . $oOrder->_aOrderCustomer['invoice_nip'] . '<br/> ' . $oOrder->_aOrderCustomer['invoice_first_name'] . ' ' . $oOrder->_aOrderCustomer['invoice_last_name'] . '<br />' . $oOrder->_aOrderCustomer['invoice_address'] . '<br />' . $oOrder->_aOrderCustomer['invoice_zip'] . ' ' . $oOrder->_aOrderCustomer['invoice_city'] . '<br />' . $oOrder->_aOrderCustomer['invoice_country']. '<br />' . $oOrder->_aOrderCustomer['invoice_phoneno'] . '<br />' . $oOrder->_aOrderCustomer['invoice_faxno'];  ?>
	</p>
<?php endif;?>
    <?php if(!empty($oOrder->_sClientsNote)): ?>
    <p style="font-weight: bold;"><?php echo Kohana::lang('shop_app.order.client_note'); ?>:<br/> </p>
        <p>
        <?php echo $oOrder->_sClientsNote; ?></p>
    <?php endif; ?>
<?php if (!empty($vOrderTable)) : ?>
<p style="margin-top: 15px; font-weight: bold;"><?php echo Kohana::lang('order.summary.delivery');?>: <?php echo $oOrder->_aDelivery['delivery_type'] ?></p>	
<p style="margin-top: 15px; font-weight: bold;"><?php echo Kohana::lang('order.summary.payment');?>: <?php echo $oOrder->_aPayment['payment_type'] ?></p>
<?php if(!empty($oOrder->_aPayment['payment_type_info'])): ?>
<p style="margin-top: 15px;"><?php echo $oOrder->_aPayment['payment_type_info']; ?></p>
<?php endif; ?>
<p  style="font-weight: bold;"><?php echo Kohana::lang('shop_app.summary.orderdetails');?>:</p>
<?php echo $vOrderTable ?>
<p><?php echo Kohana::lang('shop_app.summary.totalcost');?>: <strong><?php echo $oOrder->dProductsCost ?> zł</strong></p>
<?php 
if(!empty($bCostPerRabate) && $bCostPerRabate != 0) { ?>
    <p><?php echo Kohana::lang('shop_app.summary.rebate');?>:<strong> <?php echo $rebate; ?> %</strong></p>
    <p><?php echo Kohana::lang('shop_app.summary.rebatecost');?>: <strong><?php echo $bCostPerRabate; ?></strong></p>
<?php } ?>
<p><?php echo Kohana::lang('shop_app.summary.deliverycost');?>: <strong><?php echo $oOrder->_aDelivery['delivery_cost'] ?> zł</strong></p>
<p style="margin-bottom: 10px;"><?php echo Kohana::lang('shop_app.summary.overalcost');?>: <strong><?php echo $oOrder->fTotalCost ?></strong></p>
<?php endif;?>
<?php /* if ( ! empty($additionalText)) : ?>
<p><?php echo $additionalText; ?></p>
<?php endif; */ ?>