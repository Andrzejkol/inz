
<p style="font-weight: bold; font-size:16px;"><?php echo Kohana::lang('shop_app.email.hello');?></p>
<p>Do: <?php echo (!empty($oOrder->_aOrderCustomer)) ? $oOrder->_aOrderCustomer['customer_first_name'] . ' ' . $oOrder->_aOrderCustomer['customer_last_name'] . ' (' . $oOrder->_aOrderCustomer['customer_email'] . ')' : '' ?></p>

<p>Aktualny status Twojego zamówienia: OCZEKUJE NA POTWIERDZENIE</p>
<p>Numer zamówienia: <?php echo $oOrder->_aOrderCustomer['order_number'] ?></p>
<p>Data zamówienia: <?php echo $oOrder->_aOrderCustomer['current_number_day'] . '.' . $oOrder->_aOrderCustomer['current_number_month'] . '.' . $oOrder->_aOrderCustomer['current_number_year'] ?></p>

<p style="margin-top: 15px;">Dane klienta: <br />
		<?php echo $oOrder->_aOrderCustomer['customer_first_name'] . ' ' . $oOrder->_aOrderCustomer['customer_last_name'] . '<br />' . $oOrder->_aOrderCustomer['customer_address'] . '<br />' . $oOrder->_aOrderCustomer['customer_zip'] . ' ' . $oOrder->_aOrderCustomer['customer_city'] . '<br />' . $oOrder->_aOrderCustomer['customer_phoneno'] . '<br />' . $oOrder->_aOrderCustomer['customer_faxno']; ?>
</p>
<p style="margin-top: 15px;">Adres dostawy:<br />
	<?php if ($oOrder->_aOrderCustomer['delivery'] == 'Y') {
		echo $oOrder->_aOrderCustomer['delivery_first_name'] . ' ' . $oOrder->_aOrderCustomer['delivery_last_name'] . '<br />' . $oOrder->_aOrderCustomer['delivery_address'] . '<br />' . $oOrder->_aOrderCustomer['delivery_zip'] . ' ' . $oOrder->_aOrderCustomer['delivery_city'] . '<br /' . $oOrder->_aOrderCustomer['delivery_phoneno'] . '<br />' . $oOrder->_aOrderCustomer['delivery_faxno'];
	} else {
		echo $oOrder->_aOrderCustomer['customer_first_name'] . ' ' . $oOrder->_aOrderCustomer['customer_last_name'] . '<br />' . $oOrder->_aOrderCustomer['customer_address'] . '<br />' . $oOrder->_aOrderCustomer['customer_zip'] . ' ' . $oOrder->_aOrderCustomer['customer_city'] . '<br />' . $oOrder->_aOrderCustomer['customer_phoneno'] . '<br />' . $oOrder->_aOrderCustomer['customer_faxno'];
	}
	?>
</p>
<?php if ($oOrder->_aOrderCustomer['invoice'] == 'Y') : ?>
	<p>Dane do faktury:<br />
		<?php echo $oOrder->_aOrderCustomer['invoice_first_name'] . ' ' . $oOrder->_aOrderCustomer['invoice_last_name'] . '<br />' . $oOrder->_aOrderCustomer['invoice_address'] . '<br />' . $oOrder->_aOrderCustomer['invoice_zip'] . ' ' . $oOrder->_aOrderCustomer['invoice_city'] . '<br />' . $oOrder->_aOrderCustomer['invoice_phoneno'] . '<br />' . $oOrder->_aOrderCustomer['invoice_faxno'];  ?>
	</p>
<?php endif;?>
<p style="margin-top: 15px;">Płatność i dostawa: <?php echo $oOrder->_aDelivery['delivery_type'] ?></p>
<hr style="margin: 10px 0;">
<p>Zawartość zamówienia:</p>
<?php echo $oOrder->sOrderContent ?>
<hr style="margin: 10px 0;">
<p>Razem za zakupy: <?php echo $oOrder->dProductsCost ?> zł</p>
<p>Koszt dostawy: <?php echo $oOrder->_aDelivery['delivery_cost'] ?> zł</p>
<p style="margin-bottom: 10px;">Razem do zapłaty: <strong><?php echo $oOrder->fTotalCost ?> zł</strong></p>