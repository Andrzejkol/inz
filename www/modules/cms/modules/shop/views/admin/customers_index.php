<?php if(!request::is_ajax()) { ?>
<div id="admin_customers_index">
    <div class="options"><h5>Klienci</h5><br/>
        <div style="float:right;">
            <?php echo Kohana::lang('customer.last_name'); ?>:
            <input type="text" name="customer_name" id="customer_name" />
        </div>
    </div>
    <?php
    }
    if(!empty($oCustomers) && $oCustomers->count() > 0): ?>
    <?php if(!request::is_ajax()) { ?>
    <?php echo form::open('4dminix/usun_klienta/'); ?>

    <?php } ?>
    <table class="table_view" id="customers_list">
        <tr>
            <th><input type="checkbox" name="customer_check_all" id="customer_check_all" class="check_all" value="1" /></th>
            <th><?php echo Kohana::lang('customer.last_name') . ', ' . Kohana::lang('customer.first_name') . ' (' . Kohana::lang('customer.email') . ')'; ?> <?php layer::GetSort('customers_orderby', 1, 2, '/4dminix/klienci');?></th>
            <th><?php echo Kohana::lang('customer.actions'); ?></th>
        </tr>
        <?php foreach($oCustomers as $c): ?>
        <tr>
            <td><input type="checkbox" name="customer_check[]" class="check" value="<?php echo $c->id_customer; ?>" /></td>
            <td><?php echo strip_tags($c->customer_last_name) . ', ' . strip_tags($c->customer_first_name) . ' (' . $c->customer_email . ')'; ?></td>
            <td>
				<?php echo html::anchor('4dminix/edytuj_klienta/'.$c->id_customer, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 

				echo html::anchor('4dminix/usun_klienta/'.$c->id_customer, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); 
				if ($c->verified != 'Y') {
					echo html::anchor('4dminix/weryfikuj/' . $c->id_customer, 'Wyślij link aktywacyjny', array('class' => 'btn btn-info', 'title' => 'Wyślij link aktywacyjny'));
				}
				?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php if(!request::is_ajax()) { ?>
    <div class="delete_selected">
    <?php echo Kohana::lang('customer.selected'); ?>: 
	<button name="delete_customer" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
    </div>
    <?php echo form::close(); ?>
    <?php echo $pagination; ?>
    <?php } ?>
    <?php else: ?>
    <div class="info"><?php echo Kohana::lang('customer.no_customers'); ?></div>
    <?php endif; ?>
<?php if(!request::is_ajax()) { ?>
</div>
<?php } ?>