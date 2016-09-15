<div id="admin_polls_index">
    <div class="options">
	<h5>Kategoria sondy: "<?php echo $pollCategoryName;?>"</h5>
        <?php
        if(User_Model::IsAllowed($_SESSION['_acl'], 'polls', 'add')->Value==true){
            echo html::anchor('4dminix/dodaj_sonde/'.$iCategoryId, html::image('img/admin_default/newobject.gif', array('alt'=>'Dodaj sondę', 'class'=>'add_button')));
            echo html::anchor('4dminix/dodaj_sonde/'.$iCategoryId, Kohana::lang('poll.add_poll'), array('class'=>'add_text'));
        }
        ?>
    </div>
    <?php
    if($oPolls->count() > 0) {
        ?>
     <?php echo form::open('4dminix/usun_sonde/'); ?>
    <input type="hidden" name="category_id" value="<?php echo $iCategoryId; ?>" />
    <table class="table_view" id="polls_list">
        <tr>
            <th><?php echo form::checkbox(array('name' => 'polls_check_all', 'class' => 'check_all')); ?></th>
            <th><?php echo Kohana::lang('poll.question'); ?><?php layer::GetSort('polls_orderby', 1, 2, '/4dminix/kategoria_sondy/'.$iCategoryId.'');?></th>
            <th><?php echo Kohana::lang('poll.date_added'); ?><?php layer::GetSort('polls_orderby', 3, 4, '/4dminix/kategoria_sondy/'.$iCategoryId.'');?></th>
            <th><?php echo Kohana::lang('poll.active'); ?><?php layer::GetSort('polls_orderby', 5, 6, '/4dminix/kategoria_sondy/'.$iCategoryId.'');?></th>
            <th><?php echo Kohana::lang('poll.actions'); ?></th>
        </tr>
            <?php
            foreach($oPolls as $p) {
                ?>
        <tr>
            <td><?php echo form::checkbox(array('name' => 'polls_check[]', 'class' => 'check', 'value' => $p->id_question)); ?></td>
            <td><?php echo strip_tags($p->question); ?></td>
            <td><?php echo date(config::DATE_TIME_FORMAT, $p->date_added+0); ?></td>
            <td><?php echo $p->active == 'Y' ? html::image('img/admin_default/true.gif') : html::anchor('4dminix/widoczna_sonda/'.$iCategoryId.'/'.$p->id_question, html::image('img/admin_default/false.gif', array('alt' => 'Ustaw widoczną', 'title' => 'Ustaw widoczną'))); ?></td>
            <td>
                <?php
                if(User_Model::IsAllowed($_SESSION['_acl'], 'polls', 'edit')->Value==true){
					echo html::anchor('4dminix/edytuj_sonde/'.$iCategoryId.'/'.$p->id_question, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
                }
                if(User_Model::IsAllowed($_SESSION['_acl'], 'polls', 'delete')->Value==true){
					 echo html::anchor('4dminix/usun_sonde/'.$iCategoryId.'/'.$p->id_question, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete')));
                }
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
    </table>
    <div class="delete_selected">
        <?php echo Kohana::lang('poll.selected'); ?>:
		<button name="delete_poll" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
    </div>
  <?php echo form::close(); ?>
        <?php
        echo $oPagination;
    }
    else {
        ?>
    <div class="info"><?php echo Kohana::lang('poll.no_polls'); ?></div>
        <?php } ?>
    <?php echo html::anchor('4dminix/kategorie_sond', form::input(array('style'=>'margin-top:5px;','class' => 'btn btn-back', 'name' => 'back_to_categories', 'value' => 'Wróć', 'type' => 'button'))); ?>
</div>