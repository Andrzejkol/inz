<div id="main_left">
    <h2><?php echo Kohana::lang('product_category.categories'); ?></h2>
    <?php echo html::anchor('4dminix/dodaj_kategorie_produktu', Kohana::lang('product_category.add_category')); ?>
    <?php
        foreach($langs as $lang) {
    ?>
    <h3><?php echo Kohana::lang('pages.'.$lang->description); ?></h3>
    <?php
            echo $categories[$lang->name];
        }
    ?>
    <br style="clear:both;" />
</div>