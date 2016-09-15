<div id="admin_payments_types_index">
    <div class="options"><h5>Rodzaje płatności</h5>
        <?php echo html::anchor('4dminix/dodaj_typ_platnosci', html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('payment_type.add_payment_type'), 'class'=>'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_typ_platnosci', Kohana::lang('payment_type.add_payment_type'), array('class'=>'add_text', 'id'=>'add_news_button')); ?>
    </div>
    <?php if(!empty($oPaymentTypes) && $oPaymentTypes->count()>0) {?>
    <table class="table_view" id="payment_types_list">
        <tr>
            <th># <?php layer::GetSort('payment_types_orderby', 1, 2, '/4dminix/typy_platnosci');?></th>
            <th><?php echo Kohana::lang('payment_type.payment_type'); ?><?php layer::GetSort('payment_types_orderby', 3, 4, '/4dminix/typy_platnosci');?></th>
            <th><?php echo Kohana::lang('payment_type.payment_cost'); ?><?php layer::GetSort('payment_types_orderby', 5, 6, '/4dminix/typy_platnosci');?></th>
            <th><?php echo Kohana::lang('payment_type.language'); ?></th>
            <th><?php echo Kohana::lang('payment_type.active'); ?><?php layer::GetSort('payment_types_orderby', 7, 8, '/4dminix/typy_platnosci');?></th>
            <th><?php echo Kohana::lang('payment_type.actions'); ?></th>
        </tr>
            <?php
            foreach($oPaymentTypes as $pt): ?>
        <tr>
            <td><?php echo $pt->id_payment_type; ?></td>
            <td><?php echo strip_tags($pt->payment_type_name); ?></td>
            <td><?php echo number_format($pt->payment_cost, 2, '.', ''); ?></td>            
            <td><?php echo Kohana::lang('language.'.$pt->payment_type_language); ?></td>
            <td><?php echo $pt->active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('payment_type.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('payment_type.disabled'))); ?></td>
            <td>
				<?php echo html::anchor('4dminix/edytuj_typ_platnosci/' . $pt->id_payment_type, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 

				echo html::anchor('4dminix/usun_typ_platnosci/' . $pt->id_payment_type, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); ?>
            </td>
        </tr>
            <?php
            endforeach;
            ?>
    </table>
    <?php } else { ?>
    <div class="info"><?php echo Kohana::lang('payment_type.no_payment_types'); ?></div>
    <?php } ?>
</div>