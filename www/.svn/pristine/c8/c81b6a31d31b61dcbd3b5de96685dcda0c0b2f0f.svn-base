<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl" class="<?php echo $lang; ?>">
    <head<?php if (!empty($ogtags)) echo ' prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# product: http://ogp.me/ns/product#"'; ?>>
        <title><?php
            if (!empty($oMeta[0]->meta_title)) {
                echo $oMeta[0]->meta_title . ' - ' . Kohana::lang('meta.home_site_title');
            } else if (!empty($oMeta[0]->name_page)) {
                echo $oMeta[0]->name_page . ' - ' . Kohana::lang('meta.home_site_title');
            } else if (!empty($title)) {
                echo $title . ' - ' . Kohana::lang('meta.home_site_title');
            } else {
                echo Kohana::lang('meta.home_site_title');
            }
            ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="<?php
        if (!empty($oMeta[0]->meta_description)) {
            echo $oMeta[0]->meta_description;
        } else if (!empty($description)) {
            echo $description;
        } else {
            echo Kohana::lang('meta.home_site_description');
        }
        ?>"/>
        <meta name="keywords" content="<?php
        if (!empty($oMeta[0]->meta_keywords)) {
            echo $oMeta[0]->meta_keywords;
        } else if (!empty($keywords)) {
            echo $keywords;
        } else {
            echo Kohana::lang('meta.home_site_keywords');
        }
        ?>"/>
              <?php if (file_exists('favicon.ico')) : ?>
            <link rel="shortcut icon" href="<?php echo url::base() . 'favicon.ico' ?>" type="image/x-icon" />
        <?php endif; ?>
        <link href='https://fonts.googleapis.com/css?family=Exo+2:400,300,700,500,600&subset=latin,latin-ext' rel='stylesheet' type='text/css'>   
            <?php echo html::stylesheet('js/ref/bxslider/jquery.bxslider.css'); ?>
            <?php echo html::stylesheet('css/default/print.css', 'print'); ?>
            <?php echo html::stylesheet('js/app/prettyPhoto3.1.6/css/prettyPhoto.css'); ?>

            <?php echo html::stylesheet('js/fm.checkator.jquery.css') ?>

            <?php echo html::stylesheet('js/jquery-ui-1.11.4.dialog/jquery-ui.css') ?>  
            <?php echo html::stylesheet('js/jquery-ui-1.11.4.datepicker/jquery-ui.css') ?>  
            <?php echo html::stylesheet('js/jquery-ui-1.11.4.datepicker/jquery-ui.theme.min.css') ?> 
            <?php echo html::stylesheet('css/bootstrap/bootstrap.min.css?' . filemtime('css/bootstrap/bootstrap.min.css')); ?>


            <?php echo html::stylesheet('css/default/comm.css?' . filemtime('css/default/comm.css')); ?>
            <?php echo html::stylesheet('css/default/default_responsive.css?' . filemtime('css/default/default_responsive.css')); ?>

            <!--[if lt IE 9]>
        <style type="text/css">
        #header .search {width:213px}
        </style>
            
        <![endif]-->

            <?php echo html::script('js/respond.js'); ?>
            <?php echo html::script('js/html5shiv.js'); ?>
            <script type="text/javascript" src="http://www.google.com/jsapi"></script>
            <?php echo html::script('js/jquery-1.11.3.min.js') ?>
            <?php echo html::script('js/jquery.touchwipe.min.js') ?>
            <?php echo html::script('js/app/prettyPhoto3.1.6/js/jquery.prettyPhoto.js'); ?>
            <?php echo html::script('js/ref/bxslider/jquery.bxslider.js'); ?>
            <?php echo html::script('js/fm.checkator.jquery.js') ?>

            <?php echo html::script('js/jquery-ui-1.11.4.dialog/jquery-ui.js') ?>
            <?php // echo html::script('js/jquery-ui-1.11.4.datepicker/jquery-ui.js') ?>
            <?php echo html::script('js/inputmask/inputmask.js'); ?>
            <?php echo html::script('js/inputmask/jquery.inputmask.js'); ?>
            <script type="text/javascript">
                var urlBase = '<?php echo url::base(); ?>';
                var lang = '<?php echo $lang; ?>';

            </script>
            <?php echo html::script('js/app/app.js?' . filemtime('js/app/app.js')); ?>
            <?php // echo html::script('js/app/shop.js?' . filemtime('js/app/shop.js')); ?>
            <?php  echo html::script('js/app/responsive.js?' . filemtime('js/app/responsive.js')); ?>
            <?php echo html::script('js/app/comm.js?' . filemtime('js/app/comm.js')); ?>
            <?php if (!empty($ogtags)) echo $ogtags; ?>
    </head>
    <body<?php if (!empty($body_class)) echo $body_class; ?>>
        <?php $sLink = config::getConfig('facebook_page_link'); ?>
        <?php if (!empty($sLink)): ?>
            <div id="fb-root"></div>
            <script>(function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.5&appId=200626763330116";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
        <?php endif; ?>
        <?php echo layer::GoogleAnalytics(); // wyswietla kod google analytics  ?>
        <?php if (!empty($header)) : ?>
            <div id="header" class="container"><?php echo $header; ?>
                <div id="burger"></div>
            </div>
        <?php endif; ?>
        <div id="container" class="container">
            <div id="content_wrapper">
                <?php echo $content; ?>
            </div>
        </div>
        <?php if (!empty($footer)) : ?>
            <div id="footer" class="container"><?php echo $footer; ?></div>
        <?php endif; ?>
        <?php if (!empty($vSocial)) echo $vSocial; // karta z boku strony z facbookiem itp.  ?>
        <?php if (empty($_COOKIE['cookiechecked'])): ?>
            <div id="cookie-policy-banner" style="display: block;">
                <div class="inner">
                    <span>Strona korzysta z plików cookies w celu realizacji usług i zgodnie z 
                        <a href="/polityka-plikow-cookies">Polityka Plików Cookies</a> Możesz określić warunki przechowywania lub dostępu do plików cookies w Twojej przeglądarce. <span id="cclose">Zamknij</span>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    </body>
</html>