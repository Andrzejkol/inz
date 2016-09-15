<div id="orders_history"  class="content-center">
    <h2 class="title"><?php echo Kohana::lang('shop_app.order.transaction_history'); ?></h2>
    <?php
    if (!empty($msg)) {
        echo $msg;
    }
    ?>
    <?php if (!empty($oOrders) && $oOrders->count() > 0) { ?>
        <?php echo form::open(); ?>
        <div class="transactions">
            <div class="row hidden-xs">
                <div class="col-sm-3"><strong><?php echo Kohana::lang('shop_app.order.order_number'); ?></strong></div>
                <div class="col-sm-3"><strong><?php echo Kohana::lang('shop_app.order.order_date'); ?></strong></div>
                <div class="col-sm-3"><strong><?php echo Kohana::lang('shop_app.order.order_status'); ?></strong></div>
                <div class="col-sm-3"><strong><?php echo Kohana::lang('shop_app.order.order_cost'); ?></strong></div>
            </div>

            <?php foreach ($oOrders as $order): ?>
                <div class="row transaction">
                    <div class="col-sm-3 col-xs-12">
                        <strong class="visible-xs"><?php echo Kohana::lang('shop_app.order.order_number'); ?>: </strong>
                        <?php echo html::anchor(Kohana::lang('links.lang') . 'szczegoly_zamowienia/' . $order->id_order, $order->order_number); ?>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <strong class="visible-xs"><?php echo Kohana::lang('shop_app.order.order_date'); ?>: </strong>
                        <?php echo date(config::DATE_FORMAT, $order->order_date); ?>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <strong class="visible-xs"><?php echo Kohana::lang('shop_app.order.order_status'); ?>: </strong>
                        <?php echo Kohana::lang('shop_app.order.order_status' . $order->id_order_status); ?>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <strong class="visible-xs"><?php echo Kohana::lang('shop_app.order.order_cost'); ?>: </strong>
                        <?php echo $order->order_cost; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php echo form::close(); ?>
    <?php } else { ?>
        <div class="info"><?php echo Kohana::lang('customer.no_favs'); ?></div>
    <?php } ?>
</div>