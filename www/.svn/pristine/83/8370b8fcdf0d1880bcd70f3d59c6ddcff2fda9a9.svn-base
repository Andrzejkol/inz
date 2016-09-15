<div id="admin_polls_index">
    <div class="options">
        <?php 
            if(User_Model::IsAllowed($_SESSION['_acl'], 'polls', 'add')->Value==true){
                echo html::anchor('4dminix/dodaj_sonde/'.$iCategoryId.'/'.$iPageId, html::image('img/admin_default/newobject.gif', array('alt'=>'Dodaj sondę', 'class'=>'add_button')));
                echo html::anchor('4dminix/dodaj_sonde/'.$iCategoryId.'/'.$iPageId, Kohana::lang('poll.add_poll'), array('class'=>'add_text'));
            }
        ?>

    </div>
    <?php
    if($oPolls->count() > 0) {
        ?>
	<div id="polls_table">
     <?php echo form::open('4dminix/usun_sonde/'); ?>
    <input type="hidden" name="category_id" value="<?php echo $iCategoryId; ?>" />
    <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'polls', 'delete')->Value==true):?>
		<div class="delete_selected">
			<?php echo Kohana::lang('poll.selected'); ?>: <input type="submit" name="delete_polls" value="<?php echo Kohana::lang('poll.delete'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  />
		</div>
	<?php endif;?>
    <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'polls', 'index')->Value==true):?>
    <table class="table_view" id="polls_list">
        <tr>
            <th><?php echo form::checkbox(array('name' => 'polls_check_all', 'class' => 'check_all')); ?></th>
            <th><?php echo Kohana::lang('poll.question'); ?></th>
            <th><?php echo Kohana::lang('poll.date_added'); ?></th>
            <th><?php echo Kohana::lang('poll.active'); ?></th>
            <th><?php echo Kohana::lang('poll.actions'); ?></th>
        </tr>
            <?php
            foreach($oPolls as $p) {
                ?>
        <tr>
            <td><?php echo form::checkbox(array('name' => 'polls_check[]', 'class' => 'check', 'value' => $p->id_question)); ?></td>
            <td><?php echo html::anchor('4dminix/edytuj_sonde/'.$iCategoryId.'/'.$p->id_question, strip_tags($p->question)); ?></td>
            <td><?php echo date(config::DATE_TIME_FORMAT, $p->date_added+0); ?></td>
            <td><?php echo $p->active == 'Y' ? html::image('img/admin_default/true.gif') : html::anchor('4dminix/widoczna_sonda/'.$iCategoryId.'/'.$p->id_question, html::image('img/admin_default/false.gif', array('alt' => 'Ustaw widoczną', 'title' => 'Ustaw widoczną'))); ?></td>
            <td>
                <?php 
                if(User_Model::IsAllowed($_SESSION['_acl'], 'polls', 'edit')->Value==true){
                    echo html::anchor('4dminix/edytuj_sonde/'.$iCategoryId.'/'.$p->id_question/*.'/'.$iPageId*/, html::image('img/icons/edit.gif', array('alt' => Kohana::lang('poll.edit'))));
                }
                if(User_Model::IsAllowed($_SESSION['_acl'], 'polls', 'delete')->Value==true){
                    echo html::anchor('4dminix/usun_sonde/'.$iCategoryId.'/'.$p->id_question/*.'/'.$iPageId*/, html::image('img/icons/delete.gif', array('alt' => Kohana::lang('poll.delete'), 'class' => 'delete_button', 'title' => 'Czy na pewno chcesz usunąć sondę?')));
                }
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
    </table>
    <?php endif;?>
    
        <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'polls', 'delete')->Value==true):?>
		<div class="delete_selected">
			<?php echo Kohana::lang('poll.selected'); ?>: <input type="submit" name="delete_poll" value="<?php echo Kohana::lang('poll.delete'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  />
		</div>
        <?php endif;?>
        <?php if(!empty($iPageId)) { echo '<input type="hidden" name="page_id" value="'.$iPageId.'" />'; } ?>
        <?php echo form::close(); ?>
        <?php
        echo $pagination; ?>
	</div>
	<?php
    }
    else {
        ?>
    <div class="info"><?php echo Kohana::lang('poll.no_polls'); ?></div>
        <?php } ?>
    <?php echo form::input(array('class' => 'ui-button ui-widget ui-state-default ui-corner-all', 'name' => 'back', 'value' => 'Wróć', 'type' => 'button')); ?>
</div>