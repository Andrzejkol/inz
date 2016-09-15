<div id="admin_slider_elements_positions">
    <h2><?php echo Kohana::lang('slider.admin_slider_elements_positions_site_title'); ?></h2>
	<div class="info">
		<?php echo Kohana::lang('slider.elements_positions_info'); ?>
	</div>
	<?php
	if ( ! empty($aBoxesElements) AND count($aBoxesElements)) :
		echo form::open(); ?>
	<input type="hidden" name="boxes_set_id" value="<?php echo $boxes_set_id; ?>" />
	<table class="table_view sortable">
		<thead>
			<tr>
				<th>Pozycja</th>
				<th>Miniatura</th>
				<th>Tytuł</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$iCount = count($aBoxesElements);
			$sPosition = 1;
			foreach ($aBoxesElements as $oElement) : ?>
			<tr class="ui-state-default">
				<td>
					<span class="position"><?php echo $sPosition++; ?></span>
					<input type="hidden" name="elements[<?php echo $oElement->id_boxes; ?>]" value="<?php echo $iCount--; ?>" />
				</td>
				<td>
					<?php
					if ( ! empty($oElement->filename))
					{
						echo html::image(boxes::SMALL_PATH . $oElement->filename, array('alt' => ( ! empty($oElement->title) ? $oElement->title : Kohana::lang('slider.photo')), 'class' => 'thumb'));
					}
					else
					{
						echo Kohana::lang('slider.no_photo');
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
		<input type="submit" name="elements_positions" value="<?php echo Kohana::lang('slider.submit'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all" />
		<input type="button" value="<?php echo Kohana::lang('slider.cancel'); ?>" name="back" class="ui-button ui-widget ui-state-default ui-corner-all" />
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
		$("table.sortable tbody").sortable({
			placeholder: 'table-placeholder',
			forcePlaceholderSize: 'true',
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