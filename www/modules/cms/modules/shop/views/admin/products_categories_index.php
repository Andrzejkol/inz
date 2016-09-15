<?php if(!request::is_ajax()) { ?>
<div id="admin_product_categories_index">

    <input type="hidden" name="collapsed" value="" id="collapsed" />
    <div class="options"><h5>Kategorie produktów</h5>
        <?php echo html::anchor('4dminix/dodaj_kategorie_produktu', html::image('img/admin_default/newobject.gif', array('alt'=>'Dodaj nową ', 'class'=>'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_kategorie_produktu', Kohana::lang('product_category.add_product_category'), array('class'=>'add_text')); ?>
        <?php if(!empty($oProductsCategories) && $oProductsCategories->count()>0) { ?>
        <div style="float: right;">
            <?php echo Kohana::lang('product_category.search_by_category_name'); ?>:
            <input type="text" name="category_search" id="category_search" />
        </div>
        <?php } 
            echo html::anchor('4dminix/zmien_pozycje_kategorii', html::image('img/admin_default/sort-ascending.png', array('alt' => Kohana::lang('slider.change_elements_positions'), 'class' => 'add_button')));
            echo html::anchor('4dminix/zmien_pozycje_kategorii', Kohana::lang('slider.change_elements_positions'), array('class' => 'add_text'));	
                ?>
    </div>
</div>
<?php } ?>
<div id="categories_index">
    <?php if(!empty($oProductsCategories) && $oProductsCategories->count()>0) { ?>
    <table class="table_view" id="product_category_list">
        <tr>
            <th class="id">#</th>
            <th class="admin_th"><?php echo Kohana::lang('product_category.thumbnail'); ?></th>
            <th class="admin_th"><?php echo Kohana::lang('product_category.category_name'); ?><?php layer::GetSort('category_orderby', 1, 2, '/4dminix/kategorie_produktow');?></th>
            <th class="admin_th"><?php echo Kohana::lang('product_category.status'); ?></th>
            <th class="admin_th"><?php echo Kohana::lang('product_category.options'); ?></th>
        </tr>
        <?php
        $iPosition = 1;
        foreach($oProductsCategories as $category) { ?>
        <tr class="row">
            <td class="id"><?php echo $iPosition++; ?></td>
            <td style="width: 100px; text-align: center"><?php echo !empty($category->image_filename) ? html::image(shop::PRODUCT_CATEGORY_SMALL_PATH.$category->image_filename, Kohana::lang('product_category.thumbnail')) : '' ?></td>
            <td><span><?php echo $category->category_name; ?></span></td>
            <td><?php echo $category->active == 'Y' ? html::anchor('4dminix/zmien_status_kategorii/'.$category->id_category, html::image('img/icons/tick.png', array('alt' => Kohana::lang('product_category.enabled')))) : html::anchor('4dminix/zmien_status_kategorii/'.$category->id_category, html::image('img/icons/cross.png', array('alt' => Kohana::lang('product_category.disabled')))); ?></td>
            <td style="width: 150px;" >
				<?php
				echo html::anchor('4dminix/edytuj_kategorie_produktu/'.$category->id_category, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 

				echo html::anchor('4dminix/usun_kategorie_produktu/'.$category->id_category, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete')));?>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php
    } else { ?>
    <div class="info"><?php echo Kohana::lang('product_category.no_products_categories'); ?></div>
    <?php } ?>
</div>