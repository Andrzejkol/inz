<div id="admin_gallery_view">
    
    <div class="options">
	<h5>Galerie</h5>
        <?php 
		if(User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'add')->Value === TRUE){
			echo html::anchor('4dminix/dodaj_galerie', html::image('img/admin_default/newobject.gif', array('alt'=>'Dodaj nową galerię', 'class'=>'add_button'))); 
			echo html::anchor('4dminix/dodaj_galerie', Kohana::lang('gallery.add_gallery'), array('class'=>'add_text'));                
		} ?>
    </div>
    <?php
    if($galleries->count() > 0) {
        ?>
        <?php echo form::open('4dminix/usun_galerie/'); ?>
        <table id="gallery_list" class="table_view">
        <tr>
            <th><?php echo form::checkbox(array('name' => 'gelleries_check_all', 'class' => 'check_all')); ?></th>
            <th>
            <?php 
            	echo Kohana::lang('gallery.name'); 
            	layer::GetSort('galleries_orderby', 1, 2, '/4dminix/galerie');            	
            	?>
            </th>
            <th>
            <?php 
            	echo Kohana::lang('gallery.description');             	
            	layer::GetSort('galleries_orderby', 3, 4, '/4dminix/galerie');
            	?>
            </th>
            <th>
            <?php 
            	echo Kohana::lang('gallery.language'); 
            	layer::GetSort('galleries_orderby', 5, 6, '/4dminix/galerie');
            ?>
            </th>
            <th><?php echo Kohana::lang('gallery.options'); ?></th>
        </tr>
            <?php
            foreach($galleries as $gallery) {
                ?>
        <tr>
            <td><?php echo form::checkbox(array('name' => 'galleries_check[]', 'class' => 'check', 'value' => $gallery->id_gallery )); ?></td>
            <td><?php echo (User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'add_photo')->Value === TRUE) ? html::anchor('4dminix/galeria/'.$gallery->id_gallery, $gallery->gallery_name) : $gallery->gallery_name; ?></td>
            <td><?php echo $gallery->gallery_description; ?></td>
            <td><?php echo Kohana::lang('language.'.$gallery->language_description); ?></td>
            <td>
                <?php 
                     if(User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'add_photo')->Value === TRUE){
						 
						  echo html::anchor('4dminix/galeria/'.$gallery->id_gallery, Kohana::lang('admin.gallery'), array('title' =>Kohana::lang('admin.gallery'), 'class' => 'btn btn-gallery')); 
                     }
                     if(User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'edit')->Value === TRUE){
						  echo html::anchor('4dminix/edytuj_galerie/'.$gallery->id_gallery.'/'.$gallery->name, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.edit'), 'class' => 'btn btn-edit')); 
                     }
                     if(User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'delete')->Value === TRUE){
						  echo html::anchor('4dminix/usun_galerie/'.$gallery->id_gallery, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.delete')));
                     }
                
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
    </table>
	<?php if(User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'delete')->Value === TRUE):?>
    <div class="delete_selected">
        <?php echo Kohana::lang('gallery.selected'); ?>:
		<button name="delete_gallery" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
    </div>
	<?php endif;?>
        <?php echo form::close(); ?>
        <?php
    }
    else {
        ?>
    <div class="info"><?php echo Kohana::lang('gallery.no_galleries'); ?></div>
        <?php
    }
    ?>
<?php echo $oPagination;?>

</div>