<div class="content">
    <div id="site_map">
        <?php
        if(!empty($msg)) {
            echo $msg;
        }
        ?>
        <div id="about" class="box">
            <h2><?php echo Kohana::lang('app.about_shop'); ?></h2>
            <ul>
                <li><?php echo html::anchor('regulamin#info', Kohana::lang('app.about_us')); ?></li>
                <li><?php echo html::anchor('regulamin', Kohana::lang('app.regulations')); ?></li>
                <li><?php echo html::anchor('jak_kupowac', Kohana::lang('app.how_to_buy')); ?></li>
                <li><?php echo html::anchor('zakupy_na_raty', Kohana::lang('app.installment_buying')); ?></li>
                <li><?php echo html::anchor('zostan_naszym_dostawca', Kohana::lang('app.provider')); ?></li>
            </ul>
        </div>
        <div id="my_account" class="box">
            <h2><?php echo Kohana::lang('app.my_account'); ?></h2>
            <ul>
                <li><?php echo html::anchor('rejestracja', Kohana::lang('app.register')); ?></li>
                <li><?php echo html::anchor('logowanie', Kohana::lang('app.login')); ?></li>
                <li><?php echo html::anchor('regulamin#zamowienia', Kohana::lang('app.orders')); ?></li>
                <li><?php echo html::anchor('ustawienia_konta', Kohana::lang('app.account_settings')); ?></li>
                <li><?php echo html::anchor('historia_transakcji', Kohana::lang('app.transaction_history')); ?></li>
            </ul>
        </div>
        <div id="conditions" class="box">
            <h2><?php echo Kohana::lang('app.conditions'); ?></h2>
            <ul>
                <li><?php echo html::anchor('regulamin#warunki_dostaw', Kohana::lang('app.ways_and_shipping')); ?></li>
                <li><?php echo html::anchor('czas_realizacji', Kohana::lang('app.execution_time')); ?></li>
                <li><?php echo html::anchor('regulamin#formy_platnosci', Kohana::lang('app.payment_methods')); ?></li>
                <li><?php echo html::anchor('regulamin#reklamacje', Kohana::lang('app.complaints_and_returns')); ?></li>
                <li><?php echo html::anchor('gwarancje', Kohana::lang('app.guarantees')); ?></li>
            </ul>
        </div>
        <div id="products">
            <h3>Kategorie produktów:</h3><?php echo $oSitemap; ?>
        </div>
        <div id="producers" style="float:left; width:200px;">
            <h3>Producenci:</h3>
            <ul>
                <?php foreach($oProducers as $p) : ?>
                <li><?php echo html::anchor('producent/'.$p->id_producer.'/'.string::prepareURL($p->producer_name), $p->producer_name); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>


    </div>
</div>










