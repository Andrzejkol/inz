<div class="content">
    <div id="ask_question">
        <?php
        if(!empty($msg)) {
            echo $msg;
        }
        ?>
        <?php echo form::open_multipart(); ?>
        <table border="0">            
            <tr>
                <td><?php echo Kohana::lang('app.name'); ?>:</td>
                <td><input type="text" name="name" value="<?php echo !empty($_POST['name']) ? $_POST['name'] : '' ?>" /></td>
                <td>&ensp;</td>
            </tr>
            <tr>
                <td><?php echo Kohana::lang('app.phone'); ?>:</td>
                <td><input type="text" name="phone" value="<?php echo !empty($_POST['phone']) ? $_POST['phone'] : '' ?>"/></td>
                <td>&ensp;</td>
            </tr>
            <tr>
                <td><?php echo Kohana::lang('app.email'); ?>:</td>
                <td><input type="text" name="email" value="<?php echo !empty($_POST['email']) ? $_POST['email'] : '' ?>" /></td>
                <td>&ensp;</td>
            </tr>
            <?php if($oProductDetails->count() > 0) { ?>
            <tr>
                <td>Zapytanie dotyczące:</td>
                <td>
                    <select name="product_info" style="width: 250px;">
                        <option><?php echo $oProductDetails[0]->product_name; ?></option>
                        <option>Innego produktu</option>
                    </select>
                </td>
                <td>&ensp;</td>
            </tr>
            <?php } ?>  
            <tr>
                <td><?php echo Kohana::lang('app.message'); ?></td>
                <td><textarea name="message" cols="30" rows="5" ><?php echo !empty($_POST['message']) ? $_POST['message'] : '' ?></textarea></td>
                <td>&ensp;</td>
            </tr>
            <tr>
                <td><?php echo Kohana::lang('app.captcha'); ?>:</td>
                <td>
                    <input type="text" name="captcha_code" maxlength="6" style="width: 80px; float: left; margin-right: 20px;" />
                    <?php echo $captcha->render(TRUE); ?>
                    </td>
                <td>&ensp;</td>
            </tr>
            <tr>
                <td>&ensp;</td>
                <td>
                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $productId; ?>" />
                    <input type="submit" class="submit small" value="Wyślij" />
                </td>
            </tr>
        </table>
        <?php echo form::close(); ?>
    </div>
</div>