<?php //<h3><?php echo Kohana::lang('shop_app.account.change_details'); </h3> */   ?>
<div class="col-md-12 content-margin">
    <?php echo form::open(null, array('class' => 'form-horizontal')); ?>
    <?php
    if (!empty($msg)) :
        echo $msg;
    endif;
    ?>
    <div class="customer-info col-md-6 col-xs-12">
        <h2 class="title"><?php echo Kohana::lang('shop_app.customer.client_data'); ?></h2>
        <div class="form-group">
            <label for="customer_first_name" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.first_name'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_first_name" class="form-control" id="customer_first_name" value="<?php
                if (!empty($_POST)) {
                    echo $_POST['customer_first_name'];
                } else {
                    echo $oCustomerDetails->customer_first_name;
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_last_name" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.last_name'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_last_name" class="form-control" id="customer_last_name" value="<?php
                if (!empty($_POST)) {
                    echo $_POST['customer_last_name'];
                } else {
                    echo $oCustomerDetails->customer_last_name;
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_email" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.email'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_email" class="form-control" id="customer_email" value="<?php
                if (!empty($_POST)) {
                    echo $_POST['customer_email'];
                } else {
                    echo $oCustomerDetails->customer_email;
                }
                ?>" />
            </div>
        </div>
    </div>
    <div class="customer-info col-md-6 col-xs-12">
        <h2 class="title"><?php echo Kohana::lang('shop_app.customer.dostawa'); ?></h2>
        <div class="form-group">
            <label for="customer_city" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.city'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_city" class="form-control" id="customer_city" value="<?php
                if (!empty($_POST)) {
                    echo $_POST['customer_city'];
                } else {
                    echo $oCustomerDetails->customer_city;
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_zip" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.zip'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_zip" class="form-control" id="customer_zip" value="<?php
                if (!empty($_POST)) {
                    echo $_POST['customer_zip'];
                } else {
                    echo $oCustomerDetails->customer_zip;
                }
                ?>" />      
            </div>
        </div>

        <div class="form-group">
            <label for="customer_address" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.address'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_address" class="form-control" id="customer_address" value="<?php
                if (!empty($_POST)) {
                    echo $_POST['customer_address'];
                } else {
                    echo $oCustomerDetails->customer_address;
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_country" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.country'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_country" class="form-control" id="customer_country" value="<?php
                if (!empty($_POST)) {
                    echo $_POST['customer_country'];
                } else {
                    echo $oCustomerDetails->customer_country;
                }
                ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="customer_phoneno" class="col-sm-3 control-label"><?php echo Kohana::lang('shop_app.customer.phone_no'); ?>:</label>
            <div class="col-sm-9">
                <input type="text" name="customer_phoneno" class="form-control" id="customer_phoneno" value="<?php
                if (!empty($_POST)) {
                    echo $_POST['customer_phoneno'];
                } else {
                    echo $oCustomerDetails->customer_phoneno;
                }
                ?>" />
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-9 text-right">
                <input type="submit" name="submit" class="btn" value="<?php echo Kohana::lang('shop_app.customer.save_changes'); ?>" />
            </div>
        </div>
    </div>
    <?php echo form::close(); ?>
</div>
<?php /*
  <div id="customer_account" class="customer-forms">

  <?php echo form::open(); ?>
  <div id="customer_account_edit" class="site-form">
  <table class="table_form">
  <?php /*
  <tr>
  <td class="td_form_left">
  <label><?php echo Kohana::lang('customer.gender'); ?>:</label>
  </td>
  <td>
  <label for="male"><?php echo Kohana::lang('customer.male'); ?>:</label>
  <?php echo form::radio(array('name'=>'gender','id'=>'male', 'style'=>'width:auto'), 'M', ((!empty($_POST['gender']) && $_POST['gender']=='M') ? TRUE : (!empty($oCustomerDetails->gender) && ($oCustomerDetails->gender=='M') ? TRUE : ''))); ?>
  <label for="female"><?php echo Kohana::lang('customer.female'); ?>:</label>
  <?php echo form::radio(array('name'=>'gender','id'=>'female', 'style'=>'width:auto'), 'F', ((!empty($_POST['gender']) && $_POST['gender']=='F') ? TRUE : (!empty($oCustomerDetails->gender) && ($oCustomerDetails->gender=='F') ? TRUE : ''))); ?>

  </tr>
  ?>
  <tr>
  <td style="text-align: left;"><p> <?php echo Kohana::lang('shop_app.customer.client_data'); ?></p></td>
  </tr>
  <tr>
  <td>
  <label for="customer_first_name"><?php echo Kohana::lang('shop_app.customer.first_name'); ?>:</label>

  <input type="text" name="customer_first_name" id="customer_first_name" value="<?php
  if (!empty($_POST)) {
  echo $_POST['customer_first_name'];
  } else {
  echo $oCustomerDetails->customer_first_name;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="customer_last_name"><?php echo Kohana::lang('shop_app.customer.last_name'); ?>:</label>

  <input type="text" name="customer_last_name" id="customer_last_name" value="<?php
  if (!empty($_POST)) {
  echo $_POST['customer_last_name'];
  } else {
  echo $oCustomerDetails->customer_last_name;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="customer_email"><?php echo Kohana::lang('shop_app.customer.email'); ?>:</label>

  <input type="text" name="customer_email" id="customer_email" value="<?php
  if (!empty($_POST)) {
  echo $_POST['customer_email'];
  } else {
  echo $oCustomerDetails->customer_email;
  }
  ?>" /></td>

  </tr>
  <?php /*
  <tr>
  <td class="td_form_left">
  <label for="customer_company_name"><?php echo Kohana::lang('shop_app.customer.company_name'); ?>:</label>
  </td>
  <td><input type="text" name="customer_company_name" id="customer_company_name" value="<?php if(!empty($_POST)) { echo $_POST['customer_company_name']; } else { echo $oCustomerDetails->customer_company_name; } ?>" /></td>

  </tr>

  <tr>
  <td class="td_form_left">
  <label for="customer_nip"><?php echo Kohana::lang('shop_app.customer.nip'); ?>:</label>
  </td>
  <td><input type="text" name="customer_nip" id="customer_nip" value="<?php if(!empty($_POST)) { echo $_POST['customer_nip']; } else { echo $oCustomerDetails->customer_nip; } ?>" /></td>

  </tr>  ?>
  <tr>
  <td>
  <label for="customer_city"><?php echo Kohana::lang('shop_app.customer.city'); ?>:</label>

  <input type="text" name="customer_city" id="customer_city" value="<?php
  if (!empty($_POST)) {
  echo $_POST['customer_city'];
  } else {
  echo $oCustomerDetails->customer_city;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="customer_zip"><?php echo Kohana::lang('shop_app.customer.zip'); ?>:</label>

  <input type="text" name="customer_zip" id="customer_zip" value="<?php
  if (!empty($_POST)) {
  echo $_POST['customer_zip'];
  } else {
  echo $oCustomerDetails->customer_zip;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="customer_address"><?php echo Kohana::lang('shop_app.customer.address'); ?>:</label>

  <input type="text" name="customer_address" id="customer_address" value="<?php
  if (!empty($_POST)) {
  echo $_POST['customer_address'];
  } else {
  echo $oCustomerDetails->customer_address;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="customer_state"><?php echo Kohana::lang('shop_app.customer.state'); ?>:</label>


  <?php $aStates = layer::GetStates()->Value; ?>
  <select name="customer_state" id="customer_state" class="input-text">
  <?php foreach ($aStates as $stateKey => $stateValue): ?>
  <?php if (!empty($_POST['customer_state']) && $_POST['customer_state'] == $stateKey): ?>
  <option value="<?php echo $stateKey; ?>" selected="selected"><?php echo $stateValue; ?></option>
  <?php elseif (!empty($_SESSION['__customer']['customer_state']) && $_SESSION['_customer']['customer_state'] == $stateKey): ?>
  <option value="<?php echo $stateKey; ?>" selected="selected"><?php echo $stateValue; ?></option>
  <?php elseif ((!empty($oCustomerDetails->customer_state) && $oCustomerDetails->customer_state == $stateKey)): ?>
  <option value="<?php echo $stateKey; ?>" selected="selected"><?php echo $stateValue; ?></option>
  <?php else: ?>
  <option value="<?php echo $stateKey; ?>"><?php echo $stateValue; ?></option>
  <?php endif; ?>
  <?php endforeach; ?>
  </select>
  </td>

  </tr>
  <tr>
  <td>
  <label for="customer_country"><?php echo Kohana::lang('shop_app.customer.country'); ?>:</label>

  <input type="text" name="customer_country" id="customer_country" value="<?php
  if (!empty($_POST)) {
  echo $_POST['customer_country'];
  } else {
  echo $oCustomerDetails->customer_country;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="customer_www"><?php echo Kohana::lang('shop_app.customer.www'); ?>:</label>

  <input type="text" name="customer_www" id="customer_www" value="<?php
  if (!empty($_POST)) {
  echo $_POST['customer_www'];
  } else {
  echo $oCustomerDetails->customer_www;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="customer_phoneno"><?php echo Kohana::lang('shop_app.customer.phone_no'); ?>:</label>

  <input type="text" name="customer_phoneno" id="customer_phoneno" value="<?php
  if (!empty($_POST)) {
  echo $_POST['customer_phoneno'];
  } else {
  echo $oCustomerDetails->customer_phoneno;
  }
  ?>" /></td>

  </tr>
  <?php /*
  <tr>
  <td class="td_form_left">
  <label for="customer_faxno"><?php echo Kohana::lang('shop_app.customer.fax_no'); ?>:</label>
  </td>
  <td><input type="text" name="customer_faxno" id="customer_faxno" value="<?php if(!empty($_POST)) { echo $_POST['customer_faxno']; } else { echo $oCustomerDetails->customer_faxno; } ?>" /></td>

  </tr>
  <tr>
  <td class="td_form_left">
  <label for="customer_mobileno"><?php echo Kohana::lang('shop_app.customer.mobile_no'); ?>:</label>
  </td>
  <td><input type="text" name="customer_mobileno" id="customer_mobileno" value="<?php if(!empty($_POST)) { echo $_POST['customer_mobileno']; } else { echo $oCustomerDetails->customer_mobileno; } ?>" /></td>

  </tr>  ?>
  </table>
  <hr>
  <table class="table_form">
  <tr>
  <td style="text-align: left;"><p> <?php echo Kohana::lang('shop_app.customer.delivery_address'); ?></p></td>
  </tr>
  <tr>
  <td>
  <label for="delivery_first_name"><?php echo Kohana::lang('shop_app.customer.first_name'); ?>:</label>

  <input type="text" name="delivery_first_name" id="delivery_first_name" value="<?php
  if (!empty($_POST)) {
  echo $_POST['delivery_first_name'];
  } else {
  echo $oCustomerDetails->delivery_first_name;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="delivery_last_name"><?php echo Kohana::lang('shop_app.customer.last_name'); ?>:</label>

  <input type="text" name="delivery_last_name" id="delivery_last_name" value="<?php
  if (!empty($_POST)) {
  echo $_POST['delivery_last_name'];
  } else {
  echo $oCustomerDetails->delivery_last_name;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="delivery_email"><?php echo Kohana::lang('shop_app.customer.email'); ?>:</label>

  <input type="text" name="delivery_email" id="delivery_email" value="<?php
  if (!empty($_POST)) {
  echo $_POST['delivery_email'];
  } else {
  echo $oCustomerDetails->delivery_email;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="delivery_company_name"><?php echo Kohana::lang('shop_app.customer.company_name'); ?>:</label>

  <input type="text" name="delivery_company_name" id="delivery_company_name" value="<?php
  if (!empty($_POST)) {
  echo $_POST['delivery_company_name'];
  } else {
  echo $oCustomerDetails->delivery_company_name;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="delivery_nip"><?php echo Kohana::lang('shop_app.customer.nip'); ?>:</label>

  <input type="text" name="delivery_nip" id="delivery_nip" value="<?php
  if (!empty($_POST)) {
  echo $_POST['delivery_nip'];
  } else {
  echo $oCustomerDetails->delivery_nip;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="delivery_city"><?php echo Kohana::lang('shop_app.customer.city'); ?>:</label>

  <input type="text" name="delivery_city" id="delivery_city" value="<?php
  if (!empty($_POST)) {
  echo $_POST['delivery_city'];
  } else {
  echo $oCustomerDetails->delivery_city;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="delivery_zip"><?php echo Kohana::lang('shop_app.customer.zip'); ?>:</label>

  <input type="text" name="delivery_zip" id="delivery_zip" value="<?php
  if (!empty($_POST)) {
  echo $_POST['delivery_zip'];
  } else {
  echo $oCustomerDetails->delivery_zip;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="delivery_address"><?php echo Kohana::lang('shop_app.customer.address'); ?>:</label>

  <input type="text" name="delivery_address" id="delivery_address" value="<?php
  if (!empty($_POST)) {
  echo $_POST['delivery_address'];
  } else {
  echo $oCustomerDetails->delivery_address;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="delivery_state"><?php echo Kohana::lang('shop_app.customer.state'); ?>:</label>


  <?php $aStates = layer::GetStates()->Value; ?>
  <select name="delivery_state" id="delivery_state" class="input-text">
  <?php foreach ($aStates as $stateKey => $stateValue): ?>
  <?php if (!empty($_POST['delivery_state']) && $_POST['delivery_state'] == $stateKey): ?>
  <option value="<?php echo $stateKey; ?>" selected="selected"><?php echo $stateValue; ?></option>
  <?php elseif (!empty($_SESSION['__customer']['delivery_state']) && $_SESSION['__customer']['delivery_state'] == $stateKey): ?>
  <option value="<?php echo $stateKey; ?>" selected="selected"><?php echo $stateValue; ?></option>
  <?php elseif (!empty($oCustomerDetails->delivery_state) && $oCustomerDetails->delivery_state == $stateKey): ?>
  <option value="<?php echo $stateKey; ?>" selected="selected"><?php echo $stateValue; ?></option>
  <?php else: ?>
  <option value="<?php echo $stateKey; ?>"><?php echo $stateValue; ?></option>
  <?php endif; ?>
  <?php endforeach; ?>
  </select>
  </td>
  </tr>
  <tr>
  <td>
  <label for="delivery_country"><?php echo Kohana::lang('shop_app.customer.country'); ?>:</label>

  <input type="text" name="delivery_country" id="delivery_country" value="<?php
  if (!empty($_POST)) {
  echo $_POST['delivery_country'];
  } else {
  echo $oCustomerDetails->delivery_country;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="delivery_phoneno"><?php echo Kohana::lang('shop_app.customer.phone_no'); ?>:</label>

  <input type="text" name="delivery_phoneno" id="delivery_phoneno" value="<?php
  if (!empty($_POST)) {
  echo $_POST['delivery_phoneno'];
  } else {
  echo $oCustomerDetails->delivery_phoneno;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="delivery_faxno"><?php echo Kohana::lang('shop_app.customer.fax_no'); ?>:</label>

  <input type="text" name="delivery_faxno" id="delivery_faxno" value="<?php
  if (!empty($_POST)) {
  echo $_POST['delivery_faxno'];
  } else {
  echo $oCustomerDetails->delivery_faxno;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="delivery_mobileno"><?php echo Kohana::lang('shop_app.customer.mobile_no'); ?>:</label>

  <input type="text" name="delivery_mobileno" id="delivery_mobileno" value="<?php
  if (!empty($_POST)) {
  echo $_POST['delivery_mobileno'];
  } else {
  echo $oCustomerDetails->delivery_mobileno;
  }
  ?>" /></td>

  </tr>
  </table>
  <hr>
  <table class="table_form">
  <tr>
  <td style="text-align: left;"><p> <?php echo Kohana::lang('shop_app.customer.client_invoice_data'); ?></p></td>
  </tr>
  <tr>
  <td>
  <label for="invoice_first_name"><?php echo Kohana::lang('shop_app.customer.first_name'); ?>:</label>

  <input type="text" name="invoice_first_name" id="invoice_first_name" value="<?php
  if (!empty($_POST)) {
  echo $_POST['invoice_first_name'];
  } else {
  echo $oCustomerDetails->invoice_first_name;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="invoice_last_name"><?php echo Kohana::lang('shop_app.customer.last_name'); ?>:</label>

  <input type="text" name="invoice_last_name" id="invoice_last_name" value="<?php
  if (!empty($_POST)) {
  echo $_POST['invoice_last_name'];
  } else {
  echo $oCustomerDetails->invoice_last_name;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="invoice_email"><?php echo Kohana::lang('shop_app.customer.email'); ?>:</label>

  <input type="text" name="invoice_email" id="invoice_email" value="<?php
  if (!empty($_POST)) {
  echo $_POST['invoice_email'];
  } else {
  echo $oCustomerDetails->invoice_email;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="invoice_company_name"><?php echo Kohana::lang('shop_app.customer.company_name'); ?>:</label>

  <input type="text" name="invoice_company_name" id="invoice_company_name" value="<?php
  if (!empty($_POST)) {
  echo $_POST['invoice_company_name'];
  } else {
  echo $oCustomerDetails->invoice_company_name;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="invoice_nip"><?php echo Kohana::lang('shop_app.customer.nip'); ?>:</label>

  <input type="text" name="invoice_nip" id="invoice_nip" value="<?php
  if (!empty($_POST)) {
  echo $_POST['invoice_nip'];
  } else {
  echo $oCustomerDetails->invoice_nip;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="invoice_city"><?php echo Kohana::lang('shop_app.customer.city'); ?>:</label>

  <input type="text" name="invoice_city" id="invoice_city" value="<?php
  if (!empty($_POST)) {
  echo $_POST['invoice_city'];
  } else {
  echo $oCustomerDetails->invoice_city;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="invoice_zip"><?php echo Kohana::lang('shop_app.customer.zip'); ?>:</label>

  <input type="text" name="invoice_zip" id="invoice_zip" value="<?php
  if (!empty($_POST)) {
  echo $_POST['invoice_zip'];
  } else {
  echo $oCustomerDetails->invoice_zip;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="invoice_address"><?php echo Kohana::lang('shop_app.customer.address'); ?>:</label>

  <input type="text" name="invoice_address" id="invoice_address" value="<?php
  if (!empty($_POST)) {
  echo $_POST['invoice_address'];
  } else {
  echo $oCustomerDetails->invoice_address;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="invoice_state"><?php echo Kohana::lang('shop_app.customer.state'); ?>:</label>


  <?php $aStates = layer::GetStates()->Value; ?>
  <select name="invoice_state" id="invoice_state" class="input-text">
  <?php foreach ($aStates as $stateKey => $stateValue): ?>
  <?php if (!empty($_POST['invoice_state']) && $_POST['invoice_state'] == $stateKey): ?>
  <option value="<?php echo $stateKey; ?>" selected="selected"><?php echo $stateValue; ?></option>
  <?php elseif (!empty($_SESSION['__customer']['invoice_state']) && $_SESSION['__customer']['invoice_state'] == $stateKey): ?>
  <option value="<?php echo $stateKey; ?>" selected="selected"><?php echo $stateValue; ?></option>
  <?php elseif (!empty($oCustomerDetails->invoice_state) && $oCustomerDetails->invoice_state == $stateKey): ?>
  <option value="<?php echo $stateKey; ?>" selected="selected"><?php echo $stateValue; ?></option>
  <?php else: ?>
  <option value="<?php echo $stateKey; ?>"><?php echo $stateValue; ?></option>
  <?php endif; ?>
  <?php endforeach; ?>
  </select>
  </td>
  </tr>
  <tr>
  <td>
  <label for="invoice_country"><?php echo Kohana::lang('shop_app.customer.country'); ?>:</label>

  <input type="text" name="invoice_country" id="invoice_country" value="<?php
  if (!empty($_POST)) {
  echo $_POST['invoice_country'];
  } else {
  echo $oCustomerDetails->invoice_country;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="invoice_phoneno"><?php echo Kohana::lang('shop_app.customer.phone_no'); ?>:</label>

  <input type="text" name="invoice_phoneno" id="invoice_phoneno" value="<?php
  if (!empty($_POST)) {
  echo $_POST['invoice_phoneno'];
  } else {
  echo $oCustomerDetails->invoice_phoneno;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="invoice_faxno"><?php echo Kohana::lang('shop_app.customer.fax_no'); ?>:</label>

  <input type="text" name="invoice_faxno" id="invoice_faxno" value="<?php
  if (!empty($_POST)) {
  echo $_POST['invoice_faxno'];
  } else {
  echo $oCustomerDetails->invoice_faxno;
  }
  ?>" /></td>

  </tr>
  <tr>
  <td>
  <label for="invoice_mobileno"><?php echo Kohana::lang('shop_app.customer.mobile_no'); ?>:</label>

  <input type="text" name="invoice_mobileno" id="invoice_mobileno" value="<?php
  if (!empty($_POST)) {
  echo $_POST['invoice_mobileno'];
  } else {
  echo $oCustomerDetails->invoice_mobileno;
  }
  ?>" /></td>

  </tr>

  </table>

  <div class="account_save_changes_button"><input type="submit" name="submit" value="<?php echo Kohana::lang('shop_app.customer.save_changes'); ?>" class="submit large button_arrow" /></div>

  </div>
  <?php echo form::close(); ?>
  </div>
  </div> */ ?>