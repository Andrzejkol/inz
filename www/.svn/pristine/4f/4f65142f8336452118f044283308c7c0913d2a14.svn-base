<?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
<table class="table_form">
    <tr>
        <td class="td_form_left">
            <label for="recommend"><?php echo Kohana::lang('product.set_as_recommend'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.set_as_recommend'); ?></span>
        </td>
        <td>
            <input type="checkbox" name="recommend" id="recommend"<?php
            if (!empty($oProductDetails->recommend) && $oProductDetails->recommend == 'Y') {
                echo ' checked="checked"';
            }
            ?> />
        </td>
        <td><div id="recommend_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td class="td_form_left">
            <label for="bestseller"><?php echo Kohana::lang('product.set_as_bestseller'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.set_as_bestseller'); ?></span>
        </td>
        <td>
            <input type="checkbox" name="bestseller" id="bestseller"<?php
            if (!empty($oProductDetails->bestseller) && $oProductDetails->bestseller == 'Y') {
                echo ' checked="checked"';
            }
            ?> />
        </td>
        <td><div id="bestseller_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td class="td_form_left">
            <label for="new"><?php echo Kohana::lang('product.set_in_new'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.set_in_new'); ?></span>
        </td>
        <td><input type="checkbox" name="new" id="new"<?php
            if (!empty($oProductDetails->new) && $oProductDetails->new == 'Y') {
                echo ' checked="checked"';
            }
            ?> /></td>
        <td><div id="new_error" class="error_message"></div></td>
    </tr>
    <?php if (shop_config::getConfig('rebates_codes') == 1): ?>
        <tr>
            <td class="td_form_left">
                <label for="product_allow_rabate">Produkt objęty rabatem</label>
                <span class="label_comment"></span>
            </td>
            <td><input type="checkbox" name="product_allow_rabate" id="product_allow_rabate"<?php
                if (!empty($oProductDetails->product_allow_rabate) && $oProductDetails->product_allow_rabate == 1) {
                    echo ' checked="checked"';
                }
                ?> value="1" /></td>
            <td><div id="new_error" class="error_message"></div></td>
        </tr>
    <?php endif; ?>
    <?php if (shop_config::getConfig('voucher') == 1): ?>
        <tr>
            <td class="td_form_left">
                <label for="voucher">Voucher</label>
                <span class="label_comment"></span>
            </td>
            <td><input type="checkbox" name="voucher" id="voucher" <?php
                if (!empty($oProductDetails->voucher) && $oProductDetails->voucher == 1) {
                    echo 'checked="checked"';
                }
                ?> value="1" /></td>
            <td><div id="new_error" class="error_message"></div></td>
        </tr>
    <?php endif; ?>
    <tr>
        <td class="td_form_left">
            <label for="old_price"><?php echo Kohana::lang('product.old_price'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.old_price'); ?></span>
        </td>
        <td>
            <input type="text" name="old_price" id="old_price" value="<?php
            if (!empty($oProductDetails->old_price) && $oProductDetails->old_price) {
                echo html::specialchars($oProductDetails->old_price);
            }
            ?>" />
        </td>
        <td><div id="old_price_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="submit_tab" value="submit_tab_8" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="btn btn-save"  /></td>
        <td>&nbsp;</td>
    </tr>
</table>
<?php echo form::close(); ?>