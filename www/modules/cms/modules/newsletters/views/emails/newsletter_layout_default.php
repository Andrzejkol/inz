<div style="text-align: center; width: 660px; margin: 0 auto;" >
    <div style="width: 660px; font-family: Tahoma, Arial, Helvetica; font-size: 14px; color: #5a5a5a; text-align: left;">
        <div style="padding-bottom: 16px; padding: 20px 0;">
<?php echo html::image(url::base(true, 'http') . 'img/email/head.jpg'); ?>
        </div>

        <div style="height: 6px; background-color: #e7e7e7; border-bottom: 1px solid #d4d4d4;">&nbsp;</div>

        <div style="background-color: #e6ffbc; padding: 20px;">
            <div style="font-size: 22px;">
<?php echo !empty($sNewsletterTitle) ? $sNewsletterTitle : ('List wysłany ze strony ' . Kohana::lang('meta.home_site_title')); ?>
                <br/><br/>
            </div>

<?php if (!empty($sContent)) {
    echo $sContent;
} ?>
            <br /><br />

            <div style="font-size: 11px;">
				<?php echo Kohana::lang('newsletter.app_email.you_recieved') ?>.<br />
				<?php echo Kohana::lang('newsletter.app_email.want_remove') ?>:<br/>
				<?php 
				$unsubscribe_link = url::base(true, 'http');
				if (Kohana::config('locale.language') == 'pl_PL') {
					$unsubscribe_link .= '';
				} else {
					$unsubscribe_link .= Kohana::lang('links.lang');
				}
				$unsubscribe_link .= 'index/confirm_unsubscribe?email=' . $email . '&verify_string=' . $verifyString;
				echo html::anchor($unsubscribe_link, $unsubscribe_link, array()); ?>
            </div>

        </div>

        <div style="height: 6px; background-color: #e7e7e7; border-top: 1px solid #d4d4d4;">&nbsp;</div>

        <div style="text-align: center; padding: 20px 0;">
<?php echo html::image(url::base(true, 'http') . 'img/email/foot.jpg'); ?>
        </div>

    </div>
</div>
