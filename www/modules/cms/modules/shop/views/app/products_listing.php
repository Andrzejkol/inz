<?php if(!empty($vSearch)) { echo $vSearch; } ?>
<div id="breadcrumbs">
    <p><?php echo Kohana::lang('app.you_are_here'); ?>: <?php echo html::anchor('', 'Strona główna'); ?></p>
</div>
<div id="pagination_top">
    <h2><?php echo Kohana::lang('product.category'); ?></h2>
    <div class="pagination_view"><?php echo $pagination; ?></div>
</div>
<?php if(!empty($vFilters)) { echo $vFilters; } ?>

<?php if(!empty($vProductListing)) { echo $vProductListing; } ?>
<div id="pagination_bottom">
    
</div>