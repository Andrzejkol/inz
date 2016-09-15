<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>'Edytuj slajd'
            ))->render(TRUE);
?>
<?php
	echo ( ! empty($msg) ? $msg : NULL); ?>
<div id="admin_slider_edit" class="admin_slider">
<?php
if(!empty($type)){		
	if($type == '1'){ ?>
<div id="tabs-1" class="ui-tabs-hide">
		<?php
		echo form::open_multipart(); ?>
		<ul>
			<?php
			if ( ! empty($aNewsTitles) AND count($aNewsTitles)) : ?>
			<li>
				<?php
				echo form::label(array('for' => 'news_title'), Kohana::lang('slider.news_title'));
				echo form::dropdown(array('name' => 'news_element_id', 'id' => 'news_title'), $aNewsTitles, ( ! empty($_POST) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_NEWS AND isset($_POST['news_element_id'])) ? $_POST['news_element_id'] : NULL); ?>
				<span class="label_comment"><?php echo Kohana::lang('slider.news_title_info') ?></span>
			</li>
			<?php
			endif; ?>
			<li>
				<input type="hidden" name="slider_type_id" id="news_type_id" value="<?php echo slider_helper::ELEMENT_TYPE_NEWS; ?>" />
				<input type="submit" value="<?php echo Kohana::lang('slider.save'); ?>" name="submit" class="ui-button ui-widget ui-state-default ui-corner-all" />
			</li>
		</ul>
		<?php
		echo form::close(); ?>
	</div>
<?php }
elseif($type == '2'){
?>
	<div id="tabs-2" class="ui-tabs-hide">
		<?php
		echo form::open_multipart(); ?>
		<ul>
			<li>
				<label for="add_news_photo"><?php echo Kohana::lang('slider.choose_image'); ?></label>
				<input type="file" name="photo" id="add_news_photo" />
				<span class="label_comment" style="display: inline;"><?php echo Kohana::lang('slider.slider_news_image_info'); ?></span>				
			</li>
			<li>				
				<?php echo html::image(slider_helper::GetImagePathForType(2, 'small') . $oSliderElement->filename, array('alt' => Kohana::lang('slider.photo'), 'class' => 'thumb')); ?>
			</li>
			<li>
				<label for="add_photo_alt"><?php echo Kohana::lang('slider.add_photo_alt'); ?></label>				
				<?php
				if(!empty($_POST) && $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_SLIDER_NEWS && isset($_POST['alt'])){ ?>
					<input type="text" name="alt" id="add_photo_alt" value="<?php echo $_POST['alt']; ?>" />
				<?php } 
				elseif(!empty($oSliderElement) && $oSliderElement->alt){ ?>
					<input type="text" name="alt" id="add_photo_alt" value="<?php echo $oSliderElement->alt; ?>" />
				<?php } 
				else { ?>
					<input type="text" name="alt" id="add_photo_alt" value="" />
				<?php }
				?>
			</li>
            <?php /*
			<li>
				<?php
				echo form::label('or_link', Kohana::lang('slider.or_link')); ?>
				<?php if(!strpos($oSliderElement->link, 'http')){
					echo '<input type="checkbox" value="news" id="or_link" name="or_link" checked="checked" />'; 					
				}
				else { 
					echo '<input type="checkbox" value="news" id="or_link" name="or_link" />';
				}?>
			</li>*/ ?>
			<li>
				<?php
				echo form::label('news_link', Kohana::lang('slider.link')); ?>
				
				
				<?php
				if(!empty($_POST) && $_POST['link'] == slider_helper::ELEMENT_TYPE_SLIDER_NEWS && isset($_POST['link'])){ ?>
					<input type="text" name="link" id="news_link" value="<?php echo $_POST['link']; ?>" />
				<?php } 
				elseif(!empty($oSliderElement) && $oSliderElement->link){ ?>
					<input type="text" name="link" id="news_link" value="<?php echo $oSliderElement->link; ?>" />
				<?php } 
				else { ?>
					<input type="text" name="link" id="news_link" value="" />
				<?php }
				?>
				
				<span class="label_comment"><?php echo Kohana::lang('slider.link_info') ?></span>
			</li>
			<li>
				<label for="add_news_title"><?php echo Kohana::lang('slider.news_title'); ?></label>				
				<?php
				if(!empty($_POST) && $_POST['title'] == slider_helper::ELEMENT_TYPE_SLIDER_NEWS && isset($_POST['title'])){ ?>
					<input type="text" name="title" id="add_news_title" value="<?php echo $_POST['title']; ?>" />
				<?php } 
				elseif(!empty($oSliderElement) && $oSliderElement->title){ ?>
					<input type="text" name="title" id="add_news_title" value="<?php echo $oSliderElement->title; ?>" />
				<?php } 
				else { ?>
					<input type="text" name="title" id="add_news_title" value="" />
				<?php }
				?>
			</li>
			<li>
				<label for="add_news_short_description"><?php echo Kohana::lang('slider.short_description'); ?></label>				
				<?php
				if(!empty($_POST) && $_POST['short_description'] == slider_helper::ELEMENT_TYPE_SLIDER_NEWS && isset($_POST['short_description'])){ ?>
					<textarea name="short_description" cols="40" rows="5" id="add_news_short_description"><?php echo $_POST['short_description']; ?></textarea>
				<?php } 
				elseif(!empty($oSliderElement) && $oSliderElement->short_description){ ?>
					<textarea name="short_description" cols="40" rows="5" id="add_news_short_description"><?php echo $oSliderElement->short_description; ?></textarea>
				<?php } 
				else { ?>
					<textarea name="short_description" cols="40" rows="5" id="add_news_short_description"></textarea>
				<?php }
				?>
			</li>
			<?php /*
			<li>
				<label for="add_news_description"><?php echo Kohana::lang('slider.description'); ?></label>
				<textarea name="description" cols="40" rows="5" id="add_news_description"><?php echo ( ! empty($_POST) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_SLIDER_NEWS AND isset($_POST['description'])) ? $_POST['description'] : NULL; ?></textarea>
			</li> */ ?>
			<li>
				<input type="hidden" name="slider_type_id" id="slider_news_type_id" value="<?php echo slider_helper::ELEMENT_TYPE_SLIDER_NEWS; ?>" />
				<input type="submit" value="<?php echo Kohana::lang('slider.save'); ?>" name="submit" class="ui-button ui-widget ui-state-default ui-corner-all" />
			</li>
		</ul>
		<?php
		echo form::close(); ?>
	</div>
<?php }
elseif($type == '3') {
?>
	<div id="tabs-3" class="ui-tabs-hide">
		<?php
		echo form::open_multipart(); ?>
		<ul>
			<li>
				<?php
				echo form::label('add_photo', Kohana::lang('slider.choose_image')); ?>
				<input type="file" name="image" id="add_photo" />
				<span class="label_comment"><?php echo Kohana::lang('slider.slider_image_info') ?></span>
			</li>
			<li>				
				<?php echo html::image(slider_helper::GetImagePathForType(3, 'small') . $oSliderElement->filename, array('alt' => Kohana::lang('slider.photo'), 'class' => 'thumb')); ?>
			</li>
			<li>
				<?php echo form::label('title', Kohana::lang('slider.title')); ?>				
				<?php
				if(!empty($_POST) && $_POST['title'] == slider_helper::ELEMENT_TYPE_IMAGE && isset($_POST['title'])){ ?>
					<textarea name="title" cols="40" rows="5" id="add_photo_title"><?php echo $_POST['title']; ?></textarea>
				<?php } 
				elseif(!empty($oSliderElement) && $oSliderElement->title){ ?>
					<textarea name="title" cols="40" rows="5" id="add_photo_title"><?php echo strip_tags($oSliderElement->title); ?></textarea>
				<?php } 
				else { ?>
					<textarea name="title" cols="40" rows="5" id="add_photo_title"></textarea>
				<?php }
				?>
			</li>
                        <?php /*
			<li>
				<div><label for="slider_text_color"><?php echo Kohana::lang('slider.text_color'); ?></label>				
				<input id="slider_text_color" name="slider_text_color" type="text" value="#000000" /></div>
				<span class="label_comment">Przy każdej edycji należy wybrać odpowiedni kolor dla tekstu, w przeciwnym wypadku tekst pozostanie czarny</span>
			</li>                         
                         */ ?>
			<li>
				<label for="add_photo_alt_image"><?php echo Kohana::lang('slider.add_photo_alt'); ?></label>				
				<?php
				if(!empty($_POST) && $_POST['alt'] == slider_helper::ELEMENT_TYPE_IMAGE && isset($_POST['alt'])){ ?>
					<textarea name="alt" cols="40" rows="5" id="add_photo_alt_image"><?php echo $_POST['alt']; ?></textarea>
				<?php } 
				elseif(!empty($oSliderElement) && $oSliderElement->alt){ ?>
					<textarea name="alt" cols="40" rows="5" id="add_photo_alt_image"><?php echo $oSliderElement->alt; ?></textarea>
				<?php } 
				else { ?>
					<textarea name="alt" cols="40" rows="5" id="add_photo_alt_image"></textarea>
				<?php }
				?>
			</li>
			<?php /*
			<li>
				<?php
				echo form::label('link', Kohana::lang('slider.link')); ?>				
				<?php
				if(!empty($_POST) && $_POST['link'] == slider_helper::ELEMENT_TYPE_IMAGE && isset($_POST['link'])){ ?>
					<textarea name="link" cols="40" rows="5" id="link"><?php echo $_POST['link']; ?></textarea>
				<?php } 
				elseif(!empty($oSliderElement) && $oSliderElement->link){ ?>
					<textarea name="link" cols="40" rows="5" id="link"><?php echo $oSliderElement->link; ?></textarea>
				<?php } 
				else { ?>
					<textarea name="link" cols="40" rows="5" id="link"></textarea>
				<?php }
				?>
				<span class="label_comment"><?php echo Kohana::lang('slider.link_info') ?></span>
			</li>			  
			 */?>
                        <li id="news-link2">
				<?php
				echo form::label('news_link', Kohana::lang('slider.link')); ?>
				
				
				<?php
				if(!empty($_POST) && isset($_POST['link'])){ ?>
					<input type="text" name="link" id="news_link2" value="<?php echo $_POST['link']; ?>" />
				<?php } 
                                elseif(!empty($oSliderElement) && $oSliderElement->link){ ?>
					<input type="text" name="link" id="news_link2" value="<?php echo $oSliderElement->link; ?>" />
				<?php } 
                                else { ?>
					<input type="text" name="link" id="news_link2" value="" />
				<?php }
				?>
				
				<span class="label_comment"><?php echo Kohana::lang('slider.link_info') ?></span>
			</li>
                        <li>
                            <?php
                            echo form::label('language', Kohana::lang('slider.language'));
                            echo form::dropdown(array('name'=>'lang', 'id'=>'language'),$languages, !empty($_POST) ? $_POST['lang'] : $oSliderElement->lang); ?>
                            
                        </li>
                                
                        
                        <?php /*
			<li>
				<?php
				echo form::label('or_link', Kohana::lang('slider.or_link')); ?>
				<?php if(!strpos($oSliderElement->link, 'http')){
					echo '<input type="checkbox" value="news" id="or_link2" name="or_link" checked="checked" />'; 					
				}
				else { 
					echo '<input type="checkbox" value="news" id="or_link2" name="or_link" />';
				}?>
			</li>
			<li id="news-link2">
				<?php
				echo form::label('news_link', Kohana::lang('slider.link')); ?>
				
				
				<?php
				if(!empty($_POST) && $_POST['link'] == slider_helper::ELEMENT_TYPE_SLIDER_NEWS && isset($_POST['link'])){ ?>
					<input type="text" name="link" id="news_link2" value="<?php echo $_POST['link']; ?>" />
				<?php } 
				elseif(!empty($oSliderElement) && $oSliderElement->link){ ?>
					<input type="text" name="link" id="news_link2" value="<?php echo $oSliderElement->link; ?>" />
				<?php } 
				else { ?>
					<input type="text" name="link" id="news_link2" value="" />
				<?php }
				?>
				
				<span class="label_comment"><?php echo Kohana::lang('slider.link_info') ?></span>
			</li>
			<?php
			if ( ! empty($aNewsTitles) AND count($aNewsTitles)) : ?>
			<li id="news-title2">
				<?php
				echo form::label(array('for' => 'news_title'), Kohana::lang('slider.news_link'));
				echo form::dropdown(array('name' => 'news_element_id', 'id' => 'news_title2'), $aNewsTitles, ( ! empty($_POST) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_NEWS AND isset($_POST['news_element_id'])) ? $_POST['news_element_id'] : NULL); ?>
				<span class="label_comment"><?php echo Kohana::lang('slider.news_title_info') ?></span>
			</li>
			<?php
			endif; ?>                         
                         */ ?>
			<li>
				<input type="hidden" name="slider_type_id" id="slider_image_type_id" value="<?php echo slider_helper::ELEMENT_TYPE_IMAGE; ?>" />
				<input type="submit" value="<?php echo Kohana::lang('slider.save'); ?>" name="submit" class="btn btn-save" />
			</li>
		</ul>
		<?php
		echo form::close(); ?>
	</div>
<?php }
elseif($type == '4') {
?>
	<div id="tabs-4" class="ui-tabs-hide">
		<?php
		echo form::open_multipart(); ?>
		<ul>
			<li>
				<?php
				echo form::label('add_photo', Kohana::lang('slider.choose_image')); ?>
				<input type="file" name="image" id="add_photo" />
				<span class="label_comment"><?php echo Kohana::lang('slider.slider_movie_info') ?></span>
			</li>
			<li>				
				<?php echo html::image(slider_helper::GetImagePathForType(4, 'small') . $oSliderElement->filename, array('alt' => Kohana::lang('slider.photo'), 'class' => 'thumb')); ?>
			</li>
			<li>
				<?php echo form::label('title', Kohana::lang('slider.title')); ?>				
				<?php
				if(!empty($_POST) && $_POST['title'] == slider_helper::ELEMENT_TYPE_MOVIE && isset($_POST['title'])){ ?>
					<textarea name="title" cols="40" rows="5" id="add_photo_title"><?php echo $_POST['title']; ?></textarea>
				<?php } 
				elseif(!empty($oSliderElement) && $oSliderElement->title){ ?>
					<textarea name="title" cols="40" rows="5" id="add_photo_title"><?php echo strip_tags($oSliderElement->title); ?></textarea>
				<?php } 
				else { ?>
					<textarea name="title" cols="40" rows="5" id="add_photo_title"></textarea>
				<?php }
				?>
			</li>			
			<li>
				<label for="add_photo_alt_image"><?php echo Kohana::lang('slider.add_photo_alt'); ?></label>				
				<?php
				if(!empty($_POST) && $_POST['alt'] == slider_helper::ELEMENT_TYPE_MOVIE && isset($_POST['alt'])){ ?>
					<textarea name="alt" cols="40" rows="5" id="add_photo_alt_image"><?php echo $_POST['alt']; ?></textarea>
				<?php } 
				elseif(!empty($oSliderElement) && $oSliderElement->alt){ ?>
					<textarea name="alt" cols="40" rows="5" id="add_photo_alt_image"><?php echo $oSliderElement->alt; ?></textarea>
				<?php } 
				else { ?>
					<textarea name="alt" cols="40" rows="5" id="add_photo_alt_image"></textarea>
				<?php }
				?>
			</li>
			<li>
				<label for="code"><?php echo Kohana::lang('slider.code'); ?></label>				
				<?php
				if(!empty($_POST) && $_POST['code'] == slider_helper::ELEMENT_TYPE_MOVIE && isset($_POST['code'])){ ?>
					<textarea name="code" cols="40" rows="5" id="add_photo_alt_image"><?php echo $_POST['code']; ?></textarea>
				<?php } 
				elseif(!empty($oSliderElement) && $oSliderElement->code){ ?>
					<textarea name="code" cols="40" rows="5" id="add_photo_alt_image"><?php echo $oSliderElement->code; ?></textarea>
				<?php } 
				else { ?>
					<textarea name="code" cols="40" rows="5" id="add_photo_alt_image"></textarea>
				<?php }
				?>
				<span class="label_comment"><?php echo Kohana::lang('slider.slider_movies_code_info'); ?></span>	
			</li>
			<li>
				<?php
				echo form::label('or_link3', Kohana::lang('slider.or_link')); ?>
				<?php if(!strpos($oSliderElement->link, 'http')){
					echo '<input type="checkbox" value="news" id="or_link3" name="or_link" checked="checked" />'; 					
				}
				else { 
					echo '<input type="checkbox" value="news" id="or_link3" name="or_link" />';
				}?>
			</li>
			<li id="news-link3">
				<?php
				echo form::label('news_link', Kohana::lang('slider.link')); ?>
				
				
				<?php
				if(!empty($_POST) && $_POST['link'] == slider_helper::ELEMENT_TYPE_SLIDER_NEWS && isset($_POST['link'])){ ?>
					<input type="text" name="link" id="news_link3" value="<?php echo $_POST['link']; ?>" />
				<?php } 
				elseif(!empty($oSliderElement) && $oSliderElement->link){ ?>
					<input type="text" name="link" id="news_link3" value="<?php echo $oSliderElement->link; ?>" />
				<?php } 
				else { ?>
					<input type="text" name="link" id="news_link3" value="" />
				<?php }
				?>
				
				<span class="label_comment"><?php echo Kohana::lang('slider.link_info') ?></span>
			</li>
			<?php
			if ( ! empty($aNewsTitles) AND count($aNewsTitles)) : ?>
			<li id="news-title3">
				<?php
				echo form::label(array('for' => 'news_title'), Kohana::lang('slider.news_link'));
				echo form::dropdown(array('name' => 'news_element_id', 'id' => 'news_title3'), $aNewsTitles, ( ! empty($_POST) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_NEWS AND isset($_POST['news_element_id'])) ? $_POST['news_element_id'] : NULL); ?>
				<span class="label_comment"><?php echo Kohana::lang('slider.news_title_info') ?></span>
			</li>
			<?php
			endif; ?>
			<li>
				<input type="hidden" name="slider_type_id" id="slider_movie_type_id" value="<?php echo slider_helper::ELEMENT_TYPE_MOVIE; ?>" />
				<input type="submit" value="<?php echo Kohana::lang('slider.save'); ?>" name="submit" class="ui-button ui-widget ui-state-default ui-corner-all" />
			</li>
		</ul>
		<?php
		echo form::close(); ?>
	</div>
<?php }	
}
?>
</div>