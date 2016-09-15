<div id="footer-boxes" class="row">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <h4><?php echo config::getConfig('page_domain'); ?></h4>
                <div class="row">
                    <ul class="col-md-6 raquolist">
                        <li><?php echo html::anchor('regulamin', Kohana::lang('shop_app.regulations')); ?></li>
                        <li><?php echo html::anchor('faq', Kohana::lang('shop_app.faq')); ?></li>
                        <li><?php echo html::anchor('pomoc', Kohana::lang('shop_app.help')); ?></li>
                        <li><?php echo html::anchor('ofirmie', Kohana::lang('shop_app.aboutus')); ?></li>
                        <li><?php echo html::anchor('kontakt', Kohana::lang('shop_app.contact')); ?></li>
                    </ul>
                    <ul class="col-md-6 raquolist">
                        <li><?php echo html::anchor('jakkupowac', Kohana::lang('shop_app.howtobuy')); ?></li>
                        <li><?php echo html::anchor('formyplatnosci', Kohana::lang('shop_app.payment-forms')); ?></li>
                        <li><?php echo html::anchor('kosztydostawy', Kohana::lang('shop_app.delivery-cost')); ?></li>
                        <li><?php echo html::anchor('bezpieczeństwo', Kohana::lang('shop_app.security')); ?></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <h4><?php echo Kohana::lang('shop_app.account.my_account'); ?></h4>
                <?php if (empty($_SESSION['_customer']['logged_in'])): ?>

                    <ul class="raquolist">
                        <li><?php echo html::anchor(Kohana::lang('links.lang') . 'rejestracja', Kohana::lang('shop_app.account.registration')); ?></li>
                        <li><?php echo html::anchor(Kohana::lang('links.lang') . 'logowanie', Kohana::lang('shop_app.account.login')); ?></li>            
                        <li><?php echo html::anchor(Kohana::lang('links.lang') . 'twoje_konto', Kohana::lang('shop_app.account.my_account')); ?></li> 
                        <li><?php echo html::anchor(Kohana::lang('links.lang') . 'polityka_prywatnosci', 'Polityka prywatności'); ?></li> 
                    </ul>
                <?php else: ?>
                    <ul class="raquolist">
                        <li><?php echo html::anchor(Kohana::lang('links.lang') . 'wyloguj', Kohana::lang('shop_app.account.logout')); ?></li>            
                        <li><?php echo html::anchor(Kohana::lang('links.lang') . 'twoje_konto', Kohana::lang('shop_app.account.your_account')) ?></li>
                        <li><?php echo html::anchor(Kohana::lang('links.lang') . 'edycja_danych', Kohana::lang('shop_app.account.change_details')); ?></li>                        
                        <li><?php echo html::anchor(Kohana::lang('links.lang') . 'historia_transakcji', Kohana::lang('shop_app.account.orders_history')); ?></li>                        
                        <li><?php echo html::anchor(Kohana::lang('links.lang') . 'zmien_haslo', Kohana::lang('shop_app.account.change_password')); ?></li>                        
                        <li><?php echo html::anchor(Kohana::lang('links.lang') . 'usun_konto', Kohana::lang('shop_app.account.delete_account')); ?></li>                        
                        <li><?php echo html::anchor(Kohana::lang('links.lang') . 'polityka_prywatnosci', 'Polityka prywatności'); ?></li> 
                    </ul>
                <?php endif; ?>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-2 col-sm-6">
                <h4><?php echo Kohana::lang('shop_app.contact'); ?></h4>
                <p>
                    <?php echo Kohana::lang('shop_app.contact-footer-text'); ?>
                </p>
                <ul class="raquolist">
                    <li><?php echo Kohana::lang('shop_app.contact-footer-tel'); ?> 122 32 22 54</li>
                    <li><?php echo Kohana::lang('shop_app.contact-footer-email'); ?> <a href="mailto:olicom@olicom.pl">olicom@olicom.pl</a></li>
                </ul>
                
                <div class="clearfix"></div>
                <div class="social">
                    <p><?php echo Kohana::lang('app.jointous'); ?></p>
                    <p>
                        <?php echo html::anchor('https://www.facebook.com/olicom', html::image('img/fb.png', array('alt' => 'Facebook'))); ?>
                        <?php echo html::anchor('', html::image('img/tweet.png', array('alt' => 'Tweeter'))); ?>
                    </p>
                </div> 
            </div>
            <div class="col-md-4 col-sm-6 newsletter-box">
                <div class="newsletter">
                    <h1>NEWSLETTER</h1>
                    <h2><?php echo Kohana::lang('newsletter.subscribe-text'); ?></h2>
                    <form method="post" action="">
                        <input type="text" name="newsletter_email" value="" />
                        <button type="submit" name="newsletter-submit" class="btn"><?php echo Kohana::lang('newsletter.subscribe'); ?> </button>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div class="footer-bottom row">
    <div class="container">
        <div class="row">
            <div id="copyright" class="col-sm-6">
                <?php echo Kohana::lang('app.copy_rights') ?>.
            </div>
            <div id="realization" class="col-sm-6">
                <?php if (!empty($bHome) && $bHome === TRUE) : ?>
                    <?php echo Kohana::lang('app.realization') ?>
                <?php else: ?>
                    <?php echo Kohana::lang('app.realization_subpages') ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>