<?php if(!empty($oCategories)): ?>
<?php foreach($oCategories as $c): ?>
<tr class="row">
    <td><?php echo $c->id_product_category; ?></td>
    <td><span><?php echo str_repeat('&nbsp;', $c->level*4).$c->name; ?></span></td>
    <td><?php $lng = explode('_', $c->lang); echo html::image('img/flag/'.$lng[0].'.png', array('alt' => Kohana::lang('language.'.$c->lang))); ?></td>
    <td>
        <?php echo html::anchor((($c->parent_product_category_id==0) ? '4dminix/edytuj_kategorie_glowna_produktu/' : '4dminix/edytuj_kategorie_produktu/').$c->id_product_category, html::image('img/icons/edit.gif', array('alt' => Kohana::lang('product_category.edit_product_category')))); ?>
        <?php echo html::anchor('4dminix/usun_kategorie_produktu/'.$c->id_product_category, html::image('img/icons/delete.gif', array('alt' => Kohana::lang('product_category.delete_product_category')))); ?>
    </td>
</tr>
<?php endforeach; ?>
<?php endif; ?>