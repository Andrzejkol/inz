<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
            #container {background: #FFF;}
            a, a:visited {color: #1155CC; text-decoration: none;}
            a:hover {color: #1155CC; text-decoration: underline;}
        </style>
    </head>
    <body>
        <div id="container" style="padding:10px; margin:10px; font-family: Arial, sans-serif; font-size: 14px; color: #3d3d3d;">
            <div style="background-color:#210720; padding-top:20px;">
                <div style="padding:15px 0px; background-color:#360e31; text-align: center;">
                    <h1 style="margin:0px auto;text-align:center;padding: 0px;width:150px;">
                        <a href="<?php echo Kohana::config('config.http_host') . url::base(true); ?>">
                            <?php echo html::image(url::base(TRUE, 'http') . config::getConfig('logo'), array('alt' => config::getConfig('page_name'), 'style' => 'border:none;')); ?>
                        </a>
                    </h1>
                </div>
            </div>
            <div style="margin:10px 0px 20px 10px;clear: both;padding-top:20px">
                <?php
                if (!empty($vEmailContent)) :
                    echo $vEmailContent;
                else :
                    ?>
                    <h1>Wystąpił błąd!</h1>
                    Witaj!<br/><br/>
                    Wystąpił błąd na serwerze podczas wysyłania wiadomości! Prosimy o kontakt w celu rozwiązania problemu i dokończenia
                    procesu wykonywanego w serwisie <a href="http://<?php echo $_SERVER['HTTP_HOST'] . url::base(); ?>"><?php echo config::getConfig('page_domain'); ?></a><br/><br/>
                <?php endif; ?>
                <div style="clear: both!important; height: 0!important; line-height: 0!important; padding: 0!important; margin: 0!important; float: none!important;"></div>
            </div>
            <div style="color: #fff; background-color:#360e31; clear: both; font-size: 11px;width: 100%;text-align: left;padding-top:20px; display:inline-block">
                <h1 style="margin:0px;padding: 0px; padding-left:15px; float:left;">
                    <a href="<?php echo Kohana::config('config.http_host') . url::base(true); ?>">
                        <?php echo html::image(url::base(TRUE, 'http') . config::getConfig('logo'), array('alt' => config::getConfig('page_name'), 'style' => 'border:none;height:40px')); ?>
                    </a>
                </h1>
                <div style="float:left; padding-left:30px;"><?php echo config::getConfig('firm_address'); ?></div>
            </div>
        </div>
    </body>
</html>