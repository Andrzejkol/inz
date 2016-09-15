<div class="content-margin col-md-12">
    <?php
    if (!empty($msg)) {
        echo $msg;
    }
    ?>
    <?php echo form::open(null, array('class' => 'form-horizontal')); ?>
    <div class="customer-info col-md-6">
        <h2 class="title"><?php echo Kohana::lang('shop_app.account.create_account'); ?></h2>

        <div class="form-group">
            <label for="customer_first_name" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.first_name'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_first_name" id="customer_first_name" class="form-control" value="<?php
                if (!empty($_POST['customer_first_name'])) {
                    echo $_POST['customer_first_name'];
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_last_name" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.last_name'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_last_name" id="customer_last_name" class="form-control" value="<?php
                if (!empty($_POST['customer_last_name'])) {
                    echo $_POST['customer_last_name'];
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_email" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.email'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_email" class="form-control" id="customer_email" value="<?php
                if (!empty($_POST['customer_email'])) {
                    echo $_POST['customer_email'];
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_password" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.password'); ?>:</label>
            <div class="col-sm-9">
                <input type="password" name="customer_password" class="form-control" id="customer_password" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_password_repeat" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.password_repeat'); ?>:</label>
            <div class="col-sm-9">
                <input type="password" name="customer_password_repeat" class="form-control" id="customer_password_repeat" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_type" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.type'); ?>:</label>
            <div class="col-sm-9">
                <select type="password" name="customer_type" class="form-control" id="customer_type">
                    <option value="0">Kient indywidualny</option>
                    <option value="1">Klient biznesowy</option>
                </select>
            </div>
        </div>

    </div>
    <div class="col-md-6 customer-info ">

        <h2 class="title"><?php echo Kohana::lang('shop_app.customer.dostawa'); ?></h2>

        <div class="form-group">
            <label for="customer_phoneno" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.phone_no'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_phoneno" class="form-control" id="customer_phone" value="<?php
                if (!empty($_POST['customer_phoneno'])) {
                    echo $_POST['customer_phoneno'];
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_country" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.country'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_country" class="form-control" id="customer_country" value="<?php
                if (!empty($_POST['customer_country'])) {
                    echo $_POST['customer_country'];
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_address" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.adres'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_address" class="form-control" id="customer_address" value="<?php
                if (!empty($_POST['customer_address'])) {
                    echo $_POST['customer_address'];
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_zip" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.postcode'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_zip" class="form-control" id="customer_postcode" value="<?php
                if (!empty($_POST['customer_zip'])) {
                    echo $_POST['customer_zip'];
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_city" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.city'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_city" class="form-control" id="customer_city" value="<?php
                if (!empty($_POST['customer_city'])) {
                    echo $_POST['customer_city'];
                }
                ?>" />
            </div>
        </div>
    </div>

    <?php /* <h3><span class="cufon_chapa"><?php echo Kohana::lang('shop_app.headers.registration'); ?></span></h3> */ ?>
    <?php /*
      <div id="register_content" class="customer-forms">



      <table id="customer_register_form" class="customer_form site-form">

      <?php /*
      <tr>
      <td>
      <label for="customer_login"><?php echo Kohana::lang('app.user_login'); ?>:</label>

      <input type="text" name="customer_login" id="customer_login" value="<?php
      if (!empty($_POST['customer_login'])) {
      echo $_POST['customer_login'];
      }
      ?>" />
      </td>
      </tr>

     */ /* ?>
      <tr>
      <td>
      <label for="customer_email"><?php echo Kohana::lang('shop_app.customer.email'); ?>:</label>

      <input type="text" name="customer_email" id="customer_email" value="<?php
      if (!empty($_POST['customer_email'])) {
      echo $_POST['customer_email'];
      }
      ?>" />
      </td>
      </tr>

      <tr>
      <td>
      <label for="customer_password"><?php echo Kohana::lang('shop_app.customer.password'); ?>:</label>

      <input type="password" name="customer_password" class="input-text" id="customer_password" />
      </td>
      </tr>
      <tr>
      <td>
      <label for="customer_password_repeat"><?php echo Kohana::lang('shop_app.customer.password_repeat'); ?>:</label>

      <input type="password" name="customer_password_repeat" class="input-text" id="customer_password_repeat" />
      </td>
      </tr>
      </table>
      <hr>
      <table class="customer_form site-form">
      <tr>
      <td>
      <label for="customer_company_name"><?php echo Kohana::lang('shop_app.customer.company_name'); ?>:</label>
      <input type="text" name="customer_company_name" id="customer_company_name" value="<?php
      if (!empty($_POST['customer_company_name'])) {
      echo $_POST['customer_company_name'];
      }
      ?>" />
      </td>
      </tr>
      <tr>
      <td>
      <label for="customer_nip"><?php echo Kohana::lang('shop_app.customer.nip'); ?>:</label>

      <input type="text" name="customer_nip" id="customer_nip" value="<?php
      if (!empty($_POST['customer_nip'])) {
      echo $_POST['customer_nip'];
      }
      ?>" />
      </td>
      </tr>
      <tr>
      <td>
      <label for="customer_first_name"><?php echo Kohana::lang('shop_app.customer.first_name'); ?>:</label>

      <input type="text" name="customer_first_name" id="customer_first_name" value="<?php
      if (!empty($_POST['customer_first_name'])) {
      echo $_POST['customer_first_name'];
      }
      ?>" />
      </td>
      </tr>

      <tr>
      <td>
      <label for="customer_last_name"><?php echo Kohana::lang('shop_app.customer.last_name'); ?>:</label>

      <input type="text" name="customer_last_name" id="customer_last_name" value="<?php
      if (!empty($_POST['customer_last_name'])) {
      echo $_POST['customer_last_name'];
      }
      ?>" />
      </td>
      </tr>



      <tr>
      <td>
      <label for="customer_phoneno"><?php echo Kohana::lang('shop_app.customer.phone_no'); ?>:</label>

      <input type="text" name="customer_phoneno" id="customer_phone" value="<?php
      if (!empty($_POST['customer_phoneno'])) {
      echo $_POST['customer_phoneno'];
      }
      ?>" />
      </td>
      </tr>

      <tr>
      <td>
      <label for="customer_address"><?php echo Kohana::lang('shop_app.customer.adres'); ?>:</label>

      <input type="text" name="customer_address" id="customer_address" value="<?php
      if (!empty($_POST['customer_address'])) {
      echo $_POST['customer_address'];
      }
      ?>" />
      </td>
      </tr>

      <tr>
      <td>
      <label for="customer_zip"><?php echo Kohana::lang('shop_app.customer.postcode'); ?>:</label>

      <input type="text" name="customer_zip" id="customer_postcode" value="<?php
      if (!empty($_POST['customer_zip'])) {
      echo $_POST['customer_zip'];
      }
      ?>" />
      </td>
      </tr>

      <tr>
      <td>
      <label for="customer_city"><?php echo Kohana::lang('shop_app.customer.city'); ?>:</label>

      <input type="text" name="customer_city" id="customer_city" value="<?php
      if (!empty($_POST['customer_city'])) {
      echo $_POST['customer_city'];
      }
      ?>" />
      </td>
      </tr>

      <tr>
      <td>
      <label for="customer_country"><?php echo Kohana::lang('shop_app.customer.country'); ?>:</label>

      <input type="text" name="customer_country" id="customer_country" value="<?php
      if (!empty($_POST['customer_country'])) {
      echo $_POST['customer_country'];
      }
      ?>" />
      </td>
      </tr>

      </table>
      <hr>
      <table class="customer_form site-form">

      <tr>
      <td class="customer_inny_dost">
      <label for="customer_adres_dost"><?php echo Kohana::lang('shop_app.customer.adres_dost'); ?>: (<?php echo Kohana::lang('shop_app.customer.adres_inny'); ?>)</label>
      <input type="checkbox" name="customer_inny_adres" class="input-checkbox" id="customer_inny_adres" value="confirmed"
      <?php
      if (!empty($_POST['customer_inny_adres'])) {
      echo 'checked="checked"';
      }
      ?>/>
      </td>
      </tr>
      <tr>
      <td>
      <label for="delivery_address"><?php echo Kohana::lang('shop_app.customer.adres'); ?>:</label>

      <input type="text" name="delivery_address" id="delivery_address" disabled="disabled" value="<?php
      if (!empty($_POST['delivery_address'])) {
      echo $_POST['delivery_address'];
      }
      ?>" />
      </td>
      </tr>

      <tr>
      <td>
      <label for="delivery_zip"><?php echo Kohana::lang('shop_app.customer.postcode'); ?>:</label>

      <input type="text" name="delivery_zip" id="delivery_zip" disabled="disabled" value="<?php
      if (!empty($_POST['delivery_zip'])) {
      echo $_POST['delivery_zip'];
      }
      ?>" />
      </td>
      </tr>

      <tr>
      <td>
      <label for="delivery_city"><?php echo Kohana::lang('shop_app.customer.city'); ?>:</label>

      <input type="text" name="delivery_city" id="delivery_city" disabled="disabled" value="<?php
      if (!empty($_POST['delivery_city'])) {
      echo $_POST['delivery_city'];
      }
      ?>" />
      </td>
      </tr>

      <tr>
      <td>
      <label for="delivery_country"><?php echo Kohana::lang('shop_app.customer.country'); ?>:</label>

      <input type="text" name="delivery_country" id="delivery_country" disabled="disabled" value="<?php
      if (!empty($_POST['delivery_country'])) {
      echo $_POST['delivery_country'];
      }
      ?>" />
      </td>
      </tr>
      </table>
      <table style="margin: 20px auto 0;" class="accepts">

      <tr>
      <td style="float:left; text-align: left;">
      <input type="checkbox" name="customer_reg_accept" class="input-checkbox" id="customer_reg_accept" value="confirmed" />
      <?php echo Kohana::lang('shop_app.customer.reg_accept'); ?>
      <?php echo html::anchor(Kohana::lang('links.lang') . Kohana::lang('links.regulamin'), Kohana::lang('shop_app.regulations'), array("target" => "blank")); ?>
      <?php echo Kohana::lang('shop_app.customer.and'); ?> <?php echo html::anchor(Kohana::lang('links.lang') . Kohana::lang('links.privacy'), Kohana::lang('shop_app.privacy'), array("target" => "blank")); ?> *
      </td>
      </tr>

      <tr>
      <td style="float:left; text-align: justify;"><input type="checkbox" name="customer_reg_accept2" class="input-checkbox" id="customer_reg_accept2" value="confirmed" />
      <?php echo Kohana::lang('shop_app.customer.reg_accept2'); ?> *
      </td>
      </tr>
      <?php /*
      <tr>
      <td style="float:left; text-align: left;"><input type="checkbox" name="customer_accept3" class="input-checkbox" id="customer_accept3" value="confirmed" />
      <?php echo Kohana::lang('shop_app.customer.accept3'); ?>
      </td>
      </tr> */ /* ?>
      <tr>
      <td style="float:left;"><span class="req">* -	<?php echo Kohana::lang('shop_app.customer.field_required'); ?></span>
      </td>
      </tr>

      <tr>

      <td style="text-align: right;">
      <input type="submit" value="<?php echo Kohana::lang('shop_app.account.register'); ?>" name="register" class="submit small button_arrow" />
      </td>
      </tr>
      </table>


      </div> */ ?>
    <div class="col-xs-12">
        <div class="clear"></div>
        <div class="form-group">
            <input type="checkbox" name="customer_reg_accept" class="input-checkbox" id="customer_reg_accept" value="confirmed" />
            <?php echo Kohana::lang('shop_app.customer.reg_accept'); ?>
            <?php echo html::anchor(Kohana::lang('links.lang') . Kohana::lang('links.regulamin'), Kohana::lang('shop_app.regulations'), array("target" => "blank")); ?>
            <?php echo Kohana::lang('shop_app.customer.and'); ?> <?php echo html::anchor(Kohana::lang('links.lang') . Kohana::lang('links.privacy'), Kohana::lang('shop_app.privacy'), array("target" => "blank")); ?> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="customer_reg_accept2" class="input-checkbox" id="customer_reg_accept2" value="confirmed" />
            <?php echo Kohana::lang('shop_app.customer.reg_accept2'); ?>

        </div>
        <div class="form-group text-right">
            <input type="submit" value="<?php echo Kohana::lang('shop_app.account.register'); ?>" name="register" class="btn" />
        </div>
    </div>
</div>
<?php echo form::close(); ?>

