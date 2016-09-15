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
<div id="pagination_top">
    <h2>Kategoria</h2>
</div>
<div id="filters">
    <?php echo form::dropdown('filter_manufactures', array(0 => 'Wszyscy producenci')); ?>
    <?php echo form::dropdown('filter_manufactures', array(0 => 'Cena rosnąco')); ?>
    <?php echo form::dropdown('filter_manufactures', array(0 => 'Pokaż 10 wyników')); ?>
</div>
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
    <div class="clear"></div>
</div>
<div id="pagination_bottom">
    
</div>