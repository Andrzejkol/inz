<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('user.edit_role')
            ))->render(TRUE);
?>
<div id="admin_role_edit">
    <?php echo form::open_multipart(null, array('method' => 'post', 'id' => 'form_role_add')); ?>
    <?php foreach($oRoleDetails as $d) { ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><label for="name"><?php echo Kohana::lang('user.role_name'); ?></label></td>
            <td><?php echo form::input(array('type' => 'text', 'id' => 'name', 'name' => 'name', 'value' => $d->name)); ?></td>
            <td><div class="error_message" id="rolename_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="status"><?php echo Kohana::lang('user.role_status'); ?></label></td>
            <td>
                <select name="status" id="status">
                    <option value="Y"<?php echo $d->status=='Y'? ' selected="selected"' : ''; ?>><?php echo Kohana::lang('user.role_status_available'); ?></option>
                    <option value="N"<?php echo $d->status=='N'? ' selected="selected"' : ''; ?>><?php echo Kohana::lang('user.role_status_disable'); ?></option>
                </select>
            </td>
            <td></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="parent_role_id"><?php echo Kohana::lang('user.parent_role'); ?></label></td>
            <td>
                <select name="parent_role_id" id="parent_role_id">
                        <?php foreach($oRoles as $r) { ?>
                            <?php if($r->id_role != $d->parent_role_id) { ?>
                    <option value="<?php echo $r->id_role; ?>"><?php echo $r->name; ?></option>
                                <?php } else { ?>
                    <option value="<?php echo $r->id_role; ?>" selected="selected"><?php echo $r->name; ?></option>
                                <?php } ?>
                            <?php } ?>
                </select>
            </td>
            <td><div class="error_message" id="parent_role_id_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"></td>
            <td>
                <h4><label for="permissions"><?php echo Kohana::lang('user.permissions'); ?></label></h4>
                    <?php $sCurrentResource = ''; ?>
                <dl>
					<?php foreach($oPermissions as $p) { ?>
						<?php if($sCurrentResource != $p->resource) {
							$sCurrentResource = $p->resource; ?>
							<dt><?php echo ucfirst(Kohana::lang('user.'.$p->resource)); ?></dt>
						<?php } ?>
						<?php if(in_array($p->name, $aUserPermissions)) { ?>
							<dd><input type="checkbox" id="permission_<?php echo $p->id_permission; ?>" name="permission[<?php echo $p->id_permission; ?>]" checked="checked" /> <label for="permission_<?php echo  $p->id_permission ?>"><?php echo $p->description; ?></label></dd>
						<?php } else { ?>
							<dd><input type="checkbox" id="permission_<?php echo $p->id_permission; ?>" name="permission[<?php echo $p->id_permission; ?>]" /> <label for="permission_<?php echo  $p->id_permission ?>"><?php echo $p->description; ?></label></dd>
						<?php } ?>
					<?php } ?>
                </dl>
            </td>
            <td>
                <div class="error_message" id="permission_error"></div>
            </td>
        </tr>
        <tr>
            <td>
                    <?php echo html::anchor('4dminix/role', '<input type="button" value="'.Kohana::lang('admin.back').'" name="back" class="btn btn-back" />'); ?>
            </td>
            <td>
                <input type="submit" name="submit" value="<?php echo Kohana::lang('user.save'); ?>" class="btn btn-save"  />
                <input type="submit" name="submit_back" value="<?php echo Kohana::lang('user.save_back'); ?>" class="btn btn-save-and-back"  />
            </td>
            <td>&ensp;</td>
        </tr>
    </table>
        <?php } ?>
    <?php echo form::close(); ?>
</div>