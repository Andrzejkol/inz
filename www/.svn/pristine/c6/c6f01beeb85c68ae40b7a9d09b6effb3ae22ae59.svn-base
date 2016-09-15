<?php if(!request::is_ajax()) { ?>
<div id="admin_popup_index">
    <h2>Popupy:</h2>
    <div class="options">
        <?php
        echo html::anchor('4dminix/nowy-popup/', html::image('img/admin_default/newobject.gif', array('alt' => 'Dodaj popup', 'class' => 'add_button')));
                echo html::anchor('4dminix/nowy-popup/', 'Dodaj nowy', array('class' => 'add_text'));
        ?>
    </div>
    <?php
}
    if ($oPopups->count() > 0) {
        ?>
        <?php echo form::open('4dminix/usun-popup/'); ?>
        <table class="table_view" id="salons_list">
            <tr>
                <th>Lp.</th>
                <th>Nazwa</th>
                <th>Data od</th>
                <th>Data do:</th>
                <th>Aktywny</th>
                <th>Opcje</th>
            </tr>
            <?php
            foreach ($oPopups as $p) {
                ?>
                <tr>
                    <td><?php echo $p->id_popup; ?>
                    <td><?php echo $p->title; ?></td>
                    <td><?php echo date('Y-m-d', strtotime($p->date_start)); ?></td>
                    <td><?php echo date('Y-m-d', strtotime($p->date_end)); ?></td>
                    <td><?php echo $p->active=='0'?'Nie':'Tak'; ?></td>
                    <td>
                        <?php
                        echo html::anchor('4dminix/edytuj-popup/' . $p->id_popup, html::image('img/icons/edit.gif', array('alt' => Kohana::lang('poll.edit'))));
                        echo html::anchor('4dminix/usun-popup/' . $p->id_popup, html::image('img/icons/delete.gif', array('alt' => Kohana::lang('poll.delete'), 'class' => 'delete_button', 'title' => 'Czy na pewno chcesz usunąć element?')));
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
       
        <?php echo form::close(); ?>
        <?php
        if(!request::is_ajax()) {
        echo $oPagination;
        }
    } else {
        ?>
        <div class="info">Brak elementów</div>
    <?php } ?>
        <?php if(!request::is_ajax()) { ?>
</div>
<?php } ?>