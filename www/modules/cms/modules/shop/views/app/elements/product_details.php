<?php echo!empty($vBreadCrumbs) ? $vBreadCrumbs : ''; //echo '<pre>'; var_dump($oProductDetails); echo '</pre>';                                            ?>
<div id="product-content" class="row" itemscope itemtype="http://schema.org/Product">

    <div class="product-wrapper">
        <?php
//    if (!empty($listingheader)) {
//        echo '<h4><span class="cufon_chapa">' . $listingheader . '</span></h4>';
//    }
        ?>
        <div class="row product-details">
            <div id="product-left" class="col-md-5 col-sm-6">
                <div id="product-photo-big">
                    <ul>
                        <?php
                        $i = 1;
                        foreach ($oProductImages as $photo) {
                            //if ($photo->type == 1) {
                            if ($i != 1) {
                                echo '<li>' . html::anchor(Product_Model::PRODUCT_IMG_BIG . $photo->filename, html::image(Product_Model::PRODUCT_IMG_MEDIUM . $photo->filename, array('alt' => $oProductDetails->product_name)), array('rel' => 'prettyPhoto[]', 'class' => 'pic_' . $photo->id_image, 'itemprop' => 'image', 'title' => '')) . '</li>';
                            } else {
                                echo '<li>' . html::anchor(Product_Model::PRODUCT_IMG_BIG . $photo->filename, html::image(Product_Model::PRODUCT_IMG_MEDIUM . $photo->filename, array('alt' => $oProductDetails->product_name)), array('rel' => 'prettyPhoto[]', 'class' => 'pic_' . $photo->id_image . ' lactive', 'itemprop' => 'image', 'title' => '')) . '</li>';
                            }
                            $i++;
                            //}
                        }
                        ?>
                    </ul>
                    <div id="bx-pager">
                        <?php
                        $i = 0;
                        foreach ($oProductImages as $photo) {

                            echo '<a data-slide-index="' . $i . '" href=""><span>' . html::image(Product_Model::PRODUCT_IMG_XSMALL . $photo->filename) . '</span></a>';

                            $i++;
                        }
                        ?>
                    </div>
                </div> 
                <?php
                //echo html::anchor('kontakt', Kohana::lang('shop_app.custom.custom_order'), array('class' => 'custom_order'));
                ?>
            </div>
            <?php echo form::open(Kohana::lang('links.lang') . 'zamowienie/koszyk', array('id' => 'orderProjectForm')); ?>
            <div id="product-right" class="col-md-7 col-sm-6">
                <div id="product-right-wrapper">
                    <h2 class="product-name" itemprop="name"><?php echo $oProductDetails->product_name; ?></h2>

                    <div class="product-info-desc">
                        <?php if (!empty($oProductDetails->code)): /* ?>
                          <div class="product-code">Nr ref.:<?php echo $oProductDetails->code; ?></div>
                          <?php */ endif; ?>
                        <div class="product-price">
                            <?php
                            if (isset($_SESSION['_customer']['customer_type'])) {
                                if ($_SESSION['_customer']['customer_type'] == '0') {
                                    $Price = shop::GetPrice($oProductDetails->price, false, $oProductDetails->tax_value);
                                    echo $Price . ' zł';
                                    $Price = shop::GetPrice($oProductDetails->price, true, $oProductDetails->tax_value);
                                    echo '<span class="subprice">' . $Price . ' zł <span>netto</span></span>';
                                } else {
                                    $Price = shop::GetPrice($oProductDetails->price, true, $oProductDetails->tax_value);
                                    echo $Price . ' zł netto';
                                    $Price = shop::GetPrice($oProductDetails->price, false, $oProductDetails->tax_value);
                                    echo '<span class="subprice">' . $Price . ' zł <span>brutto</span></span>';
                                }
                            } else {
                                $Price = shop::GetPrice($oProductDetails->price, false, $oProductDetails->tax_value);
                                echo $Price . ' zł';
                                $Price = shop::GetPrice($oProductDetails->price, true, $oProductDetails->tax_value);
                                echo '<span class="subprice">' . $Price . ' zł <span>netto</span></span>';
                            }
                            ?>


                            <?php if (!empty($oProductDetails->old_price) && $oProductDetails->old_price > 0.00): ?>
                                <div class="product-old-price"><?php echo number_format($oProductDetails->old_price, 2, ',', ''); ?> zł</div>
                            <?php endif; ?>
                        </div>

                        <?php //echo shop::ShowPriceBox(number_format($oProductDetails->price, 2, ',', ' '), (!empty($oProductDetails->old_price) && $oProductDetails->old_price > 0.00) ? number_format($oProductDetails->old_price, 2, ',', ' ') : NULL);  ?>

                        <div id="product-attr">

                            <?php /* if(!empty($oProductAttributes) && count($oProductAttributes)>0) : 
                              foreach($oProductAttributes as $oP) :  ?>
                              <span class="prod_attr"><?php echo $oP->attribute_name; ?></span>
                              <?php if(!empty($oProductAttributesValues[(int)$oP->attr_id]) && count($oProductAttributesValues[(int)$oP->attr_id])>0) : ?>
                              <select name="attribute[<?php echo $oP->attr_id; ?>]" id="attributes">
                              <?php foreach($oProductAttributesValues[$oP->attr_id] as $oPAV) : ?>
                              <option <?php if($oPAV->default=='Y') { echo 'selected="selected"'; } ?>><?php echo $oPAV->attribute_value; ?>
                              <?php endforeach; ?>
                              </select>
                              <br />
                              <?php endif; ?>


                              <?php endforeach;
                              endif; */ ?>
                            <table id="attributes-selector">
                                <?php if (!empty($oProductAttributesSelect)) echo $oProductAttributesSelect; ?>
                                <?php
                                if (!empty($oProductAttributes) && count($oProductAttributes) > 0) :
                                    foreach ($oProductAttributes as $oP) :
                                        /* ?>
                                          <tr>
                                          <td class="pink-hdr"><?php
                                          echo $oP->attribute_name;
                                          ?></td>
                                          </tr> */
                                        ?>
                                        <tr>
                                            <td id="attr-val_<?php echo $oP->attribute_id; ?>">
                                                <?php
                                                foreach ($oProductAttributesValues[$oP->attr_id] as $oPAV) {
                                                    if ($oPAV->active == 'Y'):
                                                        if (!empty($oPAV->attribute_pattern) && $oPAV->attribute_pattern != '') : // jesli jest obrazkiem
                                                            /* echo '<div style="border:' . (($oPAV->default == 'Y') ? '2px solid black;width:12px;height:12px;line-height:15px;' : '1px solid #BDBDBD;width:12px;height:12px;line-height:12px;') . ' float:left;margin-right:6px;" class="attval_' . $oPAV->attribute_value_id . '" id="attr-val_' . $oP->attribute_id . '" title="' . $oPAV->attribute_value . '" >' . html::image(shop::ATTR_SMALL_PATH . $oPAV->attribute_pattern);
                                                              echo '<div class="zoomer" style="width:100px;height:100px;background-color:#ffffff;">' . html::image(shop::ATTR_MEDIUM_PATH . $oPAV->attribute_pattern) . '</div>';
                                                              echo '</div>'; */
                                                            ?>
                                                            <div class="attribute-color-select <?php echo ($oPAV->default == 'Y') ? 'attr-active' : ''; ?>">
                                                                <div class="attribute-color" id="attr-val_<?php echo $oPAV->attribute_value_id; ?>" title="<?php echo $oPAV->attribute_value; ?>">
                                                                    <?php echo html::image(shop::ATTR_SMALL_PATH . $oPAV->attribute_pattern); ?>
                                                                    <div class="zoomer" style="background-color:#fff"><?php echo html::image(shop::ATTR_MEDIUM_PATH . $oPAV->attribute_pattern); ?></div>
                                                                </div>
                                                            </div>
                                                        <?php else : ?>
                                                            <div class="attribute-color-select <?php echo ($oPAV->default == 'Y') ? 'attr-active' : ''; ?>">
                                                                <div class="attribute-color" id="attr-val_<?php echo $oPAV->attribute_value_id; ?>" title="<?php echo $oPAV->attribute_value; ?>" style="background-color:#<?php echo $oPAV->attribute_color; ?>">
                                                                    <div class="zoomer" style="background-color:#<?php echo $oPAV->attribute_color; ?>"></div>
                                                                </div>
                                                            </div>
                                                        <?php
//                                                echo '<div style="border:' . (($oPAV->default == 'Y') ? '2px solid black;width:12px;height:12px;line-height:12px;' : '1px solid #BDBDBD;width:12px;height:12px;line-height:12px;') . ' float:left;margin-right:6px;background-color:#' . $oPAV->attribute_color . '" class="attval_' . $oPAV->attribute_value_id . '" id="attr-val_' . $oP->attribute_id . '" title="' . $oPAV->attribute_value . '" >';
//                                                echo '<div class="zoomer" style="width:100px;height:100px;background-color:#' . $oPAV->attribute_color . '"></div>';
//                                                echo '</div>';
                                                        endif;
                                                    endif;
                                                }
                                                ?>
                                                <?php if (!empty($oProductAttributesValues[(int) $oP->attr_id]) && count($oProductAttributesValues[(int) $oP->attr_id]) > 0) : ?>
                                                    <select name="attribute[<?php echo $oP->attr_id; ?>]" id="attrid_<?php echo $oP->attr_id; ?>" class="select_attributes" style="display: none;">
                                                        <?php foreach ($oProductAttributesValues[$oP->attr_id] as $oPAV) : ?>
                                                            <option <?php
                                                            if ($oPAV->default == 'Y') {
                                                                echo 'selected="selected"';
                                                            }
                                                            ?> class="attr-val_<?php echo $oPAV->attribute_value_id; ?>"><?php echo $oPAV->attribute_value; ?></option>
                                                            <?php endforeach; ?>
                                                    </select>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </table>
                        </div>
                        <div class="clear"></div>
                        <div id="prod_cont">

                            <div id="product-info">
                                <?php /*
                                  <p class="box-price-cena"><span><?php echo Kohana::lang('shop_app.product.price') ?>:</span>
                                  <?php //echo number_format($oProductDetails->price, 2, ',', ' '); ?> zł
                                  <?php //echo shop::ShowAlterCurrency(number_format($oProductDetails->price, 2, ',', ' ')); ?>
                                  </p> */ ?>


                                <?php /*
                                  <div class="producer">
                                  <table>
                                  <tr>
                                  <td><?php echo Kohana::lang('shop_app.product.producer'); ?>: </td>
                                  <td><?php
                                  if(!empty($oProductDetails->producer_logo)) {
                                  //echo html::image(Producer_Model::PRODUCER_LOGO_THUMBSPATH.$oProductDetails->producer_logo, array('alt'=>$oProductDetails->producer_name));
                                  echo html::anchor('producent/' . $oProductDetails->producer_id . '/' . $oProductDetails->producer_name, html::image(Producer_Model::PRODUCER_LOGO_THUMBSPATH.$oProductDetails->producer_logo, array('alt'=>$oProductDetails->producer_name, 'title'=>$oProductDetails->producer_name)));
                                  }
                                  else {
                                  echo html::anchor('producent/' . $oProductDetails->producer_id . '/' . $oProductDetails->producer_name, '<strong>'.$oProductDetails->producer_name.'</strong>');
                                  }
                                  ?></td>
                                  </tr>
                                  </table>
                                  </div> */ ?>
                                <div class="clear"></div>


                                <?php /* <p class="quantity-box"><?php echo Kohana::lang('shop_app.product.quantity') ?>: </p> */ ?>
                                <?php // echo form::input(array('name' => 'count', 'id' => 'count_' . $oProductDetails->id_product, 'class' => 'count', 'maxlength' => 2, 'value' => 1)); ?>
                                <?php /*
                                  <?php echo html::image('img/dogthelux/more-less.png', array('alt' => Kohana::lang('product.quantity'), 'usemap' => '#m_count', 'id' => 'count_item-' . $oProductDetails->id_product)); ?>
                                  <map name="m_count" id="m_count">
                                  <area shape="rect" coords="0,14,9,23" class="less" id="less-<?php echo $oProductDetails->id_product; ?>" href="javascript:;" alt="<?php echo Kohana::lang('shop_app.product.less_btn'); ?>" />
                                  <area shape="rect" coords="0,0,9,9" class="more" id="more-<?php echo $oProductDetails->id_product; ?>" href="javascript:;" alt="<?php echo Kohana::lang('shop_app.product.more_btn'); ?>" />
                                  </map>
                                  <div class="clear"></div> */ ?>
                                <?php echo form::input(array('type' => 'hidden', 'name' => 'product_price', 'id' => 'product_price', 'class' => 'count', 'value' => number_format($oProductDetails->price, 2))); ?>
                                <?php echo form::input(array('type' => 'hidden', 'name' => 'id_product', 'id' => 'id_product', 'value' => $oProductDetails->id_product)); ?>
                                <p>
                                    <?php /* <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . url::base() . url::current(TRUE)); ?>&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;width:250px;float:left" allowTransparency="true"></iframe> */ ?>
                                <div class="clear"></div>
                                </p>

                                <div class="product-status">
                                    <?php // echo $oProductDetails->product_status_name;  ?>
                                </div>
                                <div class="clear"></div>
                                <?php /* <a id="askForProductLink" href="#askForProduct" class="submit" title="Zapytaj o produkt">Zapytaj o produkt</a> */ ?>
                            </div>
                            <?php echo form::close(); ?>
                        </div>

                        <div class="prod-desc" itemprop="description"> 
                            <?php if (!empty($oProductDetails->product_description)) : ?>
                                <div class="description active">
                                    <h4 class="underlined"><?php echo Kohana::lang('shop_app.product.description'); ?></h4>
                                    <div class="product-description" style="display: block;"><?php echo $oProductDetails->product_description; ?></div>
                                </div>
                            <?php endif; ?>
                            <?php /* if (!empty($oProductDetails->product_short_description)) : ?>
                              <div class="details">
                              <h4><?php echo Kohana::lang('shop_app.product.details'); ?></h4>
                              <div class="product-description"><?php echo $oProductDetails->product_short_description; ?></div>
                              </div>
                              <?php endif; */ ?>
                        </div>
                        <?php
                        $bSocial = shop_config::getConfig('product_like');
                        if ($bSocial == 1):
                            ?>
                            <div class="product-social">
                                <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                            </div>
                        <?php endif; ?>  
                        <div class="product-btns">
                            <?php
                            if (!empty($oProductDetails->allow_buy) && $oProductDetails->allow_buy == 'Y'):
                                echo html::anchor('zamowienie/koszyk/' . $oProductDetails->id_product, 'Do Koszyka', array('class' => 'btn btn-big'));

                                $bAsk = shop_config::getConfig('ask_for_product');
                                if (!empty($bAsk) && $bAsk == 1) :
                                    ?>
                                    <span class="btn btn-white btn-big ask-for-product">Zapytaj o produkt</span>
                                <?php endif; ?>   
                                <span class="btn btn-white btn-big" id="calc">Oblicz raty</span>
                            <?php endif; ?>   
                        </div>
                        <div id="calc-popup">
                            <iframe src="http://cw.money.pl/u_porownywarka_kredytow_gotowkowych.html" style="width:365px; border:none; height:360px;"></iframe>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#calc-popup iframe').load(function(){
                                        $(this).contents().find('.porownywarka.mini .but2').hide();
                                    })
                                });
                            </script>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <?php if (!empty($oProductDetails->product_media)) : ?>
                        <div class="product_media">
                            <?php echo $oProductDetails->product_media; ?>
                        </div>
                    <?php endif;
                    ?>
                    <?php
                    $bAsk = shop_config::getConfig('ask_for_product');
                    if (!empty($bAsk) && $bAsk == 1) {
                        // zapytaj o produkt
                        View::factory('app/product/elements/askforproduct')
                                ->set(array(
                                    'oProductDetails' => $oProductDetails,
                                ))->render(TRUE);
                    }
                    ?>
                </div>
            </div>


            <?php echo form::close(); ?>
        </div>
        <div class="row product-spec">
            <div class="col-md-12">
                <div class="product-spec-wrapper">
                    <h4 class="underlined">SPECYFIKACJA</h4>
                    <?php echo $oProductDetails->product_short_description; ?>
                    <div class="spec-group">
                        <?php if (!empty($oProductParameters)) : ?>
                            <h5>Dane techniczne</h5>
                            <?php
                            foreach ($oProductParameters as $oParam) :
                                ?>
                                <div class="spec-row">
                                    <div class="spec-name"><?php echo $oParam->parameter_name; ?>:</div>
                                    <div class="spec_val"><?php echo $oParam->value; ?></div>                                
                                </div>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                    <?php /*
                      <div class="spec-group">
                      <h5>Wyświetlacz</h5>
                      <div class="spec-row">
                      <div class="spec-name">
                      Rodzaj wyświetlacza
                      </div>
                      <div class="spec-val">
                      Dotykowy, FHD sAMOLED
                      </div>
                      </div>
                      <div class="spec-row">
                      <div class="spec-name">
                      Przekątna ekranu [cal]
                      </div>
                      <div class="spec-val">
                      5
                      </div>
                      </div>
                      </div> */ ?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <?php if (!empty($aRelatedProductsDesc) && count($aRelatedProductsDesc) > 0) : ?>
            <div id="product_more">
                <h4><span class="cufon_chapa"><?php echo Kohana::lang('app.see_more'); ?></span></h4>
                <div class="lista3prod">
                    <div class="lista_product_no">
                        <?php foreach ($aRelatedProductsDesc as $rel) : ?>
                            <div class="rel_product_content_box">
                                <div class="rel_product_content">
                                    <p class="product-name"><?php echo html::anchor('produkt/' . $rel->id_product . '/' . string::prepareURL($rel->product_name), $rel->product_name); ?></p>
                                    <div class="img_container">

                                        <?php
                                        if (!empty($rel->mainimage)) {
                                            echo html::anchor('produkt/' . $rel->id_product . '/' . string::prepareURL($rel->product_name), html::image(Product_Model::PRODUCT_IMG_XXMEDIUM . $rel->mainimage, $rel->product_name));
                                        } else {
                                            echo html::anchor('produkt/' . $rel->id_product . '/' . string::prepareURL($rel->product_name), html::image('img/zaslepka_s.jpg', array('alt' => $rel->product_name)));
                                        }
                                        ?>                                
                                    </div>
                                    <p class="product-price"><?php echo Kohana::lang('shop_app.product.price') ?>: 
                                        <?php
                                        if (!empty($rel->old_price) && $rel->old_price > 0.00) {
                                            echo '<span class="priceText pricered">' . number_format($rel->price, 2, ',', '') . ' zł</span>';
                                        } else {
                                            echo '<span class="priceText">' . number_format($rel->price, 2, ',', '') . ' zł</span>';
                                        }
                                        ?>
                                    </p>
                                    <a href="zamowienie/koszyk/<?php echo $rel->id_product; ?>" class="add_product"><?php echo Kohana::lang('app.add_product') ?></a>
                                    <div class="clear"></div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <p>&nbsp;</p>
        <?php endif; ?>
        <div class="clear"></div>
    </div>
</div>