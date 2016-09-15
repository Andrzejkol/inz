<p>Witaj!</p>
<p>Podczas rejestracji podałeś następujący e-mail: <strong><?php echo $sCustomerEmail ?></strong></p>
<p>Do Twojego konta zostało wygenerowane nowe hasło: <strong><?php echo $sNewPassword ?></strong></p>
<p style="margin-top: 15px;">Aby przejść do logowania kliknij w poniższy link lub wpisz adres do przeglądarki.<br />
	<?php echo html::anchor(Kohana::config('config.http_host') . Kohana::config('config.site_domain') . 'logowanie') ?>
</p>