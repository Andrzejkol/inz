<div id="shopping_cart">
    <div id="your_shopping_cart">
        <div id="items">
            <?php echo form::open(); ?>
            <?php
            if(!empty($vProducts) && $vProducts->count()>0) {
                foreach($vProducts as $item): ?>
            <div class="item">
                <div class="image">
                            <?php echo html::image(Product_Model::PRODUCT_IMG_SMALL.$item->filename); ?>
                </div>
                <div class="description">
                    <span class="title">
                                <?php echo $item->product_name; ?>
                    </span>
                    <span class="short_description">
                                <?php echo $item->product_short_description; ?>
                    </span>
                    <span class="price_per_item">
                        Cena za sztukę: <?php echo $item->price; ?> zł
                    </span>
                    <div class="convert">
                        <div class="button_link large" style="float:right;">
                                <?php echo html::anchor('zamowienie/koszyk/' . $item->id_product, Kohana::lang('app.add_to_cart').'&nbsp;&nbsp;&raquo;'); ?>
                        </div>
                        <div class="delete">
                                <?php echo html::anchor('usun_z_ulubionych/' . $item->id_product, Kohana::lang('app.delete')); ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
                <?php endforeach;
            }
            else { ?>
            <div class="info"><?php echo Kohana::lang('customer.no_favs'); ?></div>
            <?php }
            ?>
        </div>
    </div>
</div>