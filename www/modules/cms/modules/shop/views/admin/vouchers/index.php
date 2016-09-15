<div id="admin_rebates_groups_index">
    <div class="options"><h5>Vouchery</h5>
        <?php echo html::anchor('4dminix/dodaj_voucher', html::image('img/admin_default/newobject.gif', array('alt' => 'Dodaj voucher', 'class' => 'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_voucher', 'Dodaj voucher', array('class' => 'add_text', 'id' => 'add_news_button')); ?>
    </div>
    <?php if (!empty($oVouchers) && $oVouchers->count() > 0): ?>
        <table class="table_view" id="rebate_group_list">        
            <tr>
                <th>#</th>
                <th>Kod</th>
                <th>Kwota</th>
                <th>Status</th>
                <th><?php echo Kohana::lang('rebate_group.actions'); ?></th>
            </tr>
            <?php
            foreach ($oVouchers as $v):
                ?>
                <tr>
                    <td><?php echo $v->id_voucher; ?></td>
                    <td><?php echo $v->voucher_code; ?></td>
                    <td><?php echo $v->voucher_value; ?></td>
                    <td>
                        <?php
                        if ($v->voucher_status == 2) {
                            echo 'Użyty';
                        } elseif ($v->voucher_status == 1) {
                            echo 'Aktywny';
                        } else {
                            echo 'Nieaktywny';
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        echo html::anchor('4dminix/edytuj_voucher/' . $v->id_voucher, Kohana::lang('admin.edit'), array('title' => Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit'));

                        echo html::anchor('4dminix/usun_voucher/' . $v->id_voucher, Kohana::lang('admin.delete'), array('class' => 'btn btn-delete', 'title' => Kohana::lang('admin.pages.delete')));
                        ?>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </table>
    <?php else: ?>
        <div class="info">Brak voucherów</div>
<?php endif; ?>
</div>