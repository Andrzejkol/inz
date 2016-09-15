<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('delivery_type.edit_delivery_type')
            ))->render(TRUE);
?>
<div id="admin_delivery_type_edit">
    <?php echo form::open(null, array('id' => 'admin_delivery_type_edit_form', 'method' => 'post')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="name"><?php echo Kohana::lang('delivery_type.delivery_type_name'); ?></label>
            </td>
            <td><input type="text" name="delivery_type" id="delivery_type" value="<?php echo $oDeliveryTypeDetails->delivery_type; ?>" /></td>
            <td><div id="delivery_type_error" class="error_message"></div></td>
        </tr>
       <?php /* <tr>
            <td class="td_form_left">
                <label for="delivery_cost"><?php echo Kohana::lang('delivery_type.delivery_cost'); ?></label>
            </td>
            <td>
                <input type="text" name="delivery_cost" id="delivery_cost" value="<?php echo $oDeliveryTypeDetails->delivery_cost; ?>" size="4" />
            </td>
            <td><div id="delivery_cost_error" class="error_message"></div></td>
        </tr> */?>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('pages.language'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'lang', 'id' => 'add_pages_language'), $languages, !empty($_POST['lang']) ? $_POST['lang'] : $oDeliveryTypeDetails->delivery_type_language ); ?></td>
            <td><div id="lang_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="active"><?php echo Kohana::lang('delivery_type.active'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('delivery_type.comments.active'); ?></span>
            </td>
            <td>
                <input type="checkbox" name="active" id="active"<?php echo $oDeliveryTypeDetails->active == 'Y' ? ' checked="checked"' : ''; ?> />
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
		 <tr>
            <td class="td_form_left">
                <label for="cash_on_delivery"><?php echo Kohana::lang('delivery_type.cash_on_delivery'); ?></label>
            </td>
            <td>
                <input type="checkbox" name="cash_on_delivery" id="cash_on_delivery"<?php echo $oDeliveryTypeDetails->cash_on_delivery == '1' ? ' checked="checked"' : ''; ?> />
            </td>
            <td><div id="delivery_error" class="delivery_message"></div></td>
        </tr>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('delivery_type.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('delivery_type.save'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
    </table>
    <?php echo form::close(); ?>

    <div id="delivery_type_edit_title">
        <h2>Przedziały cenowe</h2>
    </div>
    <table class="table_form">
        <tr>
            <td>
                <?php echo form::open_multipart(null, array('method' => 'post')); ?>
                <table id="add_rabates" style="font-size:12px;">
                    <tr>
                        <td>Koszt od (zawarty)</td>
                        <td>Koszt do</td>
                        <td>Koszt przesyłki [zł]</td>
                        <td><span id="add-rabate"><?php echo html::image('img/icons/add.png'); ?> Dodaj kolejny</span></td>
                    </tr>
                    <?php $iQuant = 1; ?>
                    <?php if (!empty($_POST['delivery_price'])): ?>
                        <?php foreach ($_POST['delivery_price'] as $key => $value): ?>
                            <tr id="rabates_<?php echo $iQuant; ?>">
                                <td><input type="text" name="range_from[]" value="<?php echo $_POST['range_from'][$key]; ?>" maxlength="10" /></td>
                                <td><input type="text" name="range_to[]" value="<?php echo $_POST['range_to'][$key]; ?>" maxlength="10" /></td>
                                <td><input type="text" name="delivery_price[]" value="<?php echo $_POST['delivery_price'][$key]; ?>" /></td>
                                <td><?php echo html::image('img/icons/delete.png', array('onclick' => 'javascript:removeRabates(' . $iQuant++ . ');')); ?></td>
                            </tr> 
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr id="rabates_<?php echo $iQuant; ?>">
                            <td><input type="text" name="range_from[]" value="" maxlength="10" /></td>
                            <td><input type="text" name="range_to[]" value="" maxlength="10" /></td>
                            <td><input type="text" name="delivery_price[]" value="" /></td>
                            <td><?php echo html::image('img/icons/delete.png', array('onclick' => 'javascript:removeRabates(' . $iQuant . ');')); ?></td>
                        </tr> 
                    <?php endif; ?>            
                </table>
                <input type="submit" name="add_range" value="<?php echo Kohana::lang('product.save'); ?>" class="btn btn-save"  />
                <?php echo form::close(); ?>
                <script type="text/javascript">
                    //<![CDATA[
                    var rabatesNum = <?php echo $iQuant - 1; ?>;
                    function addMoreRabates() {
                        rabatesNum += 1;
                        $('#add_rabates').append('<tr id="rabates_' + rabatesNum + '"><td><input type="text" name="range_from[]" value="" maxlength="10" /></td><td><input type="text" name="range_to[]" value="" maxlength="10" /></td><td><input type="text" name="delivery_price[]" value="" /></td><td><img src="' + urlBase + 'img/icons/delete.png" onclick="javascript:removeRabates(' + rabatesNum + ');" /></td></tr>');
                    }

                    function removeRabates(num) {
                        rabatesNum -= 1;
                        var iCount = $('#add_rabates tr').length;
                        if(iCount>2) {
                            $('#rabates_' + num).remove();
                        }
                    }

                    $('#add-rabate').click(function() {
                        addMoreRabates();
                    });

                    //]]>
                </script>
            </td>
            <td><div id="images_error" class="images_message"></div></td>
        </tr>
        <tr>
            <td colspan="3">
                <?php if (!empty($oDeliveryRanges) && $oDeliveryRanges->count() > 0): ?>
                    <div id="delivery_ranges_list" style="margin: 3px; text-align: center; overflow: hidden;">
                        <table>
                            <tr>
                                <th>Koszt od (zawarty)</th>
                                <th>Koszt do</th>
                                <th>Koszt przesyłki [zł]</th>
                                <th>Opcje</th>
                            </tr>

                            <?php foreach ($oDeliveryRanges as $oRange): ?>
                                <tr>
                                    <td><?php echo $oRange->range_from; ?></td>
                                    <td><?php echo $oRange->range_to; ?></td>
                                    <td><?php echo $oRange->delivery_price; ?></td>
                                    <td><?php echo html::anchor('4dminix/przedzial-usun/' . $oRange->id_shop_delivery_ranges . '/' . $oDeliveryTypeDetails->id_delivery_type, 'Usuń', array('class' => 'delete_button', 'title' => 'Czy na pewno chcesz usunąć przedział?')); ?></td>
                                </tr>
                                <tr>
                                <?php endforeach; ?>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="info">Brak zdefiniowanych przedziałów cenowych.</div>
                <?php endif; ?>
            </td>
        </tr>

    </table>
</div>