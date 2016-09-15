<div class="content">
    <div id="order_form">
        <?php
        if(!empty($msg)) {
            echo $msg;
        }
        ?>
        <table border="0">
            <?php echo form::open(); ?>
            <?php if($oProductDetails->count() > 0) { ?>
            <tr>
                <td>Formularz zamówienia dotyczący:</td>
                <td>
                    <?php echo $oProductDetails[0]->product_name; ?>
                    <input type="hidden" name="product_info" id="product_info" value="<?php echo $oProductDetails[0]->product_name; ?>" />
                </td>
                <td>&ensp;</td>
            </tr>
            <?php } ?> 
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
            <tr>
                <td><?php echo Kohana::lang('app.quantity'); ?>:</td>
                <td><input type="text" name="quantity" value="<?php echo !empty($_POST['quantity']) ? $_POST['quantity'] : '' ?>" /></td>
                <td>&ensp;</td>
            </tr>
            <tr>
                <td><?php echo Kohana::lang('app.message'); ?></td>
                <td><textarea name="message" cols="30" rows="5" ><?php echo !empty($_POST['message']) ? $_POST['message'] : '' ?></textarea></td>
                <td>&ensp;</td>
            </tr>
            <?php /*
            <tr>
                <td><?php echo Kohana::lang('app.captcha'); ?>:</td>
                <td>
                    <input type="text" name="captcha_code" maxlength="6" style="width: 80px; float: left; margin-right: 20px;" />
                    <?php echo $captcha->render(TRUE); ?>
                    </td>
                <td>&ensp;</td>
            </tr>
             *
             */?>
            <tr>
                <td>&ensp;</td>
                <td>
                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $productId; ?>" />
                    <input type="submit" class="submit small" value="Wyślij" />
                </td>
            </tr>
<?php echo form::close(); ?>
        </table>

    </div>


</div>