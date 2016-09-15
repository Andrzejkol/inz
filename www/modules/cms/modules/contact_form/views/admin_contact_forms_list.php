<div id="admin_contact_form_view">
    
    <div class="options"><h5>Lista formularzy kontaktowych</h5>
        <?php 
        if(User_Model::IsAllowed($_SESSION['_acl'], 'contact_forms', 'add')->Value==true){
            echo html::anchor('4dminix/dodaj_formularz_kontaktowy', html::image('img/admin_default/newobject.gif', array('alt' => 'Dodaj nowy formularz kontaktowy', 'class' => 'add_button')));
            echo html::anchor('4dminix/dodaj_formularz_kontaktowy', Kohana::lang('contact_form.add_contact_form'), array('class' => 'add_text'));
        }
		if (User_Model::IsAllowed($_SESSION['_acl'], 'contact_forms', 'index')->Value==true) {
			echo html::anchor('4dminix/pokaz-logi-formularzy', html::image('img/admin_default/dialog-information.png', array('class' => 'add_button')), array('alt' => 'Pokaż logi dla formularzy kontaktowych', 'style' => 'margin-left: 15px;', 'class' => 'add_button'));
			echo html::anchor('4dminix/pokaz-logi-formularzy', 'Pokaż logi formularzy', array('class' => 'add_text'));
		}
        ?>
    </div>
    <?php
        if ($contactForms->count() > 0) {
    ?>
        <table id="contact_form_list" class="table_view">
            <tr>
                <th>#</th>
                <th><?php echo Kohana::lang('contact_form.contact_form_name'); ?><?php layer::GetSort('contact_forms_orderby', 1, 2, '/4dminix/formularze_kontaktowe');?></th>
                <th><?php echo Kohana::lang('contact_form.sender_email'); ?><?php layer::GetSort('contact_forms_orderby', 3, 4, '/4dminix/formularze_kontaktowe');?></th>
                <th><?php echo Kohana::lang('contact_form.receiver_email'); ?><?php layer::GetSort('contact_forms_orderby', 5, 6, '/4dminix/formularze_kontaktowe');?></th>
                <th><?php echo Kohana::lang('contact_form.options'); ?></th>
            </tr>
        <?php $i = 1;
            foreach ($contactForms as $cf) {
        ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($cf->title); ?></td>
                    <td><?php echo htmlspecialchars($cf->sender_email); ?></td>
                    <td><?php echo htmlspecialchars($cf->receiver_email); ?></td>
                    <td>
                <?php 
                if(User_Model::IsAllowed($_SESSION['_acl'], 'contact_forms', 'edit')->Value==true){
					 echo html::anchor('4dminix/edytuj_formularz_kontaktowy/' . $cf->id_contact_form, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
                }
                if(User_Model::IsAllowed($_SESSION['_acl'], 'contact_forms', 'delete')->Value==true){
					
					echo html::anchor('4dminix/usun_formularz_kontaktowy/' . $cf->id_contact_form, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete')));
                }
                ?>
            </td>
        </tr>
        <?php
            }
        ?>
        </table>
    <?php
        } else {
    ?>
            <div class="info"><?php echo Kohana::lang('contact_form.no_contact_forms'); ?></div>
<?php
        }
?>
<?php echo $oPagination;?>
</div>