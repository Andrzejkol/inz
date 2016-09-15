
    <?php if (!empty($oElements[$oContent->element_id]->news[0]->show_title) && $oElements[$oContent->element_id]->news[0]->show_title == 'Y') : ?>
    <h2 class="page_title"><span><?php echo $oElements[$oContent->element_id]->news[0]->news_category_name; ?></span></h2>
    <?php endif; ?>
    <?php foreach ($oElements[$oContent->element_id] as $oAllNews) : ?>
        <?php foreach ($oAllNews as $oNews) :
        ?>
            <div class="news row">
                <div class="col-sm-12">
                    <div class="row">
                        <?php if (!empty($oNews->mainfilename)) : ?>
                            <div class="col-md-3">
                                <a href="<?php echo url::file(news_helper::BIG_PATH . $oNews->mainfilename); ?>" rel="prettyPhoto"><?php echo html::image(news_helper::SMALL_PATH . $oNews->mainfilename, array('alt' => $oNews->alt)); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-9">
                            <h4><?php echo $oNews->title; ?></h4>
                            <div class="news_description"><?php echo $oNews->news_description; ?></div>
                            <div class="news_short_description"><?php echo $oNews->short_description; ?></div>

                        </div>
                    </div>
                </div>
            </div>
            <?php
        endforeach;
    endforeach;
    ?>
    <?php
    if (!empty($oElements[$oContent->element_id]->pagination))
        echo $oElements[$oContent->element_id]->pagination;
    ?>
