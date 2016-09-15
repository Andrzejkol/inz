<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'edit',
            'sTitle' => Kohana::lang('order.edit_order')
        ))->render(TRUE);
?>
<div id="admin_order_edit">
    <div>
        <fieldset class="half equal-height">
            <legend><?php echo Kohana::lang('order.order_details'); ?></legend>
            <table class="order_details">
                <tr>
                    <th><?php echo Kohana::lang('order.order_number'); ?>:</th>
                    <td><?php echo $oOrderDetails[0]->order_number; ?></td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('shop_admin.order.order_currency'); ?>:</th>
                    <td><?php echo $oOrderDetails[0]->currency; ?></td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.order_cost'); ?>:</th>
                    <td>
                        <span class="order_cost" style="<?php echo ($oOrderDetails[0]->paid == 'Y') ? 'color:green;' : 'color:red;'; ?>" >
                            <?php
                            if ($oOrderDetails[0]->currency != 'zł' && $oOrderDetails[0]->currency != 'PLN') {
                                echo shop::ShowAlterCurrency($oOrderDetails[0]->order_cost) . ' (' . $oOrderDetails[0]->order_cost . ' PLN)';
                            } else {
                                echo $oOrderDetails[0]->order_cost;
                            }
                            ?>                        
                        </span><br/>
                        <?php /* echo Kohana::lang('order.paid_'.$oOrderDetails[0]->paid); */ ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.products_cost'); ?>:</th>
                    <td><?php
                        if ($oOrderDetails[0]->currency != 'zł' && $oOrderDetails[0]->currency != 'PLN') {
                            echo shop::ShowAlterCurrency($oOrderDetails[0]->products_cost) . ' (' . $oOrderDetails[0]->products_cost . ' PLN)';
                        } else {
                            echo $oOrderDetails[0]->products_cost;
                        }
                        ?></td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.delivery_type'); ?>:</th>
                    <td><?php echo $oOrderDetails[0]->delivery_type; ?></td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.delivery_cost'); ?>:</th>
                    <td>
                        <?php
                        if ($oOrderDetails[0]->currency != 'zł' && $oOrderDetails[0]->currency != 'PLN') {
                            echo shop::ShowAlterCurrency($oOrderDetails[0]->delivery_cost) . ' (' . $oOrderDetails[0]->delivery_cost . ' PLN)';
                        } else {
                            echo $oOrderDetails[0]->delivery_cost;
                        }
                        ?>      
                    </td>
                </tr>
                <tr>
                    <th>Kod rabatowy:</th>
                    <td><strong><?php echo $oOrderDetails[0]->rebate_code; ?> -  <?php echo $oOrderDetails[0]->rebate_value; ?>%</strong></td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.payment_type'); ?>:</th>
                    <td><?php echo $oOrderDetails[0]->payment_type_name; ?></td>
                </tr>
                <?php /*
                  <tr>
                  <th><?php echo Kohana::lang('order.payment_cost'); ?>:</th>
                  <td><?php echo $oOrderDetails[0]->payment_cost; ?></td>
                  </tr> */ ?>
                <tr>
                    <th><?php echo Kohana::lang('order.invoice'); ?>:</th>
                    <td><?php echo Kohana::lang('order.' . $oOrderDetails[0]->invoice); ?></td>
                </tr>

                <tr>
                    <th><?php echo Kohana::lang('order.order_date'); ?>:</th>
                    <td><?php echo date(config::DATE_TIME_FORMAT, $oOrderDetails[0]->order_date); ?></td>
                </tr>
                <?php /*
                  <tr>
                  <th><?php echo Kohana::lang('order.confirm_date'); ?>:</th>
                  <td><?php if(!empty($oOrderDetails[0]->confirmation_date)) { echo date(config::DATE_TIME_FORMAT, $oOrderDetails[0]->confirmation_date); } ?></td>
                  </tr>
                 */
                ?>
                <tr>
                    <th><?php echo Kohana::lang('order.customer_note'); ?></th>
                    <td><?php echo $oOrderDetails[0]->customer_note; ?></td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.protection'); ?></th>
                    <td><?php echo $oOrderDetails[0]->protection=='1'?'Tak':'Nie'; ?></td>
                </tr>
            </table>
        </fieldset>
        <fieldset class="half equal-height">
            <legend><?php echo Kohana::lang('order.customer_details'); ?></legend>
            <table class="order_invoice_details">
                <tr>
                    <th><?php echo Kohana::lang('order.first_name'); ?></th><td><?php echo $oCustomerDetails[0]->customer_first_name; ?></td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.last_name'); ?></th><td><?php echo $oCustomerDetails[0]->customer_last_name; ?></td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.mail'); ?></th><td><?php echo $oCustomerDetails[0]->customer_email; ?></td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.phone_no'); ?></th><td><?php echo $oCustomerDetails[0]->customer_phoneno; ?></td>
                </tr>
                <?php /*
                  <tr>
                  <th><?php echo Kohana::lang('order.company_name'); ?></th><td><?php echo $oCustomerDetails[0]->customer_company_name; ?></td>
                  </tr>
                  <tr>
                  <th><?php echo Kohana::lang('order.nip'); ?></th><td><?php echo $oCustomerDetails[0]->customer_nip; ?></td>
                  </tr> */ ?>
                <tr>
                    <th><?php echo Kohana::lang('order.city'); ?></th><td><?php echo $oCustomerDetails[0]->customer_city; ?></td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.zip'); ?></th><td><?php echo $oCustomerDetails[0]->customer_zip; ?></td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.address'); ?></th><td><?php echo $oCustomerDetails[0]->customer_address; ?></td>
                </tr>

                <tr>
                    <th><?php echo Kohana::lang('order.state'); ?></th><td><?php echo (isset($oCustomerDetails[0]->customer_state) ? $aStates[$oCustomerDetails[0]->customer_state] : ''); ?></td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.country'); ?></th><td><?php echo $oCustomerDetails[0]->customer_country; ?></td>
                </tr>
                 <tr>
                    <th><?php echo Kohana::lang('shop_app.customer.type'); ?></th><td><?php echo $oCustomerDetails[0]->customer_type=='1'?"Konto biznesowe":"Konto indywidualne"; ?></td>
                </tr>
            </table>
        </fieldset>
        <?php if ($oCustomerDetails[0]->delivery == 'Y'): ?>
            <fieldset>
                <legend><?php echo Kohana::lang('order.delivery_details'); ?></legend>
                <table class="order_delivery_address_details">
                    <tr>
                        <th><?php echo Kohana::lang('order.first_name'); ?></th><td><?php echo $oCustomerDetails[0]->delivery_first_name; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.last_name'); ?></th><td><?php echo $oCustomerDetails[0]->delivery_last_name; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.company_name'); ?></th><td><?php echo $oCustomerDetails[0]->delivery_company_name; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.mail'); ?></th><td><?php echo $oCustomerDetails[0]->delivery_email; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.phone_no'); ?></th><td><?php echo $oCustomerDetails[0]->delivery_phoneno; ?></td>
                    </tr>
                    <?php /*
                      <tr>
                      <th><?php echo Kohana::lang('order.nip'); ?></th><td><?php echo $oCustomerDetails[0]->delivery_nip; ?></td>
                      </tr> */ ?>
                    <tr>
                        <th><?php echo Kohana::lang('order.city'); ?></th><td><?php echo $oCustomerDetails[0]->delivery_city; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.zip'); ?></th><td><?php echo $oCustomerDetails[0]->delivery_zip; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.address'); ?></th><td><?php echo $oCustomerDetails[0]->delivery_address; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.state'); ?></th><td><?php echo (isset($oCustomerDetails[0]->delivery_state) ? $aStates[$oCustomerDetails[0]->delivery_state] : ''); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.country'); ?></th><td><?php echo $oCustomerDetails[0]->delivery_country; ?></td>
                    </tr>
                </table>
            </fieldset>
        <?php endif; ?>
        <?php if ($oCustomerDetails[0]->invoice == 'Y'): ?>
            <fieldset>
                <legend><?php echo Kohana::lang('order.invoice_details'); ?></legend>
                <table class="order_invoice_details">
                    <tr>
                        <th><?php echo Kohana::lang('order.first_name'); ?></th><td><?php echo $oCustomerDetails[0]->invoice_first_name; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.last_name'); ?></th><td><?php echo $oCustomerDetails[0]->invoice_last_name; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.company_name'); ?></th><td><?php echo $oCustomerDetails[0]->invoice_company_name; ?></td>
                    </tr>

                    <tr>
                        <th><?php echo Kohana::lang('order.nip'); ?></th><td><?php echo $oCustomerDetails[0]->invoice_nip; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.city'); ?></th><td><?php echo $oCustomerDetails[0]->invoice_city; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.zip'); ?></th><td><?php echo $oCustomerDetails[0]->invoice_zip; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.address'); ?></th><td><?php echo $oCustomerDetails[0]->invoice_address; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.state'); ?></th><td><?php echo (isset($oCustomerDetails[0]->invoice_state) ? $aStates[$oCustomerDetails[0]->invoice_state] : ''); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo Kohana::lang('order.country'); ?></th><td><?php echo $oCustomerDetails[0]->invoice_country; ?></td>
                    </tr>
                </table>
            </fieldset>
        <?php endif; ?>
        <fieldset class="half">
            <legend><?php echo Kohana::lang('order.paid_status_details'); ?></legend>
            <?php echo form::open(null, array('method' => 'post')); ?>
            <table class="order_change_state_details">
                <tr>
                    <th><?php echo Kohana::lang('order.paid'); ?></th>
                    <td>
                        <?php $aPayStatuses = array('Y' => 'Tak', 'N' => 'Nie'); ?>
                        <?php echo form::dropdown(array('name' => 'paid', 'id' => 'paid'), $aPayStatuses, !empty($_POST['paid']) ? $_POST['paid'] : !empty($oOrderDetails[0]->paid) ? $oOrderDetails[0]->paid : ''); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" id="paid_submit" name="paid_submit" value="<?php echo Kohana::lang('order.change_paid_state'); ?>" />
                    </td>
                </tr>
            </table>
            <?php echo form::close(); ?>
        </fieldset>
        <fieldset class="half">
            <legend><?php echo Kohana::lang('order.order_status_details'); ?></legend>
            <?php echo form::open(null, array('method' => 'post')); ?>
            <table class="order_change_state_details">
                <tr>
                    <th><?php echo Kohana::lang('order.current_status'); ?></th>
                    <td>
                        <?php echo form::dropdown(array('name' => 'orders_status_search', 'id' => 'orders_status_search'), $aOrdersStatuses, !empty($_POST['orders_status_search']) ? $_POST['orders_status_search'] : !empty($oOrderDetails[0]->status_id) ? $oOrderDetails[0]->status_id : ''); ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo Kohana::lang('order.comments_edit'); ?></th>

                    <td>
                        <textarea name="orders_comments_edit" id="orders_comments_edit" rows="5" cols="28"><?php echo $oOrderDetails[0]->delivery_comments; ?></textarea> 
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="cmd" value="change_state" />
                        <input type="submit" id="change_state_submit" name="change_state_submit" value="<?php echo Kohana::lang('order.change_state'); ?>" />
                    </td>
                </tr>
            </table>
            <?php echo form::close(); ?>
        </fieldset>
    </div>
    <fieldset>
        <legend><?php echo Kohana::lang('order.order_products_details'); ?></legend>
        <table class="order_products_details" cellspacing="0">
            <tr>
                <td>ID</td>
                <td>Zdjęcie</td>
                <td>Produkt</td>
                <td>Cena</td>
                <td>Ilość</td>
                <?php /* <td>Rabat</td> */ ?>
                <td>Suma</td>
            </tr>
            <?php foreach ($oOrdersProducts as $oOP) : ?>
                <tr>
                    <td><?php echo html::anchor('produkt/' . $oOP->product_id . '/' . string::prepareURL($oOP->product_name), $oOP->product_id, array('target' => '_blank')); ?></td>
                    <td class="thumb">
                        <?php //echo html::anchor('produkt/' . $oOP->product_id . '/' . string::prepareURL($oOP->product_name), html::image(Product_Model::PRODUCT_IMG_SMALL . $oOP->filename, array('alt' => $oOP->product_name)), array('target' => '_blank')); ?>
                        <?php if (!empty($oOP->filename)): ?>
                            <?php echo html::image(shop::XSMALL_PATH .$oOP->filename, array('alt' => $oOP->product_name)); ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <strong><?php echo $oOP->product_name; ?></strong><br/>
                        <?php
                        //var_dump($oOP);
                        if (!empty($oOP->product_attributes)) {
                            $aAttr = explode(';', $oOP->product_attributes);
                            foreach ($aAttr as $aA) {
                                $aVals = explode(':', $aA);
                                echo $aProductAttr[$aVals[0]] . ': ' . $aVals[1] . '<br/>';
                            }
                        }
                        if(!empty($oOP->order_product_id)) {
                        Voucher_Model::VoucherInfo($oOP->order_product_id);
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($oOrderDetails[0]->currency != 'zł' && $oOrderDetails[0]->currency != 'PLN') {
                            echo shop::ShowAlterCurrency($oOP->product_price) . ' (' . $oOP->product_price . ' PLN)';
                        } else {
                            echo $oOP->product_price;
                        }
                        ?>                        
                    <td><?php echo $oOP->product_count; ?></td>
                    <?php /* <td><?php echo $oOP->product_rebate + 0; ?>%</td> */ ?>
                    <td>
                        <?php
                        $Price = $oOP->product_price - ((($oOP->product_rebate + 0) / 100) * $oOP->product_price);

                        if ($oOrderDetails[0]->currency != 'zł' && $oOrderDetails[0]->currency != 'PLN') {
                            echo shop::ShowAlterCurrency(number_format($oOP->product_count * $Price, '2', '.', '')) . ' (' . number_format($oOP->product_count * $Price, '2', '.', '') . ' PLN)';
                        } else {
                            echo number_format($oOP->product_count * $Price, '2', '.', '');
                        }
                        ?>                         
                        <?php //echo number_format($oOP->product_count * $oOP->product_price, '2', '.', ''); ?></td>
                    
                </tr>
            <?php endforeach; ?>
        </table>
    </fieldset>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var max = 0;
        $('.equal-height').each(function () {
            max = $(this).height()>max ? $(this).height():max;
        });
        
        $('.equal-height').each(function () {
           $(this).css('height',max); 
        });
    });
</script>