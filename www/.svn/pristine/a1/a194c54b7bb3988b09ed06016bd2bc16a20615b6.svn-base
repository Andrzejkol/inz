<?php if(!request::is_ajax()) { ?>
<div id="admin_elements_view">
    <div class="options">
        <?php
        foreach($languages as $lang) {    
             echo html::anchor('4dminix/dodaj_element/'.$lang->name, html::image('img/admin_default/newobject.gif', array('alt'=>'Dodaj nową stronę', 'class'=>'add_button')));
             echo html::anchor('4dminix/dodaj_element/'.$lang->name, Kohana::lang('elements.add_element').' - '.Kohana::lang('language.'.$lang->description), array('class'=>'add_text'));
        }
        ?>
        <div style="float:right;">
            <?php echo Kohana::lang('elements.element_search'); ?>:
            <input type="text" name="element_search" id="element_search" />
        </div>
    </div>
<?php } ?>
    <table style="width:100%" id="elements_list" class="table_view">
        <tr>
            <th>#</th>
            <th><?php echo Kohana::lang('elements.name_element'); ?></th>
            <th><?php echo Kohana::lang('elements.type'); ?></th>
            <th><?php echo Kohana::lang('elements.page_id') ;?></th>
            <th><?php echo Kohana::lang('elements.options') ;?></th>
        </tr>
    <?php
    foreach($elements as $element) {
    ?>
        <tr>
            <td><?php echo $element->id_element; ?></td>
            <td><?php echo $element->name_element; ?></td>
            <td><?php echo Kohana::lang('elements.'.$element->type); ?></td>
            <td>
            <?php
            foreach($pages_elements as $element_id => $pe) {
                if($element_id==$element->id_element) {
                    foreach($pe as $p) { echo $p.' '; }
                }
            }
            ?>
            </td>
            <td>
                <?php
                if(User_Model::IsAllowed($_SESSION['_acl'], 'elements', 'edit')->Value==true) {
                    echo html::anchor('4dminix/edytuj_element/'.$element->id_element, html::image('img/icons/edit.gif', array('alt'=>Kohana::lang('elements.edit'))), array('class'=>'edit_button', 'title'=>'Edytuj element'));
                }
                if(User_Model::IsAllowed($_SESSION['_acl'], 'elements', 'delete')->Value==true) {
                    echo html::anchor('4dminix/usun_element/'.$element->id_element, html::image('img/icons/delete.gif', array('alt'=>Kohana::lang('elements.delete'), 'id'=>'delete_elements_button')), array('class'=>'delete_button', 'title'=>'Czy napewno chcesz usunąć?'));
                }
                ?>
            </td>
        </tr>

    <?php
    }
    ?>
    </table>
<?php if(!request::is_ajax()) { ?>
</div>
<?php } ?>