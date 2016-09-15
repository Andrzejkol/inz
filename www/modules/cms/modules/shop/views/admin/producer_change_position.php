<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'position',
            'sTitle'=>Kohana::lang('slider.admin_slider_elements_positions_site_title')
            ))->render(TRUE);
?>
<div id="admin_product_categories_change_position">
	<div class="info">
		<?php echo Kohana::lang('slider.elements_positions_info'); ?>
	</div>

    <?php 
    if($oProducers->count() > 0): 
    echo form::open(); ?>
        
    <table class="table_view sortable" id="product_category_list">
        <thead>
        <tr>
            <th>Pozycja</th>
            <th><?php echo Kohana::lang('producer.logo'); ?></th>
            <th><?php echo Kohana::lang('producer.name'); ?></th>            
            <th><?php echo Kohana::lang('producer.active'); ?></th>            
        </tr>
        </thead>
        <tbody>
        <?php
        $iCount = count($oProducers);
	$sPosition = 1;
            foreach($oProducers as $p): ?>
        <tr class="ui-state-default">
            <td>
            <span class="position"><?php echo $sPosition++; ?></span>
	        <input type="hidden" name="elements[<?php echo $p->id_producer; ?>]" value="<?php echo $iCount--; ?>" />
            </td>
            <td><?php echo html::image(Producer_Model::PRODUCER_LOGO_THUMBSPATH . $p->producer_logo); ?></td>
            <td><?php echo strip_tags($p->producer_name); ?></td> 
            <td><?php echo $p->active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('producer.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('producer.disabled'))); ?></td>
        </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
    <span class="submit_wrapper">
		<input type="submit" name="elements_positions" value="<?php echo Kohana::lang('slider.submit'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all" />
		<input type="button" value="<?php echo Kohana::lang('slider.cancel'); ?>" name="back" class="ui-button ui-widget ui-state-default ui-corner-all" />
	</span>
        <?php
        echo form::close();
    else: ?>
    <div class="info"><?php echo Kohana::lang('producer.no_producers'); ?></div>
    <?php endif; ?>
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
</div>