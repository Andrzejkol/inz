<div id="cart">
    <?php if( ! empty($aCartContent) && count($aCartContent)>0 ): ?>
    <table class="os-cart-content">
        <?php foreach($aCartContent as $aCartItem): ?>
        <tr>
            <td><?php echo $aCartItem['filename']; ?></td>
            <td><?php echo $aCartItem['product_name']; ?></td>
            <td><?php echo $aCartItem['price']; ?></td>
            <td><?php echo $aCartItem['quantity']; ?></td>
            <td><?php echo $aCartItem['amount']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div>
        <div class="os-cart-delivery">
            <ul>
            <?php foreach($oDeliveryTypes as $dt): ?>
                <li><input type="radio" name="delivery_type" id="delivery_type_<?php echo $dt->id_delivery_type; ?>" value="<?php echo $dt->id_delivery_type; ?>" /> <label for="delivery_type_<?php echo $dt->id_payment_type; ?>"><?php echo $dt->delivery_type; ?></label></li>
            <?php endforeach; ?>
            </ul>
        </div>
        <div class="os-cart-payment">
            <ul>
            <?php foreach($oPaymentTypes as $pt): ?>
                <li><input type="radio" name="payment_type" id="payment_type_<?php echo $pt->id_payment_type; ?>" value="<?php echo $pt->id_payment_type; ?>" /> <label for="payment_type_<?php echo $pt->id_payment_type; ?>"><?php echo $pt->payment_type; ?></label></li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
</div>