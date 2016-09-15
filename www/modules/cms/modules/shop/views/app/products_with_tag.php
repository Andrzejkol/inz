<div>
    <?php
        if(!empty($oProducts) && $oProducts->count() > 0):
            foreach($oProducts as $oProduct) :
    ?>
    <div class="project-box" style="margin: 10px 2px;">
        <div class="top"></div>
        <div class="content">
            <?php echo html::anchor('produkt/'.$oProduct->id_product.'/'.string::prepareURL($oProduct->product_name), html::image(Product_Model::PRODUCT_IMG_XMEDIUM.$oProduct->filename, $oProduct->product_name)); ?>
            <p class="project-name"><?php echo html::anchor('produkt/'.$oProduct->id_product.'/'.string::prepareURL($oProduct->product_name), $oProduct->product_name); ?></p>
            <?php //if(!empty($aProductsParameters[$oProduct->id_product])): ?>
            <?php //foreach($aProductsParameters[$oProduct->id_product] as $oPP): ?>
                <p class="property">Pow. użytkowa:</p>
                <p class="property-value"><?php echo (!empty($aProductsParameters[$oProduct->id_product][3])) ? $aProductsParameters[$oProduct->id_product][3].' m' : 'brak danych' ?></p>
                <div class="clear"></div>
                <p class="property">Min. działka:</p>
                <p class="property-value"><?php echo (!empty($aProductsParameters[$oProduct->id_product][20]) && !empty($aProductsParameters[$oProduct->id_product][21])) ? $aProductsParameters[$oProduct->id_product][20].' m x '.$aProductsParameters[$oProduct->id_product][21].' m' : 'brak danych' ?></p>
                <div class="clear"></div>
            <?php //endforeach; ?>
            <?php //endif; ?>
        </div>
        <div class="bottom"></div>
    </div>
    <?php
            endforeach;
        else:
    ?>
  <div class="info"><?php if(!empty($searchMessage)): echo $searchMessage; else: echo Kohana::lang('product.no_products_in_this_category');endif; ?></div>
  <?php endif;  ?>
  <div class="clear"></div>
</div>

