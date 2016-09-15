<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('product_category.edit_category')
            ))->render(TRUE);
?>
<div id="product_category_edit">
    <script type="text/javascript">
        //<![CDATA[
        function requestAjax() {
            var retValue = false;
            var dataString = 'name=' + encodeURIComponent($('#name').val()) + '&product_category_id=' + encodeURIComponent($('#product_category_id').val());
            $('.error_message').hide();
            $.ajax({
                type: "POST",
                url: "../../products_categories_ajax/validate_product_category_edit",
                data: dataString,
                async: false,
                success: function(serverResponse) {
                    var valid = serverResponse.getElementsByTagName('validation');
                    var errorsCount = valid[0].getAttribute('counter');
                    if(errorsCount > 0) {
                        var mainElement = serverResponse.getElementsByTagName('error');
                        for(i = 0 ; i < mainElement.length ; ++i) {
                            var att = mainElement[i].getAttribute('id');
                            att = '#'+att+'_error';
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
    <?php echo form::open_multipart(null, array('id' => 'validate_product_category_add', 'method' => 'post', 'onsubmit' => 'javascript:return requestAjax();')); ?>
    <?php foreach($oProductCategoryDetails as $c) { 
     //$c = $oProductCategoryDetails;          
     ?>
    <table class="table_form">
        <?php /*
        <tr>
            <td class="td_form_left"><label for="name"><?php echo Kohana::lang('product_category.category_name').' - EN'; ?></label></td>
            <td>
                <p><input type="text" id="name" name="name_en" value="<?php echo $c->category_name; ?>" /></p>                                            
            </td>
            <td><div id="name_error" class="error_message"></div>
        </tr>        
         */
        ?>
        <tr>
            <td class="td_form_left"><label for="name"><?php echo Kohana::lang('product_category.category_name'); ?></label></td>
            <td style="position: relative;">                
                <input type="text" id="name" name="category_name" value="<?php if(!empty($c->category_name)){echo $c->category_name;} ?>" />
                <?php echo languages::ShowTranslationBox('category', $c->category_id, 'input');?>
            </td>
            <td><div id="name_error" class="error_message"></div>
        </tr>
        
        <tr>
            <td class="td_form_left"><label for="parent_category_id"><?php echo Kohana::lang('product_category.parent_category'); ?></label></td>
            <td>
                <select id="parent_category_id" name="parent_category_id" style="width: 300px;">
                    <option value="0"><?php echo Kohana::lang('product_category.choose').'...'; ?></option>
                        <?php if(!empty($oProductsCategories)) {
                            echo $oProductsCategories;
                        } ?>
                </select>
            </td>
            <td>&ensp;</td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="actives"><?php echo Kohana::lang('product_category.category_status'); ?></label>
            </td>
            <td>
                <select id="active" name="active">
                    <option value="Y" <?php echo ($c->active == 'Y') ? 'selected=selected' : '' ?>><?php echo Kohana::lang('product_category.available'); ?></option>
                    <option value="N" <?php echo ($c->active == 'N') ? 'selected=selected' : '' ?>><?php echo Kohana::lang('product_category.unavailable'); ?></option>
                </select>
            </td>
            <td><div id="active_error" class="error_message"></div></td>
        </tr>
         <tr>
            <td class="td_form_left"><label for="page"><?php echo Kohana::lang('product_category.category_page'); ?></label></td>
            <td><input type="text" id="page" name="category_page"  value="<?php if(!empty($c->category_page)){echo $c->category_page;} ?>"/>            
            </td>
            <td><div id="name_error" class="error_message"></div>
        </tr>
        <tr>
            <td class="td_form_left"><label for="images"><?php echo Kohana::lang('product_category.category_image'); ?> (slider kategorii)</label></td>
            <td>
                <input type="file" name="images" id="images" />
            </td>
            <td><?php echo !empty($c->image_filename) ? '<div id="category_img">'.html::image(shop::PRODUCT_CATEGORY_SMALL_PATH.$c->image_filename).html::image('img/icons/cross.png', array('id' => 'delete_product_category_image', 'class' => $c->id_category, 'style' => 'cursor:pointer; margin-left: 10px;')).'</div>': Kohana::lang('product_category.no_image_found'); ?></td>
        </tr>
        <tr style="display:none">
            <td class="td_form_left"><label for="images"><?php echo Kohana::lang('product_category.category_image'); ?> (slider kategorii - widoczny po najechaniu kursorem)</label></td>
            <td>
                <input type="file" name="image_filename_hover" id="image_filename_hover" />
            </td>
            <td><?php echo !empty($c->image_filename_hover) ? '<div id="category_img">'.html::image(shop::PRODUCT_CATEGORY_HOVER_SMALL_PATH.$c->image_filename_hover).html::image('img/icons/cross.png', array('id' => 'delete_product_category_image', 'class' => $c->id_category, 'style' => 'cursor:pointer; margin-left: 10px;')).'</div>': Kohana::lang('product_category.no_image_found'); ?></td>
        </tr>
        <tr style="display:none">
            <td class="td_form_left"><label for="banner">Banner (lista produktów)</label></td>
            <td>
                <input type="file" name="banner" id="banner" />
            </td>
            <td><?php echo !empty($c->banner) ? '<div id="category_banner">'.html::image(shop::PRODUCT_CATEGORY_SMALL_BANNER_PATH.$c->banner).html::image('img/icons/cross.png', array('id' => 'delete_product_category_banner', 'class' => $c->id_category, 'style' => 'cursor:pointer; margin-left: 10px;')).'</div>': Kohana::lang('product_category.no_image_found'); ?></td>
        </tr>
        <tr>
            <td>
                    <?php echo html::anchor('4dminix/kategorie_produktow', '<input type="button" value="'.Kohana::lang('admin.back').'" name="cancel" class="btn btn-back" />'); ?>
            </td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('product_category.save'); ?>" class="btn btn-save"  /></td>
            <td>&ensp;</td>
        </tr>
    </table>
        <?php } ?>
    <?php echo form::close(); ?>
</div>
