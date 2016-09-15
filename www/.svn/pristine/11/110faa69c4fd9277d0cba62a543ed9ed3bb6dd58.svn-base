<div id="order_step3">
    <div class="shopping_cart_summary" id="shopping_cart">
        <div class="cart-tab">

        </div>
    </div>
    <div class="summary row">
        <div class="shopping_cart_summary col-md-6 col-lg-4" id="delivery-summary">
            <h3 class="title">Dane dostawy</h3>
            <div class="group" id="name">
                <label><?php echo Kohana::lang('order.name'); ?></label>
                <span></span>
            </div>
            <div class="group" id="street">
                <label><?php echo Kohana::lang('order.street'); ?></label>
                <span></span>
            </div>
            <div class="group" id="city">
                <label><?php echo Kohana::lang('order.city'); ?></label>
                <span></span>
            </div>
            <div class="group" id="email">
                <label><?php echo Kohana::lang('order.mail'); ?></label>
                <span></span>
            </div>
            <div class="group" id="phone">
                <label><?php echo Kohana::lang('order.phone'); ?></label>
                <span></span>
            </div>
             <div class="group" id="protect">
                <label><?php echo Kohana::lang('order.protection'); ?></label>
                <span></span>
            </div>
        </div>
        <div class="shopping_cart_summary col-md-6 col-lg-4 col-lg-offset-4 text-right" id="prices-summary">
            <div class="group" id="summary-cost">
                <label><?php echo Kohana::lang('order.order_value'); ?></label>
                <span></span>
            </div>
            <div class="group" id="summary-delivery-type">
                <label><?php echo Kohana::lang('order.transport_type'); ?></label>
                <span></span>
            </div>
            <div class="group" id="summary-delivery-cost">
                <label><?php echo Kohana::lang('order.transport_cost'); ?></label>
                <span></span>
            </div>
            <div class="group" id="summary-payment">
                <label><?php echo Kohana::lang('order.payment_type'); ?></label>
                <span></span>
            </div>
            <div class="group" id="summary-total">
                <label><?php echo Kohana::lang('order.order_total_cost'); ?></label>
                <span></span>
            </div>
        </div>

    </div>
    <div class="summary-btns row">
        <span class="summary-back col-xs-6 text-left">

            <?php if (shop_config::getConfig('one_step_order') == 0): ?>
                <span class="btn btn-big goto_step2">Wstecz</span>
                <?php /* <span class="back"><a class="btn btn-big btn-default" href="<?php echo $_SESSION['referer']; ?>"><?php echo Kohana::lang('shop_app.cart.continue_shopping'); ?></a></span> */ ?>
            <?php else: ?>
                <span class="btn btn-big goto_step2">Wstecz</span>
            <?php endif; ?>
        </span>
        <span class="summary-next col-xs-6 text-right">
            <?php /* <input type="submit" name="recount" id="recount-order" class="btn" value="<?php echo Kohana::lang('shop_app.cart.recount'); ?>" />
             *  <button type="submit" name="confirm_order" class="next btn btn-big"><?php echo Kohana::lang('order.order_and_pay'); ?> &raquo;</button> */ ?>
         
            <button type="submit" name="confirm_order" value="confirm_order" class="next btn btn-big"><?php echo Kohana::lang('order.order_and_pay'); ?> &raquo;</button>
        </span>

    </div>  
</div>