<div id="your_subscriptions">
	<?php echo (!empty($msg)) ? $msg : ''?>
	<div class="calculatorBuySubscription">
		<div class="top"></div>
		<div class="content">
				<h3>Formularz płatności</h3>
				<p>Aby złożyć zamówienie na nowy abonament wybierz odpowiednią dla siebie pozycję z rozwijanej listy i przejdź na stronę płatności.</p>
				<div id="validation-info"></div>
				<form method="post" action="http://ssl.dotpay.pl/" id="subscriptionForm">
					<ul>
						<li>
							<label for="payment">Wybierz abonament</label>
							<select name="payment" id="payment">
								<option value="0"></option>
								<?php
					//			echo '<pre>';
					//			var_dump($subscriptionTypes);
					//			echo '</pre>';
					//			exit;
								if (!empty($subscriptionTypes)) {
									foreach ($subscriptionTypes as $sub) {	?>
										<option value="<?php echo $sub->subscription_value ?>"><?php echo $sub->subscription_name . ' -> ' . $sub->subscription_value . ' zł' ?></option>
								<?php
									}
								}
								?>
							</select><br />
						</li>
						<input type="hidden" name="id" id="id" value="<?php echo layer::DOTPAY_KLIENT_ID; ?>" />
						<input type="hidden" id="kwota" name="kwota" value="" />
						<input type="hidden" name="opis" id="opis" value="Opłata testowa" />
						<input type="hidden" name="lang" id="lang" value="pl" />
						<input type="hidden" name="waluta" id="waluta" value="PLN" />
						<input type="hidden" name="url" id="url" value="<?php echo (isset($sUrl)) ? $sUrl : '' ?>" />
						<input type="hidden" name="typ" id="typ" value="0" />
						<input type="hidden" name="urlc" id="urlc" id="urlc" value="<?php echo (!empty($sUrlc)) ? $sUrlc : '' ?>" />
						<input type="hidden" id="control" name="control" value="<?php echo (!empty($iToken)) ? $iToken : '' ?>" />
						<input type="hidden" name="txtguzik" id="txtguzik" value="Powrót do sklepu" />
						<?php if (!empty($oCustomer)): ?>
							<input type="hidden" id="email" name="email" value="<?php echo (!empty($oCustomer->customer_email)) ? $oCustomer->customer_email : '' ?>" />
							<input type="hidden" id="imie" name="imie" value="<?php echo (!empty($oCustomer->customer_first_name)) ? $oCustomer->customer_first_name : '' ?>" />
							<input type="hidden" id="nazwisko" name="nazwisko" value="<?php echo (!empty($oCustomer->customer_last_name)) ? $oCustomer->customer_last_name : '' ?>" />
							<input type="hidden" id="ulica" name="ulica" value="<?php echo (!empty($oCustomer->customer_address)) ? $oCustomer->customer_address : '' ?>" />
							<input type="hidden" id="miasto" name="miasto" value="<?php echo (!empty($oCustomer->customer_city)) ? $oCustomer->customer_city : '' ?>" />
							<input type="hidden" id="kod" name="kod" value="<?php echo (!empty($oCustomer->customer_zip)) ? $oCustomer->customer_zip : '' ?>" />
							<input type="hidden" id="telefon" name="telefon" value="<?php if (!empty($oCustomer->customer_mobileno)) {echo $oCustomer->customer_mobileno;} elseif (!empty($oCustomer->customer_phoneno)) {echo $oCustomer->customer_phoneno;} ?>" />
							<input type="hidden" id="kraj" name="kraj" value="<?php echo (!empty($oCustomer->customer_country)) ? $oCustomer->customer_country : '' ?>" />
						<?php endif; ?>
						<li>
							<input type="submit" class="submit" id="submit" value="ZAPŁAĆ" />
						</li>
					</ul>
				</form>
			<div class="clear"></div>
		</div>
		<div class="bottom"></div>
	</div>
	<h3>Twoje abonamenty</h3>
	<?php echo (!empty($emptySubs)) ? $emptySubs : ''?>
	<?php
	if (!empty($oCustomersSubscriptions)) { ?>
	<table class="subscriptions_table">
		<thead>
			<tr>
				<th>Nr. operacji</th>
				<th>Data zakupu</th>
				<th>Data rozpoczęcia</th>
				<th>Data zakończenia</th>
				<th>Aktywny</th>
				<th>Opłacony</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			foreach ($oCustomersSubscriptions as $subs) :
			?>
			<tr <?php if ($i == $oCustomersSubscriptions->count()) echo 'class="last"'?>>
				<td><?php echo $subs->id_shop_customers_subscription;?></td>
				<td><?php echo date(config::DATE_TIME_FORMAT, $subs->subscription_added);?></td>
				<td><?php echo date(config::DATE_TIME_FORMAT, $subs->start_time);?></td>
				<td><?php echo date(config::DATE_TIME_FORMAT, $subs->end_time);?></td>
				<td><?php echo ($subs->active == 'Y') ? html::image('img/icons/tick.png') : html::image('img/icons/cross.png');?></td>
				<td><?php echo ($subs->confirmed == 'Y') ? html::image('img/icons/tick.png') : html::image('img/icons/cross.png');?></td>
			</tr>
			<?php $i ++;
			endforeach;?>
		</tbody>
	</table>
	<?php } ?>	
</div>