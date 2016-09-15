<?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")) ?>
<table class="table_form">
    <tr>
        <td class="td_form_left td_form_top">
            <script type="text/javascript">
                $(function () {
                    function log(message, value) {
                        if (message.length > 0) {
                            //                                        $("#related_product_suggest").val(value)
                            $("#related_products").append(message);
                            $("#related_products").attr("scrollTop", 0);
                        }
                    }

                    $("#related_product_suggest").autocomplete({
                        source: urlBase + "products_ajax/search",
                        minLength: 3,
                        select: function (event, ui) {
//                                        var tmp = [];
//                                        $('#related_products').each(function (i, opt) {
//                                            tmp.push($(opt).val());
//                                        });
//                                        if (tmp.indexOf(ui.item.value)) {
//                                            alert('Podany produkt już znajduje się na liście.');
//                                            $("#related_product_suggest").val('');
//                                            return false;
//                                        }
                            log(ui.item ? ('<option value="' + ui.item.id + '">' + ui.item.label + '</option>') : "", '');
                        }
                    });
                });
            </script>
            <label for="related_products"><?php echo Kohana::lang('product.related_products'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.related_products'); ?></span><br />
            <span class="label_comment"><?php echo Kohana::lang('product.releted_products_info') ?></span>
        </td>
        <td>
            <input type="text" id="related_product_suggest" style="width: 400px;" /><br /><br />
            <select name="related_products[]" id="related_products" size="10" multiple="multiple" class="ui-widget-content" style="width: 400px">
                <?php foreach ($oRelatedProducts as $rp): ?>
                    <option value="<?php echo $rp->product_id; ?>"><?php echo $rp->product_name; ?></option>
                <?php endforeach; ?>
            </select>
            <script type="text/javascript">
                $('#related_products *').attr('selected', 'selected');
            </script>
        </td>
        <td><div id="related_products_error" class="error_message"></div></td>
    </tr>
</table>
<input type="hidden" name="submit_tab" value="submit_tab_9" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  />
<?php echo form::close(); ?>