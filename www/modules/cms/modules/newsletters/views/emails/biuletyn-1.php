<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <title></title>
    </head>
    <body>
        <?php
        if (isset($msg)) {
            echo $msg . '<br/><br/>';
        }
        ?>
        <center>
            <table width="600" cellpadding="0" cellspacing="0" border="1" >
                <tr>
                    <td colspan="2" width="600">
                        <span style="font-size:24px;">
                            <?php echo $title; ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td width="300" valign="top">
                        <?php foreach ($oImages as $image): ?>
                            <img src="<?php echo url::base(true, 'http') . newsletter::IMAGE_NEWSLETTER_PATH . $image->filename; ?>" alt="" style="display: block;  "/><br/>
                        <?php endforeach; ?>
                    </td>
                    <td width="300" valign="top">
                        <?php echo $content; ?>
                    </td>
                </tr>
            </table>

            <div style="font-family: Arial; font-size: 11px; color: #888;">
                Otrzymałeś/aś ten list, ponieważ Twój adres e-mail został wpisany na naszą listę.<br/>
                Jeśli nie chcesz otrzymywać od nas wiadomości kliknij w ten link: <br/>
                <?php
                if (isset($verifyString) && isset($email)) {
                    echo html::anchor(url::base(true, 'http') . 'index/confirm_unsubscribe/?email=' . $email . '&verify_string=' . $verifyString);
                }
                ?>
            </div>
        </center>

    </body>
</html>

