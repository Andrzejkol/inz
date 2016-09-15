<div id="admin_product_edit">
    <div id="product_name_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate'); ?>">
        <input type="text" class="os-dialog-input" id="product_name_language" name="product_name_language" />
    </div>
    <div id="product_short_description_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate'); ?>">
        <textarea rows="5" cols="40" class="os-dialog-textarea" id="product_short_description_language" name="product_short_description_language"></textarea>
    </div>
    <div id="product_description_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate'); ?>">
        <textarea rows="5" cols="40" class="os-dialog-textarea" id="product_description_language" name="product_description_language"></textarea>
    </div>
    <div id="product_guarantee_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate'); ?>">
        <textarea rows="5" cols="40" class="os-dialog-textarea" id="product_guarantee_language" name="product_guarantee_language"></textarea>
    </div>
    <div id="product_meta_title_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate'); ?>">
        <input type="text" class="os-dialog-input" id="product_meta_title_language" name="product_meta_title_language" />
    </div>
    <div id="product_meta_description_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate'); ?>">
        <input type="text" class="os-dialog-input" id="product_meta_description_language" name="product_meta_description_language" />
    </div>
    <div id="product_meta_keywords_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate'); ?>">
        <input type="text" class="os-dialog-input" id="product_meta_keywords_language" name="product_meta_keywords_language" />
    </div>
    <div id="product_edit_title">
        <h2><?php echo Kohana::lang('product.edit_product') . ' - ' . $oProductDetails->product_name; ?></h2>
    </div>
    <div id="admin_edit_product">
        <ul style="overflow: hidden;">
            <?php
            $aTabTitles = array(
                Kohana::lang('product.product'), //0
                Kohana::lang('product.description'), //1
                Kohana::lang('product.images'), //2
                Kohana::lang('product.product_attributes'), //3
                Kohana::lang('product.product_comments'), //4
                Kohana::lang('product.product_files'), //5
                Kohana::lang('product.seo'), //6
                Kohana::lang('product.settings'), //7
                Kohana::lang('product.related_products'), // 8
                Kohana::lang('product.product_variants'), //9
                );
            $iTabTitlesCount = count($aTabTitles);
            $perms = array(3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14);
            $perms = array();
            if (User_Model::IsAllowed($_SESSION['_acl'], 'attributes', 'index')->Value == false) {
                $perms[] = 5;
            }
            if (User_Model::IsAllowed($_SESSION['_acl'], 'variants', 'all')->Value == false) {
                $perms[] = 14;
            }


            for ($i = 0; $i <= $iTabTitlesCount - 1; $i++):
                if (in_array($i, $perms)) {
                    continue;
                } // pomijamy zakładkę wartianty produktu i komentarze i pliki
                ?>
                <li><a href="#tabs-<?php echo $i + 1; ?>"><?php echo html::specialchars($aTabTitles[$i]); ?></a></li>
            <?php endfor; ?>
        </ul>
        <?php //PRODUKT ?>
        <div id="tabs-1" class="ui-tabs-hide">
            <?php
            // Szczegóły produktu
            View::factory('admin/product/elements/details')
                    ->set(array(
                        'oProductDetails' => $oProductDetails,
                        'oLanguages' => $oLanguages,
                        'oTaxes' => $oTaxes,
                        'oProducers' => $oProducers,
                        'oProductStatuses' => $oProductStatuses,
                        'oProductCategories' => $oProductCategories
                    ))->render(TRUE);
            ?>
        </div>
        <?php //OPIS ?>
        <div id="tabs-2" class="ui-tabs-hide">
            <?php
            // opisy produktu
            View::factory('admin/product/elements/descriptions')
                    ->set(array(
                        'oProductDetails' => $oProductDetails,
                        'oLanguages' => $oLanguages,
                        'oProductParameters' => $oProductParameters,
                        'oParameters' => $oParameters,
                        'oParametersValues' => $oParametersValues
                    ))->render(TRUE);
            ?>
        </div>
        <?php //ZDJĘCIA  ?>
        <div id="tabs-3" class="ui-tabs-hide">
            <?php
            // Szczegóły produktu
            View::factory('admin/product/elements/images')
                    ->set(array(
                        'oProductDetails' => $oProductDetails,
                        'oLanguages' => $oLanguages,
                        'oProductImages' => $oProductImages
                    ))->render(TRUE);
            ?>
        </div>
        <?php
        //ATRYBUTY 
        if (User_Model::IsAllowed($_SESSION['_acl'], 'attributes', 'index')->Value == true) :
            ?>
            <div id="tabs-4" class="ui-tabs-hide">
                <?php
                // atrybuty
                View::factory('admin/product/elements/attributes')
                        ->set(array(
                            'oProductDetails' => $oProductDetails,
                            'oLanguages' => $oLanguages,
                            'oProductAttributes' => $oProductAttributes,
                            'oAttributes' => $oAttributes
                        ))->render(TRUE);
                ?>
            </div>
        <?php endif; ?>
        <div id="tabs-5" class="ui-tabs-hide">
            <?php
            // atrybuty
            View::factory('admin/product/elements/comments')
                    ->set(array(
                        'oProductDetails' => $oProductDetails,
                        'oLanguages' => $oLanguages,
                        'oComments' => $oComments
                    ))->render(TRUE);
            ?>
        </div>
        <div id="tabs-6" class="ui-tabs-hide">
            <?php
            // pliki
            View::factory('admin/product/elements/files')
                    ->set(array(
                        'oProductDetails' => $oProductDetails,
                        'oLanguages' => $oLanguages,
                        'oProductFiles' => $oProductFiles
                    ))->render(TRUE);
            ?>
        </div>
        <div id="tabs-7" class="ui-tabs-hide">
            <?php
            // meta tagi
            View::factory('admin/product/elements/meta')
                    ->set(array(
                        'oProductDetails' => $oProductDetails,
                        'oLanguages' => $oLanguages
                    ))->render(TRUE);
            ?>
        </div>
        <div id="tabs-8" class="ui-tabs-hide">
            <?php
            // ustawienia
            View::factory('admin/product/elements/settings')
                    ->set(array(
                        'oProductDetails' => $oProductDetails,
                        'oLanguages' => $oLanguages
                    ))->render(TRUE);
            ?>
        </div>
        <div id="tabs-9" class="ui-tabs-hide">
            <?php
            // powiązane
            View::factory('admin/product/elements/related')
                    ->set(array(
                        'oProductDetails' => $oProductDetails,
                        'oLanguages' => $oLanguages,
                        'oRelatedProducts' => $oRelatedProducts
                    ))->render(TRUE);
            ?>
        </div>
        <?php
        // WARIANTY        
        //if (User_Model::IsAllowed($_SESSION['_acl'], 'variants', 'all')->Value == false) :
        ?>
        <div id="tabs-10" class="ui-tabs-hide">
            <?php
            View::factory('admin/product/elements/variants')
                    ->set('oProductDetails', $oProductDetails)
                    ->set('oProductVariants', $oProductVariants)
                    ->set('oOnlyAttributes', $oOnlyAttributes)
                    ->set('oAttributes', $oAttributes)->render(TRUE);
            ?>
        </div>
        <?php
        //endif;
        ?>
        

        <script type="text/javascript">
            //<![CDATA[
            // obliczenie ceny netto
            //countPrice();

            function requestAjax() {
                var retValue = false;
                var dataString =
                        'name=' + encodeURIComponent($('#name').val())
                        + '&short_description=' + encodeURIComponent($('#short_description').val())
                        + '&description=' + encodeURIComponent(tinyMCE.get('description').getContent());
                $('.error_message').hide();
                $.ajax({
                    type: "POST",
                    url: urlBase + "products_ajax/validate_product_add", data: dataString,
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

            var displayedAttributeRows = new Array();
            function getAttributeValues(ctrl, iProductId, iAttributeValue) {
                try {
                    if ($(ctrl).is(':checked')) {
                        var dataString = 'attribute_id=' + encodeURIComponent(iAttributeValue) + '&product_id=' + encodeURIComponent(iProductId);
                        $.ajax({
                            type: "POST",
                            url: "../pobierz_wartosci_atrybutu",
                            data: dataString,
                            async: false,
                            success: function (serverResponse) {
                                $('#attribute_row_' + iAttributeValue).after(serverResponse);
                            }
                        });
                    } else {
                        $('.attribute_row_' + iAttributeValue).remove();
                    }
                } catch (e) {
                    alert(e);
                }
            }

            var displayedParameterRows = new Array();
            function getParameterValues(ctrl, iProductId, iParameterValue) {
                try {
                    if ($(ctrl).is(':checked')) {
                        $(ctrl).next('.loaderImage').show();
                        var dataString = 'parameter_id=' + encodeURIComponent(iParameterValue) + '&product_id=' + encodeURIComponent(iProductId);
                        $.ajax({
                            type: "POST",
                            url: "../pobierz_wartosci_parametru",
                            data: dataString,
                            async: false,
                            success: function (serverResponse) {
                                $('#parameter_row_' + iParameterValue).after(serverResponse);
                                $(ctrl).next('.loaderImage').hide();
                            }
                        });
                    } else {
                        $('.param_row_' + iParameterValue).remove();
                    }
                } catch (e) {
                    alert(e);
                }
            }
            //]]>
        </script>
    </div>