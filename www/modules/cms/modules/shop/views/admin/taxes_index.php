<div id="admin_taxes_index">
    <div class="options"><h5>Stawki VAT</h5>
        <?php echo html::anchor('4dminix/dodaj_stawke_vat', html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('tax.add_tax'), 'class'=>'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_stawke_vat', Kohana::lang('tax.add_tax'), array('class'=>'add_text', 'id'=>'add_news_button')); ?>
    </div>
    <?php if(!empty($oTaxes) && $oTaxes->count()>0) :?>
    <table class="table_view" id="taxes_list">
        <tr>
            <th># <?php layer::GetSort('taxes_orderby', 1, 2, '/4dminix/stawki_vat');?></th>
            <th><?php echo Kohana::lang('tax.name'); ?><?php layer::GetSort('taxes_orderby', 3, 4, '/4dminix/stawki_vat');?></th>
            <th><?php echo Kohana::lang('tax.value'); ?><?php layer::GetSort('taxes_orderby', 5, 6, '/4dminix/stawki_vat');?></th>
            <th><?php echo Kohana::lang('tax.actions'); ?></th>
        </tr>
        <?php
            foreach($oTaxes as $t):
        ?>
        <tr>
            <td><?php echo $t->id_tax; ?></td>
            <td><?php echo strip_tags($t->tax_name); ?></td>
            <td><?php echo $t->tax_value; ?> %</td>
            <td>
				<?php echo html::anchor('4dminix/edytuj_stawke_vat/'.$t->id_tax, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 

				echo html::anchor('4dminix/usun_stawke_vat/'.$t->id_tax, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); ?>
            </td>
        </tr>
        <?php
            endforeach;
        ?>
    </table>
    <?php else: ?>
        <div class="info"><?php echo Kohana::lang('tax.no_taxes'); ?></div>
    <?php endif; ?>
</div>