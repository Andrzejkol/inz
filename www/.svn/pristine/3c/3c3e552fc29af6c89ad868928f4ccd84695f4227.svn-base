<div id="admin_newsletter_groups_index">
    <div class="options">
            <h5><?php echo Kohana::lang('newsletter.newsletter_email_groups'); ?></h5>
        <?php 
        if(User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'group_add')->Value==true){
            echo html::anchor('4dminix/newsletter_dodaj_grupe', html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('newsletter.add_group'), 'class'=>'add_button')));
            echo html::anchor('4dminix/newsletter_dodaj_grupe', Kohana::lang('newsletter.add_group'), array('class'=>'add_text'));
        }
        ?>
    </div>

    <?php echo form::open('4dminix/newsletter_usun_grupe/'); ?>
    <?php if(!empty($groups) && $groups->count()>0) { ?>
    <table class="table_view" id="newsletter_groups">
        <tr>
            <th><input type="checkbox" name="newsletter_groups_check_all" id="newsletter_groups_check_all" class="check_all" value="1" /></th>
            <th><?php echo Kohana::lang('newsletter.is_default'); ?><?php layer::GetSort('newsletter_groups_orderby', 1, 2, '/4dminix/newsletter_grupy');?></th>
			<th><?php echo Kohana::lang('newsletter.language') ?><?php layer::GetSort('newsletter_groups_orderby', 3, 4, '/4dminix/newsletter_grupy');?></th>
            <th><?php echo Kohana::lang('newsletter.group_name'); ?><?php layer::GetSort('newsletter_groups_orderby', 5, 6, '/4dminix/newsletter_grupy');?></th>
            <th><?php echo Kohana::lang('newsletter.actions'); ?></th>
        </tr>
        <?php
        foreach($groups as $g) { ?>
        <tr>
            <td><input type="checkbox" name="newsletter_groups_check[]" class="check" value="<?php echo $g->id_newsletter_group; ?>" /></td>
            <td><?php echo ($g->default_group ==1) ? html::image('img/icons/tick.png') : ''; ?></td>
			<td><?php echo Kohana::lang('language.' . $g->lang) ?></td>
            <td><?php echo strip_tags($g->name); ?></td>
            <td>
                <?php 
                if(User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'group_edit')->Value==true){
					 echo html::anchor('4dminix/newsletter_edytuj_grupe/'.($g->id_newsletter_group), Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
                }
                if(User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'group_delete')->Value==true){
					echo html::anchor('4dminix/newsletter_usun_grupe/'.($g->id_newsletter_group), Kohana::lang('admin.delete'), array('title' =>Kohana::lang('admin.pages.delete'), 'class' => 'btn btn-delete')); 
                }
                ?>
            </td>
        </tr>
        <?php }
        
        ?>
    </table>
    <div class="delete_selected">
    <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'group_delete')->Value==true):?>
    <?php echo Kohana::lang('newsletter.selected'); ?>: 
	<button name="delete_newsletter_groups" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
    <?php endif;?>
    </div>
    <?php echo form::close(); ?>
    <?php } else { ?>
    <div class="info"><?php echo Kohana::lang('newsletter.no_newsletters'); ?></div>
    <?php } ?>
    <?php echo $oPagination;?>
</div>