<div style="text-align: center; width: 660px; margin: 0 auto;" >
    <div style="width: 660px; font-family: Helvetica, Arial; font-size: 14px; color: #3d3d3d; text-align: left;">
        <div style="padding-bottom: 16px; padding: 20px 0;">
            <?php
            echo html::image(url::base(TRUE, 'http').config::getConfig('logo'));
            ?>
        </div>        
        <div style="height: 1px; border-bottom: 1px solid #cccccc;">&nbsp;</div>

        <div style="padding: 20px;">
            <div style="font-size: 22px;">
                <?php echo!empty($sTitle) ? $sTitle : ('Wiadomość wysłana ze strony ' . config::getConfig('page_name')); ?>
                <br/><br/>
            </div>
            <?php
            if (!empty($sContent)) {
                echo $sContent;
            }
            ?>
            <br />
        </div>
        <div style="height: 1px;border-top: 1px solid #cccccc;">&nbsp;</div>        
    </div>
</div>