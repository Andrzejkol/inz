<div id="all_categories">
    <h3><?php echo Kohana::lang('shop_app.product.products'); ?></h3>    
    <?php
    if (!empty($categories) && count($categories) > 0) :
        foreach ($categories as $cat) {
        if(!empty($products[$cat['id_category']]) && count($products[$cat['id_category']]) > 0) :
            ?>
            <div class="category-row">
                <h4 class="cat-header"><?php echo $cat['category_name']; ?></h4>
                <?php 
                
                $i=1;
                foreach ($products[$cat['id_category']] as $product) { ?>
                    <div class="project-box<?php if($i%3 == 0){echo ' thelast';}?>">
                        <div class="img_container">
                            <?php
                            if (!empty($product->filename)) {
                                if (file_exists(Product_Model::PRODUCT_IMG_XMEDIUM . $product->filename)) {
                                    echo html::anchor(Kohana::lang('links.lang') . 'produkt/' . $product->id_product . '/' . string::prepareURL($product->product_name), html::image(Product_Model::PRODUCT_IMG_XMEDIUM . $product->filename, $product->product_name));
                                } else {
                                    echo html::anchor(Kohana::lang('links.lang') . 'produkt/' . $product->id_product . '/' . string::prepareURL($product->product_name), html::image(Product_Model::PRODUCT_IMG_XMEDIUM . $product->filename, $product->product_name), array('class' => 'no-img'));
                                }
                            } else {
                                echo html::anchor(Kohana::lang('links.lang') . 'produkt/' . $product->id_product . '/' . string::prepareURL($product->product_name), html::image('img/zaslepka_s.jpg', array('alt' => $product->product_name)));
                            }
                            ?>
                        </div>
                        <div class="product-desc">
                                    <p class="product-name"><?php echo html::anchor(Kohana::lang('links.lang') . 'produkt/' . $product->id_product . '/' . string::prepareURL($product->product_name), $product->product_name); ?></p>
                                    <div class="product-desc-link">										
                                        <?php echo html::anchor(Kohana::lang('links.lang') . 'produkt/' . $product->id_product . '/' . string::prepareURL($product->product_name), Kohana::lang('app.see_more'), array('class' => 'product_read_more button_arrow')); ?>
                                    </div>
                                </div>                        
                    </div>
                <?php 
                if($i % 3 == 0) {
                        echo '<div class="clear"></div>';
                    }
                    $i++;                
                            }
                            
                ?>
            </div>
            <div class="clear"></div>
            <?php
            endif;
        }
    endif;
    ?>
</div>