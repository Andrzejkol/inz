<div id="admin_products_index">
    <span onclick="$('#product_filters').toggle();" style="cursor: pointer;"><?php echo Kohana::lang('product.show_filters'); ?></span>
    <fieldset id="product_filters" style="display: none;">
        <legend><?php echo Kohana::lang('product.filters'); ?></legend>
        <?php echo form::open(NULL, array('method'=>'get')); ?>
        <table>
            <tr>
                <th>
                    <?php echo Kohana::lang('product.product_availability'); ?>:
                </th>
                <td>
                    <?php echo form::dropdown(array('name' => 'available', 'id'=>'available'), array('-' => '-', 'Y' => Kohana::lang('product.available'), 'N' => Kohana::lang('product.unavailable')), !empty($_POST['available'])?$_POST['available']:''); ?>
                </td>
                <th>
                    <?php echo Kohana::lang('product.product_status'); ?>:
                </th>
                <td>
                    <?php echo form::dropdown(array('name' => 'product_status', 'id'=>'product_status'), $aProductStatus, !empty($_POST['product_status'])?$_POST['product_status']:''); ?>
                </td>
                <th>
                    <?php echo Kohana::lang('product.product_code'); ?>:
                </th>
                <td>
                    <input type="text" name="product_code" id="product_code" value="<?php echo !empty($_POST['product_code'])?$_POST['product_code']:''; ?>" />
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <th>
                    <?php echo Kohana::lang('product.product_quantity'); ?>:
                </th>
                <td>
                    <div id="quantity-slider-range" style="width: 200px; margin: 4px;"></div>
                    <label for="quantity_min"><?php echo Kohana::lang('product.min_quantity'); ?></label> <input type="text" value="<?php echo !empty($_POST['quantity_min'])?$_POST['quantity_min']:'0'; ?>" name="quantity_min" id="quantity_min" size="5" /> &ndash; <label for="quantity_max"><?php echo Kohana::lang('product.max_quantity'); ?></label> <input type="text" name="quantity_max" id="quantity_max" size="5" value="<?php echo !empty($_POST['quantity_max'])?$_POST['quantity_max']:$iMaxQuantity; ?>" />
                </td>
                <th>
                    <?php echo Kohana::lang('product.product_price'); ?>:
                </th>
                <td>
                    <div id="price-slider-range" style="width: 200px; margin: 4px;"></div>
                    <label for="price_min"><?php echo Kohana::lang('product.min_price'); ?></label> <input type="text" name="price_min" id="price_min" size="5" value="<?php echo !empty($_POST['price_min'])?$_POST['price_min']:'0.00'; ?>" /> &ndash; <label for="price_max"><?php echo Kohana::lang('product.max_price'); ?></label> <input type="text" name="price_max" id="price_max" size="5" value="<?php echo !empty($_POST['price_max'])?$_POST['price_max']:$dMaxPrice; ?>" />
                </td>
                <td></td><td></td>
            </tr>
            <tr>
                <th>
                    <?php echo Kohana::lang('product.search_product'); ?>:
                </th>
                <td>
                    <input type="text" name="query" id="query" value="<?php echo !empty($_POST['query'])?$_POST['query']:''; ?>" />
                </td>
                <th><?php echo Kohana::lang('product.product_category'); ?>:</th>
                <td>
                    <?php echo form::dropdown(array('name' => 'product_category', 'id'=>'product_category'), $aCategories, !empty($_POST['product_category'])?$_POST['product_category']:''); ?>
                </td>
                <th>
                    <?php echo Kohana::lang('product.product_producer'); ?>:
                </th>
                <td>
                    <?php echo form::dropdown(array('name' => "product_producers", 'id'=>'product_producers'), $aProducers, !empty($_POST['product_producers'])?$_POST['product_producers']:''); ?>
                </td>
            </tr>
        </table>
        <script type="text/javascript">
        $(function() {
                $("#price-slider-range").slider({
                    range: true,
                    min: <?php echo !empty($_POST['price_min'])?$_POST['price_min']:0.00; ?>,
                    max: <?php echo !empty($_POST['price_max'])?$_POST['price_max']:$dMaxPrice; ?>,
                    values: [<?php echo !empty($_POST['price_min'])?$_POST['price_min']:0.00; ?>, <?php echo !empty($_POST['price_max'])?$_POST['price_max']:$dMaxPrice; ?>],
                    slide: function(event, ui) {
                        $('#price_min').val(parseFloat(ui.values[0]).toFixed(2));
                        $('#price_max').val(parseFloat(ui.values[1]).toFixed(2));
                    }
                });
                $("#quantity-slider-range").slider({
                    range: true,
                    min: <?php echo !empty($_POST['quantity_min'])?$_POST['quantity_min']:0; ?>,
                    max: <?php echo !empty($_POST['quantity_max'])?$_POST['quantity_max']:$iMaxQuantity; ?>,
                    values: [<?php echo !empty($_POST['quantity_min'])?$_POST['quantity_min']:'0'; ?>, <?php echo !empty($_POST['quantity_max'])?$_POST['quantity_max']:$iMaxQuantity; ?>],
                    slide: function(event, ui) {
                        $('#quantity_min').val(parseInt(ui.values[0]));
                        $('#quantity_max').val(parseInt(ui.values[1]));
                    }
                });
               //$("#amount").val('$' + $("#slider-range").slider("values", 0) + ' - $' + $("#slider-range").slider("values", 1));
               $("#price-slider-range").slider("values", 0)
            });
        </script>
        <input type="submit" name="filter" id="filter_btn" value="<?php echo Kohana::lang('product.filter'); ?>" />
        <?php echo form::close(); ?>
    </fieldset>
    <div class="options"><h5>Lista produktów</h5>
        <?php echo html::anchor('4dminix/dodaj_produkt', html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('product.add_product'), 'class'=>'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_produkt', Kohana::lang('product.add_product'), array('class'=>'add_text', 'id'=>'add_news_button')); ?>
    </div>
    <table class="table_view" id="products_list">
        <?php
        if($oProducts->count() > 0):
        ?>
        <tr>
            <th># <?php layer::GetSort('products_orderby', 1, 2, '/4dminix/produkty');?></th>
            <th><?php echo Kohana::lang('product.image'); ?></th>
            <th><?php echo Kohana::lang('product.product_name'); ?><?php layer::GetSort('products_orderby', 3, 4, '/4dminix/produkty');?></th>
            <th><?php echo Kohana::lang('product.price') . ' [' . Kohana::lang('product.promotion_price') . ']'; ?><?php layer::GetSort('products_orderby', 5, 6, '/4dminix/produkty');?></th>
            <?php /*
            <th><?php echo Kohana::lang('product.quantity'); ?></th>
             *
             */
            ?>
            <th><?php echo Kohana::lang('product.active'); ?><?php layer::GetSort('products_orderby', 7, 8, '/4dminix/produkty');?></th>
            <th><?php echo Kohana::lang('product.actions'); ?></th>
        </tr>
            <?php
            foreach($oProducts as $p): ?>
        <tr>
            <td style="width: 75px; text-align: center;"><?php echo $p->id_product; ?></td>
            <td style="width: 150px; text-align: center;"><?php echo html::image(product_Model::PRODUCT_IMG_SMALL . $p->filename); ?></td>
            <td><?php echo strip_tags($p->product_name); ?></td>
            <td style="text-align: center;"><?php echo $p->price; if(!empty($p->product_price) && is_int($p->product_price)){echo $p->product_price;} ?></td>
            <?php /*<td style="width: 75px; text-align: center;"><?php echo $p->quantity; ?></td>*/ ?>
            <td style="width: 75px; text-align: center;"><?php echo $p->active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('product.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('product.disabled'))); ?></td>
            <td style="width: 150px; text-align: center;">
                <?php //echo html::image('img/allegro.png', array('alt' => Kohana::lang('product.allegro'), 'style' => 'cursor: pointer;' , 'onclick' => "window.open(urlBase + '4dminix/generuj_szablon_allegro/" . $p->id_product . "','Szablon Allegro','location=0,status=0,toolbar=0,width=980,height=670')")); ?>
  
				<?php echo html::anchor('4dminix/edytuj_produkt/' . $p->id_product, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
				
				 echo html::anchor('4dminix/usun_produkt/' . $p->id_product, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); ?>
				 

            </td>
        </tr>
                <?php
            endforeach;
            echo $pagination;
        else:
            echo Kohana::lang('product.no_products_found');
        endif;
        ?>
    </table>
</div>