<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('admin.partners.add_news')
            ))->render(TRUE);
?>
<div id="admin_news_view">
    <?php echo form::open_multipart(null, array('id'=>'form_add_partner')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.partners.add_photo'); ?>
                <span class="label_comment">Dla najlepszego efektu należy wgrać obazek w rozmiarze: <?php echo partners_helper::XSMALL_WIDTH;?>px szerokości na <?php echo partners_helper::XSMALL_HEIGHT;?>px wysokości</span>
            </td>
            <td><input type="file" name="photo" id="add_partner_photo" /></td>
            <td><div id="photo_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.partners.name'); ?></td>
            <?php /*<td><textarea name="name" cols="40" rows="5" id="add_partner_name"><?php if(!empty($_POST)) { echo $_POST['title']; } ?></textarea></td>*/ ?>
            <td><input type="text" name="name" id="add_partner_name" value="<?php if(!empty($_POST)) { echo $_POST['name']; } ?>" /></td>
            <td><div id="name_error" class="error_message"></div></td>
        </tr>        
        <?php /*<tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.partners.partner_address'); ?></td>
            <td><textarea name="address" cols="40" rows="5" id="add_partner_address"><?php if(!empty($_POST)) { echo $_POST['address']; } ?></textarea></td>
            <td><div id="address_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.partners.partner_description'); ?></td>
            <td><textarea name="description" cols="40" rows="5" id="add_news_description"><?php if(!empty($_POST)) { echo $_POST['description']; } ?></textarea></td>
            <td><div  id="description_error" class="error_message"></div></td>
        </tr>*/ ?>
		<tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.partners.partner_web_address'); ?>
				<span class="label_comment"><?php echo Kohana::lang('admin.partners.partner_web_address_comment') ?></span>
			</td>
            <?php /*<td><textarea name="web_address" cols="40" rows="5" id="add_partner_web_address"><?php if(!empty($_POST)) { echo $_POST['web_address']; } else if (!empty($oPartner->web_address)){echo $oPartner->web_address;} ?></textarea></td>*/ ?>
               <td><input type="text" name="web_address" id="add_partner_name" value="<?php if(!empty($_POST)) { echo $_POST['web_address']; } else if (!empty($oPartner->web_address)){echo $oPartner->web_address;} ?>" /></td>         
            <td><div id="web_address_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.partners.available'); ?></td>
            <td>
                <select name="available">
                    <option value="1" <?php if(isset($_POST['available']) && $_POST['available']==1) { echo 'selected="selected"'; } ?>><?php echo Kohana::lang('admin.partners.available_true'); ?></option>
                    <option value="0" <?php if(isset($_POST['available']) && $_POST['available']==0) { echo 'selected="selected"'; } ?>><?php echo Kohana::lang('admin.partners.available_false'); ?></option>
                </select>
            </td>
            <td><div id="available_error" class="error_message"></div></td>
        </tr>        
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('admin.back'); ?>" name="back" class="btn btn-back" /></td>
            <td>
                <input type="submit" value="<?php echo Kohana::lang('admin.add'); ?>" name="add_partner" class="btn btn-save" />
            </td>
            <td></td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>