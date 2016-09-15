<div id="admin_rebates_groups_index">
    <div class="options"><h5>Kody rabatowe</h5>
        <?php echo html::anchor('4dminix/dodaj_kod_rabatowy', html::image('img/admin_default/newobject.gif', array('alt'=>'Dodaj kod rabatowy', 'class'=>'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_kod_rabatowy', 'Dodaj kod rabatowy', array('class'=>'add_text', 'id'=>'add_news_button')); ?>
    </div>
    <?php if(!empty($oRebateCode) && $oRebateCode->count() > 0): ?>
    <table class="table_view" id="rebate_group_list">        
        <tr>
            <th># <?php layer::GetSort('codes_orderby', 1, 2, '/4dminix/kody_rabatowe');?></th>
            <th>Kod rabatowy <?php layer::GetSort('codes_orderby', 3, 4, '/4dminix/kody_rabatowe');?></th>
            <th><?php echo Kohana::lang('rebate_group.rebate'); ?><?php layer::GetSort('codes_orderby', 5, 6, '/4dminix/kody_rabatowe');?></th>
            <th>Aktywny <?php layer::GetSort('codes_orderby', 7, 8, '/4dminix/kody_rabatowe');?></th>
            <th><?php echo Kohana::lang('rebate_group.actions'); ?></th>
        </tr>
        <?php
            foreach($oRebateCode as $rc):
        ?>
        <tr>
            <td><?php echo $rc->id_rebate_code; ?></td>
            <td><?php echo $rc->rebate_code; ?></td>
            <td><?php echo $rc->rebate; ?> %</td>
            <td><?php echo $rc->active == 1 ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('rebate_group.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('rebate_group.disabled'))); ?></td>
            <td>
				<?php echo html::anchor('4dminix/edytuj_kod_rabatowy/'.$rc->id_rebate_code, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 

				echo html::anchor('4dminix/usun_kod_rabatowy/'.$rc->id_rebate_code, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); ?>
            </td>
        </tr>
        <?php
            endforeach;
        
        ?>
    </table>
    <?php else: ?>
        <div class="info">Brak kodów rabatowych</div>
    <?php endif; ?>
</div>