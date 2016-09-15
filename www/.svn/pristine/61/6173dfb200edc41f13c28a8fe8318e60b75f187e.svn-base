<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('user.add_role')
            ))->render(TRUE);
?>
<div id="admin_role_add">
    <?php echo form::open_multipart(null, array('method' => 'post', 'id' => 'form_role_add')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><label for="name"><?php echo Kohana::lang('user.role_name'); ?></label></td>
            <td><?php echo form::input(array('type' => 'text', 'id' => 'name', 'name' => 'name')); ?></td>
            <td><div class="error_message" id="name_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="status"><?php echo Kohana::lang('user.role_status'); ?></label></td>
            <td>
                <select name="status" id="status">
                    <option value="Y"><?php echo Kohana::lang('user.role_status_available'); ?></option>
                    <option value="N"><?php echo Kohana::lang('user.role_status_disable'); ?></option>
                </select>
            </td>
            <td>&ensp;</td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="parent_role_id"><?php echo Kohana::lang('user.parent_role'); ?></label></td>
            <td><select name="parent_role_id" id="parent_role_id">
                    <?php foreach($roles as $r) { ?>
                    <option value="<?php echo $r->id_role; ?>"><?php echo $r->name; ?></option>
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
                    <?php foreach($permissions as $p) { ?>
                        <?php if($sCurrentResource != $p->resource) {
                            $sCurrentResource = $p->resource;
                            ?>
                    <dt><?php echo $p->description; ?></dt>
                            <?php } ?>
                    <dd><input type="checkbox" id="<?php echo $p->name; ?>" name="permission[<?php echo $p->id_permission; ?>]" /> <label for="<?php echo $p->name; ?>"><?php echo $p->description; ?></label></dd>
                        <?php } ?>
                </dl>
            </td>
            <td><div class="error_message" id="permission_error"></div></td>
        </tr>
        <tr>
            <td>
                <?php echo html::anchor('4dminix/role', '<input type="button" value="'.Kohana::lang('admin.back').'" name="back" class="btn btn-back" />'); ?>
            </td>
            <td>
                <input type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" class="btn btn-save"  />
                <input type="submit" name="submit_back" value="<?php echo Kohana::lang('admin.add_back'); ?>" class="btn btn-save-and-back"  />
            </td>
            <td>&ensp;</td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>