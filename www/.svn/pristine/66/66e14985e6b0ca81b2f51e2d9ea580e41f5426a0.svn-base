<?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
<table class="table_form">
    <tr>
        <td class="td_form_left">
            <label for="product_name"><?php echo Kohana::lang('product.product_name'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.product_name') . ' ' . Kohana::lang('product.comments.field_required'); ?></span>
        </td>
        <td>
            <input type="text" name="product_name" id="product_name" value="<?php
            if (!empty($_POST['product_name'])) {
                echo $_POST['product_name'];
            } elseif (!empty($oProductDetails->product_name)) {
                echo $oProductDetails->product_name;
            } else {
                echo '';
            }
            ?>" />
                   <?php echo languages::ShowTranslationBox('product', $oProductDetails->id_product, 'input'); ?>
                   <?php /*
                     <ul class="os-languages-list">
                     <?php foreach($oLanguages as $lang): ?>
                     <li><span onclick="javascript:showI18nDialog('product_name_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
                     <?php endforeach; ?>
                     </ul>
                    */ ?>
        </td>
        <td><div id="product_name_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td class="td_form_left">
            <label for="price"><?php echo Kohana::lang('product.product_price'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.product_price'); ?></span>
        </td>
        <td>
            <script type="text/javascript">
                jQuery(function ($) {
                    $('#price').on('keyup', function () {
                        $('#netto_price').val(($('#price').val().replace(',', '.') / (1 + ($('#tax_id').val() / 100.00))).toFixed(2));
                    });
                });
            </script>
            <input type="text" name="price" id="price"  value="<?php
            if (!empty($_POST['price'])) {
                echo $_POST['price'];
            } elseif (!empty($oProductDetails->price)) {
                echo $oProductDetails->price;
            } else {
                echo '';
            }
            ?>" />
            <select name="tax_id" id="tax_id" >
                <!-- <option value="0">Wybierz podatek</option> -->
                <?php foreach ($oTaxes as $t): ?>
                    <option value="<?php echo $t->tax_value; ?>" <?php
                    if (!empty($_POST['tax_id']) && $_POST['tax_id'] == $t->tax_value) {
                        echo 'selected="selected"';
                    }
                    ?>><?php echo $t->tax_name . '  -  ' . $t->tax_value . '%'; ?></option>
                        <?php endforeach; ?>
            </select>
            <br />
        </td>
        <td><div id="price_error" class="error_message"></div></td>
    </tr>

    <tr>
        <td class="td_form_left">
            <label for="net_price"><?php echo Kohana::lang('product.product_net_price'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.product_price'); ?></span>
        </td>
        <td>
            <script type="text/javascript">
                jQuery(function ($) {
                    $('#netto_price').on('keyup', function () {
                        $('#price').val(($('#netto_price').val().replace(',', '.') * (1 + ($('#tax_id').val() / 100.00))).toFixed(2));
                    });
                });
            </script>
            <input type="text" name="net_price" id="netto_price" />

        </td>
        <td><div id="price_error" class="error_message"></div></td>
    </tr>
    <?php if (shop_config::getConfig('product_stock') == 1): ?>
        <tr>
            <td class="td_form_left">
                <label for="product_stock">Stan magazynowy</label>
                <span class="label_comment"></span>
            </td>
            <td><input type="text" name="product_stock" id="product_stock" value="<?php
                if (!empty($_POST['product_stock'])) {
                    echo $_POST['product_stock'];
                } else {
                    echo $oProductDetails->product_stock;
                }
                ?>"  /></td>
            <td><div id="product_stock_error" class="error_message"></div></td>
        </tr>
    <?php endif; ?>
    <tr style="display:none">
        <td class="td_form_left">
            <label for="code"><?php echo Kohana::lang('product.product_code'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.product_code'); ?></span>
        </td>
        <td><input type="text" name="code" id="code" value="<?php
            if (!empty($_POST['code'])) {
                echo $_POST['code'];
            } else {
                echo $oProductDetails->code;
            }
            ?>" /></td>
        <td><div id="code_error" class="error_message"></div></td>
    </tr>
    <?php
    /*
      <tr>
      <td class="td_form_left">
      <label for="ean"><?php echo Kohana::lang('product.product_ean'); ?></label>
      <span class="label_comment"><?php echo Kohana::lang('product.comments.product_ean'); ?></span>
      </td>
      <td><input type="text" name="ean" id="ean" value="<?php if(!empty($_POST['ean'])) {echo $_POST['ean'];} else { echo '';} ?>" /></td>
      <td><div id="product_ean_error" class="error_message"></div></td>
      </tr>
      <tr>
      <td class="td_form_left">
      <label for="date_expire"><?php echo Kohana::lang('product.date_expire'); ?></label>
      <span class="label_comment"><?php echo Kohana::lang('product.comments.date_expire'); ?></span>
      </td>
      <td><input type="text" name="date_expire" id="date_expire" value="<?php if(!empty($_POST['date_expire'])) {echo $_POST['date_expire'];} else { echo '';} ?>" /></td>
      <td><div id="date_expire_error" class="error_message"></div></td>
      </tr>
     */
    ?>
    <tr>
        <td class="td_form_left">
            <label for="producer_id"><?php echo Kohana::lang('product.producer'); ?></label>
        </td>
        <td>
            <select id="producer_id" name="producer_id">
                <?php
                $tmpProducerId = 0;
                if (!empty($_POST['producer_id'])) {
                    $tmpProducerId = $_POST['producer_id'];
                } elseif (!empty($oProductDetails->producer_id)) {
                    $tmpProducerId = $oProductDetails->producer_id;
                } else {
                    $tmpProducerId = 0;
                }
                ?>
                <?php foreach ($oProducers as $pp): ?>
                    <?php if ($pp->id_producer == $tmpProducerId): ?>
                        <option value="<?php echo $pp->id_producer; ?>" selected="selected"><?php echo $pp->producer_name; ?></option>
                    <?php else: ?>
                        <option value="<?php echo $pp->id_producer; ?>"><?php echo $pp->producer_name; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </td>
        <td><div id="product_name_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td class="td_form_left td_form_top">
            <label for="category_id"><?php echo Kohana::lang('product.category'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.category'); ?></span>
        </td>
        <td>
            <select name="category_id[]" id="category_id" multiple="multiple">
                <?php echo!empty($oProductCategories) ? $oProductCategories : ''; ?>
            </select>
        </td>
        <td><div id="category_id_error" class="error_message"></div></td>
    </tr>
    <tr style="display:none">
        <td class="td_form_left">
            <label for="product_position"><?php echo Kohana::lang('product.position'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.position'); ?></span>
        </td>
        <td><input type="text" name="product_position" id="product_position" value="<?php
            if (!empty($_POST['product_position'])) {
                echo $_POST['product_position'];
            } else {
                echo $oProductDetails->product_position;
            }
            ?>" /></td>
        <td><div id="new_error" class="error_message"></div></td>
    </tr>
    <tr style="display:none">
        <td class="td_form_left">
            <label for="active"><?php echo Kohana::lang('product.product_availability'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.product_availability'); ?></span>
        </td>
        <td>
            <select id="active" name="active">
                <option value="Y"<?php
                if (!empty($_POST['active']) && $_POST['active'] == 'Y') {
                    echo ' selected="selected"';
                } elseif (!empty($oProductDetails->product_active) && $oProductDetails->product_active == 'Y') {
                    echo ' selected="selected"';
                }
                ?>><?php echo Kohana::lang('product.yes'); ?></option>
                <option value="N"<?php
                if (!empty($_POST['active']) && $_POST['active'] == 'N') {
                    echo ' selected="selected"';
                } elseif (!empty($oProductDetails->product_active) && $oProductDetails->product_active == 'N') {
                    echo ' selected="selected"';
                }
                ?>><?php echo Kohana::lang('product.no'); ?></option>
            </select>
        </td>
        <td><div id="active_error" class="error_message"></div></td>
    </tr>
    <tr style="display:none">
        <td class="td_form_left">
            <label for="status_id"><?php echo Kohana::lang('product.product_status_id'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.product_status_id'); ?></span>
        </td>
        <td>
            <select name="product_status_id" id="product_status_id">
                <?php
                $tmpStatusId = 0;
                if (!empty($_POST['product_status_id'])) {
                    $tmpStatusId = $_POST['product_status_id'];
                } elseif (!empty($oProductDetails->product_status_id)) {
                    $tmpStatusId = $oProductDetails->product_status_id;
                } else {
                    $tmpStatusId = 0;
                }
                ?>
                <?php foreach ($oProductStatuses as $ps): ?>
                    <?php if ($ps->id_product_status == $tmpStatusId) : ?>
                        <option value="<?php echo $ps->id_product_status; ?>" selected="selected"><?php echo $ps->product_status_name; ?></option>
                    <?php else: ?>
                        <option value="<?php echo $ps->id_product_status; ?>"><?php echo $ps->product_status_name; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </td>
        <td><div id="product_status_id_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="submit_tab" value="submit_tab_1" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="btn btn-save"  /></td>
        <td>&nbsp;</td>
    </tr>
</table>
<?php echo form::close(); ?>