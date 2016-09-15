<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('newsletter.edit_newsletter')
            ))->render(TRUE);
?>
<div id="admin_newsletter_edit">
    <div>
        Podgląd<br/>
        <?php
		$preview_link = '';
		if ($newsletter[0]->language !== 'pl_PL') {
			$preview_link .= $newsletter[0]->language{0} . $newsletter[0]->language{1} . '/';
		}
        echo html::anchor($preview_link . 'podglad_newsletter/'.$newsletter[0]->id_newsletter, html::image('img/icons/preview.gif', array('alt' => 'Podgląd', 'title'=>'Podgląd. Najpierw zapisz')), array('target'=>'_blank'));
        ?>
        
    </div>
    
    <?php echo form::open_multipart(null, array('method' => 'post', 'id' => 'form_newsletter_edit')); ?>
    <?php foreach($newsletter as $n) { ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><label for="language"><?php echo Kohana::lang('newsletter.language'); ?></label></td>
            <td>
				<?php echo form::dropdown(array('name' => 'language', 'id' => 'language'), $languages, (!$_POST) ? $newsletter[0]->language : $_POST['language']) ?>				
            </td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="title"><?php echo Kohana::lang('newsletter.title'); ?></label></td>
            <td>
                <input type="text" id="title" name="title" value="<?php if(!empty($_POST['title'])) { echo $_POST['title']; } else { echo $n->title; } ?>" />
            </td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="content"><?php echo Kohana::lang('newsletter.content'); ?></label></td>
            <td>
                <textarea rows="10" cols="60" name="content" id="newsletter_content">
                <?php if(!empty($_POST['content'])) { echo $_POST['content']; } else { echo $n->content; } ?>
                </textarea>
            </td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="interval"><?php echo Kohana::lang('newsletter.interval'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('newsletter.interval_comment'); ?></span>
            </td>
            <td>
                <input type="text" id="interval" name="interval" value="<?php if(!empty($_POST['interval'])) { echo $_POST['interval']; } else { echo ($n->interval/60000); } ?>" />
                <div class="error_message" id="interval_error"></div>
            </td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="bulk"><?php echo Kohana::lang('newsletter.bulk'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('newsletter.bulk_comment'); ?></span>
            </td>
            <td>
                <input type="text" id="bulk" name="bulk" value="<?php if(!empty($_POST['bulk'])) { echo $_POST['bulk']; } else { echo $n->bulk; } ?>" />
                <div class="error_message" id="bulk_error"></div>
            </td>
        </tr>
        <?php
//		@TODO: Odkomentować, jeśli jest potrzeba dodawania zdjęć do newslettera
		/*
        <tr>
            <td class="td_form_left">
            </td>
            <td>
                <?php foreach($newsletterImages as $image):?>
                <p id="newsletterImage-<?php echo $image->id_image; ?>">
                    <a href="#" class="newsletterImgDelete" id="newsletterImgDelete-<?php echo $image->id_image; ?>">
                        <?php 
                        echo html::image('img/icons/delete.png', array('alt'=>'Usuń', 'title'=>'Usuń'));
                        ?></a>
                    
                    <?php echo html::image(newsletter::IMAGE_NEWSLETTER_PATH . $image->filename);?>
                    
                    
                </p>
                <?php endforeach;?>
            </td>
            <td></td>
        </tr>
        
        <script type="text/javascript">
            $('a.newsletterImgDelete').click(function(){
                var anchor = $(this);
                var idImg = anchor.attr('id').split('-')[1];  
                $.get("<?php echo url::site('newsletters_ajax/deleteImage');?>",
                    {
                        id_image: idImg
                    },
                    function(data){
                        if(data == '1'){
                            anchor.parent().remove();
                        }
                        else{
                            alert('Błąd');
                        }
                    }
                );
                
                return false;
            });
        </script>
        
        <tr>
            <td class="td_form_left">
                <label for="bulk"><?php echo Kohana::lang('newsletter.images'); ?></label>
            </td>
            <td>
                <input type="file" id="file1" name="file1"  /><br/>
                <input type="file" id="file2" name="file2"  /><br/>
                <input type="file" id="file3" name="file3"  /><br/>
                <input type="file" id="file4" name="file4"  /><br/>
                <input type="file" id="file5" name="file5"  /><br/>
                <input type="file" id="file6" name="file6"  /><br/>
                <input type="file" id="file7" name="file7"  /><br/>
                <input type="file" id="file8" name="file8"  /><br/>
                <input type="file" id="file9" name="file9"  /><br/>
                <input type="file" id="file10" name="file10"  /><br/>
            </td>
            <td><div class="error_message" id="file_error"></div></td>
        </tr> */ ?>
        
        <tr>
            <td class="td_form_left"><label for="newsletter_groups"><?php echo Kohana::lang('newsletter.newsletter_email_groups'); ?></label></td>
            <td>
                <ul id="newsletter_groups">
                        <?php foreach($allNewsletterGroups as  $ng) : ?>
							<?php if(empty($_POST) && in_array($ng->id_newsletter_group, $aNewsletterGroups)) { ?>
								<li><input type="checkbox" name="newsletter_group[<?php echo $ng->id_newsletter_group; ?>]" id="newsletter_group_<?php echo $ng->id_newsletter_group; ?>" checked="checked" /> 
								<label for="newsletter_group_<?php echo $ng->id_newsletter_group; ?>"><?php echo $ng->name; ?></label></li>
							<?php } else if(!empty($_POST['newsletter_group'][$ng->id_newsletter_group])) { ?>
								<li><input type="checkbox" name="newsletter_group[<?php echo $ng->id_newsletter_group; ?>]" id="newsletter_group_<?php echo $ng->id_newsletter_group; ?>" checked="checked" /> 
								<label for="newsletter_group_<?php echo $ng->id_newsletter_group; ?>"><?php echo $ng->name; ?></label></li>
							<?php } else { ?>
								<li><input type="checkbox" name="newsletter_group[<?php echo $ng->id_newsletter_group; ?>]" id="newsletter_group_<?php echo $ng->id_newsletter_group; ?>" /> 
								<label for="newsletter_group_<?php echo $ng->id_newsletter_group; ?>"><?php echo $ng->name; ?></label></li>
							<?php } ?>
						<?php endforeach; ?>
                </ul>
            </td>
            <td><div class="error_message" id="newsletter_groups_error"></div></td>
        </tr>
        <tr>
            <td>
                    <?php echo html::anchor('4dminix/newslettery', '<input type="button" value="'.Kohana::lang('admin.back').'" name="back" class="btn btn-back" />'); ?>
            </td>
            <td>
                <input type="submit" name="submit" value="<?php echo Kohana::lang('newsletter.save'); ?>" class="btn btn-save"   />
                <input type="submit" name="submit_back" value="<?php echo Kohana::lang('newsletter.save_back'); ?>" class="btn btn-save-and-back"   />
            </td>
        </tr>
		<input type="hidden" name="newsletter_edit_id" id="newsletter_edit_id" value="<?php echo $n->id_newsletter ?>" />
    </table>
        <?php } ?>
    <?php echo form::close(); ?>
</div>