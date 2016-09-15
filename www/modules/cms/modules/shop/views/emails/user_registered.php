<div>
	<p>
		<?php if (!empty($user)) : ?>
		Do: <?php echo $user ?>
		<?php endif;?>
	</p>
	<p>
		<?php echo Kohana::lang('customer.user_registered.mail_title');?>
	</p>
	<p><?php echo Kohana::lang('customer.user_registered.customer_details');?><br />
		<?php echo Kohana::lang('customer.user_registered.login');?> <strong><?php echo $user_login?></strong><br />
		<?php echo Kohana::lang('customer.user_registered.password');?> <strong><?php echo $user_password?></strong><br />
		<?php echo Kohana::lang('customer.user_registered.safe_details');?>
	</p>
	<p>
		<?php echo Kohana::lang('customer.user_registered.confirm_click');?><br />
		<?php echo html::anchor('http://' . $_SERVER['HTTP_HOST'] . url::base() . Kohana::lang('links.lang').'potwierdzenie_rejestracji?verify_string=' . $verify_string); ?>		
	</p>
	<p>
		<?php echo Kohana::lang('customer.user_registered.update_details');?>
	</p>
</div>
