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

<div id="categories_index">
    <?php if(!empty($oProductsCategories) && $oProductsCategories->count()>0) { 
        echo form::open(); ?>
        
    <table class="table_view sortable" id="product_category_list">
        <thead>
        <tr>
            <th>Pozycja</th>
            <th><?php echo Kohana::lang('product_category.thumbnail'); ?></th>
            <th><?php echo Kohana::lang('product_category.category_name'); ?></th>
            <th><?php echo Kohana::lang('product_category.status'); ?></th>            
        </tr>
        </thead>
        <tbody>
        <?php
        $iCount = count($oProductsCategories);
	$sPosition = 1;
        
        foreach($oProductsCategories as $category) { ?>
        <tr class="ui-state-default">
            <td>                
                <span class="position"><?php echo $sPosition++; ?></span>
	        <input type="hidden" name="elements[<?php echo $category->id_category; ?>]" value="<?php echo $iCount--; ?>" />
            </td>
            <td style="width: 100px; text-align: center"><?php echo !empty($category->image_filename) ? html::image(shop::PRODUCT_CATEGORY_SMALL_PATH.$category->image_filename, Kohana::lang('product_category.thumbnail')) : '' ?></td>
            <td><span><?php echo $category->category_name; ?></span></td>
            <td><?php echo $category->active == 'Y' ? html::anchor('4dminix/zmien_status_kategorii/'.$category->id_category, html::image('img/icons/tick.png', array('alt' => Kohana::lang('product_category.enabled')))) : html::anchor('4dminix/zmien_status_kategorii/'.$category->id_category, html::image('img/icons/cross.png', array('alt' => Kohana::lang('product_category.disabled')))); ?></td>            
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <span class="submit_wrapper">
		<input type="submit" name="elements_positions" value="<?php echo Kohana::lang('slider.submit'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all" />
		<input type="button" value="<?php echo Kohana::lang('slider.cancel'); ?>" name="back" class="ui-button ui-widget ui-state-default ui-corner-all" />
	</span>
    <?php
    echo form::close();
    } else { ?>
    <div class="info"><?php echo Kohana::lang('product_category.no_products_categories'); ?></div>
    <?php } ?>
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
    </div>
