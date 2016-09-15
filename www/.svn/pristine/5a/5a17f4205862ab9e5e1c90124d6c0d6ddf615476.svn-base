<?php if (!empty($oProducts) && $oProducts->count() > 0): ?>
    <div id="also_liked">
        <div>
            <div class="underline"><div class="cont"><h3>MOŻESZ RÓWNIEŻ POLUBIĆ</h3></div></div>
            <?php
            $i=1;
            foreach ($oProducts as $oProduct) : ?>
                <div class="project-box<?php if($i%5 == 0){echo ' mobile-none';}?>">
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
            <?php endforeach; 
            $i++;
            ?>
        </div>
        <div class="clear"></div>
    </div>
<?php endif; ?>