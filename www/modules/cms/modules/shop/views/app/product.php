<div id="search">
    <?php echo form::open_multipart(); ?>
    <label for="search_phrase"><?php echo Kohana::lang('app.search'); ?></label>
    <input type="text" id="search_phrase" name="search_phrase"/>
    <input type="submit" value="&nbsp;" class="submit" />
    <?php echo form::close(); ?>
</div>
<div id="breadcrumbs">
    <p><?php echo Kohana::lang('app.you_are_here'); ?>: <?php echo html::anchor('', 'Strona główna'); ?></p>
</div>
<div id="product_details">
    <div id="images">
        <div class="big_image">
            <?php echo html::image('img/product_details.jpg'); ?>
        </div>
        <div class="thumbnail">
            <?php echo html::image('img/flowers.jpg'); ?>
        </div>
        <div class="thumbnail">
            <?php echo html::image('img/flowers.jpg'); ?>
        </div>
    </div>
    <div id="description">
        <span class="title">AGASTACHE - agastache mexicana </span>
        <span class="short_description">Agastache mexicana, 35 g</span>
        <span class="products_code"><?php echo Kohana::lang('app.products_code'); ?> :<span>5901363410749</span></span>
        <span class="producer"><?php echo Kohana::lang('app.producer'); ?> :<span>Plantico</span></span>
        <span class="other_products"><?php echo html::anchor('', Kohana::lang('app.see_other_products')); ?></span>
        <div class="quantity">
            <span class="price_per_item">
                <?php echo Kohana::lang('app.price_per_item'); ?> :
                <span>24.50 zł</span>
            </span>
            <div class="convert">
                <?php echo form::open_multipart(); ?>
                <?php echo form::label('count', Kohana::lang('app.quantity').' :'); ?>
                <?php echo form::input(array('name' => 'count', 'class' => 'count', 'maxlength' => 3, 'value' => 1));?>
                <?php echo html::image('img/count.png', array('alt' => Kohana::lang('app.count'), 'usemap' => '#m_count', 'id' => 'count_item')); ?>
                <map name="m_count" id="m_count">
                    <area shape="poly" coords="10,0,16,8,22,0,10,0" id="less" alt="<?php echo Kohana::lang('app.less'); ?>" title="<?php echo Kohana::lang('app.less'); ?>" />
                    <area shape="poly" coords="0,8,6,0,12,8,0,8" id="more" alt="<?php echo Kohana::lang('app.more_btn'); ?>" title="<?php echo Kohana::lang('app.more_btn'); ?>" />
                </map>
                <?php echo form::submit(array('name' => 'submit', 'value' => '', 'class' => 'convert'));?>
                <?php echo form::close(); ?>
                <div class="clear"></div>
            </div>
            <span class="price">
                <?php echo Kohana::lang('app.price'); ?> :
                <span>24.50 zł</span>
            </span>
        </div>
        <div class="description">
            <p>
                Roślina jednoroczna. Wymaga gleby żyznej o pH 7
                do 8,0. Stanowisko słoneczne. Nasiona wysiewamy
                do półciepłego inspektu lub na rozsadniku. Kiełkują
                w temperaturze 12°C po 14 dniach.
                Rozsadę na miejsce stałe wysadzamy po 15 maja.
                Nasiona wysiewamy także w maju wprost do gruntu.
                Odporna jest na susze i upały.
            </p>
            <div class="add_to_cart">
                <?php echo html::anchor('', Kohana::lang('app.add_to_cart').'&nbsp;&nbsp;&raquo;'); ?>
            </div>
        </div>

    </div>
    <div id="options">
        <?php echo html::image('img/shipped_within.png', Kohana::lang('app.shipped_within')); ?>
        <span><?php echo Kohana::lang('app.shipped_within'); ?> 24h</span>

        <?php echo html::image('img/add_to_favourite.png', Kohana::lang('app.add_to_favourite')); ?>
        <span><?php echo html::anchor('', Kohana::lang('app.add_to_favourite')); ?></span>

        <?php echo html::image('img/print.png', Kohana::lang('app.print')); ?>
        <span><?php echo html::anchor('', Kohana::lang('app.print')); ?></span>

        <div class="clear"></div>
    </div>
    <div id="more_options">
        <p>
            <?php echo Kohana::lang('app.inadequate_description'); ?>
        </p>
        <div class="ask_question">
            <?php echo html::anchor('', Kohana::lang('app.ask_question').'&nbsp;&nbsp;&raquo;'); ?>
        </div>
    </div>

</div>
<div id="most_purchased">
    <h2>Najczęściej kupowane z tym produktem</h2>
    <div id="products">
        <div class="product">
            <div class="image">
                <?php echo html::image('img/product.jpg'); ?>
            </div>
            <div class="description">
                <span class="title">
                    AGASTACHE - agastache mexicana
                </span>
                <span class="short_description">
                    Agastache mexicana, 35 g
                </span>
                <span class="price">
                    Cena: 89,90 zł
                </span>
                <span class="old_price">
                    Stara cena: <span>250 zł</span>
                </span>
                <div class="more">
                    <?php echo html::anchor('', Kohana::lang('app.more').'&nbsp;&nbsp;&raquo;'); ?>
                </div>
                <div class="add_to_cart">
                    <?php echo html::anchor('', Kohana::lang('app.add_to_cart').'&nbsp;&nbsp;&raquo;'); ?>
                </div>
            </div>
        </div>
        <div class="product">
            <div class="image">
                <?php echo html::image('img/product.jpg'); ?>
            </div>
            <div class="description">
                <span class="title">
                    AGASTACHE - agastache mexicana
                </span>
                <span class="short_description">
                    Agastache mexicana, 35 g
                </span>
                <span class="price">
                    Cena: 89,90 zł
                </span>
                <span class="old_price">
                    Stara cena: <span>250 zł</span>
                </span>
                <div class="more">
                    <?php echo html::anchor('', Kohana::lang('app.more').'&nbsp;&nbsp;&raquo;'); ?>
                </div>
                <div class="add_to_cart">
                    <?php echo html::anchor('', Kohana::lang('app.add_to_cart').'&nbsp;&nbsp;&raquo;'); ?>
                </div>
            </div>
        </div>
        <div class="product">
            <div class="image">
                <?php echo html::image('img/product.jpg'); ?>
            </div>
            <div class="description">
                <span class="title">
                    AGASTACHE - agastache mexicana
                </span>
                <span class="short_description">
                    Agastache mexicana, 35 g
                </span>
                <span class="price">
                    Cena: 89,90 zł
                </span>
                <span class="old_price">
                    Stara cena: <span>250 zł</span>
                </span>
                <div class="more">
                    <?php echo html::anchor('', Kohana::lang('app.more').'&nbsp;&nbsp;&raquo;'); ?>
                </div>
                <div class="add_to_cart">
                    <?php echo html::anchor('', Kohana::lang('app.add_to_cart').'&nbsp;&nbsp;&raquo;'); ?>
                </div>
            </div>
        </div>
        <div class="product">
            <div class="image">
                <?php echo html::image('img/product.jpg'); ?>
            </div>
            <div class="description">
                <span class="title">
                    AGASTACHE - agastache mexicana
                </span>
                <span class="short_description">
                    Agastache mexicana, 35 g
                </span>
                <span class="price">
                    Cena: 89,90 zł
                </span>
                <span class="old_price">
                    Stara cena: <span>250 zł</span>
                </span>
                <div class="more">
                    <?php echo html::anchor('', Kohana::lang('app.more').'&nbsp;&nbsp;&raquo;'); ?>
                </div>
                <div class="add_to_cart">
                    <?php echo html::anchor('', Kohana::lang('app.add_to_cart').'&nbsp;&nbsp;&raquo;'); ?>
                </div>
            </div>
        </div>
    </div>
</div>