<div class="row category-widget widget">
    <div class="col-md-12 widget-wrapper">
        <h1 class="widget-title">Kategorie</h1>
        <div class="widget-content">
            <ul class="raquolist">
                <?php foreach ($catlist as $cat) : ?>
                    <li class="cat_<?php echo $cat->id_category; ?>"><?php echo html::anchor(url::base(TRUE, 'http') . 'kategoria/' . $cat->category_name . '/' . $cat->id_category, $cat->category_name); ?> <span class="prod-count">(<span class="red"><?php echo shop::CatProductCount($cat->id_category); ?></span>)</span></li>
                    <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>