<div id="main_left">
    <h2><?php echo Kohana::lang('product_category.'); ?></h2>
    <?php
        foreach($langs as $lang) {
    ?>
    <h3><?php echo Kohana::lang('pages.'.$lang->description); ?></h3>
    <?php
            echo $pages[$lang->name];
        }
    ?>
    <br style="clear:both;" />
</div>