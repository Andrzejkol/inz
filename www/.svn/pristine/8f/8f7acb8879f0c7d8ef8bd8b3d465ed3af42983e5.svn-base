<div id="admin_backup_view">
    <div class="options">
        <h5><?php echo Kohana::lang('admin.backup.index_site_title'); ?></h5>
        <?php 
		if(User_Model::IsAllowed($_SESSION['_acl'], 'backup', 'add')->Value === TRUE){
			echo html::anchor('4dminix/backup/add', html::image('img/admin_default/backup_add.png', array('alt'=>Kohana::lang('admin.backup.add_backup'), 'class'=>'add_button'))); 
			echo html::anchor('4dminix/backup/add', Kohana::lang('admin.backup.add_backup'), array('class'=>'add_text'));                
		} 
        ?>
        
    </div>
    <?php
    if($oBackup->count() > 0) {
        ?>
        <?php echo form::open('4dminix/backup/delete'); ?>
        <table id="backup_list" class="table_view">
        <tr>
            <th><?php echo form::checkbox(array('name' => 'backup_check_all', 'class' => 'check_all')); ?></th>
            <th>
            <?php 
            	echo Kohana::lang('admin.name');             	      	
            	?>
            </th>
            <th>
            <?php 
            	echo Kohana::lang('admin.desc');            	
            	        	
            	?>
            </th><th>
            <?php 
            	echo Kohana::lang('admin.file');            	
            	        	
            	?>
            </th>            
            <th><?php echo Kohana::lang('admin.options'); ?></th>
        </tr>
            <?php
            foreach($oBackup as $backup) {
            ?>
        <tr>
            <td><?php 
                echo form::checkbox(array('name' => 'backup_check', 'class' => 'check', 'value' => $backup->backup_id )); 
                if($backup->state){
            	echo Kohana::lang('admin.restored');            	
                } ?></td>
            <td><?php echo $backup->name; ?></td>
            <td><?php echo $backup->description; ?></td>
            <td><?php echo $backup->file; ?></td>
            <td>
                <?php 
                     if(User_Model::IsAllowed($_SESSION['_acl'], 'backup', 'restore')->Value === TRUE){
                         echo html::anchor('4dminix/backup/restore/'.$backup->backup_id, Kohana::lang('admin.restore'), array('title' =>Kohana::lang('admin.pages.restore'), 'class' => 'btn btn-rest')); 
                     }
                     if(User_Model::IsAllowed($_SESSION['_acl'], 'backup', 'delete')->Value === TRUE){
                     	 echo html::anchor('4dminix/backup/delete/'.$backup->backup_id, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete')));
                     }
                
                ?>
            </td>
        </tr>
        	<?php
            }
            ?>
    </table>
    </div>
    <?php echo form::close(); ?>
    <?php
    } else {
    ?>
    <div class="info"><?php echo Kohana::lang('admin.backup.no_backup'); ?></div>
    <?php
    } ?>
</div>