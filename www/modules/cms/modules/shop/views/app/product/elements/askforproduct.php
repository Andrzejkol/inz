<div style="display: block;" id="askForProductPopup">
    <div id="askForProduct">
        <div id="ask-validate"></div>
        <?php echo form::open('', array('method' => 'post', 'id' => 'askForProductForm')); ?>
        <ul>
            <li>
                <label for="email"><?php echo Kohana::lang('shop_app.ask_for_product.your_email') ?>: <sup class="requiredFiled">*</sup></label>
                <input type="text" value="" id="questionEmail" name="questionEmail" />
            </li>
            <li>
                <label for="content"><?php echo Kohana::lang('shop_app.ask_for_product.message') ?>: <sup class="requiredFiled">*</sup></label>
                <textarea cols="32" rows="5" id="questionContent" name="questionContent"></textarea>
            </li>
            <li>
                <label for="content"><?php echo Kohana::lang('shop_app.ask_for_product.product') ?>:</label>
                <p><?php echo html::specialchars($oProductDetails->product_name); ?><p>
            </li>
            <li>
                <input type="hidden" value="<?php echo $oProductDetails->id_product; ?>" id="questionId" name="questionId" />
                <?php /*<input type="submit" class="submit" id="askForProductSubmitBtn" value="<?php echo Kohana::lang('shop_app.ask_for_product.send') ?>" />*/ ?>
            </li>
        </ul>
    </div>
</div>