<div style="margin-top:15px; padding:20px;text-align: justify;">
    <strong><?php echo Kohana::lang('newsletter.app_email.hello') ?>.</strong><br /><br />
    <?php echo Kohana::lang('newsletter.app_email.in_order_to_add') ?>: <?php echo config::getConfig('page_name'); ?><br />
    <?php echo Kohana::lang('newsletter.app_email.click') ?>

    <a href="http://<?php
    echo $_SERVER['HTTP_HOST'] . url::base();
    echo Kohana::lang('links.lang')
    ?>index/confirm_subscribe/?email=<?php echo $email; ?>&verify_string=<?php echo $verifyString; ?>"><?php echo Kohana::lang('newsletter.app_email.here') ?></a>
    <?php echo Kohana::lang('newsletter.app_email.or_paste') ?>:<br/><br/>

    <div style="border-top:1px dotted #6F6F6F;border-bottom: 1px dotted #6F6F6F; padding: 10px 0px;">
        http://<?php
        echo $_SERVER['HTTP_HOST'] . url::base();
        echo Kohana::lang('links.lang')
        ?>index/confirm_subscribe/?email=<?php echo $email; ?>&verify_string=<?php echo $verifyString; ?>
    </div>
    <br/>
    <?php echo Kohana::lang('newsletter.app_email.greetings') ?>,<br /> <?php echo config::getConfig('page_name'); ?><br /><br />

</div>