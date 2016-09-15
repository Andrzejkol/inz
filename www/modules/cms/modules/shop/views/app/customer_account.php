
<div class="col-md-12 content-margin">
    <?php
    if (!empty($msg)) :
        echo $msg;
    endif;
    ?>
    <div id="customer_account" class="customer_login customer-forms col-sm-6 col-sm-offset-3">
        <h2 class="title"><?php echo Kohana::lang('shop_app.account.your_account'); ?></h2>
        <?php echo form::open(); ?>
        <div id="customer_account_form" class="customer_form site-form">
            <div class="customer_row row">
                <div class="col-md-6 col-xs-6">
                    <label>
                        <?php echo Kohana::lang('shop_app.customer.customer_details'); ?>:
                    </label>
                </div>
                <div class="col-md-3 col-xs-6 text-center">
                    <?php echo html::anchor(Kohana::lang('links.lang') . 'edycja_danych', Kohana::lang('shop_app.customer.change_details'), array('class' => 'btn btn-yellow')); ?>
                </div>
            </div>
            <?php /*
              <tr>
              <td class="td_form_left"><?php echo Kohana::lang('customer.favourite'); ?>:</td>
              <td>
              <div class="button_link large">
              <?php echo html::anchor('ulubione', Kohana::lang('customer.watch')); ?>
              </div></td>
              </tr>
              <tr>
              <td class="td_form_left"><?php echo Kohana::lang('customer.basket'); ?>:</td>
              <td>
              <div class="button_link large">
              <?php echo html::anchor('zamowienie/koszyk', Kohana::lang('customer.watch')); ?>
              </div>
              </td>
              </tr> */ ?>
            <div class="customer_row row">
                <div class="col-md-6 col-xs-6">
                    <label><?php echo Kohana::lang('shop_app.customer.orders_history'); ?>:</label></div>
                <div class="col-md-3 col-xs-6 text-center">
                    <?php echo html::anchor(Kohana::lang('links.lang') . 'historia_transakcji', Kohana::lang('shop_app.customer.watch'), array('class' => 'btn btn-yellow')); ?>
                </div>
            </div>

            <?php /*
              <tr>
              <td class="td_form_left"><?php echo Kohana::lang('customer.title.your_subscriptions'); ?>:</td>
              <td>
              <div class="button_link large">
              <?php echo html::anchor('twoje_abonamenty', Kohana::lang('customer.watch')); ?>
              </div>
              </td>
              </tr>
             */ ?>
            <div class="customer_row row">
                <div class="col-md-6 col-xs-6">
                    <label><?php echo Kohana::lang('shop_app.customer.change_password'); ?>:</label></div>
                <div class="col-md-3 col-xs-6 text-center">
                    <?php echo html::anchor(Kohana::lang('links.lang') . 'zmien_haslo', Kohana::lang('shop_app.customer.change_password'), array('class' => 'btn btn-yellow')); ?>
                </div>
            </div>
            <div class="customer_row row">
                <div class="col-md-6 col-xs-6"><label><?php echo Kohana::lang('shop_app.customer.delete_account'); ?>:</label></div>
                <div class="col-md-3 col-xs-6 text-center">
                    <?php echo html::anchor(Kohana::lang('links.lang') . 'usun_konto', Kohana::lang('shop_app.customer.delete'), array('class' => 'btn btn-yellow')); ?>
                </div>
            </div>
        </div>
        <?php echo form::close(); ?>
    </div>
</div>