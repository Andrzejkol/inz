<?php if(!request::is_ajax()) { ?>
<div id="admin_orders_index">
    <span onclick="$('#product_filters').toggle();" style="cursor: pointer;"><?php echo Kohana::lang('product.show_filters'); ?></span>
    <fieldset id="product_filters" style="display: none;">
        <legend><?php echo Kohana::lang('order.filters'); ?></legend>
        <?php echo form::open(null, array('method' => 'get')); ?>
        <table>
            <tr>
                <th>
                    <?php echo Kohana::lang('order.date_order_from'); ?>:
                </th>
                <td>
                    <input type="text" name="date_order_from" id="date_order_from" value="<?php echo !empty($_GET['date_order_from'])?$_GET['date_order_from']:'';?>" />
                </td>
                <th>
                    <?php echo Kohana::lang('order.order_number'); ?>:
                </th>
                <td>
                    <input type="text" name="order_number" id="order_number" value="<?php echo !empty($_GET['order_number'])?$_GET['order_number']:'';?>" />
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo Kohana::lang('order.date_order_to'); ?>:
                </th>
                <td>
                    <input type="text" name="date_order_to" id="date_order_to" value="<?php echo !empty($_GET['date_order_to'])?$_GET['date_order_to']:'';?>" />
                </td>
                <th>
                    <?php echo Kohana::lang('order.order_status'); ?>:
                </th>
                <td>
                    <?php echo form::dropdown(array('name'=>'orders_status_search', 'id'=>'orders_status_search'), $aOrdersStatuses,  !empty($_GET['orders_status_search'])?$_GET['orders_status_search']:''); ?>
                </td>
            </tr>
			  <tr>
                <th>
                    <?php echo Kohana::lang('order.last_name'); ?>:
                </th>
                <td>
                    <input type="text" name="order_last_name" id="order_last_name" value="<?php echo !empty($_GET['order_last_name'])?$_GET['order_last_name']:'';?>" />
                </td>
				 <th>
                    <?php echo Kohana::lang('order.first_name'); ?>:
                </th>
                <td>
                    <input type="text" name="order_first_name" id="order_first_name" value="<?php echo !empty($_GET['order_first_name'])?$_GET['order_first_name']:'';?>" />
                </td>
            </tr>
			 <tr>
                <th>
                    <?php echo Kohana::lang('order.mail'); ?>:
                </th>
                <td colspan="3">
                    <input type="text" name="order_mail" id="order_mail" value="<?php echo !empty($_GET['order_mail'])?$_GET['order_mail']:'';?>" />
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="submit" name="filter" id="filter_btn" value="<?php echo Kohana::lang('product.filter'); ?>" />
                </td>
            </tr>
        </table>
        <script type="text/javascript">
            $(function() {
                $('#date_order_from').datepicker({dateFormat: '<?php echo config::JQ_DATE_FORMAT;?>'});
                $('#date_order_to').datepicker({dateFormat: '<?php echo config::JQ_DATE_FORMAT;?>'});
            });
        </script>
        <?php echo form::close(); ?>
    </fieldset>
    <?php
}
    if(!empty($oOrders) && $oOrders->count()>0) { ?>
    <?php if(!request::is_ajax()) { ?>
    <?php echo form::open('4dminix/usun_zamowienie/'); ?>

    <?php } ?><div class="options"><h5>Zamówienia</h5></div><br/>
    <table class="table_view" id="orders_list">
        <tr>
            <th><input type="checkbox" name="order_check_all" id="order_check_all" class="check_all" value="1" /></th>
            <th><?php echo Kohana::lang('order.order_number'); ?></th>
            <th><?php echo Kohana::lang('order.order_date');?> 
                <?php echo html::image('img/admin_default/sort-2.png', array('alt' => Kohana::lang('app.count'), 'usemap' => '#m_orderdate_count', 'id' => 'order_date_sort')); ?>
                <map name="m_orderdate_count" id="m_orderdate_count">
                    <area shape="poly" coords="10,0,16,8,22,0,10,0" class="less" id="date_order_less" alt="<?php echo Kohana::lang('app.less'); ?>" title="<?php echo Kohana::lang('app.less'); ?>" href="<?php echo url::base(); ?>4dminix/zamowienia?orderby=order_date&order_type=DESC" />
                    <area shape="poly" coords="0,8,6,0,12,8,0,8" class="more" id="date_order_more" alt="<?php echo Kohana::lang('app.more_btn'); ?>" title="<?php echo Kohana::lang('app.more_btn'); ?>" href="<?php echo url::base(); ?>4dminix/zamowienia?orderby=order_date&order_type=ASC" />
                </map>
            </th>
			<th><?php echo Kohana::lang('order.customer_details');?> 
               <?php /*   <?php echo html::image('img/count.png', array('alt' => Kohana::lang('app.count'), 'usemap' => '#m_ordercust_count', 'id' => 'order_date_sort')); ?>
              <map name="m_ordercust_count" id="m_ordercust_count">
                    <area shape="poly" coords="10,0,16,8,22,0,10,0" class="less" id="ordercust_less" alt="<?php echo Kohana::lang('app.less'); ?>" title="<?php echo Kohana::lang('app.less'); ?>" href="<?php echo url::base(); ?>4dminix/zamowienia?orderby=confirm_email&order_type=DESC" />
                    <area shape="poly" coords="0,8,6,0,12,8,0,8" class="more" id="ordercust_more" alt="<?php echo Kohana::lang('app.more_btn'); ?>" title="<?php echo Kohana::lang('app.more_btn'); ?>" href="<?php echo url::base(); ?>4dminix/zamowienia?orderby=confirm_email&order_type=ASC" />
                </map> */ ?>
            </th>
            <th><?php echo Kohana::lang('order.order_cost'); ?>
                <?php echo html::image('img/admin_default/sort-2.png', array('alt' => Kohana::lang('app.count'), 'usemap' => '#m_ordercost_count', 'id' => 'order_date_sort')); ?>
                <map name="m_ordercost_count" id="m_ordercost_count">
                    <area shape="poly" coords="10,0,16,8,22,0,10,0" class="less" id="ordercost_less" alt="<?php echo Kohana::lang('app.less'); ?>" title="<?php echo Kohana::lang('app.less'); ?>" href="<?php echo url::base(); ?>4dminix/zamowienia?orderby=order_cost&order_type=DESC" />
                    <area shape="poly" coords="0,8,6,0,12,8,0,8" class="more" id="ordercost_more" alt="<?php echo Kohana::lang('app.more_btn'); ?>" title="<?php echo Kohana::lang('app.more_btn'); ?>" href="<?php echo url::base(); ?>4dminix/zamowienia?orderby=order_cost&order_type=ASC" />
                </map>
            </th>
            <th><?php echo Kohana::lang('order.order_status'); ?></th>
            <th><?php echo Kohana::lang('order.actions'); ?></th>
        </tr>
        <?php
        foreach($oOrders as $o):
        ?>
        <tr>
            <td><input type="checkbox" name="order_check[]" class="check" value="<?php echo $o->id_order; ?>" /></td>
            <td><?php echo (!empty($o->order_number) ? $o->order_number : ''); ?></td>
            <td><?php echo date(config::DATE_TIME_FORMAT, $o->order_date); ?></td>
			<td><?php echo $o->customer_last_name; ?> <?php echo $o->customer_first_name; ?> <br/> <?php echo $o->confirm_email; ?></td>
            <td>
                <span class="order_cost" style="<?php echo ($o->paid=='Y') ? 'color:green;' : ''; ?>" ><?php echo $o->order_cost; ?></span><br/>
                <?php echo Kohana::lang('order.paid_'.$o->paid); ?>
            </td>
            <td style="vertical-align: middle">
                <?php echo form::dropdown(array('name'=>'orders_status_check-' . $o->id_order, 'id'=>'orders_status_check-' . $o->id_order, 'class'=>'ddorder_status_check'), $aOrdersStatuses, $o->status_id); ?> <?php echo html::image('img/admin_default/pointer.png', array('class' => 'order_status_check', 'id'=>'orders_status_check-' . $o->id_order, 'style' => 'cursor: pointer')); ?>
            </td>
            <td>
				<?php echo html::anchor('4dminix/edytuj_zamowienie/'.$o->id_order, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
				echo html::anchor('4dminix/usun_zamowienie/'.$o->id_order, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); ?>
            </td>
        </tr>
         <?php endforeach; ?>
    </table>
    <?php echo $pagination; ?>
    <?php if(!request::is_ajax()) { ?>
    <div class="delete_selected">
    <?php echo Kohana::lang('order.selected'); ?>: 
	<button name="delete_order" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
    </div>
    <?php echo form::close(); ?>
    <?php } ?>
    <?php
    } else { ?>
    <div class="info"><?php echo Kohana::lang('order.no_orders'); ?></div>
    <?php }
    if(!request::is_ajax()) { ?>
</div>
<?php } ?>
