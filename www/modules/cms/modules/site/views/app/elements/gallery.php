<?php
foreach ($oElements[$oContent->element_id] as $oGallery) :
    if (!empty($oGallery) && $oGallery->count() > 0) :
        ?>
        <div class="gallery page-gallery">
            <?php if (!empty($oGallery[0]->show_title) && $oGallery[0]->show_title == 'Y') : ?>
            <h2 class="page_title"><span><?php echo $oGallery[0]->name; ?></span></h2>
            <?php endif; ?>
            <div class="row">
            <?php
            foreach ($oGallery as $oPhoto) :
                ?>
                <div class="gallery_photo col-sm-3">
                    <?php echo html::anchor(gallery_helper::BIG_PATH . $oPhoto->filename, html::image(gallery_helper::SMALL_PATH . $oPhoto->filename, array('alt' => $oPhoto->alt)), array('rel' => 'prettyPhoto[]')); ?>
                </div>
                <?php
            endforeach;
            ?>
        </div>        
        </div>

        <?php
    endif;
endforeach;
?>