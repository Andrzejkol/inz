<?php if(!empty($oProducts) && count($oProducts)>0) : ?>
<div id="promotions">
    <h2><?php echo Kohana::lang('app.promotions'); ?></h2>
    <div class="image">
    <?php echo html::anchor('produkt/'.$oProducts[0]->id_product.'/'.string::prepareURL($oProducts[0]->product_name),html::image(Product_Model::PRODUCT_IMG_XMEDIUM.$oProducts[0]->filename, array('alt' => $oProducts[0]->product_name))); ?>
    </div>
        <p>
        <strong><?php echo html::anchor('produkt/'.$oProducts[0]->id_product.'/'.string::prepareURL($oProducts[0]->product_name),$oProducts[0]->product_name); ?></strong><br />
        <?php echo Kohana::lang('app.price'); ?> : <strong><?php echo number_format($oProducts[0]->price, 2); ?> <?php echo Kohana::lang('product.pl_money'); ?></strong>
    </p>
</div>
<div id="other_promotions">
<?php
if(count($oProducts)>1) :
foreach($oProducts as $key => $oProduct) :
if($key>0) : ?>

    <div class="promotion">
        <div class="image">
        <?php echo html::anchor('produkt/'.$oProduct->id_product.'/'.string::prepareURL($oProduct->product_name),html::image(Product_Model::PRODUCT_IMG_XSMALL.$oProduct->filename, array('alt' => $oProduct->product_name))); ?>
        </div>
        <p><strong><?php echo html::anchor('produkt/'.$oProduct->id_product.'/'.string::prepareURL($oProduct->product_name),$oProduct->product_name); ?></strong></p>
        <span><?php echo number_format($oProduct->price, 2); ?> <?php echo Kohana::lang('product.pl_money'); ?></span>
        <div class="clear"></div>
    </div>

<?php endif;
endforeach;
endif;
endif;
?>
</div>