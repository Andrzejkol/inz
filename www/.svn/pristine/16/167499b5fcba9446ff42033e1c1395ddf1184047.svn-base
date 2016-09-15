<table class="table_view" id="product_category_list">
    <tr>
        <th class="admin_th">#</th>
        <th class="admin_th"><?php echo Kohana::lang('product_category.category_name'); ?></th>
        <th class="admin_th"><?php echo Kohana::lang('product_category.language'); ?></th>
        <th class="admin_th"><?php echo Kohana::lang('product_category.options'); ?></th>
    </tr>
    <?php
    if(!empty($oProductsCategories)) {
        foreach($oProductsCategories as $category) {
            ?>
    <tr class="row">
        <td><?php echo $category->id_product_category; ?></td>
        <td><span><?php echo $category->name; ?></span></td>
        <td><?php $lng = explode('_', $category->lang);
        echo html::image('img/flag/'.$lng[0].'.png', array('alt' => Kohana::lang('language.'.$category->lang))); ?></td>
        <td>
        <?php echo $category->allow_edit == 'Y' ? html::anchor('4dminix/edytuj_kategorie_produktu/'.$category->id_product_category, html::image('img/icons/edit.gif', array('alt' => Kohana::lang('product_category.edit_product_category')))) : ''; ?>
        <?php echo html::anchor('4dminix/usun_kategorie_produktu/'.$category->id_product_category, html::image('img/icons/delete.gif', array('alt' => Kohana::lang('product_category.delete_product_category'), 'class' => 'delete_button', 'title' => 'Czy na pewno chcesz usunąć kategorię produktu?'))); ?>
        </td>
    </tr>
            <?php
        }
    ?>
</table>
    <?php
} else {
    echo Kohana::lang('product_category.no_products_categories');
}
?>