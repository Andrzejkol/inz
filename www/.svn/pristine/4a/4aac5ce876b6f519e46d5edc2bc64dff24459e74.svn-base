<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'backup_add',
            'sTitle'=>Kohana::lang('admin.backup.add_backup')
            ))->render(TRUE);
?>
<div class="admin_box_edit">
    <?php echo form::open_multipart(null, array('id'=>'form_add_backup')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.name'); ?></td>
            <td><input name="name" id="add_backup_name" value="<?php if(!empty($_POST['name'])) { echo $_POST['name'];} ?>" /></td>
            <td><div id="name_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.desc'); ?></td>
            <td><textarea name="description" rows="5" id="add_backup_description"><?php if(!empty($_POST['description'])) {echo $_POST['description'];} ?></textarea></td>
            <td><div id="description_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.elements'); ?></td>
            <td>
                <input type="checkbox" name="elements_db" value="db"> Baza danych<br>
                <input type="checkbox" id="elements_all" name="elements_all" value="all"> Wszystkie<br><br>
                <?php $back_dirs = explode(';', BACKDIRS);
                foreach($back_dirs as $dir): ?>
                <input type="checkbox" class="elements" name="elements[]" value="<?php echo $dir; ?>"> <?php echo $dir; ?><br>
                <?php endforeach; ?>
                
            </td>
            <td><div id="elements_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td>
                <input type="button" value="<?php echo Kohana::lang('admin.back'); ?>" name="back" class="btn btn-back" />
            </td>
            <td>                
                <input type="submit" value="<?php echo Kohana::lang('admin.add'); ?>" name="submit_back" class="btn btn-save" />
            </td>
            <td></td>          

        </tr>
    </table>    
    <?php echo form::close(); ?>
</div>
<script type="text/javascript">
        $(document).ready(function(){
            $("#elements_all").click(function{
                alert($("#elements_all").attr("checked"));
                if($("#elements_all").attr("checked")){
                    $(".elements").attr("checked", "checked");
                    $(".elements").check();
                }
                else
                {
                    $(".elements").removeAttr("checked");
                    $(".elements").uncheck();
                }
            });
            
            
        });
    </script>