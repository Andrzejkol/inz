<div id="admin_newsletter_groups_index">
   

    <fieldset>
        <legend>Filtr</legend>
        <form action="" method="GET">
            <label for="email">Email:</label> <input type="text" name="email" id="email" value="<?php if(!empty($_GET['email'])) {echo $_GET['email']; }?>" /> 
            <label for="">Grupa:</label> <select name="group" id="group">
                <option value="-">wybierz...</option>
                <?php foreach($emailGroups as $group): ?>
                <option value="<?php echo $group->id_newsletter_group ?>"<?php if(!empty($_GET['group']) && $_GET['group']==$group->id_newsletter_group){echo ' selected="selected"';}?>><?php echo html::specialchars($group->name) ?></option>
                <?php endforeach; ?>
            </select> 
            <label for="status">Status:</label> <select name="status" id="status">
                <option value="-">wybierz...</option>
                <option value="1"<?php if(isset($_GET['status']) && $_GET['status'] != '-' && $_GET['status']==1) {echo 'selected="selected"';} ?>>Aktywny</option>
                <option value="0"<?php if(isset($_GET['status']) && $_GET['status'] != '-' && $_GET['status']=0) {echo 'selected="selected"';} ?>>Nieaktwny</option>
            </select> 
            <label for="verified">Potwierdzone:</label> <select name="verified" id="vierified">
                <option value="-">wybierz...</option>
                <option value="1"<?php if(isset($_GET['verified']) && $_GET['verified'] != '-' && $_GET['verified']==1) {echo 'selected="selected"';} ?>>TAK</option>
                <option value="0"<?php if(isset($_GET['verified']) && $_GET['verified'] != '-' && $_GET['verified']==0) {echo 'selected="selected"';} ?>>NIE</option>
            </select> 
            <input type="submit" name="filter" id="filter" value="Filtruj" />
        </form>
    </fieldset>

    <div class="options">
	 <h5>Lista emaili</h5>
        <?php
        if (User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'email_add')->Value == true) {
            echo html::anchor('4dminix/dodaj_email', html::image('img/admin_default/newobject.gif', array('alt' => 'Dodaj nowy email', 'class' => 'add_button')));
            echo html::anchor('4dminix/dodaj_email', Kohana::lang('newsletter.add_email'), array('class' => 'add_text'));
        }
		if (User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'email_index')->Value == true) {
			echo html::anchor('4dminix/eksport_cvs', html::image('img/admin_default/Export.png', array('alt' => 'Eksportuj dane do pliku CSV', 'class' => 'add_button', 'style' => 'margin-left:5px;')));
			echo html::anchor('4dminix/eksport_cvs', 'Eksportuj dane do pliku CSV', array('class' => 'add_text'));
		}
        ?>
    </div>
    <?php echo form::open('4dminix/usun_email/'); ?>

    <?php if (!empty($oEmails) && $oEmails->count() > 0) { ?>
        <table class="table_view">
            <tr>
                <th><input type="checkbox" name="newsletter_emails_check_all" id="newsletter_emails_check_all" class="check_all" value="1" /></th>
                <th><?php echo Kohana::lang('newsletter.name'); ?><?php layer::GetSort('newsletter_emails_orderby', 1, 2, '/4dminix/emaile');?></th>
                <th><?php echo Kohana::lang('newsletter.email'); ?><?php layer::GetSort('newsletter_emails_orderby', 3, 4, '/4dminix/emaile');?></th>            
                <th><?php echo Kohana::lang('newsletter.groups'); ?><?php// layer::GetSort('newsletter_emails_orderby', 5, 6, '/4dminix/emaile');?></th>
                <th><?php echo Kohana::lang('newsletter.verified'); ?><?php layer::GetSort('newsletter_emails_orderby', 7, 8, '/4dminix/emaile');?></th>
                <th><?php echo Kohana::lang('newsletter.active'); ?><?php layer::GetSort('newsletter_emails_orderby', 9, 10, '/4dminix/emaile');?></th>
                <th><?php echo Kohana::lang('newsletter.actions'); ?></th>
            </tr>
            <?php foreach ($oEmails as $e) { ?>
                <tr>
                    <td><input type="checkbox" name="newsletter_emails_check[]" class="check" value="<?php echo $e->id_email; ?>" /></td>
                    <td><?php echo strip_tags($e->name); ?></td>
                    <td><?php echo strip_tags($e->email); ?></td>
                    <td><?php
        foreach ($e->oGroups as $group) {
            echo strip_tags($group->name) . '<br/>';
        }
                ?></td>
                    <td><?php echo $e->verified == 1 ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('pages.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('pages.disabled'))); ?></td>
                    <td>
                        <?php //echo $e->newsletter_email_active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('pages.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('pages.disabled'))); ?>
                        <a href="#" class="changeStatus" id="mail-<?php echo $e->id_email; ?>"><?php
                        echo ($e->newsletter_email_active == 'Y') ? 
                            html::image('img/icons/tick.png', array('alt' => Kohana::lang('pages.enabled'))) : 
                            html::image('img/icons/cross.png', array('alt' => Kohana::lang('pages.disabled'))); 
                        ?></a>
                    </td>

                    <td>
                        <?php
                        if (User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'email_edit')->Value == true) {
							echo html::anchor('4dminix/edytuj_email/'.$e->id_email, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
                        }
                        if (User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'email_delete')->Value == true) {
								echo html::anchor('4dminix/usun_email/'.$e->id_email, Kohana::lang('admin.delete'), array('title' =>Kohana::lang('admin.pages.delete'), 'class' => 'btn btn-delete')); 
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>

        <div class="delete_selected">
            <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'email_delete')->Value == true): ?>
                <?php echo Kohana::lang('newsletter.selected'); ?>: 
				<button name="delete_newsletter_groups" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
            <?php endif; ?>
        </div>
        <?php echo form::close(); ?>
    <?php } else { ?>
        <div class="info"><?php echo Kohana::lang('newsletter.no_newsletters_emails'); ?></div>
    <?php } ?>

    <?php echo $oPagination; ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.changeStatus').click(function(){
            var email = $(this);
            var id = parseInt(email.attr('id').split('-')[1]);
            $.get("<?php echo url::base() . 'newsletters_ajax/change_email_status';?>", 
            { id_email: id }, 
            function(result){
                if(result == 'Y'){
                    $('img', email).attr({'src':"<?php echo url::file('img/icons/tick.png');?>", 'alt':"<?php echo Kohana::lang('pages.enabled');?>"});
                }
                else if(result == 'N'){
                    $('img', email).attr({'src':"<?php echo url::file('img/icons/cross.png');?>", 'alt':"<?php echo Kohana::lang('pages.disabled');?>"});
                }
            });            
            
            return false;
        });
    });
</script>
