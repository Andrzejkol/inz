<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'position',
            'sTitle'=>Kohana::lang('slider.admin_slider_elements_positions_site_title')
            ))->render(TRUE);
?>
<div id="admin_slider_elements_positions">
	<div class="info">
		<?php echo Kohana::lang('slider.elements_positions_info'); ?>
	</div>
	<?php
	if ( ! empty($aSliderElements) AND count($aSliderElements)) :
		echo form::open(); ?>
	<table class="table_view sortable">
		<thead>
			<tr>
				<th>Pozycja</th>
				<th>Miniatura</th>
				<th>Typ</th>
				<th>Tytuł</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$iCount = count($aSliderElements);
			$sPosition = 1;
			foreach ($aSliderElements as $oElement) : ?>
			<tr class="ui-state-default">
				<td>
					<span class="position"><?php echo $sPosition++; ?></span>
					<input type="hidden" name="elements[<?php echo $oElement->id_slider_element; ?>]" value="<?php echo $iCount--; ?>" />
				</td>
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
				<td>
					<?php echo ( ! empty($oElement->title) ? $oElement->title : NULL); ?>
				</td>
			</tr>
			<?php
			endforeach;?>
		</tbody>
	</table>
	<span class="submit_wrapper">
		
		<input type="button" value="<?php echo Kohana::lang('admin.back'); ?>" name="back" class="btn btn-back" />
		<input type="submit" name="elements_positions" value="<?php echo Kohana::lang('slider.submit'); ?>" class="btn btn-save" />
	</span>
	<?php
		echo form::close();
	endif;
	?>
</div>
<script>
	$(document).ready(function() {
		var fixHelper = function(e, ui) {
			ui.children().each(function() {
				$(this).width($(this).width());
			});
			return ui;
		};
		$( "table.sortable tbody").sortable({
			axis: 'y',
			helper: fixHelper,
			update: function(event, ui) {
				var position =  1;
				var count = $('table.sortable tbody tr').length;
				$('table.sortable tbody tr').each(function(){
					$(this).find('.position').text(position++);
					$(this).find('input[type="hidden"]').val(count--);
				});
				//console.log(ui.item.find('.position').text());
			}
		});
		$( ".sortable" ).disableSelection();
	});
</script>