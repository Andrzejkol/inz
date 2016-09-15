<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'add',
            'sTitle' => Kohana::lang('product.add_product')
        ))->render(TRUE);
?>
<div id="admin_product_add">
    <script type="text/javascript">
        //<![CDATA[
        function requestAjax() {
            var retValue = false;
            var dataString =
                    'name=' + encodeURIComponent($('#name').val())
                    //+ '&short_description=' + encodeURIComponent($('#short_description').val())
                    + '&description=' + encodeURIComponent(tinyMCE.get('description').getContent());
            $('.error_message').hide();
            $.ajax({
                type: "POST",
                url: "../products_ajax/validate_product_add",
                data: dataString,
                async: false,
                success: function (serverResponse) {
                    var valid = serverResponse.getElementsByTagName('validation');
                    var errorsCount = valid[0].getAttribute('counter');
                    if (errorsCount > 0) {
                        var mainElement = serverResponse.getElementsByTagName('error');
                        for (i = 0; i < mainElement.length; ++i) {
                            var att = mainElement[i].getAttribute('id');
                            att = '#' + att + '_error';
                            $(att).html(mainElement[i].firstChild.nodeValue);
                            $(att).show();
                        }
                    } else {
                        retValue = true;
                    }
                }
            });
            return retValue;
        }
        //]]>
    </script>
    <div id="product_add_title">
        <h2><?php echo Kohana::lang('product.add_product'); ?></h2>
    </div>
    <?php echo form::open_multipart(null, array('id' => 'admin_product_add_form', 'method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="product_name"><?php echo Kohana::lang('product.product_name'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product.comments.product_name') . ' ' . Kohana::lang('product.comments.field_required'); ?></span>
            </td>
            <td><input type="text" name="product_name" id="product_name" value="<?php
                if (!empty($_POST['product_name'])) {
                    echo $_POST['product_name'];
                }
                ?>" /></td>
            <td><div id="product_name_error" class="error_message"></div></td>
        </tr>
        <?php /*
          <tr>
          <td class="td_form_left">
          <label for="product_name"><?php echo Kohana::lang('product.product_name'); ?> - en</label>
          <span class="label_comment"><?php echo Kohana::lang('product.comments.product_name') . ' ' . Kohana::lang('product.comments.field_required'); ?></span>
          </td>
          <td><input type="text" name="product_name_en" id="product_name_en" value="<?php if(!empty($_POST['product_name_en'])) { echo $_POST['product_name_en']; } ?>" /></td>
          <td><div id="product_name_error" class="error_message"></div></td>
          </tr>
         * 
         */
        ?>
        <tr>
            <td class="td_form_left">
                <label for="price"><?php echo Kohana::lang('product.product_price'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product.comments.product_price'); ?></span>
            </td>
            <td>
                <input type="text" name="price" id="price" value="<?php
                if (!empty($_POST['price'])) {
                    echo $_POST['price'];
                }
                ?>" />

                <select name="tax_id" id="tax_id" onchange="javascript:countPrice();">
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
                    }
                    ?>"  /></td>
                <td><div id="product_stock_error" class="error_message"></div></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td class="td_form_left">
                <label for="code"><?php echo Kohana::lang('product.product_code'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product.comments.product_code'); ?></span>
            </td>
            <td><input type="text" name="code" id="code" value="<?php
                if (!empty($_POST['code'])) {
                    echo $_POST['code'];
                }
                ?>"  /></td>
            <td><div id="code_error" class="error_message"></div></td>
        </tr>
        <!--
        <tr>
            <td class="td_form_left">
                <label for="ean"><?php echo Kohana::lang('product.product_ean'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product.comments.product_ean'); ?></span>
            </td>
            <td><input type="text" name="ean" id="ean"  value="<?php
        if (!empty($_POST['ean'])) {
            echo $_POST['ean'];
        }
        ?>" /></td>
            <td><div id="product_ean_error" class="error_message"></div></td>
        </tr>
        -->
        <?php /*
          <tr>
          <td class="td_form_left">
          <label for="date_expire"><?php echo Kohana::lang('product.date_expire'); ?></label>
          <span class="label_comment"><?php echo Kohana::lang('product.comments.date_expire'); ?></span>
          </td>
          <td><input type="text" name="date_expire" id="date_expire" value="<?php if(!empty($_POST['date_expire'])) { echo $_POST['date_expire']; } ?>" /></td>
          <td><div id="date_expire_error" class="error_message"></div></td>
          </tr>
          <tr>
          <td class="td_form_left">
          <label for="ask_for_price"><?php echo Kohana::lang('product.ask_for_price'); ?></label>
          <span class="label_comment"><?php echo Kohana::lang('product.comments.ask_for_price'); ?></span>
          </td>
          <td><input type="checkbox" name="ask_for_price" id="ask_for_price" <?php if(!empty($_POST['ask_for_price'])) { echo 'checked="checked"'; } ?> /></td>
          <td><div id="ask_for_price_error" class="error_message"></div></td>
          </tr>
          <tr>
          <td class="td_form_left">
          <label for="hide_price"><?php echo Kohana::lang('product.hide_price'); ?></label>
          <span class="label_comment"><?php echo Kohana::lang('product.comments.hide_price'); ?></span>
          </td>
          <td><input type="checkbox" name="hide_price" id="hide_price" <?php if(!empty($_POST['hide_price'])) { echo 'checked="checked"'; } ?> /></td>
          <td><div id="hide_price_error" class="error_message"></div></td>
          </tr>
         */ ?>
        <tr>
            <td class="td_form_left td_form_top">
                <label for="short_description"><?php echo Kohana::lang('product.short_description'); ?></label>
                <span class="label_comment"><?php //echo Kohana::lang('product.comments.short_description');       ?></span>
            </td>
            <td><textarea name="short_description" class="tinyText" id="short_description" rows="5" cols="40"><?php
                    if (!empty($_POST['short_description'])) {
                        echo $_POST['short_description'];
                    }
                    ?></textarea></td>
            <td><div id="short_description_error" class="error_message"></div></td>
        </tr>   
        <?php
        /*
          <tr>
          <td class="td_form_left td_form_top">
          <label for="short_description"><?php echo Kohana::lang('product.short_description'); ?> - en</label>
          <span class="label_comment"><?php echo Kohana::lang('product.comments.short_description'); ?></span>
          </td>
          <td><textarea name="short_description_en" id="short_description_en" rows="5" cols="40"><?php if(!empty($_POST['short_description_en'])) { echo $_POST['short_description_en']; } ?></textarea></td>
          <td><div id="short_description_error" class="error_message"></div></td>
          </tr>
         */
        ?>
        <tr>
            <td class="td_form_left td_form_top">
                <label for="description"><?php echo Kohana::lang('product.description'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product.comments.description'); ?></span>
            </td>
            <td><textarea name="description" class="tinyText" id="description" rows="5" cols="40"><?php
                    if (!empty($_POST['description'])) {
                        echo $_POST['description'];
                    }
                    ?></textarea></td>
            <td><div id="description_error" class="error_message"></div></td>
        </tr>
        <?php /*
          <tr>
          <td class="td_form_left td_form_top">
          <label for="description"><?php echo Kohana::lang('product.description'); ?> - en</label>
          <span class="label_comment"><?php echo Kohana::lang('product.comments.description'); ?></span>
          </td>
          <td><textarea name="description_en" id="description_en" rows="5" cols="40"><?php if(!empty($_POST['description_en'])) { echo $_POST['description_en']; } ?></textarea></td>
          <td><div id="description_error" class="error_message"></div></td>
          </tr>

          <tr>
          <td class="td_form_left td_form_top">
          <label for="product_media"><?php echo Kohana::lang('product.product_media'); ?></label>
          <span class="label_comment"><?php echo Kohana::lang('product.comments.product_media'); ?></span>
          </td>
          <td>
          <textarea name="product_media" id="product_media" rows="5" cols="60"><?php if(!empty($_POST['product_media'])) { echo $_POST['product_media']; } ?></textarea>
          </td>
          <td><div id="product_media_error" class="error_message"></div></td>
          </tr> */ ?>
        <tr>
            <td class="td_form_left td_form_top">
                <label for="category_id"><?php echo Kohana::lang('product.category'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product.comments.category'); ?></span>
            </td>
            <td>
                <select name="category_id[]" id="category_id" multiple="multiple" size="10">
                    <?php echo!empty($oProductCategories) ? $oProductCategories : ''; ?>
                </select>
            </td>
            <td><div id="description_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('product.product_availability'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product.comments.product_availability'); ?></span>
            </td>
            <td>
                <select id="active" name="active">
                    <option value="Y" <?php
                    if (!empty($_POST['active']) && $_POST['active'] == 'Y') {
                        echo 'selected="selected"';
                    }
                    ?>><?php echo Kohana::lang('product.yes'); ?></option>
                    <option value="N" <?php
                    if (!empty($_POST['active']) && $_POST['active'] == 'N') {
                        echo 'selected="selected"';
                    }
                    ?>><?php echo Kohana::lang('product.no'); ?></option>
                </select>
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="status_id"><?php echo Kohana::lang('product.product_status_id'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product.comments.product_status_id'); ?></span>
            </td>
            <td>
                <select name="product_status_id" id="product_status_id">
                    <?php foreach ($oProductStatuses as $ps): ?>
                        <option value="<?php echo $ps->id_product_status; ?>" <?php
                        if (!empty($_POST['product_status_id']) && $_POST['product_status_id'] == $ps->id_product_status) {
                            echo 'selected="selected"';
                        }
                        ?>><?php echo $ps->product_status_name; ?></option>
                            <?php endforeach; ?>
                </select>
            </td>
            <td><div id="product_status_id_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="producer_id"><?php echo Kohana::lang('product.producer'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product.comments.producer'); ?></span>
            </td>
            <td>
                <select id="producer_id" name="producer_id">
                    <?php foreach ($oProducers as $pp): ?>
                        <option value="<?php echo $pp->id_producer; ?>" <?php
                        if (!empty($_POST['producer_id']) && $_POST['producer_id'] == $pp->id_producer) {
                            echo 'selected="selected"';
                        }
                        ?>><?php echo $pp->producer_name; ?></option>
                            <?php endforeach; ?>
                </select>
            </td>
            <td><div id="product_name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="new"><?php echo Kohana::lang('product.set_in_new'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product.comments.set_in_new'); ?></span>
            </td>
            <td><input type="checkbox" name="new" id="new" <?php
                if (!empty($_POST['new'])) {
                    echo 'checked="checked"';
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
                <td><input type="checkbox" name="product_allow_rabate" id="product_allow_rabate" <?php
                    if (!empty($_POST['product_allow_rabate'])) {
                        echo 'checked="checked"';
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
                    if (!empty($_POST['voucher'])) {
                        echo 'checked="checked"';
                    }
                    ?> value="1" /></td>
                <td><div id="new_error" class="error_message"></div></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td class="td_form_left">
                <label for="product_position"><?php echo Kohana::lang('product.position'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product.comments.position'); ?></span>
            </td>
            <td><input type="text" name="product_position" id="product_position" value="<?php
                if (!empty($_POST['product_position'])) {
                    echo $_POST['product_position'];
                }
                ?>" /></td>
            <td><div id="new_error" class="error_message"></div></td>
        </tr>
        <?php /*
          <tr>
          <td class="td_form_left">
          <label for="quantity_tracking"><?php echo Kohana::lang('product.quantity_tracking'); ?></label>
          <span class="label_comment"><?php echo Kohana::lang('product.comments.quantity_tracking'); ?></span>
          </td>
          <td><input type="checkbox" name="quantity_tracking" id="quantity_tracking" <?php if(!empty($_POST['quantity_tracking'])) { echo 'checked="checked"'; } ?> /></td>
          <td><div id="quantity_tracking_error" class="error_message"></div></td>
          </tr>
          <tr>
          <td class="td_form_left">
          <label for="quantity"><?php echo Kohana::lang('product.quantity'); ?></label>
          <span class="label_comment"><?php echo Kohana::lang('product.comments.quantity'); ?></span>
          </td>
          <td><input type="text" name="quantity" id="quantity" value="<?php if(!empty($_POST['quantity'])) { echo $_POST['quantity']; } ?>" /></td>
          <td><div id="quantity_error" class="error_message"></div></td>
          </tr>
         *
         */ ?>
        <tr>
            <td class="td_form_left">
                <label for="images" id="show_images_panel"><?php echo Kohana::lang('product.product_images'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('product.comments.product_images'); ?></span>
            </td>
            <td>
                <div id="images">
                    <?php for ($i = 0; $i < shop::PRODUCT_IMAGES_LIMIT; ++$i): ?>
                        <input type="file" name="images[]" id="images_1" style="margin: 3px; background-color: #fff; color: #000;" /> <?php echo html::image('img/icons/add.png', array('id' => 'more_image_btn', 'onclick' => "javascript:addMoreImages();")); ?><br />
                    <?php endfor; ?>
                </div>
                <script type="text/javascript">
                    //<![CDATA[
                    var globalNum = 1;
                    function addMoreImages() {
                        globalNum += 1;
                        $('#images').append('<div id="images_' + globalNum + '"><input type="file" name="images[]" style="margin: 3px; background-color: #fff; color: #000;" /> <?php echo html::image('img/icons/delete.png', array('class' => 'remove_image_btn', 'onclick' => "javascript:removeImages('+globalNum+');")); ?></div>');
                    }

                    function removeImages(num) {
                        globalNum -= 1;
                        $('#images_' + num).remove();
                    }
                    //]]>
                </script>
            </td>
            <td><div id="images_error" class="images_message"></div></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save"  /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>
</div>