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
                    echo html::anchor('4dminix/edytuj_sonde/'.$iCategoryId.'/'.$p->id_question, html::image('img/icons/edit.gif', array('alt' => Kohana::lang('poll.edit'))));
                }
                if(User_Model::IsAllowed($_SESSION['_acl'], 'polls', 'delete')->Value==true){
                    echo html::anchor('4dminix/usun_sonde/'.$iCategoryId.'/'.$p->id_question, html::image('img/icons/delete.gif', array('alt' => Kohana::lang('poll.delete'), 'class' => 'delete_button', 'title' => 'Czy na pewno chcesz usunąć sondę?')));
                }
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
    </table>
	<?php echo $pagination; ?>