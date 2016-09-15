<div>
    <?php echo (!empty($msg)) ? $msg : ''?>
    <div class="projects-title" style="margin-bottom: 10px;">
        <h2>SCHOWEK</h2>
        <div class="clear"></div>
    </div>
    <?php 
        if(!empty($aClipboard) && is_array($aClipboard) && count($aClipboard)) :
            foreach($aClipboard as $clpbrdItem) :
    ?>
    <div class="project-box" style="margin: 10px 2px;">
        <div class="top"></div>
        <div class="content">
            <?php echo html::anchor('produkt/'.$clpbrdItem['id_product'].'/'.string::prepareURL($clpbrdItem['product_name']), html::image(Product_Model::PRODUCT_IMG_XMEDIUM.$clpbrdItem['filename'], $clpbrdItem['product_name'])); ?>
            <p class="project-name"><?php echo html::anchor('produkt/'.$clpbrdItem['id_product'].'/'.string::prepareURL($clpbrdItem['product_name']), $clpbrdItem['product_name']); ?> <?php echo html::anchor('usun_ze_schowka/'.$clpbrdItem['id_product'], html::image('img/icons/cross.png'), array('class'=>'removeFromClipboardImage')); ?></p>
        </div>
        <div class="bottom"></div>
    </div>
    <?php
            endforeach;
        else:
    ?>
    <div class="info"><?php if(!empty($searchMessage)): echo $searchMessage; else: echo Kohana::lang('product.no_products_in_clipboard');endif; ?></div>
    <?php endif;  ?>
    <div class="clear"></div>
</div>