<div class="img-wrapper">
<?php
if ( ! empty($oElement)) :     
    ?>

	<?php
	echo html::image(slider_helper::GetImagePathForType($oElement->slider_type_id, 'big') . $oElement->filename, array('alt' => ( ! empty($oElement->alt) ? $oElement->alt : NULL)));        
?>
</div>
<div class="news-wrapper">
	<?php
	if ( ! empty($oElement->title)) : ?>
	<h4 class="news-title"><?php echo $oElement->title ?></h4>
	<?php
	endif;
	$sDescription = ! empty($oElement->short_description) ? $oElement->short_description : $oElement->description;
	$sDescription = trim($sDescription);
	if ( ! empty($sDescription)) :
	$sDescription = text::limit_chars($sDescription, 220, '...', TRUE); ?>
	<div class="news_short_description"><?php echo $sDescription; ?></div>
	<?php
	endif;
	if ($oElement->slider_type_id == slider_helper::ELEMENT_TYPE_NEWS)
	{
		$sLink = Kohana::lang('links.lang') . Kohana::lang('links.single_news') . string::prepareURL($oElement->id_news . '-' . $oElement->title);
	}
	elseif ($oElement->slider_type_id == slider_helper::ELEMENT_TYPE_SLIDER_NEWS)
	{
		$sLink = ! empty($oElement->link) ? $oElement->link : NULL;
	}
	if (! empty($sLink)) : ?>
	<span class="wrapper">
		<?php echo html::anchor($sLink, Kohana::lang('slider.read_all'), array('class'=>'btn btn-transparent'));   ?>
	</span>
	<?php 
	endif; ?>
</div>
<?php
endif; ?>