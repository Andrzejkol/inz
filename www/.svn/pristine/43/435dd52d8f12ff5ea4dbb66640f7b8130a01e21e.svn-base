<div id="admin_slider_index">    
	<?php
	echo ( ! empty($msg) ? $msg : NULL); ?>
    <div class="options">
    	<h5><?php echo Kohana::lang('slider.admin_slider_index_site_title'); ?></h5>
        <?php
        if (User_Model::IsAllowed($_SESSION['_acl'], 'slider', 'add')->Value === TRUE)
		{
			if (isset($iSliderElementsCount) AND $iSliderElementsCount < slider_helper::SLIDER_MAX_ELEMENTS)
			{
				echo html::anchor('4dminix/slider/dodaj', html::image('img/admin_default/newobject.gif', array('alt' => Kohana::lang('slider.add_slider_element'), 'class' => 'add_button')));
				echo html::anchor('4dminix/slider/dodaj', Kohana::lang('slider.add_slider_element'), array('class' => 'add_text'));
			}
		}
		if (User_Model::IsAllowed($_SESSION['_acl'], 'slider', 'element_position')->Value === TRUE) {
			echo html::anchor('4dminix/slider/pozycje_elementow', html::image('img/admin_default/sort-ascending.png', array('alt' => Kohana::lang('slider.change_elements_positions'), 'class' => 'add_button')));
			echo html::anchor('4dminix/slider/pozycje_elementow', Kohana::lang('slider.change_elements_positions'), array('class' => 'add_text'));
		}
        ?>
    </div>
    <?php if (!empty($aSliderElements) AND count($aSliderElements) > 0) : ?>

        <?php echo form::open(); ?>

        <table id="slider_index" class="table_view">
            <tr>
                <th><?php if (User_Model::IsAllowed($_SESSION['_acl'], 'slider', 'delete')->Value === TRUE): ?><input type="checkbox" name="slider_check_all" id="slider_check_all" class="check_all" value="1" /><?php endif; ?></th>
                <th>
                <?php 
                	echo Kohana::lang('admin.position');
                	layer::GetSort('slider_orderby', 1, 2, '/4dminix/slider');             
            	?>
            	</th>
				<th>
				<?php 
                	echo Kohana::lang('admin.thumb');                	
            	?>
            	</th>
				<th>
				<?php 
                	echo Kohana::lang('admin.type');
                	layer::GetSort('slider_orderby', 3, 4, '/4dminix/slider');             
            	?>
            	</th>
                <th>
                <?php 
                	echo Kohana::lang('admin.title');
                	layer::GetSort('slider_orderby', 5, 6, '/4dminix/slider');             
            	?>
            	</th>
                <th>
                <?php 
                	echo Kohana::lang('admin.status');
                	layer::GetSort('slider_orderby', 7, 8, '/4dminix/slider');             
            	?>
            	</th>
                <th>
                <?php 
                	echo Kohana::lang('admin.options');
            	?>
            	</th>
            </tr>
            <?php
			$iPosition = 1;
            foreach ($aSliderElements as $oElement) : ?>
			<tr>
				<td><input type="checkbox" name="slider_check[]" class="check" value="<?php echo $oElement->id_slider_element; ?>" /></td>
				<td><?php //echo $iPosition++; 
					echo $oElement->slider_element_position; ?></td>
				<td>
					<?php
					if ( ! empty($oElement->filename))
					{
						echo html::image(slider_helper::GetImagePathForType($oElement->slider_type_id, 'small') . $oElement->filename, array('alt' => ( ! empty($oElement->alt) ? $oElement->alt : Kohana::lang('slider.photo')), 'class' => 'thumb'));
					}
					else
					{
						echo Kohana::lang('slider.no_photo');
					}
					?>
				</td>
				<td>
					<?php
					switch ($oElement->slider_type_id)
					{
						case slider_helper::ELEMENT_TYPE_NEWS:
							echo Kohana::lang('slider.form_news_title');
							break;
						case slider_helper::ELEMENT_TYPE_SLIDER_NEWS:
							echo Kohana::lang('slider.form_slider_news_title');
							break;
						case slider_helper::ELEMENT_TYPE_IMAGE:
							echo Kohana::lang('slider.form_slider_image_title');
							break;
					}
					?>
				</td>
				<td><?php echo ! empty($oElement->title) ? $oElement->title : NULL; ?></td>
				<td>
				<?php //if(!empty($ns->available)) { echo html::image('img/icons/tick.png', array('alt'=>Kohana::lang('news.available_true'))); } else { echo html::image('img/icons/cross.png', array('alt'=>Kohana::lang('news.available_false'))); } ?>
                    <a href="#" class="changeStatus" id="slide-<?php echo $oElement->id_slider_element; ?>"><?php
                    echo ($oElement->available == 1) ? 
                            html::image('img/icons/tick.png', array('alt' => Kohana::lang('news.available_true'))) : 
                            html::image('img/icons/cross.png', array('alt' => Kohana::lang('news.available_false'))); 
                    ?></a>
                </td>
				<td>
					<?php
					if (User_Model::IsAllowed($_SESSION['_acl'], 'slider', 'edit')->Value == true) {
						echo html::anchor('4dminix/slider/edytuj/' . $oElement->id_slider_element, Kohana::lang('admin.edit'), array('class' => 'btn btn-edit'));
					}
					if (User_Model::IsAllowed($_SESSION['_acl'], 'slider', 'delete')->Value == true) {
						echo html::anchor('4dminix/slider/usun/' . $oElement->id_slider_element, Kohana::lang('admin.delete'), array('class' => 'btn btn-delete', 'title' => Kohana::lang('slider.delete_info')));
					}
					?>
				</td>
			</tr>
            <?php
			endforeach; ?>
        </table>
		<?php
		if (User_Model::IsAllowed($_SESSION['_acl'], 'slider', 'delete')->Value === TRUE): ?>
        <div class="delete_selected">
			<?php echo Kohana::lang('slider.selected'); ?>: 
            <button name="delete_selected" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
        </div>
        <?php
		endif;
		echo form::close(); ?>

    <?php else: ?>
        <div class="info"><?php echo Kohana::lang('slider.no_slider_elements'); ?></div>
    <?php endif; ?>

    <?php echo ! empty($oPagination) ? $oPagination : NULL; ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.changeStatus').click(function(){
            var sliders = $(this);
            var id = parseInt(sliders.attr('id').split('-')[1]);            
            $.get("<?php echo url::base() . 'slider_ajax/change_status';?>", 
            { id_slider_element: id }, 
            function(result){            	                
            	console.log('test');
            	console.log(result);
                if(result == '1'){          
                	console.log('test_1');      
                    $('img', sliders).attr({'src':"<?php echo url::file('img/icons/tick.png');?>", 'alt':"<?php echo Kohana::lang('admin.sliders.available_true');?>"});
                }
                else if(result == '0'){
                	console.log('test_0');
                    $('img', sliders).attr({'src':"<?php echo url::file('img/icons/cross.png');?>", 'alt':"<?php echo Kohana::lang('admin.sliders.available_false');?>"});
                }
            });            
            
            return false;
        });
    });
</script>

