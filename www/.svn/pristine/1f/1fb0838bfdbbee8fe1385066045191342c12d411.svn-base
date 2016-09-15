<?php if (!empty($oProducts) && $oProducts->count() > 0): ?>
    <div id="see_product" class="container">
        <div class="jcarousel">
            <ul>
                <?php foreach ($oProducts as $oProduct) : ?>
                    <li>
                        <div class="project-box">
                            <div class="img_container">
                                <?php
                                if (!empty($oProduct->filename)) {
                                    echo html::anchor(shop::ProductUrl($oProduct), html::image(Product_Model::PRODUCT_IMG_SMALL . $oProduct->filename, $oProduct->product_name));
                                } else {
                                    echo html::anchor(shop::ProductUrl($oProduct), html::image('img/zaslepka_s.jpg', array('alt' => $oProduct->product_name)));
                                }
                                ?>
                            </div>
                            <div class="product-desc">
                                <p class="product-name"><?php echo $oProduct->price; ?> zł</p>
                                <div class="product-desc-link">		
                                    <?php echo html::anchor(shop::ProductUrl($oProduct), $oProduct->product_name); ?>
                                    <?php //echo html::anchor(Kohana::lang('links.lang') . Kohana::lang('links.shop'), Kohana::lang('shop_app.see_more'), array('class' => 'product_read_more button_arrow')); ?>
                                </div>
                            </div>    
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <a href="#" class="jcarousel-control-prev"><?php echo html::image('img/haribo/left.png', array('alt' => 'Poprzedni')); ?></a>
        <a href="#" class="jcarousel-control-next"><?php echo html::image('img/haribo/right.png', array('alt' => 'Następny')); ?></a>
        <div class="clear"></div>
    </div>
<?php endif; ?>