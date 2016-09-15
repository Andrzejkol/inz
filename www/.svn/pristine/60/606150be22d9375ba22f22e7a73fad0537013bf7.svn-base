<div>
    <div class="projects-title" style="margin-bottom: 10px;">
        <h2>Wyniki wyszukiwania</h2>
        <div class="clear"></div>
    </div>
    <?php
        if(!empty($oProducts) && $oProducts->count() > 0):
            foreach($oProducts as $oProduct) :
    ?>
    <div class="project-box" style="margin: 10px 2px;">
        <div class="top"></div>
        <div class="content">
            <?php echo html::anchor('produkt/'.$oProduct->id_product.'/'.string::prepareURL($oProduct->product_name), html::image(Product_Model::PRODUCT_IMG_XMEDIUM.$oProduct->filename, $oProduct->product_name)); ?>
            <p class="project-name"><?php echo html::anchor('produkt/'.$oProduct->id_product.'/'.string::prepareURL($oProduct->product_name), $oProduct->product_name); ?></p>
            <?php if(!empty($aProductsParameters[$oProduct->id_product])): ?>
            <?php foreach($aProductsParameters[$oProduct->id_product] as $oPP): ?>
                <p class="property"><?php echo $oPP->parameter_name; ?>:</p>
                <p class="property-value"><?php echo $oPP->value; ?></p>
                <div class="clear"></div>
            <?php endforeach; ?>
            <?php endif; ?>
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

