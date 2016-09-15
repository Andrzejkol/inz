<div class="row">
    <div class="order_summary_delivery col-sm-12">
        <h3 class="title">Dokonaj płatności</h3>
        <div id="dotpay-form" class="row">  
            <div class="col-sm-3 col-xs-12">
                <form action="<?php echo $iPaymentTypeUrl; ?>" method="post" target="_blank">
                    <input type="hidden" name="id" value="<?php echo $iPaymentTypeLogin; ?>">

                    <input type="hidden" name="URL" value="<?php echo dotpay::GetBackUrl($sGet); // adres powrotny z id zamowienia         ?>" />
                    <input type="hidden" name="control" value="<?php echo $sControl; // confirm_string dla zamowienia          ?>" />
                    <input type="hidden" name="kwota" size="15" value="<?php echo $Price; // koszt zamowienia          ?>">
                    <input type="hidden" name="type" value="3" />

                    <input type="hidden" name="lang" value="<?php echo Kohana::lang('dotpay.lang'); ?>">
                    <!-- dostepne wersje jezykowe: pl, en, de, it, fr, es, cz, ru, bg -->

                    <input type="hidden" name="opis" value="Zapłata za zakupy w sklepie">
                    <!-- domyslny opis transakcji -->                        
                    <button type="submit" class="dotpay_btn" name="b1">
                        <?php echo html::image('img/dotpay/dotpay_b2_160x83.gif', array('alt' => 'Dotpay')); ?>
                    </button>
                </form>
            </div>
            <div class="dotpay-info col-sm-9 col-xs-12">
                <?php echo Kohana::lang('dotpay.crd'); ?>
            </div>
        </div>
    </div>
</div>