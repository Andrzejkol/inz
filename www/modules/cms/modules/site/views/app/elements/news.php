<div class="news row">
    <div class="col-sm-12">
        <h4 class="cufon"><?php echo $oNewsDetails->title; ?></h4>
        <div class="news_date"><?php echo Kohana::lang('app.date') ?>: 
            <?php
            echo date(config::DATE_TIME_FORMAT, $oNewsDetails->date_added);
            if (!empty($oNewsDetails->modified_date)) {
                echo ' (' . Kohana::lang('app.modified') . ' ' . date(config::DATE_TIME_FORMAT, $oNewsDetails->modified_date) . ')';
            }
            ?>
        </div>
        <?php if (!empty($oNewsDetails->mainfilename)) { ?>
            <div class="news_image">
                <a href="<?php echo url::file(news_helper::BIG_PATH . $oNewsDetails->mainfilename); ?>" rel="prettyPhoto[]"><?php echo html::image(news_helper::SMALL_PATH . $oNewsDetails->mainfilename, array('alt' => $oNewsDetails->alt)); ?></a>
            </div>
        <?php } ?>
        <div class="news_short_description"><?php echo $oNewsDetails->description; ?></div>
        <div class="news_back btn"><span class="back"><< <?php echo Kohana::lang('app.back') ?></span></div>
        <div class="clear"></div>
        <?php /* if (!empty($vNewsComments)) : ?>
            <?php echo $vNewsComments; ?>
        <?php
          endif; */ 
        
        ?>
    </div>
</div>