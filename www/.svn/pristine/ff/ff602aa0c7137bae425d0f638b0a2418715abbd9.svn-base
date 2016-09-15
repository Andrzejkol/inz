<div style="text-align: center; width: 660px; margin: 0 auto;" >
    <div style="width: 660px; font-family: Tahoma, Arial, Helvetica; font-size: 14px; color: #5a5a5a; text-align: left;">
        <div style="padding-bottom: 16px; padding: 20px 0;">
<?php echo html::image(url::base(true, 'http') . 'img/newsletter/head.jpg'); ?>
        </div>

        <div style="height: 6px; background-color: #e7e7e7; border-bottom: 1px solid #d4d4d4;">&nbsp;</div>

        <div style="background-color: #e5f3fc; padding: 20px;">
            <div style="font-size: 22px;">
<?php echo!empty($sNewsletterTitle) ? $sNewsletterTitle : 'Llist wysłany ze strony Olicom.pl'; ?>
                <br/><br/>
            </div>

<?php if (!empty($sContent)) {
    echo $sContent;
} ?>
            <br /><br />

            <div style="font-size: 11px;">
                Otrzymałeś/aś ten list, ponieważ Twój adres e-mail istnieje na naszej liście. Jeśli nie wiesz o co chodzi,
                prawdopodobnie ktoś zrobił Ci kawał - w takim wypadku po prostu zignoruj tę wiadomość.<br />
                <br />
                Jeśli chcesz zrezygnować z otrzymywania newslettera kliknij <a href="<?php echo url::base(true, 'http') . 'index/confirm_unsubscribe?email=' . $sEmail . '&verify_string=' . $sVerifyString ?>">tutaj</a>
                lub wklej poniższy link w przeglądarce:
<?php echo url::base(true, 'http') . 'index/confirm_unsubscribe?email=' . $sEmail . '&verify_string=' . $sVerifyString ?>

            </div>

        </div>

        <div style="height: 6px; background-color: #e7e7e7; border-top: 1px solid #d4d4d4;">&nbsp;</div>

        <div style="text-align: center; padding: 20px 0;">
<?php echo html::image(url::base(true, 'http') . 'img/newsletter/foot.jpg'); ?>
        </div>

    </div>
</div>
