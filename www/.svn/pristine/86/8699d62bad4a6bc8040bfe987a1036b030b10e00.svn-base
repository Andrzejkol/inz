<div class="row">
    <div class="col-md-12">
        <div class="row">
            <h1 id="logo">
                <?php echo html::anchor(Kohana::lang('links.lang') . '/', html::image('img/comm/logo.jpg', array('alt' => config::getConfig('page_name')))); ?>
            </h1>

        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div id="nav">
                <?php
                foreach ($oPages as $oPage) :
                    echo $oPage;
                endforeach;
                ?>
            </div>
            <div id="topslider">
                <?php
                if (!empty($vSlider)) {
                    echo $vSlider;
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div id="lang-selection">
            <?php if($lang[0]!='p') echo html::anchor('', html::image('img/flag/pl.png', array('alt' => config::getConfig('page_name')))); ?>
            <?php if($lang[0]!='d') echo html::anchor('de', html::image('img/flag/de.png', array('alt' => config::getConfig('page_name')))); ?>
            <?php if($lang[0]!='e') echo html::anchor('en', html::image('img/flag/en.png', array('alt' => config::getConfig('page_name')))); ?>
</div> 
<?php echo html::anchor('https://www.facebook.com/pages/Hotel-Comm-Hotel/141582892575079', html::image('img/comm/fb.jpg'), array('id' => 'fbimg')); ?>