<?php if(!request::is_ajax()) { ?>

<div id="admin_users_index">
    <div class="options">
	<h5>Użytkownicy</h5>
        <?php echo html::anchor('4dminix/dodaj_uzytkownika', html::image('img/admin_default/newobject.gif', array('alt'=>'Dodaj użytkownika', 'class'=>'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_uzytkownika', Kohana::lang('user.add'), array('class'=>'add_text')); ?>
        <div style="float:right;">
            <?php echo Kohana::lang('user.email'); ?>:
            <input type="text" name="users_search" id="users_search" />
            <?php echo Kohana::lang('user.role_name'); ?>:
            <?php echo form::dropdown(array('name'=>'users_in_role', 'id'=>'users_in_role'),$aRoles); ?>
        </div>
    </div>
    <?php
}
    if(!empty($users) && $users->count()>0) { ?>
    <?php if(!request::is_ajax()) { ?>
    <?php echo form::open('4dminix/usun_uzytkownika/'); ?>
   
    <?php } ?>
    <table class="table_view" id="user_list">
        <tr>
            <th><input type="checkbox" name="user_check_all" id="user_check_all" class="check_all" value="1" /></th>
            <th><?php echo Kohana::lang('user.full_name_with_email'); ?><?php layer::GetSort('users_orderby', 1, 2, '/4dminix/uzytkownicy');?></th>
            <th><?php echo Kohana::lang('user.role_name'); ?><?php layer::GetSort('users_orderby', 3, 4, '/4dminix/uzytkownicy');?></th>
            <th><?php echo Kohana::lang('user.date_added'); ?><?php layer::GetSort('users_orderby', 5, 6, '/4dminix/uzytkownicy');?></th>
            <th><?php echo Kohana::lang('user.user_status'); ?><?php layer::GetSort('users_orderby', 7, 8, '/4dminix/uzytkownicy');?></th>
            <th><?php echo Kohana::lang('user.actions'); ?></th>
        </tr>
        <?php
        foreach($users as $u) {
        ?>
        <tr>
            <td><input type="checkbox" name="user_check[]" class="check" value="<?php echo $u->id_user; ?>" /></td>
            <td><?php echo $u->first_name.', '.$u->last_name.' ('.html::mailto(strip_tags($u->email)).')'; ?></td>
            <td><?php echo $u->role_name; ?></td>
            <td><?php echo date(config::DATE_TIME_FORMAT, $u->date_added+0); ?></td>
            <td><?php echo $u->status == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('user.user_status_available'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('user.user_status_available'))); ?></td>
            <td>  
				
				<?php echo html::anchor('4dminix/edytuj_uzytkownika/'.$u->id_user, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.edit'), 'class' => 'btn btn-edit'));  ?>
							
				<?php echo html::anchor('4dminix/usun_uzytkownika/'.$u->id_user, Kohana::lang('admin.delete'), array('title' =>Kohana::lang('admin.delete'), 'class' => 'btn btn-delete'));  ?>
            </td>
        </tr>
                <?php } ?>
    </table>
    <?php if(!request::is_ajax()) { ?>
    <div class="delete_selected">
    <?php echo Kohana::lang('user.selected'); ?>: 
	<button name="delete_user" value="<?php echo Kohana::lang('user.delete'); ?>" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
    </div>
    <?php echo form::close();
    ; ?>
    <?php } ?>
    <?php
    } else { ?>
    <div class="info"><?php echo Kohana::lang('user.no_users'); ?></div>
    <?php } 
    if(!request::is_ajax()) { ?>
</div>
<?php } ?>
<?php echo $oPagination;?>