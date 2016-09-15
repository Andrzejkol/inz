<div id="admin_boxes_view">
    <div class="options">
        <h5><?php echo Kohana::lang('admin.boxes.index_site_title'); ?></h5>
        <?php 
		if(User_Model::IsAllowed($_SESSION['_acl'], 'boxes', 'add')->Value === TRUE){
			echo html::anchor('4dminix/boxes/add', html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('admin.boxes.add_block'), 'class'=>'add_button'))); 
			echo html::anchor('4dminix/boxes/add', Kohana::lang('admin.boxes.add_block'), array('class'=>'add_text'));                
		} 
        ?>
        
    </div>
    <?php
    if($oBoxes->count() > 0) {
        ?>
        <?php echo form::open('4dminix/boxes/delete'); ?>
        <table id="boxes_list" class="table_view">
        <tr>
            <th><?php echo form::checkbox(array('name' => 'boxes_check_all', 'class' => 'check_all')); ?></th>
            <th>
            <?php 
            	echo Kohana::lang('admin.name'); 
            	layer::GetSort('boxes_orderby', 1, 2, '/4dminix/boxes');            	
            	?>
            </th>
            <th>
            <?php 
            	echo Kohana::lang('admin.desc');             	
            	layer::GetSort('boxes_orderby', 3, 4, '/4dminix/boxes');            	
            	?>
            </th>
            <th><?php echo Kohana::lang('admin.options'); ?></th>
        </tr>
            <?php
            foreach($oBoxes as $box) {
            ?>
        <tr>
            <td><?php echo form::checkbox(array('name' => 'boxes_check', 'class' => 'check', 'value' => $box->id_boxes_set )); ?></td>
            <td><?php echo html::anchor('4dminix/boxes/'.$box->id_boxes_set, $box->name); ?></td>
            <td><?php echo $box->description; ?></td>
            <td>
                <?php 
                     if(User_Model::IsAllowed($_SESSION['_acl'], 'boxes', 'edit')->Value === TRUE){
                         echo html::anchor('4dminix/boxes/edit/'.$box->id_boxes_set, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
                     }
                     if(User_Model::IsAllowed($_SESSION['_acl'], 'boxes', 'delete')->Value === TRUE){
                     	 echo html::anchor('4dminix/boxes/delete/'.$box->id_boxes_set, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete')));
                     }
                
                ?>
            </td>
        </tr>
        	<?php
            }
            ?>
    </table>
	<?php if(User_Model::IsAllowed($_SESSION['_acl'], 'boxes', 'delete')->Value === TRUE){
    	echo Kohana::lang('admin.selected'); ?>:     		
		
		<button name="delete_pages" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
		
	<?php } ?>
    </div>
    <?php echo form::close(); ?>
    <?php
    } else {
    ?>
    <div class="info"><?php echo Kohana::lang('admin.boxes.no_boxes'); ?></div>
    <?php
    }
    echo $oPagination;
    ?>
</div>