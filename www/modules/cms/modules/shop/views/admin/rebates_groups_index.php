<div id="admin_rebates_groups_index">
    <div class="options"><h5>Grupy rabatowe</h5>
        <?php echo html::anchor('4dminix/dodaj_grupe_rabatowa', html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('rebate_group.add_rebate_group'), 'class'=>'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_grupe_rabatowa', Kohana::lang('rebate_group.add_rebate_group'), array('class'=>'add_text', 'id'=>'add_news_button')); ?>
    </div>
    <?php if($oRebatesGroups->count() > 0): ?>
    <table class="table_view" id="rebate_group_list">        
        <tr>
            <th># <?php layer::GetSort('rebates_groups_orderby', 1, 2, '/4dminix/grupy_rabatowe');?></th>
            <th><?php echo Kohana::lang('rebate_group.group_name'); ?> <?php layer::GetSort('rebates_groups_orderby', 3, 4, '/4dminix/grupy_rabatowe');?></th>
            <th><?php echo Kohana::lang('rebate_group.rebate'); ?> <?php layer::GetSort('rebates_groups_orderby', 5, 6, '/4dminix/grupy_rabatowe');?></th>
            <th><?php echo Kohana::lang('rebate_group.active'); ?> <?php layer::GetSort('rebates_groups_orderby', 7, 8, '/4dminix/grupy_rabatowe');?></th>
            <th><?php echo Kohana::lang('rebate_group.actions'); ?></th>
        </tr>
        <?php
            foreach($oRebatesGroups as $rg):
        ?>
        <tr>
            <td><?php echo $rg->id_rebate_group; ?></td>
            <td><?php echo strip_tags($rg->group_name); ?></td>
            <td><?php echo $rg->rebate; ?> %</td>
            <td><?php echo $rg->active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('rebate_group.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('rebate_group.disabled'))); ?></td>
            <td>		
				<?php echo html::anchor('4dminix/edytuj_grupe_rabatowa/'.$rg->id_rebate_group, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 

				echo html::anchor('4dminix/usun_grupe_rabatowa/'.$rg->id_rebate_group, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); ?>
            </td>
        </tr>
        <?php
            endforeach;
        
        ?>
    </table>
    <?php else: ?>
        <div class="info"><?php echo Kohana::lang('rebate_group.no_rebate_groups'); ?></div>
    <?php endif; ?>
</div>