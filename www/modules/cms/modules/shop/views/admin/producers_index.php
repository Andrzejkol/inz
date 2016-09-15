<div id="admin_producers_index">
    <div class="options"><h5>Producenci</h5>
        <?php echo html::anchor('4dminix/dodaj_producenta', html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('producer.add_producer'), 'class'=>'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_producenta', Kohana::lang('producer.add_producer'), array('class'=>'add_text', 'id'=>'add_news_button')); 
        echo html::anchor('4dminix/zmien_pozycje_producentow', html::image('img/admin_default/sort-ascending.png', array('alt' => Kohana::lang('slider.change_elements_positions'), 'class' => 'add_button')));
            echo html::anchor('4dminix/zmien_pozycje_producentow', Kohana::lang('slider.change_elements_positions'), array('class' => 'add_text'));	?>
    </div>
    <?php if($oProducers->count() > 0): ?>
    <table class="table_view" id="producers_list">
        <tr>
            <th>#</th>
            <th><?php echo Kohana::lang('producer.logo'); ?></th>
            <th><?php echo Kohana::lang('producer.name'); ?> <?php layer::GetSort('producers_orderby', 1, 2, '/4dminix/producenci');?></th>
            <th><?php echo Kohana::lang('producer.rebate'); ?><?php layer::GetSort('producers_orderby', 3, 4, '/4dminix/producenci');?></th>
            <th><?php echo Kohana::lang('producer.active'); ?><?php layer::GetSort('producers_orderby', 5, 6, '/4dminix/producenci');?></th>
            <th><?php echo Kohana::lang('producer.actions'); ?></th>
        </tr>
            <?php
            $iPosition = 1;
            foreach($oProducers as $p): ?>
        <tr>
            <td><?php echo $iPosition++;?> </td>
            <td><?php echo html::image(Producer_Model::PRODUCER_LOGO_THUMBSPATH . $p->producer_logo); ?></td>
            <td><?php echo strip_tags($p->producer_name); ?></td>
            <td><?php echo $p->rebate; ?> %</td>
            <td><?php echo $p->active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('producer.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('producer.disabled'))); ?></td>
            <td>		
				<?php echo html::anchor('4dminix/edytuj_producenta/'.$p->id_producer, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 

				echo html::anchor('4dminix/usun_producenta/'.$p->id_producer, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); ?>
            </td>
        </tr>
            <?php
            endforeach;
            ?>
    </table>
        <?php
        echo $pagination;
    else: ?>
    <div class="info"><?php echo Kohana::lang('producer.no_producers'); ?></div>
    <?php endif; ?>
</div>