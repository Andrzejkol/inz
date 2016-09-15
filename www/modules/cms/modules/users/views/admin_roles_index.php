<div id="admin_roles_index">
   
    <div class="options">
	 <h5>Role użytkowników</h5>
        <?php echo html::anchor('4dminix/dodaj_role', html::image('img/admin_default/newobject.gif', array('alt' => 'Dodaj nową rolę', 'class' => 'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_role', Kohana::lang('user.add_role'), array('class' => 'add_text')); ?>
    </div>
    <table class="table_view" id="newsletter_roles">
        <tr>
            <th># <?php layer::GetSort('roles_orderby', 1, 2, '/4dminix/role');?></th>
            <th><?php echo Kohana::lang('user.role_name'); ?><?php layer::GetSort('roles_orderby', 3, 4, '/4dminix/role');?></th>
            <th><?php echo Kohana::lang('user.date_added'); ?><?php layer::GetSort('roles_orderby', 5, 6, '/4dminix/role');?></th>
            <th><?php echo Kohana::lang('user.role_status'); ?><?php layer::GetSort('roles_orderby', 7, 8, '/4dminix/role');?></th>
            <th><?php echo Kohana::lang('user.actions'); ?></th>
        </tr>

        <?php
        if (!empty($roles)) {
            foreach ($roles as $r) {
                ?>
                <tr>
                    <td><?php echo $r->id_role; ?></td>
                    <td><?php echo strip_tags($r->name); ?></td>
                    <td><?php echo date(config::DATE_TIME_FORMAT, $r->date_added + 0); ?></td>
                    <td><?php echo $r->status == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('user.role_status_available'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('user.role_status_available'))); ?></td>
                    <td>
					<?php echo html::anchor('4dminix/edytuj_role/'.$r->id_role, Kohana::lang('news.edit'), array('title' =>Kohana::lang('news.edit'), 'class' => 'btn btn-edit'));  ?>
					<?php echo html::anchor('4dminix/usun_role/'.$r->id_role, Kohana::lang('news.delete'), array('title' =>Kohana::lang('news.delete'), 'class' => 'btn btn-delete'));  ?>
					</td>
                </tr>
        <?php } ?>
        </table>
        <?php
    } else {
        echo Kohana::lang('user.no_role');
    }
    ?>

</div>
<?php echo $oPagination; ?>