<?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
<table class="table_form">
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
    </tr>
    <tr>
        <td colspan="3">
            <div id="product_images" style="width: 462px; border: 1px solid #000; margin: 3px; text-align: center; overflow: hidden;">
                <?php if (!empty($oProductImages) && $oProductImages->count() > 0): ?>
                    <?php foreach ($oProductImages as $img): ?>
                        <div class="image">
                            <?php echo html::image(Product_Model::PRODUCT_IMG_SMALL . $img->filename, array('alt' => $img->filename)); ?>
                            <div id="del_image_chb"><input type="checkbox" id="delImage_<?php echo $img->id_image; ?>" name="delImage[<?php echo $img->filename; ?>]" /><label for="delImage_<?php echo $img->filename; ?>"> <?php echo Kohana::lang('product.delete_image'); ?></label></div>
                            <div id="del_image_rdb"><input type="radio" id="mainImage_<?php echo $img->id_image; ?>" name="mainimage" value="<?php echo $img->id_image; ?>"<?php
                                if ($img->mainimage == 'Y') {
                                    echo ' checked="checked"';
                                }
                                ?> /><label for="mainImage_<?php echo $img->id_image; ?>"> <?php echo Kohana::lang('product.main_image'); ?></label></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="submit_tab" value="submit_tab_3" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="btn btn-save"  /></td>
        <td>&nbsp;</td>
    </tr>
</table>
<?php echo form::close(); ?>