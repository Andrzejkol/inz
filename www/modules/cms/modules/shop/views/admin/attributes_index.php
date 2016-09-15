<div id="admin_attributes_index">
    <div class="options"><h5>Atrybuty</h5>
        <?php echo html::anchor('4dminix/dodaj_atrybut', html::image('img/admin_default/newobject.gif', array('alt' => Kohana::lang('attribute.add_attribute'), 'class' => 'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_atrybut', Kohana::lang('attribute.add_attribute'), array('class' => 'add_text', 'id' => 'add_news_button')); ?>
    </div>
    <?php
    if (!empty($oAttributes) && $oAttributes->count() > 0):
        ?>
        <table class="table_view" id="attribute_list">

            <tr>
                <th>#  <?php layer::GetSort('attributes_orderby', 1, 2, '/4dminix/atrybuty');?></th>
                <th><?php echo Kohana::lang('attribute.name'); ?>  <?php layer::GetSort('attributes_orderby', 3, 4, '/4dminix/atrybuty');?></th>
                <th><?php echo Kohana::lang('attribute.active'); ?>  <?php layer::GetSort('attributes_orderby', 5, 6, '/4dminix/atrybuty');?></th>
                <th><?php echo Kohana::lang('attribute.actions'); ?></th>
            </tr>
            <?php foreach ($oAttributes as $a): ?>
                <tr>
                    <td><?php echo $a->id_attribute; ?></td>
                    <td><?php echo strip_tags($a->attribute_name); ?></td>
                    <td><?php echo $a->active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('attribute.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('attribute.disabled'))); ?></td>
                    <td>	
                        <?php echo html::anchor('4dminix/edytuj_atrybut/' . $a->id_attribute, Kohana::lang('admin.edit'), array('title' => Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit'));

                        echo html::anchor('4dminix/usun_atrybut/' . $a->id_attribute, Kohana::lang('admin.delete'), array('class' => 'btn btn-delete', 'title' => Kohana::lang('admin.pages.delete')));
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
        </table>
        <?php
        echo $pagination;
    else:
        ?>
        <div class="info"><?php echo Kohana::lang('attribute.no_attributes'); ?></div>
    <?php endif; ?>
</div>