<div id="admin_delivery_types_index">
    <div class="options"><h5>Rodzaje dostaw</h5>
        <?php echo html::anchor('4dminix/dodaj_typ_dostawy', html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('delivery_type.add_delivery_type'), 'class'=>'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_typ_dostawy', Kohana::lang('delivery_type.add_delivery_type'), array('class'=>'add_text', 'id'=>'add_news_button')); ?>
    </div>
    <?php if(!empty($oDeliveryTypes) && $oDeliveryTypes->count()>0):  ?>
    <table class="table_view" id="delivery_types_list">

        <tr>
            <th># <?php layer::GetSort('delivery_types_orderby', 1, 2, '/4dminix/typy_dostaw');?></th>
            <th><?php echo Kohana::lang('delivery_type.delivery_type'); ?> <?php layer::GetSort('delivery_types_orderby', 3, 4, '/4dminix/typy_dostaw');?></th>
      <?php /*      <th><?php echo Kohana::lang('delivery_type.delivery_cost'); ?></th> */ ?>
            <th><?php echo Kohana::lang('delivery_type.active'); ?> <?php layer::GetSort('delivery_types_orderby', 5, 6, '/4dminix/typy_dostaw');?></th>
            <th><?php echo Kohana::lang('delivery_type.actions'); ?></th>
        </tr>
            <?php
            foreach($oDeliveryTypes as $dt): ?>
        <tr>
            <td><?php echo $dt->id_delivery_type; ?></td>
            <td><?php echo strip_tags($dt->delivery_type); ?></td>
      <?php /*   <td><?php echo number_format($dt->delivery_cost, 2, '.', ''); ?></td> */ ?>
            <td><?php echo $dt->active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('delivery_type.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('delivery_type.disabled'))); ?></td>
            <td>
						<?php echo html::anchor('4dminix/edytuj_typ_dostawy/' . $dt->id_delivery_type, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 

						echo html::anchor('4dminix/usun_typ_dostawy/' . $dt->id_delivery_type, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); ?>
            </td>
        </tr>
            <?php
            endforeach;
            ?>
    </table>
    <?php else: ?>
        <div class="info"><?php echo Kohana::lang('delivery_type.no_delivery_types'); ?></div>
    <?php endif; ?>
</div>