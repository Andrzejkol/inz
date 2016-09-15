<div id="admin_parameters_index">
    <div class="options"><h5>Parametry</h5>
        <?php echo html::anchor('4dminix/dodaj_parametr', html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('parameter.add_parameter'), 'class'=>'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_parametr', Kohana::lang('parameter.add_parameter'), array('class'=>'add_text', 'id'=>'add_news_button')); ?>
    </div>
    <?php if(!empty($oParameters) && $oParameters->count()>0): ?>
    <table class="table_view" id="parameter_list">
        <tr>
            <th>#  <?php layer::GetSort('parameter_orderby', 1, 2, '/4dminix/parametry');?></th>
            <th><?php echo Kohana::lang('parameter.parameter_name'); ?> <?php layer::GetSort('parameter_orderby', 3, 4, '/4dminix/parametry');?></th>
            <th><?php echo Kohana::lang('parameter.type'); ?> <?php layer::GetSort('parameter_orderby', 5, 6, '/4dminix/parametry');?></th>
            <th><?php echo Kohana::lang('parameter.active'); ?> <?php layer::GetSort('parameter_orderby', 7, 8, '/4dminix/parametry');?></th>
            <th><?php echo Kohana::lang('parameter.actions'); ?></th>
        </tr>
            <?php
            foreach($oParameters as $p): ?>
        <tr>
            <td><?php echo $p->id_parameter; ?></td>
            <td><?php echo strip_tags($p->parameter_name); ?></td>
            <td><?php echo $p->type == 'product' ? 'Produkt' : 'Kategoria';  ?></td>
            <td><?php echo $p->active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('parameter.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('parameter.disabled'))); ?></td>
            <td>
				<?php echo html::anchor('4dminix/edytuj_parametr/'.$p->id_parameter, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 

				echo html::anchor('4dminix/usun_parametr/'.$p->id_parameter, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); ?>
            </td>
        </tr>
            <?php
            endforeach;
            ?>
    </table>
        <?php
        echo $pagination;
    else: ?>
    <div class="info"><?php echo Kohana::lang('parameter.no_parameter'); ?></div>
    <?php endif; ?>
</div>