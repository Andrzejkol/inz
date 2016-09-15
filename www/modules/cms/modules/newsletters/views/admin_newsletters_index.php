<div id="admin_newsletters_index">
    <div class="options">
            <h5>Newslettery</h5>
        <?php 
        if(User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'add')->Value==true){
            echo html::anchor('4dminix/dodaj_newsletter', html::image('img/admin_default/newobject.gif', array('alt'=>'Dodaj nowy newsletter', 'class'=>'add_button', 'title'=>'Dodaj newsletter')));
            echo html::anchor('4dminix/dodaj_newsletter', Kohana::lang('newsletter.add_newsletter'), array('class'=>'add_text', 'title'=>'Dodaj newsletter'));
        }
        ?>
    </div>
    <?php echo form::open('4dminix/usun_newsletter/'); ?>
 
    <?php if(!empty($newsletters) && $newsletters->count()>0) { ?>
    <table class="table_view" id="newsletter_list">
        <tr>
            <th><input type="checkbox" name="newsletter_check_all" id="newsletter_check_all" class="check_all" value="1" /></th>
            <th>
            <?php 
            	echo Kohana::lang('newsletter.title'); 
            	echo html::anchor ('/4dminix/newslettery/?newsletters_orderby=1', html::image('img/admin_default/sort-asc.png')); 
            	echo html::anchor ('/4dminix/newslettery/?newsletters_orderby=2', html::image('img/admin_default/sort-desc.png'));
            ?>
            </th>
            <th>
            <?php 
            	echo Kohana::lang('newsletter.language'); 
            	echo html::anchor ('/4dminix/newslettery/?newsletters_orderby=3', html::image('img/admin_default/sort-asc.png')); 
            	echo html::anchor ('/4dminix/newslettery/?newsletters_orderby=4', html::image('img/admin_default/sort-desc.png'));
            ?>
            </th>
            <th>
            <?php 
            	echo Kohana::lang('newsletter.date_added'); 
            	echo html::anchor ('/4dminix/newslettery/?newsletters_orderby=5', html::image('img/admin_default/sort-asc.png')); 
            	echo html::anchor ('/4dminix/newslettery/?newsletters_orderby=6', html::image('img/admin_default/sort-desc.png'));
            ?>
            </th>
            <th>
            <?php 
            	echo Kohana::lang('newsletter.date_sent'); 
            	echo html::anchor ('/4dminix/newslettery/?newsletters_orderby=7', html::image('img/admin_default/sort-asc.png')); 
            	echo html::anchor ('/4dminix/newslettery/?newsletters_orderby=8', html::image('img/admin_default/sort-desc.png'));
            ?>
			</th>
            <th><?php echo Kohana::lang('newsletter.actions'); ?></th>
        </tr>

        <?php
        foreach($newsletters as $newsletter) { ?>
        <tr>
            <td><input type="checkbox" name="newsletter_check[]" class="check" value="<?php echo $newsletter->id_newsletter; ?>" /></td>
            <td><?php echo strip_tags($newsletter->title); ?></td>
            <td><?php $lang = explode('_', $newsletter->language);
                        echo html::image("img/flag/{$lang[0]}.png", array('alt' => Kohana::lang('language.'.$newsletter->language))); ?></td>
            <td><?php echo date(config::DATE_TIME_FORMAT, $newsletter->date_added+0); ?></td>
            <td><?php echo (!empty($newsletter->date_sent) ? date(config::DATE_TIME_FORMAT, $newsletter->date_sent+0) : Kohana::lang('newsletter.not_send')); ?></td>
            <td>
                <?php 
                if(User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'edit')->Value==true){	
					echo html::anchor('4dminix/edytuj_newsletter/'.$newsletter->id_newsletter, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.edit'), 'class' => 'btn btn-edit')); 
                }
                if(User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'delete')->Value==true){
					echo html::anchor('4dminix/usun_newsletter/'.$newsletter->id_newsletter, Kohana::lang('admin.delete'), array('title' =>Kohana::lang('admin.delete'), 'class' => 'btn btn-delete')); 
                }
                if(User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'send')->Value==true){
                    echo html::anchor('4dminix/wyslij_newsletter/'.$newsletter->id_newsletter, Kohana::lang('admin.send'), array('class'=>'btn btn-send'));
                }
                if(User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'edit')->Value==true){
					$preview_link = '';
					if ($newsletter->language !== 'pl_PL') {
						$preview_link .= $newsletter->language{0} . $newsletter->language{1} . '/';
					}
                    echo html::anchor($preview_link . 'podglad_newsletter/'.$newsletter->id_newsletter, Kohana::lang('admin.view'), array('target'=>'_blank', 'class'=>'btn btn-view'));
                }
                
                ?>
            </td>
        </tr>
        <?php }
        ?>
    </table>
    <div class="delete_selected">
    <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'delete')->Value==true):?>
    <?php echo Kohana::lang('newsletter.selected'); ?>: 
	<button name="delete_newsletter" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
    <?php endif;?>
    </div>
    <?php echo form::close(); ?>
    <?php } else { ?>
    <div class="info"><?php echo Kohana::lang('newsletter.no_newsletters'); ?></div>
    <?php } ?>
    <?php echo $oPagination;?>
</div>