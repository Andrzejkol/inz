<div id="admin_boxes_index">
    <div class="options">
            <h5><?php echo Kohana::lang('boxes.admin_boxes_index_site_title'); ?></h5>
        <?php		
			if (User_Model::IsAllowed($_SESSION['_acl'], 'boxes', 'add')->Value == true) {
				echo html::anchor('4dminix/box/add/'.$boxes_set_id.((!empty($iPageId)) ? '/'.$iPageId : ''), html::image('img/admin_default/newobject.gif', array('alt' => Kohana::lang('boxes.add_box'), 'class' => 'add_button')));
				echo html::anchor('4dminix/box/add/'.$boxes_set_id.((!empty($iPageId)) ? '/'.$iPageId : ''), Kohana::lang('boxes.add_box'), array('class' => 'add_text'));
			}
            if (User_Model::IsAllowed($_SESSION['_acl'], 'boxes', 'element_position')->Value === TRUE) {
                echo html::anchor('4dminix/boxes/elements-positions/'.$boxes_set_id.((!empty($iPageId)) ? '/'.$iPageId : ''), html::image('img/admin_default/sort-ascending.png', array('alt' => Kohana::lang('slider.change_elements_positions'), 'class' => 'add_button')));
                echo html::anchor('4dminix/boxes/elements-positions/'.$boxes_set_id.((!empty($iPageId)) ? '/'.$iPageId : ''), Kohana::lang('slider.change_elements_positions'), array('class' => 'add_text'));
            }
        ?>
    </div>

    <?php //var_dump($oBoxes);
    if (!empty($oBoxes) && $oBoxes->count() > 0) : ?>

        <?php echo form::open('4dminix/box/delete'); ?>
        <input type="hidden" name="boxes_set_id" value="<?php echo $boxes_set_id; ?>" />
        <?php if(!empty($iPageId)): ?>
        <input type="hidden" name="page_id" value="<?php echo $iPageId; ?>" />
        <?php endif; ?>
        <table id="boxes_index" class="table_view">
            <tr>
                <th><input type="checkbox" name="boxes_check_all" id="boxes_check_all" class="check_all" value="1" /></th>
				<th><?php echo Kohana::lang('boxes.photo'); ?></th>
                <th>
                <?php 
            		echo Kohana::lang('boxes.unique_name');
                    if(empty($iPageId))
            		layer::GetSort('boxes_orderby', 1, 2, '/4dminix/boxes/'.$boxes_set_id); 
            	?>
            	</th>
                <th>
                <?php 
            		echo Kohana::lang('boxes.title'); 
                    if(empty($iPageId))
            		layer::GetSort('boxes_orderby', 3, 4, '/4dminix/boxes/'.$boxes_set_id); 
            	?>
                </th>
                <th>
                <?php 
            		echo Kohana::lang('boxes.status'); 
                    if(empty($iPageId))
            		layer::GetSort('boxes_orderby', 5, 6, '/4dminix/boxes/'.$boxes_set_id); 
            	?>
				</th>
                <th><?php echo Kohana::lang('boxes.option'); ?></th>
            </tr>
            <?php
            foreach ($oBoxes as $box) {
                ?>
                <tr>
                    <td><input type="checkbox" name="box_check[]" class="check" value="<?php echo $box->id_boxes; ?>" /></td>
					<td>
                        <?php
                        if(!empty($box->filename)) {
                            echo html::image('files/boxes/small/'.$box->filename, array('style'=>'width:50px;', 'class'=>'image'));
                        }
                        ?>
					</td>
                    <td><?php echo $box->name; ?></td>
                    <td><?php echo $box->title; ?></td>
                    <td><?php echo html::image('img/icons/' . (($box->active == 1) ? 'tick' : 'cross') . '.png', ''); ?></td>
                    <td>
                        <?php
                        if (User_Model::IsAllowed($_SESSION['_acl'], 'boxes', 'edit')->Value == true) {
                        	echo html::anchor('4dminix/box/edit/' . $box->id_boxes.'/'.$boxes_set_id.((!empty($iPageId)) ? '/'.$iPageId : ''), Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
                        }
                        if (User_Model::IsAllowed($_SESSION['_acl'], 'boxes', 'delete')->Value == true) {
                            echo html::anchor('4dminix/box/delete/' . $box->id_boxes.'/'.$boxes_set_id.((!empty($iPageId)) ? '/'.$iPageId : ''), Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete')));
                        }
                        ?>                
                    </td>
                </tr>

                <?php
            }
            ?>
        </table>

        <div class="delete_selected">
            <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'boxes', 'delete')->Value == true){
    			echo Kohana::lang('admin.selected'); ?>:     		

				<button name="delete_pages" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>

    		<?php } ?>
    	</div>

        <?php echo form::close(); ?>

    <?php else: ?>
        <div class="info"><?php echo Kohana::lang('admin.boxes.no_boxes'); ?></div>
    <?php endif; ?>

    <?php //echo $oPagination; ?>
</div>
