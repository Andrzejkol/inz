<table class="table_view" id="product_list">
    <tr>
        <th>#</th>
        <th><?php echo Kohana::lang('product.product_name'); ?></th>
        <th><?php echo Kohana::lang('product.product_category'); ?></th>
        <th><?php echo Kohana::lang('product.product_status'); ?></th>
        <th><?php echo Kohana::lang('product.language'); ?></th>
        <th><?php echo Kohana::lang('product.options'); ?></th>
    </tr>
    <?php
    if(!empty($oProducts)) {
        foreach($oProducts as $product) {
        ?>
        <tr>
            <td><?php echo $product->id_product; ?></td>
            <td><?php echo $product->name; ?></td>
            <td><?php echo $product->category_name; ?></td>
            <td><?php echo $product->available == 'Y'
                    ? html::image('img/icons/bullet_green.png', array('alt' => Kohana::lang('product.product_enabled'), 'title' => Kohana::lang('product.enabled')))
                    : html::image('img/icons/bullet_red.png', array('alt' => Kohana::lang('product.product_disabled'), 'title' => Kohana::lang('product.disabled')));
                 ?>
            </td>
            <td><?php $lng = explode('_', $product->lang); echo html::image('img/flag/'.$lng[0].'.png', array('alt' => Kohana::lang('language.'.$product->lang))); ?></td>
            <td><?php echo html::anchor('4dminix/edytuj_produkt/'.$product->id_product, html::image('img/icons/edit.gif', array('alt' => Kohana::lang('product.edit_product')))); ?>
                <?php echo html::anchor('4dminix/usun_produkt/'.$product->id_product, html::image('img/icons/delete.gif', array('alt' => Kohana::lang('product.delete_product'), 'class' => 'delete_button', 'title' => 'Czy na pewno chcesz usunąć produkt?'))); ?>
            </td>
        </tr>
       <?php
        }
    ?>
</table>
<?php
    } else {
        echo Kohana::lang('product.no_products_found');
    }
    ?>