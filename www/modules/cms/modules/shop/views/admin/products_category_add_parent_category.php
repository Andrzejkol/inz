<div id="main_product_category_add">
    <script type="text/javascript">
        //<![CDATA[
        function requestAjax() {
            var retValue = false;
            var dataString = 'name=' + encodeURIComponent($('#name').val());
            $('.error_message').hide();
            $.ajax({
                type: "POST",
                url: "../products_categories_ajax/validate_product_category_add",
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
    <div id="product_categories_add_title">
        <h2><?php echo Kohana::lang('product_category.add_parent_category'); ?></h2>
    </div>
    <?php echo form::open_multipart(null, array('id' => 'validate_product_category_add', 'method' => 'post', 'onsubmit' => 'javascript:return requestAjax();')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><label for="name"><?php echo Kohana::lang('product_category.category_name'); ?></label></td>
            <td><input type="text" id="name" name="name" /></td>
            <td><div id="name_error" class="error_message"></div>
        </tr>
        <tr>
            <td class="td_form_left"><label for="lang"><?php echo Kohana::lang('product_category.lang'); ?></label></td>
            <td>
                <select id="add_parent_category_lang" name="lang">
                    <?php foreach($oLanguages as $lang): ?>
                    <option value="<?php echo $lang->name ; ?>"><?php echo Kohana::lang('language.'.$lang->description) ; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><div id="language_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="brands_check"><?php echo Kohana::lang('product_category.brand'); ?></label></td>
            <td>
                <select id="brands_check" name="related_page_id" style="width: 300px;">
                    <?php if(!empty($oProductsCategories)) {
                        echo $oProductsCategories;
                    } ?>
                </select>
            </td>
            <td>&ensp;</td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('pages.logo_for_categories'); ?></td>
            <td><input type="file" name="main_category_logo" id="add_pages_main_category_logo" /></td>
            <td><div id="main_category_logo_error" class="error_message"></div></td>
        </tr>
        
        <tr>
            <td>
                    <?php echo html::anchor('4dminix/kategorie_produktow', '<input type="button" value="'.Kohana::lang('product.cancel').'" name="cancel" class="ui-button ui-widget ui-state-default ui-corner-all" />'); ?>
            </td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('product_category.add_category'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
            <td>&ensp;</td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>
