<div id="admin_products_statuses_index">
    <div class="options"><h5>Statusy produktów</h5>
        <?php echo html::anchor('4dminix/dodaj_status_produktu', html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('product_status.add_product_status'), 'class'=>'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_status_produktu', Kohana::lang('product_status.add_product_status'), array('class'=>'add_text', 'id'=>'add_news_button')); ?>
    </div>
    <?php if(!empty($oProductsStatuses) && $oProductsStatuses->count()>0): ?>
    <table class="table_view" id="products_statuses_list">
        <tr>
            <th>#  <?php layer::GetSort('products_statues_orderby', 1, 2, '/4dminix/statusy_produktow');?></th>
            <th><?php echo Kohana::lang('product_status.status_name'); ?><?php layer::GetSort('products_statues_orderby', 3, 4, '/4dminix/statusy_produktow');?></th>
            <th><?php echo Kohana::lang('product_status.active'); ?><?php layer::GetSort('products_statues_orderby', 5, 6, '/4dminix/statusy_produktow');?></th>
            <th><?php echo Kohana::lang('product_status.allow_buy'); ?><?php layer::GetSort('products_statues_orderby', 7, 8, '/4dminix/statusy_produktow');?></th>
            <th><?php echo Kohana::lang('product_status.actions'); ?></th>
        </tr>
            <?php
            foreach($oProductsStatuses as $ps):
                ?>
        <tr>
            <td><?php echo $ps->id_product_status; ?></td>
            <td><?php echo strip_tags($ps->product_status_name); ?></td>
            <td><?php echo $ps->active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('product_status.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('product_status.disabled'))); ?></td>
            <td><?php echo $ps->allow_buy == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('product_status.allow_buy'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('product_status.deny_buy'))); ?></td>
            <td>
				<?php echo html::anchor('4dminix/edytuj_status_produktu/'.$ps->id_product_status, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 

				echo html::anchor('4dminix/usun_status_produktu/'.$ps->id_product_status, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); ?>
            </td>
        </tr>
            <?php
            endforeach;
            ?>
    </table>
    <?php else: ?>
        <div class="info"><?php echo Kohana::lang('product_status.no_products_statuses'); ?></div>
    <?php endif; ?>
</div>