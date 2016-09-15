<div id="left_menu">
    <h2>Kategorie produktów</h2>
    <ul>
        <?php foreach($oProductsCategories as $oProductCategory) : ?>
        <li <?php echo (!empty($iCategoryId) && $iCategoryId == $oProductCategory->id_category) ? 'class="current"' : '' ?>>
                <?php echo html::anchor('produkty/'.$oProductCategory->id_category.'/'.string::prepareURL($oProductCategory->category_name), $oProductCategory->category_name); ?>
                <?php if(!empty($aProductsSubCategories[$oProductCategory->id_category])) {
                    ?>
            <ul style="display:<?php echo (!empty($iCategoryId) && $iCategoryId == $oProductCategory->id_category || $iParentCategoryId == $oProductCategory->id_category) ? 'block;' : 'none'; ?>">
                        <?php foreach($aProductsSubCategories[$oProductCategory->id_category] as $oProductSubCategory) : ?>
                <li><?php echo html::anchor('produkty/'.$oProductSubCategory->id_category.'/'.string::prepareURL($oProductSubCategory->category_name), $oProductSubCategory->category_name, (!empty($iCategoryId) && $iCategoryId == $oProductSubCategory->id_category) ? array('class' => 'current') : ''); ?></li>
                        <?php endforeach; ?>
            </ul>
                    <?php } ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>