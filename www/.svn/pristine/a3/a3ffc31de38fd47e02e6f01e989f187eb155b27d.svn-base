<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'edit',
            'sTitle' => Kohana::lang('customer.edit_customer')
        ))->render(TRUE);
?>
<div id="admin_customer_edit">
    <?php echo form::open_multipart(null, array('id' => 'admin_customer_edit_form', 'method' => 'post')); ?>
    <div id="admin_customer_edit_table">
        <ul style="overflow: hidden;">
            <li><a href="#tabs-1"><?php echo Kohana::lang('customer.client_data'); ?></a></li>
            <li><a href="#tabs-2"><?php echo Kohana::lang('customer.delivery_address'); ?></a></li>
            <li><a href="#tabs-3"><?php echo Kohana::lang('customer.invoice_address'); ?></a></li>
        </ul>
        <div id="tabs-1" class="ui-tabs-hide">
            <fieldset>
                <legend><?php echo Kohana::lang('customer.client_data'); ?></legend>
                <table class="table_form">
                    <tr>
                        <td class="td_form_left">
                            <label><?php echo Kohana::lang('customer.gender'); ?>:</label>
                        </td>
                        <td>
                            <label for="male"><?php echo Kohana::lang('customer.male'); ?>:</label>
                            <?php echo form::radio(array('name' => 'gender', 'id' => 'male'), 'M', (!empty($oCustomerDetails->gender) && ($oCustomerDetails->gender == 'M') ? TRUE : '')); ?>
                            <label for="female"><?php echo Kohana::lang('customer.female'); ?>:</label>
                            <?php echo form::radio(array('name' => 'gender', 'id' => 'female'), 'F', (!empty($oCustomerDetails->gender) && ($oCustomerDetails->gender == 'F') ? TRUE : '')); ?>
                        <td><div id="gender_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_first_name"><?php echo Kohana::lang('customer.first_name'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_first_name" id="customer_first_name" value="<?php echo $oCustomerDetails->customer_first_name; ?>" /></td>
                        <td><div id="customer_first_name_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_last_name"><?php echo Kohana::lang('customer.last_name'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_last_name" id="customer_last_name" value="<?php echo $oCustomerDetails->customer_last_name; ?>" /></td>
                        <td><div id="customer_last_name_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_email"><?php echo Kohana::lang('customer.email'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_email" id="customer_email" value="<?php echo $oCustomerDetails->customer_email; ?>" /></td>
                        <td><div id="customer_email_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_rebate"><?php echo Kohana::lang('customer.rebate'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_rebate" id="customer_rebate" value="<?php echo $oCustomerDetails->customer_rebate; ?>" /> [%]</td>
                        <td><div id="customer_rebate_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_company_name"><?php echo Kohana::lang('customer.company_name'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_company_name" id="customer_company_name" value="<?php echo $oCustomerDetails->customer_company_name; ?>" /></td>
                        <td><div id="customer_company_name_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_nip"><?php echo Kohana::lang('customer.nip'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_nip" id="customer_nip" value="<?php echo $oCustomerDetails->customer_nip; ?>" /></td>
                        <td><div id="customer_nip_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_city"><?php echo Kohana::lang('customer.city'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_city" id="customer_city" value="<?php echo $oCustomerDetails->customer_city; ?>" /></td>
                        <td><div id="customer_city_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_zip"><?php echo Kohana::lang('customer.zip'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_zip" id="customer_zip" value="<?php echo $oCustomerDetails->customer_zip; ?>" /></td>
                        <td><div id="customer_zip_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_address"><?php echo Kohana::lang('customer.address'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_address" id="customer_address" value="<?php echo $oCustomerDetails->customer_address; ?>" /></td>
                        <td><div id="customer_address_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_state"><?php echo Kohana::lang('customer.state'); ?>:</label>
                        </td>
                        <td>
							<?php $aStates = layer::GetStates()->Value; ?>
                            <?php echo form::dropdown('customer_state', $aStates, $oCustomerDetails->customer_state); ?>
						</td>
                        <td><div id="customer_state_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_country"><?php echo Kohana::lang('customer.country'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_country" id="customer_country" value="<?php echo $oCustomerDetails->customer_country; ?>" /></td>
                        <td><div id="customer_country_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_www"><?php echo Kohana::lang('customer.www'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_www" id="customer_www" value="<?php echo $oCustomerDetails->customer_www; ?>" /></td>
                        <td><div id="customer_www_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_phoneno"><?php echo Kohana::lang('customer.phone_no'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_phoneno" id="customer_phoneno" value="<?php echo $oCustomerDetails->customer_phoneno; ?>" /></td>
                        <td><div id="customer_phoneno_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_faxno"><?php echo Kohana::lang('customer.fax_no'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_faxno" id="customer_faxno" value="<?php echo $oCustomerDetails->customer_faxno; ?>" /></td>
                        <td><div id="customer_faxno_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="customer_mobileno"><?php echo Kohana::lang('customer.mobile_no'); ?>:</label>
                        </td>
                        <td><input type="text" name="customer_mobileno" id="customer_mobileno" value="<?php echo $oCustomerDetails->customer_mobileno; ?>" /></td>
                        <td><div id="customer_mobileno_error" class="error_message"></div></td>
                    </tr>
                </table>
            </fieldset>
        </div>
        <div id="tabs-2" class="ui-tabs-hide">
            <fieldset>
                <legend><?php echo Kohana::lang('customer.delivery_address'); ?></legend>
                <table class="table_form">
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_first_name"><?php echo Kohana::lang('customer.first_name'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_first_name" id="delivery_first_name" value="<?php echo $oCustomerDetails->delivery_first_name; ?>" /></td>
                        <td><div id="delivery_first_name_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_last_name"><?php echo Kohana::lang('customer.last_name'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_last_name" id="delivery_last_name" value="<?php echo $oCustomerDetails->delivery_last_name; ?>" /></td>
                        <td><div id="delivery_last_name_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_email"><?php echo Kohana::lang('customer.email'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_email" id="delivery_email" value="<?php echo $oCustomerDetails->delivery_email; ?>" /></td>
                        <td><div id="delivery_email_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_company_name"><?php echo Kohana::lang('customer.company_name'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_company_name" id="delivery_company_name" value="<?php echo $oCustomerDetails->delivery_company_name; ?>" /></td>
                        <td><div id="delivery_company_name_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_nip"><?php echo Kohana::lang('customer.nip'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_nip" id="delivery_nip" value="<?php echo $oCustomerDetails->delivery_nip; ?>" /></td>
                        <td><div id="delivery_nip_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_city"><?php echo Kohana::lang('customer.city'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_city" id="delivery_city" value="<?php echo $oCustomerDetails->delivery_city; ?>" /></td>
                        <td><div id="delivery_city_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_zip"><?php echo Kohana::lang('customer.zip'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_zip" id="delivery_zip" value="<?php echo $oCustomerDetails->delivery_zip; ?>" /></td>
                        <td><div id="delivery_zip_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_address"><?php echo Kohana::lang('customer.address'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_address" id="delivery_address" value="<?php echo $oCustomerDetails->delivery_address; ?>" /></td>
                        <td><div id="delivery_address_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_state"><?php echo Kohana::lang('customer.state'); ?>:</label>
                        </td>
                        <td>
							<?php $aStates = layer::GetStates()->Value; ?>
                            <?php echo form::dropdown('delivery_state', $aStates, $oCustomerDetails->delivery_state); ?>
						</td>
                        <td><div id="delivery_state_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_country"><?php echo Kohana::lang('customer.country'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_country" id="delivery_country" value="<?php echo $oCustomerDetails->delivery_country; ?>" /></td>
                        <td><div id="delivery_country_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_www"><?php echo Kohana::lang('customer.www'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_www" id="delivery_www" value="<?php echo $oCustomerDetails->delivery_www; ?>" /></td>
                        <td><div id="delivery_www_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_phoneno"><?php echo Kohana::lang('customer.phone_no'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_phoneno" id="delivery_phoneno" value="<?php echo $oCustomerDetails->delivery_phoneno; ?>" /></td>
                        <td><div id="delivery_phoneno_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_faxno"><?php echo Kohana::lang('customer.fax_no'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_faxno" id="delivery_faxno" value="<?php echo $oCustomerDetails->delivery_faxno; ?>" /></td>
                        <td><div id="delivery_faxno_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="delivery_mobileno"><?php echo Kohana::lang('customer.mobile_no'); ?>:</label>
                        </td>
                        <td><input type="text" name="delivery_mobileno" id="delivery_mobileno" value="<?php echo $oCustomerDetails->delivery_mobileno; ?>" /></td>
                        <td><div id="delivery_mobileno_error" class="error_message"></div></td>
                    </tr>
                </table>
            </fieldset>
        </div>
        <div id="tabs-3" class="ui-tabs-hide">
            <fieldset>
                <legend><?php echo Kohana::lang('customer.invoice_address'); ?></legend>
                <table class="table_form">
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_first_name"><?php echo Kohana::lang('customer.first_name'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_first_name" id="invoice_first_name" value="<?php echo $oCustomerDetails->invoice_first_name; ?>" /></td>
                        <td><div id="invoice_first_name_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_last_name"><?php echo Kohana::lang('customer.last_name'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_last_name" id="invoice_last_name" value="<?php echo $oCustomerDetails->invoice_last_name; ?>" /></td>
                        <td><div id="invoice_last_name_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_email"><?php echo Kohana::lang('customer.email'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_email" id="invoice_email" value="<?php echo $oCustomerDetails->invoice_email; ?>" /></td>
                        <td><div id="invoice_email_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_company_name"><?php echo Kohana::lang('customer.company_name'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_company_name" id="invoice_company_name" value="<?php echo $oCustomerDetails->invoice_company_name; ?>" /></td>
                        <td><div id="invoice_company_name_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_nip"><?php echo Kohana::lang('customer.nip'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_nip" id="invoice_nip" value="<?php echo $oCustomerDetails->invoice_nip; ?>" /></td>
                        <td><div id="invoice_nip_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_city"><?php echo Kohana::lang('customer.city'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_city" id="invoice_city" value="<?php echo $oCustomerDetails->invoice_city; ?>" /></td>
                        <td><div id="invoice_city_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_zip"><?php echo Kohana::lang('customer.zip'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_zip" id="invoice_zip" value="<?php echo $oCustomerDetails->invoice_zip; ?>" /></td>
                        <td><div id="invoice_zip_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_address"><?php echo Kohana::lang('customer.address'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_address" id="invoice_address" value="<?php echo $oCustomerDetails->invoice_address; ?>" /></td>
                        <td><div id="invoice_address_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_state"><?php echo Kohana::lang('customer.state'); ?>:</label>
                        </td>
                        <td>
							<?php $aStates = layer::GetStates()->Value; ?>
                            <?php echo form::dropdown('invoice_state', $aStates, $oCustomerDetails->invoice_state); ?>
						</td>
                        <td><div id="invoice_state_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_country"><?php echo Kohana::lang('customer.country'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_country" id="invoice_country" value="<?php echo $oCustomerDetails->invoice_country; ?>" /></td>
                        <td><div id="invoice_country_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_www"><?php echo Kohana::lang('customer.www'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_www" id="invoice_www" value="<?php echo $oCustomerDetails->invoice_www; ?>" /></td>
                        <td><div id="invoice_www_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_phoneno"><?php echo Kohana::lang('customer.phone_no'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_phoneno" id="invoice_phoneno" value="<?php echo $oCustomerDetails->invoice_phoneno; ?>" /></td>
                        <td><div id="invoice_phoneno_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_faxno"><?php echo Kohana::lang('customer.fax_no'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_faxno" id="invoice_faxno" value="<?php echo $oCustomerDetails->invoice_faxno; ?>" /></td>
                        <td><div id="invoice_faxno_error" class="error_message"></div></td>
                    </tr>
                    <tr>
                        <td class="td_form_left">
                            <label for="invoice_mobileno"><?php echo Kohana::lang('customer.mobile_no'); ?>:</label>
                        </td>
                        <td><input type="text" name="invoice_mobileno" id="invoice_mobileno" value="<?php echo $oCustomerDetails->invoice_mobileno; ?>" /></td>
                        <td><div id="invoice_mobileno_error" class="error_message"></div></td>
                    </tr>

                </table>
            </fieldset>
        </div>
        <table class="table_form">
            <tr>
                <td><input type="button" value="<?php echo Kohana::lang('customer.back'); ?>" name="back" class="btn btn-back" /></td>
                <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.save'); ?>" class="btn btn-save" /></td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div>

    <?php echo form::close(); ?>
</div>