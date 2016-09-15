<div id="admin_product_edit">
    <div id="product_name_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate');?>">
        <input type="text" class="os-dialog-input" id="product_name_language" name="product_name_language" />
    </div>
    <div id="product_short_description_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate');?>">
        <textarea rows="5" cols="40" class="os-dialog-textarea" id="product_short_description_language" name="product_short_description_language"></textarea>
    </div>
    <div id="product_description_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate');?>">
        <textarea rows="5" cols="40" class="os-dialog-textarea" id="product_description_language" name="product_description_language"></textarea>
    </div>
    <div id="product_guarantee_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate');?>">
        <textarea rows="5" cols="40" class="os-dialog-textarea" id="product_guarantee_language" name="product_guarantee_language"></textarea>
    </div>
    <div id="product_meta_title_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate');?>">
        <input type="text" class="os-dialog-input" id="product_meta_title_language" name="product_meta_title_language" />
    </div>
    <div id="product_meta_description_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate');?>">
        <input type="text" class="os-dialog-input" id="product_meta_description_language" name="product_meta_description_language" />
    </div>
    <div id="product_meta_keywords_language_dialog" class="os-dialog-box" title="<?php echo Kohana::lang('language.translate');?>">
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
            Kohana::lang('product.product_variants'), //3
            Kohana::lang('product.projects_galleries'), //4
            Kohana::lang('product.product_attributes'), //5
            Kohana::lang('product.elevation_galleries'), //6
            Kohana::lang('product.product_comments'), //7
            Kohana::lang('product.product_files'), //8
            Kohana::lang('product.seo'), //9
            Kohana::lang('product.settings'), //10
            Kohana::lang('product.product_variants'), //11
            Kohana::lang('product.product_adaptations'), //12
            Kohana::lang('product.product_projection')); //13
        $iTabTitlesCount = count($aTabTitles);
        for($i = 0 ; $i <= $iTabTitlesCount - 1 ; $i++):
            if(in_array($i, array(3, 4, 6, 7, 8, 9, 11, 12, 13))) { continue; } // pomijamy zakładkę wartianty produktu i komentarze i pliki
        ?>
            <li><a href="#tabs-<?php echo $i+1; ?>"><?php echo html::specialchars($aTabTitles[$i]); ?></a></li>
        <?php endfor; ?>
        </ul>
        <div id="tabs-1" class="ui-tabs-hide">
            <?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
            <table class="table_form">
                <tr>
                    <td class="td_form_left">
                        <label for="product_name"><?php echo Kohana::lang('product.product_name'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.product_name') . ' ' . Kohana::lang('product.comments.field_required'); ?></span>
                    </td>
                    <td>
                        <input type="text" name="product_name" id="product_name" value="<?php if(!empty($_POST['product_name'])) {echo $_POST['product_name'];} elseif(!empty($oProductDetails->product_name)) { echo $oProductDetails->product_name;} else { echo '';} ?>" />
                        <ul class="os-languages-list">
                        <?php foreach($oLanguages as $lang): ?>
                            <li><span onclick="javascript:showI18nDialog('product_name_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
                        <?php endforeach; ?>
                        </ul>
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
                        function countPrice() {
                            $('#netto_price').html( ( $('#price').val().replace(',', '.') / ( 1+($('#tax_id').val()/100.00)) ).toFixed(2) );
                        }
                        </script>
                        <input type="text" name="price" id="price" onchange="javascript:countPrice();" value="<?php if(!empty($_POST['price'])) {echo $_POST['price'];} elseif(!empty($oProductDetails->price)) { echo $oProductDetails->price;} else { echo '';} ?>" />
                        <input type="hidden" name="tax_id" id="tax_id" value="">
                        <!--
                        <select name="tax_id" id="tax_id" onchange="javascript:countPrice();">
                            <?php $tmpTaxId = 0; if(!empty($_POST['tax_id'])) {$tmpTaxId = $_POST['tax_id'];} elseif(!empty($oProductDetails->tax_id)) { $tmpTaxId = $oProductDetails->tax_id;} else { $tmpTaxId = 0;} ?>
                            <?php foreach($oTaxes as $t): ?>
                            <?php if(!empty($oProductDetails->tax_id) && $t->tax_value == $oProductDetails->tax_id): ?>
                            <option value="<?php echo $t->tax_value; ?>" selected="selected"><?php echo $t->tax_name; ?></option>
                            <?php else: ?>
                            <option value="<?php echo $t->tax_value; ?>"><?php echo $t->tax_name; ?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <br /><span id="netto_price" class="break_netto_price"></span>
                        -->
                    </td>
                    <td><div id="price_error" class="error_message"></div></td>
                </tr>
                <tr>
                    <td class="td_form_left">
                        <label for="code"><?php echo Kohana::lang('product.product_code'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.product_code'); ?></span>
                    </td>
                    <td><input type="text" name="code" id="code" value="<?php if(!empty($_POST['code'])) {echo $_POST['code'];} else { echo $oProductDetails->code;} ?>" /></td>
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
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.producer'); ?></span>
                    </td>
                    <td>
                        <select id="producer_id" name="producer_id">
                            <?php $tmpProducerId = 0; if(!empty($_POST['producer_id'])) {$tmpProducerId = $_POST['producer_id'];} elseif(!empty($oProductDetails->producer_id)) { $tmpProducerId = $oProductDetails->producer_id;} else { $tmpProducerId = 0;} ?>
                            <?php foreach($oProducers as $pp): ?>
                            <?php if($pp->id_producer == $tmpProducerId): ?>
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
                            <?php echo !empty($oProductCategories) ? $oProductCategories : ''; ?>
                        </select>
                    </td>
                    <td><div id="category_id_error" class="error_message"></div></td>
                </tr>
                <tr>
                    <td class="td_form_left">
                        <label for="active"><?php echo Kohana::lang('product.product_availability'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.product_availability'); ?></span>
                    </td>
                    <td>
                        <select id="active" name="active">
                            <option value="Y"<?php if(!empty($_POST['active']) && $_POST['active'] == 'Y') { echo ' selected="selected"'; } elseif(!empty($oProductDetails->product_active) && $oProductDetails->product_active == 'Y') { echo ' selected="selected"'; } ?>><?php echo Kohana::lang('product.available'); ?></option>
                            <option value="N"<?php if(!empty($_POST['active']) && $_POST['active'] == 'N') { echo ' selected="selected"'; } elseif(!empty($oProductDetails->product_active) && $oProductDetails->product_active == 'N') { echo ' selected="selected"'; } ?>><?php echo Kohana::lang('product.unavailable'); ?></option>
                        </select>
                    </td>
                    <td><div id="active_error" class="error_message"></div></td>
                </tr>
                <?php /*
                <tr>
                    <td class="td_form_left">
                        <label for="status_id"><?php echo Kohana::lang('product.product_status_id'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.product_status_id'); ?></span>
                    </td>
                    <td>
                        <select name="product_status_id" id="product_status_id">
                            <?php $tmpStatusId = 0; if(!empty($_POST['product_status_id'])) {$tmpStatusId = $_POST['product_status_id'];} elseif(!empty($oProductDetails->product_status_id)) { $tmpStatusId = $oProductDetails->product_status_id;} else { $tmpStatusId = 0;} ?>
                            <?php foreach($oProductStatuses as $ps): ?>
                            <?php if($ps->id_product_status == $tmpStatusId) : ?>
                            <option value="<?php echo $ps->id_product_status; ?>" selected="selected"><?php echo $ps->product_status_name; ?></option>
                            <?php else: ?>
                            <option value="<?php echo $ps->id_product_status; ?>"><?php echo $ps->product_status_name; ?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><div id="product_status_id_error" class="error_message"></div></td>
                </tr>
                 */
                ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="submit_tab" value="submit_tab_1" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <?php echo form::close(); ?>
        </div>
        <div id="tabs-2" class="ui-tabs-hide">
            <?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
            <table class="table_form">
                <?php /*
                <tr>
                    <td class="td_form_left td_form_top">
                        <label for="short_description"><?php echo Kohana::lang('product.short_description'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.short_description'); ?></span>
                    </td>
                    <td>
                        <textarea name="short_description" id="short_description" rows="5" cols="60"><?php if(!empty($POST['short_description'])) {echo $POST['short_description']; } elseif(!empty($oProductDetails->product_short_description)) { echo $oProductDetails->product_short_description; } else { echo '';} ?></textarea>
                        <ul class="os-languages-list">
                        <?php foreach($oLanguages as $lang): ?>
                            <li><span onclick="javascript:showI18nDialog('product_short_description_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
                        <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><div id="short_description_error" class="error_message"></div></td>
                </tr>
                 * 
                 */ ?>
                <tr>
                    <td class="td_form_left td_form_top">
                        <label for="description"><?php echo Kohana::lang('product.description'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.description'); ?></span>
                    </td>
                    <td>
                        <textarea name="description" id="description" rows="5" cols="60"><?php if(!empty($_POST['product_description'])) { echo $_POST['product_description']; } elseif(!empty($oProductDetails->product_description)) { echo $oProductDetails->product_description; } else {echo '';} ?></textarea>
                        <ul class="os-languages-list">
                        <?php foreach($oLanguages as $lang): ?>
                            <li><span onclick="javascript:showI18nDialog('product_description_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
                        <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><div id="description_error" class="error_message"></div></td>
                </tr>
                <!--
                <tr>
                    <td class="td_form_left td_form_top">
                        <label for="guarantee"><?php echo Kohana::lang('product.guarantee'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.guarantee'); ?></span>
                    </td>
                    <td>
                        <textarea name="guarantee" id="guarantee" rows="5" cols="60"><?php if(!empty($POST['guarantee'])) {echo $POST['guarantee']; } elseif(!empty($oProductDetails->product_guarantee)) { echo $oProductDetails->product_guarantee; } else { echo '';} ?></textarea>
                        <ul class="os-languages-list">
                        <?php foreach($oLanguages as $lang): ?>
                            <li><span onclick="javascript:showI18nDialog('product_guarantee_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
                        <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><div id="short_description_error" class="error_message"></div></td>
                </tr>
                <tr>
                    <td class="td_form_left td_form_top">
                        <label for="tags"><?php echo Kohana::lang('product.tags'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.tags'); ?></span>
                    </td>
                    <td>
                        <textarea name="tags" id="tags" rows="5" cols="60"><?php if(!empty($_POST['tags'])) {echo $_POST['tags']; } elseif(!empty($oProductTags)) { echo $oProductTags; } else {echo '';} ?></textarea>
                    </td>
                    <td><div id="description_error" class="error_message"></div></td>
                </tr>
                -->
                <tr>
                    <td class="td_form_left td_form_top">
                        <label for="parameters"><?php echo Kohana::lang('product.parameters'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.parameters'); ?></span>
                    </td>
                    <td>
                        <?php
                        $aProductParameters=array();
                        foreach($oProductParameters as $pp) :
                            $aProductParameters[$pp->parameter_id]=$pp->value;
                        endforeach;
                        ?>
                        <table class="table_view">
                        <?php
                        $sCurrentName = '';
                        foreach($oParameters as $p):
                            if($sCurrentName!=$p->parameter_name):
                                $sCurrentName=$p->parameter_name;
                        ?>
                        <tr>
                            <td><?php echo html::specialchars($sCurrentName);?>:</td>
                        <?php
                            endif;
                        ?>
							<td><?php //echo Kohana::debug( $oParametersValues[$p->parameter_id] );?>
                            <?php if (count($oParametersValues[$p->parameter_id]['parameter_value'])>=1 &&
                                    !empty($oParametersValues[$p->parameter_id]['parameter_value'][0])) : ?>
                                <?php 
                                    $dropdownValue = null;
                                    if(in_array($p->id_parameter, array_keys($aProductParameters))) {
                                    $dropdownValue = $oParametersValues[$p->parameter_id]['id_parameter_value'];
                                } ?>
                                <?php echo Form::dropdown('nazwa_tymczasowa', array_combine($oParametersValues[$p->parameter_id]['id_parameter_value'], $oParametersValues[$p->parameter_id]['parameter_value']), $dropdownValue) ?>
                            <?php endif; ?>
                            <?php if(in_array($p->id_parameter, array_keys($aProductParameters))) : ?>
                                <?php //echo Kohana::debug($aProductParameters[$p->id_parameter]);?>
                                <input type="text" name="parameter_value[<?php echo $p->parameter_id; ?>]" value="<?php echo html::specialchars($aProductParameters[$p->id_parameter]); ?>" />
                            <?php else : ?>
                                <input type="text" name="parameter_value[<?php echo $p->parameter_id; ?>]" value="" />
                            <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                        ?>
                        </table>
                    </td>
                    <td><div id="parameters_error" class="error_message"></div></td>
                </tr>
                <!--
                <tr>
                    <td class="td_form_left td_form_top">
                        <label for="estimate"><?php echo Kohana::lang('product.estimate'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.estimate'); ?></span>
                    </td>
                    <td>
                        <textarea name="estimate" id="estimate" rows="5" cols="60"><?php if(!empty($_POST['estimate'])) {echo $_POST['esitmate']; } elseif(!empty($oProductDetails->estimate)) { echo $oProductDetails->estimate; } else {echo '';} ?></textarea>
                    </td>
                    <td><div id="description_error" class="error_message"></div></td>
                </tr>
                -->
                <?php /*
                <tr>
                    <td class="td_form_left td_form_top">
                        <label for="estimate_files"><?php echo Kohana::lang('product.estimate_files'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.estimate_files'); ?></span>
                    </td>
                    <td>
                        <ul>
                        <?php $i=1;
                        $estimateFileCount=5-$oProductEstimateFiles->count();
                        while($i<=$estimateFileCount) :
                        ?>
                            <li>
                                <input type="file" name="estimate_file[]" id="estimate_file_<?php echo $i;?>" />
                                <input type="text" name="estimate_new_file_description[]" id="estimate_new_file_description" />
                            </li>
                        <?php
                        ++$i;
                        endwhile;
                        ?>
                        </ul>
                        <?php if(!empty($oProductEstimateFiles) && $oProductEstimateFiles instanceof Mysql_Result && $oProductEstimateFiles->count()) : ?>
                        <table>
                            <tr>
                                <th>Plik</th>
                                <th>Opis</th>
                                <th>Usuń</th>
                            </tr>
                        <?php
                        foreach($oProductEstimateFiles as $estimateFile) :
                        ?>
                            <tr>
                                <td>
                                    <a href="<?php echo url::base();?>files/estimate_files/<?php echo $estimateFile->product_id;?>/<?php echo html::specialchars($estimateFile->real_file_name); ?>"><?php echo html::specialchars($estimateFile->real_file_name); ?></a>
                                </td>
                                <td><input type="text" name="estimate_file_description[<?php echo $estimateFile->id_product_estimate_file; ?>]" id="estimate_file_description_<?php echo $estimateFile->id_product_estimate_file; ?>" value="<?php echo html::specialchars($estimateFile->description) ;?>" /></td>
                                <td><input type="checkbox" name="delete_estimate_file[<?php echo $estimateFile->id_product_estimate_file; ?>]" id="delete_estimate_file_<?php echo $estimateFile->id_product_estimate_file; ?>" /></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                        </table>
                        <?php endif; ?>
                    </td>
                    <td><div id="description_error" class="error_message"></div></td>
                </tr>
                 *
                 */ ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="submit_tab" value="submit_tab_2" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <?php echo form::close(); ?>
        </div>
        <div id="tabs-3" class="ui-tabs-hide">
                        <?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
            <table class="table_form">
                <tr>
                    <td class="td_form_left">
                        <label for="images" id="show_images_panel"><?php echo Kohana::lang('product.product_images'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.product_images'); ?></span>
                    </td>
                    <td>
                        <div id="images">
                            <?php for($i = 0 ; $i < shop::PRODUCT_IMAGES_LIMIT ; ++$i): ?>
                            <input type="file" name="images[]" id="images_1" style="margin: 3px; background-color: #fff; color: #000;" /> <?php echo html::image('img/icons/add.png', array('id' => 'more_image_btn', 'onclick' => "javascript:addMoreImages();")); ?><br />
                            <?php endfor; ?>
                        </div>
                        <script type="text/javascript">
                            //<![CDATA[
                            var globalNum = 1;
                            function addMoreImages() {
                                globalNum+=1;
                                $('#images').append('<div id="images_'+globalNum+'"><input type="file" name="images[]" style="margin: 3px; background-color: #fff; color: #000;" /></div>');
                            }

                            function removeImages(num) {
                                globalNum-=1;
                                $('#images_'+num).remove();
                            }
                            //]]>
                        </script>
                    </td>
                    <td><div id="images_error" class="images_message"></div></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div id="product_images" style="width: 462px; border: 1px solid #000; margin: 3px; text-align: center; overflow: hidden;">
                            <?php if(!empty($oProductImages) && $oProductImages->count() > 0): ?>
                                <?php foreach($oProductImages as $img): ?>
                                <div class="image">
                                    <?php echo html::image(Product_Model::PRODUCT_IMG_SMALL . $img->filename, array('alt' => $img->filename)); ?>
                                    <div id="del_image_chb"><input type="checkbox" id="delImage_<?php echo $img->id_image; ?>" name="delImage[<?php echo $img->filename; ?>]" /><label for="delImage_<?php echo $img->filename; ?>"> <?php echo Kohana::lang('product.delete_image'); ?></label></div>
                                    <div id="del_image_rdb"><input type="radio" id="mainImage_<?php echo $img->id_image; ?>" name="mainimage" value="<?php echo $img->id_image; ?>"<?php if($img->mainimage=='Y'){echo ' checked="checked"';}?> /><label for="mainImage_<?php echo $img->id_image; ?>"> <?php echo Kohana::lang('product.main_image'); ?></label></div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="submit_tab" value="submit_tab_3" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <?php echo form::close(); ?>
        </div>
        <?php /*
        <div id="tabs-4" class="ui-tabs-hide">
            <?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
            <table class="table_form">
                <tr>
                    <td class="td_form_left" colspan="3">
                        <h1>Warianty projektów</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        Warianty
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="submit_tab" value="submit_tab_4" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <?php if(!empty($oVariants) && $oVariants instanceof Mysql_Result && $oVariants->count()): ?>
                        <table>
                        <?php foreach($oVariants as $v) : ?>
                        <tr>
                            <td><?php echo html::specialchars($v->variant_name); ?></td>
                            <td><?php echo html::specialchars($v->usable_surface); ?> / <?php echo html::specialchars($v->net_surface); ?></td>
                            <td><?php echo html::specialchars($v->building_area); ?></td>
                            <td><?php echo html::specialchars($v->roof_angle); ?></td>
                            <td><?php echo html::specialchars($v->variant_price); ?></td>
                            <td><?php echo html::specialchars($v->variant_file); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </table>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <?php echo form::close(); ?>
        </div>
        */
        ?>

        <div id="tabs-5" class="ui-tabs-hide">
            <?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
            <table>
                <tr>
                    <td class="td_form_left td_form_top">
                        <?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
                        <table class="table_form">
                            <tr>
                                <td class="td_form_left" colspan="3">
                                    <h1>Galeria projektów</h1>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <ul>
                                        <?php for($i=0;$i<4;$i++) : ?>
                                        <li><input type="file" name="projects_gallery[<?php echo $i; ?>]" /> <input type="text" name="projects_gallery_description[<?php echo $i; ?>]" /></li>
                                        <?php endfor; ?>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="elevationGalleryId">
                                        <?php if(!empty($oProductProjectsGallery) && $oProductProjectsGallery instanceof Mysql_Result && $oProductProjectsGallery->count()>0) : ?>
                                            <table>
                                            <?php foreach($oProductProjectsGallery as $image): ?>
                                                <tr>
                                                    <td><img src="<?php echo url::base(); ?>files/projects_galleries/small/<?php echo html::specialchars($image->file_name); ?>" alt="<?php echo html::specialchars($image->real_file_name); ?>" /></td>
                                                    <td><img src="<?php echo url::base(); ?>images/icons/cross.png" alt="" onclick="DeleteProjectGalleryImage('<?php echo html::specialchars($image->real_file_name); ?>')" /></td>
                                                    <td><input type="text" name="projectGalleryDescription[<?php echo $image->id_project_gallery;?>]" id="projectGalleryDescription_<?php echo $image->id_project_gallery;?>" value="<?php echo html::specialchars($image->project_description);?>" /></td>
                                                    <td><input type="checkbox" name="pgDelImage[<?php echo $image->id_project_gallery;?>]" id="pgDelImage_<?php echo $image->id_project_gallery;?>" /></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </table>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                
                                <td><input type="hidden" name="submit_tab" value="submit_tab_5" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                        <?php echo form::close(); ?>
                    </td>
                    <td> </td>
                </tr>
            </table>
            <?php echo form::close(); ?>
        </div>
        <div id="tabs-6" class="ui-tabs-hide">
            <?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
            <table>
                <tr>
                    <td class="td_form_left td_form_top">
                        <label for="attributes"><?php echo Kohana::lang('product.attributes'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.attributes'); ?></span>
                    </td>
                    <td>
                        <table class="table_view">
                        <?php
                        $aProductAttributes=array();
                        foreach($oProductAttributes as $pa) :
                            $aProductAttributes[]=$pa->attribute_value_id;
                        endforeach;
                        $sCurrentName = '';
                        foreach($oAttributes as $a):
                            if($sCurrentName!=$a->attribute_name):
                                $sCurrentName=$a->attribute_name;
                        ?>
                        <tr>
                            <th colspan="2"><?php echo html::specialchars($sCurrentName);?></th>
                        </tr>
                        <?php
                            endif;
                        ?>
                        <tr>
                            <td>
                            <?php if(in_array($a->attribute_value_id, $aProductAttributes)) : ?>
                                <input type="checkbox" name="attribute_value[<?php echo $a->attribute_id; ?>][<?php echo $a->attribute_value_id; ?>]" checked="checked" />
                            <?php else : ?>
                                <input type="checkbox" name="attribute_value[<?php echo $a->attribute_id; ?>][<?php echo $a->attribute_value_id; ?>]" />
                            <?php endif; ?>
                            </td>
                            <td><?php echo html::specialchars($a->attribute_value);?></td>
                        </tr>
                        <?php
                        endforeach;
                        ?>
                        </table>
                    </td>
                    <td><div id="description_error" class="error_message"></div></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="submit_tab" value="submit_tab_6" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <?php echo form::close(); ?>
        </div>
        <div id="tabs-7" class="ui-tabs-hide">
            <?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
            <table class="table_form">
                <tr>
                    <td class="td_form_left" colspan="3">
                        <h1>Galeria elewacji</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <?php for($i=0;$i<5;$i++) : ?>
                            <li><input type="file" name="elevations_images[<?php echo $i; ?>]" /> <input type="text" name="elevations_description[<?php echo $i; ?>]" /></li>
                            <?php endfor; ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="elevationGalleryId">
                            <?php if(!empty($elevationGalleryImages) && $elevationGalleryImages instanceof Mysql_Result && $elevationGalleryImages->count()) : ?>
                            <table>
                                <tr>
                                    <td>Plik</td>
                                    <td>Opis</td>
                                    <td>Usuń</td>
                                </tr>
                                <?php foreach($elevationGalleryImages as $image): ?>
                                <tr>
                                    <td><img src="<?php echo url::base(); ?>files/elevation_galleries/small/<?php echo html::specialchars($image->file_name); ?>" alt="<?php echo html::specialchars($image->real_file_name); ?>" /></td>
                                    <td><input type="text" name="elevation_image_description[<?php echo $image->id_elevation_gallery; ?>]" id="elevation_image_description_<?php echo $image->id_elevation_gallery; ?>" value="<?php echo html::specialchars($image->elevation_description);?>" /></td>
                                    <td><input type="checkbox" name="deleteElevationImage[<?php echo $image->id_elevation_gallery; ?>]" id="deleteElevationImage_<?php echo $image->id_elevation_gallery; ?>"</td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="submit_tab" value="submit_tab_7" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <?php echo form::close(); ?>
        </div>
        <?php /*
        <div id="tabs-8" class="ui-tabs-hide">
            <table class="table_view">
                <?php if($oComments->count() > 0): ?>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        <?php echo Kohana::lang('product.comment_date_added'); ?>
                    </th>
                    <th>
                        <?php echo Kohana::lang('product.comment_nick'); ?>
                    </th>
                    <th>
                        <?php echo Kohana::lang('product.comment_content'); ?>
                    </th>
                    <th>
                        <?php echo Kohana::lang('product.active'); ?>
                    </th>
                    <th>
                        <?php echo Kohana::lang('product.options'); ?>
                    </th>
                </tr>
                <?php foreach($oComments as $c): ?>
                <tr>
                    <td>
                        <?php echo $c->id_product_comment; ?>
                    </td>
                    <td>
                        <?php echo date('Y-m-d, H:i:s', $c->date_added+0); ?>
                    </td>
                    <td>
                        <?php echo $c->nick; ?>
                    </td>
                    <td>
                        <?php echo text::limit_words($c->content, 24); ?>
                    </td>
                    <td>
                        <?php echo $c->active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('product.comment_active'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('product.comment_not_active'))); ?>
                    </td>
                    <td>
                        <?php echo html::anchor('4dminix/edytuj_komentarz/' . $c->id_product_comment, html::image('img/icons/edit.gif', Kohana::lang('product.edit_comment'))); ?>
                        <?php echo html::anchor('4dminix/usun_komentarz/' . $c->id_product_comment, html::image('img/icons/delete.gif', Kohana::lang('product.delete_comment'))); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="info"><?php echo Kohana::lang('product.no_product_comments'); ?></div>
                <?php endif; ?>
            </table>
        </div>
         */
        ?>

        <?php // dodawanie plikow
        /*
        <div id="tabs-9" class="ui-tabs-hide">
            <?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
            <table class="table_form">
                <tr>
                    <td class="td_form_left" colspan="3">
                        <h1>Pliki</h1>
                    </td>
                </tr>
                <tr>
                    <td class="td_form_left" colspan="3">
                        <ul>
                        <?php for($i=1;$i<=5;++$i) : ?>
                            <li><input type="file" name="file[]" id="file_<?php echo $i; ?>" /> <input type="text" name="new_description[]" id="description_<?php echo $i; ?>" /></li>
                        <?php endfor; ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php if(!empty($oProductFiles) && $oProductFiles instanceof Mysql_Result && $oProductFiles->count()): ?>
                        <table>
                            <tr>
                                <th>Plik</th>
                                <th>Opis</th>
                                <th>Usuń</th>
                            </tr>
                            <?php foreach($oProductFiles as $file): ?>
                            <tr>
                                <td>
                                    <a href="<?php echo url::base();?>files/product_files/<?php echo html::specialchars($file->product_id);?>/<?php echo html::specialchars($file->real_file_name);?>"><?php echo html::specialchars($file->real_file_name);?></a>
                                </td>
                                <td>
                                    <input type="text" name="filesDescription[<?php echo $file->id_product_file;?>]" value="<?php echo html::specialchars($file->description);?>" />
                                </td>
                                <td>
                                    <input type="checkbox" name="delFilesDescription[<?php echo $file->id_product_file;?>]" name="delFilesDescription_<?php echo $file->id_product_file;?>" />
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="submit_tab" value="submit_tab_9" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <?php echo form::close(); ?>

        </div>
         *
         */ ?>
        <div id="tabs-10" class="ui-tabs-hide">
            <?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
            <table class="table_form">
                <tr>
                    <td class="td_form_left">
                        <label for="meta_title"><?php echo Kohana::lang('product.meta_title'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.meta_title'); ?></span>
                    </td>
                    <td>
                        <input type="text" name="meta_title" id="meta_title" value="<?php if(!empty($oProductDetails->meta_title)) {echo $oProductDetails->meta_title;}; ?>" style="width: 300px;" />
                        <ul class="os-languages-list">
                        <?php foreach($oLanguages as $lang): ?>
                            <li><span onclick="javascript:showI18nDialog('product_meta_title_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
                        <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><div id="meta_title_error" class="error_message"></div></td>
                </tr>
                <tr>
                    <td class="td_form_left">
                        <label for="meta_description"><?php echo Kohana::lang('product.meta_description'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.meta_description'); ?></span>
                    </td>
                    <td>
                        <input type="text" name="meta_description" id="meta_description" value="<?php if(!empty($oProductDetails->meta_description)) { echo $oProductDetails->meta_description; } ?>" style="width: 300px;" />
                        <ul class="os-languages-list">
                        <?php foreach($oLanguages as $lang): ?>
                            <li><span onclick="javascript:showI18nDialog('product_meta_description_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
                        <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><div id="meta_description_error" class="error_message"></div></td>
                </tr>
                <tr>
                    <td class="td_form_left">
                        <label for="meta_keywords"><?php echo Kohana::lang('product.meta_keywords'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.meta_keywords'); ?></span>
                    </td>
                    <td>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="<?php if(!empty($oProductDetails->meta_keywords)) { echo $oProductDetails->meta_keywords; } ?>" style="width: 300px;" />
                        <ul class="os-languages-list">
                        <?php foreach($oLanguages as $lang): ?>
                            <li><span onclick="javascript:showI18nDialog('product_meta_keywords_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
                        <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><div id="meta_keyword_error" class="error_message"></div></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="submit_tab" value="submit_tab_10" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <?php echo form::close(); ?>
            
        </div>
        <div id="tabs-11" class="ui-tabs-hide">
            <?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
            <table class="table_form">
                <tr>
                    <td class="td_form_left">
                        <label for="recommend"><?php echo Kohana::lang('product.set_as_recommend'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.set_as_recommend'); ?></span>
                    </td>
                    <td>
                        <input type="checkbox" name="recommend" id="recommend"<?php if(!empty($oProductDetails->recommend) && $oProductDetails->recommend == 'Y'){echo ' checked="checked"';} ?> />
                    </td>
                    <td><div id="recommend_error" class="error_message"></div></td>
                </tr>
                <tr>
                    <td class="td_form_left">
                        <label for="bestseller"><?php echo Kohana::lang('product.set_as_bestseller'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.set_as_bestseller'); ?></span>
                    </td>
                    <td>
                        <input type="checkbox" name="bestseller" id="bestseller"<?php if(!empty($oProductDetails->bestseller)&&$oProductDetails->bestseller == 'Y'){ echo ' checked="checked"';} ?> />
                    </td>
                    <td><div id="bestseller_error" class="error_message"></div></td>
                </tr>
                <tr>
                    <td class="td_form_left">
                        <label for="new"><?php echo Kohana::lang('product.set_in_new'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.set_in_new'); ?></span>
                    </td>
                    <td><input type="checkbox" name="new" id="new"<?php if(!empty($oProductDetails->new)&&$oProductDetails->new=='Y'){echo ' checked="checked"';} ?> /></td>
                    <td><div id="new_error" class="error_message"></div></td>
                </tr>
                <tr>
                    <td class="td_form_left">
                        <label for="old_price"><?php echo Kohana::lang('product.old_price'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.old_price'); ?></span>
                    </td>
                    <td>
                        <input type="text" name="old_price" id="old_price" value="<?php if(!empty($oProductDetails->old_price) && $oProductDetails->old_price) {echo html::specialchars($oProductDetails->old_price);} ?>" />
                    </td>
                    <td><div id="old_price_error" class="error_message"></div></td>
                </tr>
                <?php /*
                <tr>
                    <td class="td_form_left">
                        <label for="search[building_type]"><?php echo Kohana::lang('product.search.building_type'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.building_type'); ?></span>
                    </td>
                    <td>
                        <select name="search[building_type]" id="building_type">
                            <option value="parterowy"<?php if(!empty($oSearchDetails[0]->typ_zabudowy) && $oSearchDetails[0]->typ_zabudowy=='parterowy') {echo ' selected="selected"';} ?>>parterowy</option>
                            <option value="pietrowy"<?php if(!empty($oSearchDetails[0]->typ_zabudowy) && $oSearchDetails[0]->typ_zabudowy=='pietrowy') {echo ' selected="selected"';} ?>>piętrowy</option>
                            <option value="z_poddaszem"<?php if(!empty($oSearchDetails[0]->typ_zabudowy) && $oSearchDetails[0]->typ_zabudowy=='z_poddaszem') {echo ' selected="selected"';} ?>>z poddaszem</option>
                            <option value="blizniak"<?php if(!empty($oSearchDetails[0]->typ_zabudowy) && $oSearchDetails[0]->typ_zabudowy=='blizniak') {echo ' selected="selected"';} ?>>bliźniak</option>
                            <option value="garaz"<?php if(!empty($oSearchDetails[0]->typ_zabudowy) && $oSearchDetails[0]->typ_zabudowy=='garaz') {echo ' selected="selected"';} ?>>garaż</option>
                        </select>
                    </td>
                    <td><div id="estimate_build_cost_error" class="error_message"></div></td>
                </tr>

                <tr>
                    <td class="td_form_left">
                        <label for="search[kominek]"><?php echo Kohana::lang('product.search.kominek'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.kominek'); ?></span>
                    </td>
                    <td>
                        <input type="checkbox" name="search[kominek]" id="search[kominek]" <?php if(!empty($oSearchDetails[0]->kominek) && $oSearchDetails[0]->kominek==1) {echo 'checked="checked"';} ?> />
                    </td>
                    <td><div id="kominek_error" class="error_message"></div></td>
                </tr>

                <tr>
                    <td class="td_form_left">
                        <label for="search[garaz]"><?php echo Kohana::lang('product.search.garaz'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.garaz'); ?></span>
                    </td>
                    <td>
                        <input type="checkbox" name="search[garaz]" id="search[garaz]" <?php if(!empty($oSearchDetails[0]->garaz) && $oSearchDetails[0]->garaz==1) {echo 'checked="checked"';} ?> />
                    </td>
                    <td><div id="garaz_error" class="error_message"></div></td>
                </tr>
                
                <tr>
                    <td class="td_form_left">
                        <label for="search[piwnica]"><?php echo Kohana::lang('product.search.piwnica'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.piwnica'); ?></span>
                    </td>
                    <td>
                        <input type="checkbox" name="search[piwnica]" id="search[piwnica]" <?php if(!empty($oSearchDetails[0]->piwnica) && $oSearchDetails[0]->piwnica) {echo 'checked="checked"';} ?> />
                    </td>
                    <td><div id="piwnica_error" class="error_message"></div></td>
                </tr>

                <tr>
                    <td class="td_form_left">
                        <label for="search[estimate_build_cost]"><?php echo Kohana::lang('product.search.estimate_build_cost'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.estimate_build_cost'); ?></span>
                    </td>
                    <td>
                        <select name="search[estimate_build_cost]" id="search_estimate_build_cost">
                            <option value="200-300"<?php if(!empty($oSearchDetails[0]->estimated_build_price) && $oSearchDetails[0]->estimated_build_price=='200-300') {echo ' selected="selected"';} ?>>200-300</option>
                            <option value="301-400"<?php if(!empty($oSearchDetails[0]->estimated_build_price) && $oSearchDetails[0]->estimated_build_price=='301-400') {echo ' selected="selected"';} ?>>301-400</option>
                            <option value="401-500"<?php if(!empty($oSearchDetails[0]->estimated_build_price) && $oSearchDetails[0]->estimated_build_price=='401-500') {echo ' selected="selected"';} ?>>401-500</option>
                            <option value="501<"<?php if(!empty($oSearchDetails[0]->estimated_build_price) && $oSearchDetails[0]->estimated_build_price=='501<') {echo ' selected="selected"';} ?>>501 &lt;</option>
                        </select>
                    </td>
                    <td><div id="estimate_build_cost_error" class="error_message"></div></td>
                </tr>
                
                <tr>
                    <td class="td_form_left">
                        <label for="search[usearea]"><?php echo Kohana::lang('product.search.usearea'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.usearea'); ?></span>
                    </td>
                    <td>
                        <input type="text" name="search[usearea]" id="search[usearea]" value="<?php if(!empty($oSearchDetails[0]->usearea) && $oSearchDetails[0]->usearea) {echo html::specialchars($oSearchDetails[0]->usearea);} ?>" />
                    </td>
                    <td><div id="usearea_error" class="error_message"></div></td>
                </tr>

                <tr>
                    <td class="td_form_left">
                        <label for="search[buildarea]"><?php echo Kohana::lang('product.search.buildarea'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.buildarea'); ?></span>
                    </td>
                    <td>
                        <input type="text" name="search[buildarea]" id="search[buildarea]" value="<?php if(!empty($oSearchDetails[0]->buildarea) && $oSearchDetails[0]->buildarea) {echo html::specialchars($oSearchDetails[0]->buildarea);} ?>" />
                    </td>
                    <td><div id="buildarea_error" class="error_message"></div></td>
                </tr>

                <tr>
                    <td class="td_form_left">
                        <label for="search[roofangle]"><?php echo Kohana::lang('product.search.roofangle'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.roofangle'); ?></span>
                    </td>
                    <td>
                        <input type="text" name="search[roofangle]" id="search[roofangle]" value="<?php if(!empty($oSearchDetails[0]->roof_angle) && $oSearchDetails[0]->roof_angle) {echo html::specialchars($oSearchDetails[0]->roof_angle);} ?>" />
                    </td>
                    <td><div id="roofangle_error" class="error_message"></div></td>
                </tr>

                <tr>
                    <td class="td_form_left">
                        <label for="search[min_field_width]"><?php echo Kohana::lang('product.search.min_field_width'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.min_field_width'); ?></span>
                    </td>
                    <td>
                        <input type="text" name="search[min_field_width]" id="search[min_field_width]" value="<?php if(!empty($oSearchDetails[0]->min_field_width) && $oSearchDetails[0]->min_field_width) {echo html::specialchars($oSearchDetails[0]->min_field_width);} ?>" />
                    </td>
                    <td><div id="min_field_width_error" class="error_message"></div></td>
                </tr>
                */ ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="submit_tab" value="submit_tab_11" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
			 <?php echo form::close(); ?>
        </div>
		<?php /* ?>
		<div id="tabs-12" class="ui-tabs-hide">
			<?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();"))?>
			<table class="table_form">
                <tr>
                    <td class="td_form_left td_form_top">
                        <script type="text/javascript">
                            $(function() {
                                function log(message, value) {
                                    if(message.length>0) {
//                                        $("#related_product_suggest").val(value)
                                        $("#related_products").append(message);
                                        $("#related_products").attr("scrollTop", 0);
                                    }
                                }

                                $("#related_product_suggest").autocomplete({
                                    source: urlBase + "products_ajax/search",
                                    minLength: 3,
                                    select: function(event, ui) {
//                                        var tmp = [];
//                                        $('#related_products').each(function(i, opt){
//                                            tmp.push($(opt).val());
//                                        });
//                                        if(tmp.indexOf(ui.item.value)) {
//                                            alert('Podany produkt już znajduje się na liście.');
//                                            $("#related_product_suggest").val('');
//                                            return false;
//                                        }
                                        log(ui.item ? ('<option value="'+ui.item.id+'">'+ui.item.label+'</option>') : "", '');
                                    }
                                });
                            });
                        </script>
                        <label for="related_products"><?php echo Kohana::lang('product.related_products'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.related_products'); ?></span><br />
						<span class="label_comment"><?php echo Kohana::lang('product.releted_products_info')?></span>
                    </td>
                    <td>
                        <input type="text" id="related_product_suggest" style="width: 400px;" /><br /><br />
                        <select name="related_products[]" id="related_products" size="10" multiple="multiple" class="ui-widget-content" style="width: 400px">
                            <?php foreach($oRelatedProducts as $rp):?>
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
			<input type="hidden" name="submit_tab" value="submit_tab_12" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  />
         <?php echo form::close(); ?>
		</div>
		<div id="tabs-13" class="ui-tabs-hide">
			<?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
            <table class="table_form">
                <tr>
                    <td class="td_form_left">
                        <label for="adaptations" id="show_images_panel"><?php echo Kohana::lang('product.product_images'); ?></label>
                        <span class="label_comment"><?php echo Kohana::lang('product.comments.product_images'); ?></span>
                    </td>
                    <td>
                        <div id="adaptations">
                            <?php for($i = 0 ; $i < shop::PRODUCT_IMAGES_LIMIT ; ++$i): ?>
                            <input type="file" name="adaptations[]" id="images_1" style="margin: 3px; background-color: #fff; color: #000;" /> <?php echo html::image('img/icons/add.png', array('id' => 'more_image_btn', 'onclick' => "javascript:addMoreImages();")); ?><br />
                            <?php endfor; ?>
                        </div>
                        <script type="text/javascript">
                            //<![CDATA[
                            var globalNum = 1;
                            function addMoreImages() {
                                globalNum+=1;
                                $('#adaptations').append('<div id="adaptations_'+globalNum+'"><input type="file" name="adaptations[]" style="margin: 3px; background-color: #fff; color: #000;" /></div>');
                            }

                            function removeImages(num) {
                                globalNum-=1;
                                $('#adaptations_'+num).remove();
                            }
                            //]]>
                        </script>
                    </td>
                    <td><div id="images_error" class="images_message"></div></td>
                </tr>
				<?php if(!empty($oProductAdaptations) && $oProductAdaptations->count() > 0): ?>
                <tr>
                    <td colspan="3">
						
                        <div id="product_images" style="width: 462px; border: 1px solid #000; margin: 3px; text-align: center; overflow: hidden;">
							<?php foreach($oProductAdaptations as $img): ?>
							<div class="image">
								<?php echo html::image(Product_Model::PRODUCT_IMG_SMALL . $img->filename, array('alt' => $img->filename)); ?>
								<div id="del_image_chb"><input type="checkbox" id="delImage_<?php echo $img->id_shop_products_adaptation; ?>" name="delImage[<?php echo $img->filename; ?>]" /><label for="delImage_<?php echo $img->filename; ?>"> <?php echo Kohana::lang('product.delete_image'); ?></label></div>
								<div id="del_image_rdb"><input type="radio" id="mainImage_<?php echo $img->id_shop_products_adaptation; ?>" name="mainImage" value="<?php echo $img->id_shop_products_adaptation; ?>"<?php if($img->mainimage=='Y'){echo ' checked="checked"';}?> /><label for="mainImage_<?php echo $img->id_shop_products_adaptation; ?>"> <?php echo Kohana::lang('product.main_image'); ?></label></div>
							</div>
							<?php endforeach; ?>
                        </div>						
                    </td>
                </tr>
				<?php endif; ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="submit_tab" value="submit_tab_13" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <?php echo form::close(); ?>
		</div>
		<div id="tabs-14" class="ui-tabs-hide">
			<?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
            <table class="table_form">
				<tr>

				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="submit_tab" value="submit_tab_14" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <?php echo form::close(); ?>
		</div>
		<?php */ ?>
    </div>
    <script type="text/javascript">
        //<![CDATA[
        // obliczenie ceny netto
        countPrice();

        function requestAjax() {
            var retValue = false;
            var dataString =
                'name=' + encodeURIComponent($('#name').val())
                + '&short_description=' + encodeURIComponent($('#short_description').val())
                + '&description=' + encodeURIComponent(tinyMCE.get('description').getContent());
            $('.error_message').hide();
            $.ajax({
                type: "POST",
                url: urlBase+"products_ajax/validate_product_add",
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

        var displayedAttributeRows = new Array();
        function getAttributeValues(ctrl, iProductId, iAttributeValue) {
            try {
                if($(ctrl).is(':checked')) {
                    var dataString = 'attribute_id=' + encodeURIComponent(iAttributeValue) + '&product_id=' + encodeURIComponent(iProductId);
                    $.ajax({
                        type: "POST",
                        url: "../pobierz_wartosci_atrybutu",
                        data: dataString,
                        async: false,
                        success: function(serverResponse) {
                            $('#attribute_row_' + iAttributeValue).after(serverResponse);
                        }
                    });
                } else {
                    $('.attribute_row_' + iAttributeValue).remove();
                }
            } catch(e) {
                alert(e);
            }
        }

        var displayedParameterRows = new Array();
        function getParameterValues(ctrl, iProductId, iParameterValue) {
            try {
                if($(ctrl).is(':checked')) {
                    $(ctrl).next('.loaderImage').show();
                    var dataString = 'parameter_id=' + encodeURIComponent(iParameterValue) + '&product_id=' + encodeURIComponent(iProductId);
                    $.ajax({
                        type: "POST",
                        url: "../pobierz_wartosci_parametru",
                        data: dataString,
                        async: false,
                        success: function(serverResponse) {
                            $('#parameter_row_' + iParameterValue).after(serverResponse);
                            $(ctrl).next('.loaderImage').hide();
                        }
                    });
                } else {
                    $('.param_row_' + iParameterValue).remove();
                }
            } catch(e) {
                alert(e);
            }
        }
        //]]>
    </script>
</div>