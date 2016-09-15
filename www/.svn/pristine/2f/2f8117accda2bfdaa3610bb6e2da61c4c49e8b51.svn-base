<div id="categories">
    <?php foreach($oProductsCategories as $oProductCategory) : ?>
    <div class="category">
        <?php echo html::image(shop::PRODUCT_CATEGORY_BIG_PATH.$oProductCategory->image_filename, array('alt' => $oProductCategory->category_name, 'style' => 'width:233px;')); ?>
        <h3><?php echo $oProductCategory->category_name; ?></h3>
        <ul>
           <?php
                if(!empty($aProductsSubCategories)) {
                    foreach($aProductsSubCategories[$oProductCategory->id_category] as $oProductSubCategory) {
            ?>
                <li><?php echo html::anchor('produkty/'.$oProductSubCategory->id_category.'/'.string::prepareURL($oProductSubCategory->category_name), $oProductSubCategory->category_name); ?></li>
            <?php } } ?>
        </ul>
        <div class="more_anchor">
            <?php echo html::anchor('produkty/'.$oProductCategory->id_category.'/'.string::prepareURL($oProductCategory->category_name), Kohana::lang('app.more').'&nbsp;&nbsp;&raquo;'); ?>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="clear"></div>
</div>