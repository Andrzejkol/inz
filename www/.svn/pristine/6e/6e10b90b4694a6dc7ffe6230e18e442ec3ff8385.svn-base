<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'position',
            'sTitle'=>Kohana::lang('gallery.admin_elements_positions_site_title')
            ))->render(TRUE);
?>
<div id="admin_slider_elements_positions">
	<div class="info">
		<?php echo Kohana::lang('gallery.elements_positions_info'); ?>
	</div>
	<?php
	if ( ! empty($oElements) AND count($oElements)) :
		echo form::open(); ?>
	<table class="table_view sortable">
		<thead>
			<tr>
				<th style="width: 30px;"><?php echo Kohana::lang('gallery.position'); ?></th>
				<th>Miniatura</th>
				<th>Opis</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$iCount = count($oElements);
			$sPosition = 1;
			foreach ($oElements as $oElement) : ?>
			<tr class="ui-state-default">
				<td style="width: 30px;">
					<span class="position"><?php echo $sPosition++; ?></span>
					<input type="hidden" name="elements[<?php echo $oElement->id_image; ?>]" value="<?php echo $iCount--; ?>" />
				</td>
				<td>
					<?php
					if ( ! empty($oElement->filename))
					{
						echo html::image(gallery_helper::SMALL_PATH . $oElement->filename, array('alt' => ( ! empty($oElement->alt) ? $oElement->alt : Kohana::lang('slider.photo')), 'class' => 'thumb'));
					}
					?>
				</td>
				<td>
					<?php echo ( ! empty($oElement->alt) ? $oElement->alt : NULL); ?>
				</td>
			</tr>
			<?php
			endforeach;?>
		</tbody>
	</table>
	<div class="submit_wrapper" style="text-align: center; margin: 1em 0;">
		<input type="submit" name="elements_positions" value="<?php echo Kohana::lang('gallery.submit'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all" />
		<input type="button" value="<?php echo Kohana::lang('gallery.cancel'); ?>" name="back" class="ui-button ui-widget ui-state-default ui-corner-all" />
	</div>
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
			}
		});
		$( ".sortable" ).disableSelection();
	});
</script>