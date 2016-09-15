<div id="admin_gallery_view">
	<div id="element_title">
	</div>
    <div class="options">
	<h5><?php echo Kohana::lang('gallery.edit_gallery'); echo isset($galleryName) ? ' "'.$galleryName.'"' : ''; ?></h5>
		<?php
		if (User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'add_photo')->Value === TRUE) :
			echo html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('gallery.add_image'), 'title'=>Kohana::lang('gallery.add_image'), 'class'=>'add_button', 'id'=>'add_image_button'.$galleryId)); 
		endif;
		
		if (User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'element_position')->Value === TRUE) :
			echo html::anchor('4dminix/galeria/pozycje_elementow/' . $galleryId, 
				html::image('img/admin_default/sort-ascending.png', 
					array('alt' => Kohana::lang('gallery.change_elements_positions'), 
					'title' => Kohana::lang('gallery.change_elements_positions'), 
					'class' => 'add_button')
				));
			//echo html::anchor('4dminix/galeria/pozycje_elementow/' . $galleryId, Kohana::lang('gallery.change_elements_positions'), array('class' => 'add_text'));
		endif; ?>

    </div> 
        
    <div id="add_gallery_image<?php echo $galleryId;?>" class="add_gallery_image_hidden">
        <?php echo form::open_multipart(); ?>
		<div id="selectedFiles"></div>
        <table class="table_form add_image">
            <tr>
                <td class="td_form_left">
                    <?php echo Kohana::lang('gallery.check_photo'); ?>
                </td>
                <td>
                      <input type="file" name="photo[]" id="files" multiple/>
                </td>
				
				
            </tr>
            
            <tr>
                <td class="td_form_left">
                        <?php echo Kohana::lang('gallery.alt_language'); ?>
                </td>
                <td>
                    <input type="text" name="alt" value="" />
                </td>
            </tr>

            <tr>
                <td>                    
                    <div id="close"><? echo html::image('img/admin_default/close.png'); ?></div>
                </td>
                <td>
                    <?php if(!empty($gallery[0]->element_id) && !empty($gallery[0]->type)) { ?>
                    <input type="hidden" value="<?php echo $gallery[0]->element_id; ?>" name="element_id" />
                    <input type="hidden" value="<?php echo $gallery[0]->type; ?>" name="type_name" />
                    <?php } ?>
                    <input type="submit" name="send_photo" class="ui-button ui-widget ui-state-default ui-corner-all" value="<?php echo Kohana::lang('gallery.send_photo'); ?>" />
                </td>
            </tr>
        </table>
        <?php echo form::close(); ?>
    </div>

    <?php
    if($photos->count() > 0 ) : ?>
    <?php echo form::open('4dminix/usun_zdjecie/'); ?>
    <input type="hidden" name="gallery_id" value="<?php echo $galleryId; ?>" />

    <table class="table_view">
        <tr>
            <th style="width: 40px;"><?php echo form::checkbox(array('name' => 'photo_check_all', 'class' => 'check_all')); ?></th>
            <th style="width: 90px;">
            <?php 
            	echo Kohana::lang('gallery.position'); 
            	echo html::anchor ('/4dminix/galeria/'.$galleryId.'/?images_orderby=1', html::image('img/admin_default/sort-asc.png')); 
            	echo html::anchor ('/4dminix/galeria/'.$galleryId.'/?images_orderby=2', html::image('img/admin_default/sort-desc.png'));
            ?>
            </th>
            <th style="width: 90px;"><?php echo Kohana::lang('gallery.thumb'); ?></th>
            <th>
            <?php 
            	echo Kohana::lang('gallery.description'); 
            	echo html::anchor ('/4dminix/galeria/'.$galleryId.'/?images_orderby=3', html::image('img/admin_default/sort-asc.png')); 
            	echo html::anchor ('/4dminix/galeria/'.$galleryId.'/?images_orderby=4', html::image('img/admin_default/sort-desc.png'));
            ?>
            </th>
            <th><?php echo Kohana::lang('gallery.options'); ?></th>
        </tr>
		<?php
		foreach($photos as $photo) : ?>
        <tr>
            <td style="width: 40px;"><?php echo form::checkbox(array('name' => 'photo_check[]', 'class' => 'check', 'value' => $photo->id_image)); ?></td>
            <td><?php echo $photo->position; ?></td>
            <td style="width: 90px;"><?php echo html::image(gallery_helper::SMALL_PATH.$photo->filename, array('class' => 'image', 'style'=>'width:70px;'));?></td>
            <td>
                <div class="admin_image_alt" id="photo_alt_<?php echo $photo->id_image; ?>">
                	<?php echo $photo->alt; ?>
                </div>
                <div class="admin_edit_image_alt" id="edit_alt">
                	<? echo html::image('img/icons/edit16.png'); ?>
                </div>
            	<? //edycja opisu obrazka updateImage ?>
            	<div class="edit_alt_form" id="edit_alt_form_<?php echo $photo->id_image; ?>">
            		 <?php //echo form::open('4dminix/galeria/edytuj_zdjecie'); ?>
            		 <input type="hidden" class="photo_id" value="<?php echo $photo->id_image; ?>" name="id_image" />
            		 <input type="text" class="photo_alt" name="alt" value="<?php echo $photo->alt; ?>" />
                     <input type="button" class="update_photo ui-button ui-widget ui-state-default ui-corner-all" name="update_photo" class="ui-button ui-widget ui-state-default ui-corner-all" value="<?php echo Kohana::lang('gallery.update_photo'); ?>" />
            		 <?php //echo form::close(); ?>
            		 
            	</div>
            </td>
            <?php 
			if(!empty($iPageId)) : // dla edycji calej strony ?>
            <td><?php echo html::anchor('4dminix/usun_zdjecie/'.$photo->image_id.'/'.$photo->gallery_id.'/'.$iPageId, html::image('img/icons/delete.gif', Kohana::lang('gallery.delete_photo')));?></td>
            <?php 
			else : // dla edycji w elementach - galeriach ?>
            <td>
                <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'delete_photo')->Value === TRUE):?>
                <?php 
				echo html::anchor('4dminix/usun_zdjecie/'.$photo->image_id.'/'.$photo->gallery_id, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete')));
				?>
				
				
                <?php endif;?>
            </td>
            <?php 
			endif; ?>
        </tr>
		<?php 
		endforeach; ?>
    </table>
        <?php if(!empty($iPageId)) { echo '<input type="hidden" name="page_id" value="'.$iPageId.'" />'; } ?>
	<?php if(User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'delete_photo')->Value === TRUE):?>
	<div class="delete_selected">
			<?php echo Kohana::lang('gallery.selected'); ?>: 
			<button name="delete_photo" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
	</div>
	<?php endif;?>
	<?php echo form::close();
    else : ?>
    <div class="info"><?php echo Kohana::lang('gallery.no_photos'); ?></div>
	<?php
    endif; ?>
</div>
<script>

</script>