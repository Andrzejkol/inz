<?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
<table class="table_form"><?php /*
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
  $('#images').append('<div id="images_' + globalNum + '"><input type="file" name="images[]" style="margin: 3px; background-color: #fff; color: #000;" /></div>');
  }

  function removeImages(num) {
  globalNum -= 1;
  $('#images_' + num).remove();
  }
  //]]>
  </script>
  </td>
  <td><div id="images_error" class="images_message"></div></td>
  </tr> */ ?>
    <tr>
        <td class="td_form_left td_form_top">
            <label for="attributes"><?php echo Kohana::lang('product.attributes'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.attributes'); ?></span>
        </td>
        <td><table>
                <?php foreach ($oOnlyAttributes as $key => $ak) { ?>
                    <tr>
                        <td class="td_form_left"><?php echo $ak; ?></td>
                        <td><select name="attr_<?php echo $key; ?>">
                                <option>wybierz</option>
                                <?php
                                foreach ($oAttributes as $a) {
                                    if ($key == $a->attribute_id) {
                                        ?>
                                        <option value="<?php echo $a->attribute_value_id; ?>"><?php echo $a->attribute_value; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select></td><tr>
                        <?php
                    }
                    ?>
            </table></td>
        <td><div id="images_error" class="images_message"></div></td>
    </tr>
    <tr>
        <td><label>Ilość</label></td>
        <td><input type="text" name="quantity" value="0" /></td>
    </tr>
    <tr>
        <td colspan="3">
            <table class="table_view">
                <tr>
                    <th>#</th>
                    <?php //<th>Zdjęcie</th> ?>
                    <th>Wariant</th>
                    <th>Ilość</th>
                    <th>Opcje</th>
                </tr>
                <?php
                if (!empty($oProductVariants) && $oProductVariants->count() > 0):
                    foreach ($oProductVariants as $pv):
                        ?>
                        <tr>
                            <td><?php echo $pv->variant_id; ?></td>
                            <?php /* <td><?php echo html::image(shop::SMALL_PATH . $pv->filename); ?></td> */ ?>
                            <td>
                                <?php
                                $tmp = unserialize($pv->variant_values);
                                foreach ($tmp as $key => $value) {
                                    echo $oOnlyAttributes[$key] . ': ';
                                    foreach ($oAttributes as $aa) {
                                        if ($aa->attribute_value_id == $value) {
                                            echo $aa->attribute_value;
                                        }
                                    }
                                    echo '<br>';
                                }
                                ?>
                            </td>
                            <td><?php echo $pv->quantity; ?></td>
                            <td>

                                <?php
                                echo html::anchor('4dminix/usun_wariant/' . $pv->id_variant . '/' . $oProductDetails->id_product, html::image('img/icons/delete.gif', array('alt' => 'Usuń')));
                                ?>

                            </td></tr>
                        <?php
                    endforeach;
                endif;
                ?>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="submit_tab" value="submit_tab_15" />
            <input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="btn btn-save"  /></td>
        <td>&nbsp;</td>
    </tr>
</table>
<?php echo form::close(); ?>