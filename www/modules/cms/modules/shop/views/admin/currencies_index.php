<div id="admin_currencies_index">
    <?php
    if (!empty($msg)) {
        echo $msg;
    }
    ?>
    <div class="options"><h5>Waluty</h5>
        <?php echo html::anchor('4dminix/dodaj_walute', html::image('img/admin_default/newobject.gif', array('alt' => Kohana::lang('shop_admin.currencies.add_currency'), 'class' => 'add_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_walute', Kohana::lang('shop_admin.currencies.add_currency'), array('class' => 'add_text', 'id' => 'add_news_button')); ?>
    </div>
    <?php if (!empty($oCurrencies) && $oCurrencies->count() > 0) : ?>
        <table class="table_view" id="currencies_list">
            <tr>
                <th># <?php layer::GetSort('currencies_orderby', 1, 2, '/4dminix/waluty');?></th>
                <th><?php echo Kohana::lang('shop_admin.currencies.currency_name'); ?><?php layer::GetSort('currencies_orderby', 3, 4, '/4dminix/waluty');?></th>
                <th><?php echo Kohana::lang('shop_admin.currencies.currency_code'); ?><?php layer::GetSort('currencies_orderby', 5, 6, '/4dminix/waluty');?></th>
                <th><?php echo Kohana::lang('shop_admin.currencies.currency_factor'); ?><?php layer::GetSort('currencies_orderby', 7, 8, '/4dminix/waluty');?></th>
                <th><?php echo Kohana::lang('boxes.status'); ?><?php layer::GetSort('currencies_orderby', 9, 10, '/4dminix/waluty');?></th>
                <th><?php echo Kohana::lang('shop_admin.currencies.actions'); ?></th>
            </tr>
            <?php
            foreach ($oCurrencies as $t):
                ?>
                <tr>
                    <td><?php echo $t->id_currency; ?></td>
                    <td><?php echo strip_tags($t->currency_name); ?></td>
                    <td><?php echo strip_tags($t->currency_code); ?></td>
                    <td><?php echo $t->currency_factor; ?></td>
                    <td>
                        <a href="#" class="changeStatus" id="currency-<?php echo $t->id_currency; ?>"><?php
                            echo ($t->currency_active == 'Y') ?
                                    html::image('img/icons/tick.png', array('alt' => Kohana::lang('shop_admin.currencies.enabled'))) :
                                    html::image('img/icons/cross.png', array('alt' => Kohana::lang('shop_admin.currencies.disabled')));
                            ?></a>    
                    </td>
                    <td>
						<?php echo html::anchor('4dminix/edytuj_walute/' . $t->id_currency, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 

						echo html::anchor('4dminix/usun_walute/' . $t->id_currency, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); ?>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </table>
    <?php else: ?>
        <div class="info"><?php echo Kohana::lang('shop_admin.currencies.no_currencies'); ?></div>
    <?php endif; ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.changeStatus').click(function() {
                var page = $(this);
                var id = parseInt(page.attr('id').split('-')[1]);
                $.get("<?php echo url::base() . 'admin_currencies/change_status'; ?>",
                        {id_currency: id},
                function(result) {
                    if (result == 'Y') {
                        $('img', page).attr({'src': "<?php echo url::file('img/icons/tick.png'); ?>", 'alt': "<?php echo Kohana::lang('pages.enabled'); ?>"});
                    }
                    else if (result == 'N') {
                        $('img', page).attr({'src': "<?php echo url::file('img/icons/cross.png'); ?>", 'alt': "<?php echo Kohana::lang('pages.disabled'); ?>"});
                    }
                });
                return false;
            });
        });
    </script>
</div>