<?php $sLink = config::getConfig('facebook_page_link'); ?>
<?php if (!empty($sLink)): ?>
    <div id="social">
        <div class="facebook" style="right: -292px;">
            <?php echo html::image('img/facebook.png', array('alt' => 'facebook')); ?>
            <div class="fb-page" data-href="<?php echo $sLink; ?>" data-small-header="false" 
                 data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"></div>
        </div>
    </div>                      
<?php endif; ?>