<?php if(!empty($oProduct)) : ?>
<div id="recommended">
    
    <h2><?php echo Kohana::lang('app.recommended'); ?></h2>
    <div class="image">
        <?php echo html::anchor('produkt/'.$oProduct->id_product.'/'.string::prepareURL($oProduct->product_name),html::image(Product_Model::PRODUCT_IMG_XMEDIUM.$oProduct->filename, array('alt' => $oProduct->product_name))); ?>
    </div>
    <p>
        <strong><?php echo html::anchor('produkt/'.$oProduct->id_product.'/'.string::prepareURL($oProduct->product_name),$oProduct->product_name); ?></strong><br />
        <?php echo Kohana::lang('app.price'); ?> : <strong><?php echo number_format($oProduct->price, 2); ?> <?php echo Kohana::lang('product.pl_money'); ?></strong>
    </p>
    <p><?php echo $oProduct->product_short_description; ?></p>
    <div class="more_anchor">
        <?php echo html::anchor('produkt/'.$oProduct->id_product.'/'.string::prepareURL($oProduct->product_name), Kohana::lang('app.more').'&nbsp;&nbsp;&raquo;'); ?>
    </div>
</div>
<?php endif; ?>