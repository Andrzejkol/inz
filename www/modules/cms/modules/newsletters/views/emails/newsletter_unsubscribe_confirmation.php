<div id="confirm_register_mail" style="border:1px solid #6F6F6F; width:450px; min-height: 300px; color:black;font-size: 14px">
    <div style="width:inherit; background-color: #6F6F6F;  ">
        <h3 style=" padding: 5px;font-size: 16px; font-weight: bold;line-height: 20px;margin: 0px;color:white">
            <?php echo Kohana::lang('newsletter.app_email.confirm_unsubscribe_title') ?>.
        </h3>
    </div>
    <div style="margin-top:15px; padding:20px;text-align: justify;">
        <strong><?php echo Kohana::lang('newsletter.app_email.hello') ?>.</strong><br /><br />
        <?php echo Kohana::lang('newsletter.app_email.unsubscribe_want_remove') ?>:<br />
		<?php echo Kohana::lang('newsletter.app_email.click') ?>

        <a href="http://<?php echo $_SERVER['HTTP_HOST'] . url::base(); echo Kohana::lang('links.lang') ?>index/confirm_unsubscribe/?email=<?php echo $email; ?>&verify_string=<?php echo $verifyString; ?>"><?php echo Kohana::lang('newsletter.app_email.here') ?></a>
        <?php echo Kohana::lang('newsletter.app_email.or_paste') ?>:<br/><br/>

        <div style="border-top:1px dotted #6F6F6F;border-bottom: 1px dotted #6F6F6F; padding: 10px 0px;">
        http://<?php echo $_SERVER['HTTP_HOST'] . url::base();echo Kohana::lang('links.lang'); ?>index/confirm_unsubscribe/?email=<?php echo $email; ?>&verify_string=<?php echo $verifyString; ?>
        </div>
        <br/>
        <?php echo Kohana::lang('newsletter.app_email.greetings') ?>,<br /> <?php echo Kohana::lang('meta.home_site_title') ?><br /><br />

        <div style="font-size: 11px;">
            <?php echo Kohana::lang('newsletter.app_email.you_recieved')?>.<br />
            <br />
            <a href="http://www.olicom.pl/">Tworzenie stron WWW - Olicom</a>
        </div>
    </div>
</div>