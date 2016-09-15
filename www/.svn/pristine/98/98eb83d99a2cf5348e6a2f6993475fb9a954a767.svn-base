<?php if (!empty($oCategories)): ?>
    <div id="cat_slider" class="container">
        <div class="jcarousel">
            <ul id="sub_slider">
                <?php foreach ($oCategories as $cat) : ?>
                    <?php if (!empty($cat->image_filename)) : ?>
                        <li <?php echo ((!empty($cat->image_filename_hover)) ? 'class="hover-li"' : ''); ?>>
                            <?php /* <h4><?php echo html::anchor('kategoria/' . string::prepareURL($cat->category_name) . '/' . $cat->id_category, $cat->category_name); ?></h4> */ ?>
                            <?php echo html::anchor('kategoria/' . string::prepareURL($cat->category_name) . '/' . $cat->id_category, html::image(shop::PRODUCT_CATEGORY_MEDIUM_PATH . $cat->image_filename, array('alt' => $cat->category_name))); ?>
                            <?php
                            if (!empty($cat->image_filename_hover)) :
                                echo html::anchor('kategoria/' . string::prepareURL($cat->category_name) . '/' . $cat->id_category, html::image(shop::PRODUCT_CATEGORY_HOVER_MEDIUM_PATH . $cat->image_filename_hover, array('alt' => $cat->category_name)), array('class' => 'hover-img'));
                            endif;
                            ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <a href="#" class="jcarousel-control-prev"><?php echo html::image('img/haribo/left.png', array('alt' => 'Poprzedni')); ?></a>
        <a href="#" class="jcarousel-control-next"><?php echo html::image('img/haribo/right.png', array('alt' => 'Następny')); ?></a>
    </div>
<?php endif; ?>