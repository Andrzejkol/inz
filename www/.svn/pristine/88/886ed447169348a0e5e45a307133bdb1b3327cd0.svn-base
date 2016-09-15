<div id="admin_polls_categories">  
    <div class="options">
	<h5>Lista kategorii sond</h5>
        <?php 
        if(User_Model::IsAllowed($_SESSION['_acl'], 'polls_categories', 'add')->Value==true){
            echo html::anchor('4dminix/dodaj_kategorie_sond', html::image('img/admin_default/newobject.gif', array('alt'=>'Dodaj kategorie sond', 'class'=>'add_button')));
            echo html::anchor('4dminix/dodaj_kategorie_sond', Kohana::lang('poll.add_poll_category'), array('class'=>'add_text')); 
        }
        ?>
    </div>
    <?php if($oPollsCategories->count() > 0) { ?>
    <?php echo form::open('4dminix/usun_kategorie_sond/'); ?>
    <table class="table_view" id="polls_list">
        <tr>
            <th><?php echo form::checkbox(array('name' => 'polls_category_check_all', 'class' => 'check_all')); ?></th>
            <th><?php echo Kohana::lang('poll.category_name'); ?><?php layer::GetSort('polls_categories_orderby', 1, 2, '/4dminix/kategorie_sond');?></th>
            <th><?php echo Kohana::lang('poll.language'); ?><?php layer::GetSort('polls_categories_orderby', 3, 4, '/4dminix/kategorie_sond');?></th>
            <th><?php echo Kohana::lang('poll.date_added'); ?><?php layer::GetSort('polls_categories_orderby', 5, 6, '/4dminix/kategorie_sond');?></th>
            <th><?php echo Kohana::lang('poll.actions'); ?></th>
        </tr>
            <?php

            foreach($oPollsCategories as $oPollsCategory) {
                ?>
        <tr>
            <td><?php echo form::checkbox(array('name' => 'polls_category_check[]', 'class' => 'check', 'value' => $oPollsCategory->id_poll_category )); ?></td>
            <td>
            <?php 
            if(User_Model::IsAllowed($_SESSION['_acl'], 'polls', 'index')->Value==true){
                echo html::anchor('4dminix/kategoria_sondy/'.$oPollsCategory->id_poll_category, strip_tags($oPollsCategory->category_name)); 
            }
            else{
                echo strip_tags($oPollsCategory->category_name);
            }
            ?>
            </td>
            <td>
            <?php $lang = explode('_', $oPollsCategory->lang);
                        echo html::image("img/flag/{$lang[0]}.png", array('alt' => Kohana::lang('language.'.$oPollsCategory->lang))); ?>
            </td>
            <td><?php echo date(config::DATE_TIME_FORMAT, $oPollsCategory->date_added+0); ?></td>
            <td>
                <?php
                if(User_Model::IsAllowed($_SESSION['_acl'], 'polls_categories', 'edit')->Value==true){
					 echo html::anchor('4dminix/edytuj_kategorie_sond/'.$oPollsCategory->id_poll_category, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
                }
                if(User_Model::IsAllowed($_SESSION['_acl'], 'polls_categories', 'delete')->Value==true){
					 echo html::anchor('4dminix/usun_kategorie_sond/'.$oPollsCategory->id_poll_category, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete')));
                }
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
    </table>
    <div class="delete_selected">
    <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'polls_categories', 'delete')->Value==true):?>
    <?php echo Kohana::lang('poll.selected'); ?>: 
	<button name="delete_polls" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
    <?php endif;?>
    </div>
  <?php echo form::close(); ?>
        <?php
    } else {
        ?>

    <div class="info">
            <?php echo Kohana::lang('poll.no_polls_categories'); ?>
    </div>

        <?php  } ?>

<?php echo $oPagination;?>
</div>