<?php
if (!empty($listingheader)) {
    echo '<h4><span class="cufon_chapa">' . $listingheader . '</span></h4>';
}
if (!empty($oCatD->category_name)) {
    echo '<h3 class="mobile-only">' . $oCatD->category_name . '</h3>';
}
if (!empty($oCatD->banner)) {
    echo '<div id="cat_banner">' . html::image(shop::PRODUCT_CATEGORY_BANNER_PATH . $oCatD->banner, array('class' => 'container')) . '</div>';
}
?>
<div id="product-listing-box" class="row">

    <?php
    if (!empty($oProducts) && $oProducts->count() > 0):
        $i = 1;
        foreach ($oProducts as $oProduct) :
            ?>
            <div class="product-box col-md-4">
                <div class="product-wrapper">
                    <div class="img_container">
                        <?php
                        if (!empty($oProduct->filename)) {
                            echo html::image(Product_Model::PRODUCT_IMG_XMEDIUM . $oProduct->filename, $oProduct->product_name);
                            echo html::anchor(shop::ProductUrl($oProduct), '<span class="btn btn-transparent">ZOBACZ WIĘCEJ</a>');
                        } else {
                            echo html::image('img/zaslepka_s.jpg', array('alt' => $oProduct->product_name));
                            echo html::anchor(shop::ProductUrl($oProduct), '<span class="btn btn-transparent">ZOBACZ WIĘCEJ</a>');
                        }
                        ?>
                    </div>
                    <div class="product-desc">
                        <div class="product-name">		
                            <?php echo html::anchor(shop::ProductUrl($oProduct), $oProduct->product_name); ?>
                        </div>
                        <p class="product-price">
                            cena: <span class="price"> 
                                <?php
                                if (isset($_SESSION['_customer']['customer_type'])) {
                                    if ($_SESSION['_customer']['customer_type'] == '0') {
                                        $Price = shop::GetPrice($oProduct->price, false, $oProduct->tax_value);
                                        echo $Price . ' zł';
                                        $Price = shop::GetPrice($oProduct->price, true, $oProduct->tax_value);
                                        echo '<span class="subprice">' . $Price . ' zł <span>netto</span></span>';
                                    } else {
                                        $Price = shop::GetPrice($oProduct->price, true, $oProduct->tax_value);
                                        echo $Price . ' zł netto';
                                        $Price = shop::GetPrice($oProduct->price, false, $oProduct->tax_value);
                                        echo '<span class="subprice">' . $Price . ' zł <span>brutto</span></span>';
                                    }
                                } else {
                                    $Price = shop::GetPrice($oProduct->price, false, $oProduct->tax_value);
                                    echo $Price . ' zł';
                                    $Price = shop::GetPrice($oProduct->price, true, $oProduct->tax_value);
                                    echo '<span class="subprice">' . $Price . ' zł <span>netto</span></span>';
                                }
                                ?>
                            </span>
                            <?php if (!empty($oProduct->old_price) && $oProduct->old_price > 0.00): ?>
                                <span class="product-old-price"><?php echo number_format($oProduct->old_price, 2, ',', ' '); ?> zł</span>
                            <?php endif; ?>
                        </p>

                    </div>
                    <div class="product-btns">
                        <?php
                        echo html::anchor('zamowienie/koszyk/' . $oProduct->id_product, 'Do Koszyka', array('class' => 'btn'));
                        echo html::anchor(shop::ProductUrl($oProduct), 'Podgląd', array('class' => 'btn btn-white'));
                        ?>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        endforeach;
    else:
        ?>
        <div class="info"><?php
            if (!empty($searchMessage)): echo $searchMessage;
            else: echo Kohana::lang('product.no_products_in_this_category');
            endif;
            ?></div>
    <?php endif; ?>

    <?php
    if (!empty($pagination)) {
        echo $pagination;
    }
    ?>
</div>