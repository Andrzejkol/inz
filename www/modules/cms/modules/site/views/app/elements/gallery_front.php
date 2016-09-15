<?php
foreach ($oElements[$oContent->element_id] as $oGallery) :
    if (!empty($oGallery) && $oGallery->count() > 0) :
        ?><div class="gallery-slider-wrapper">
        <div class="gallery-slider">
            <?php
            foreach ($oGallery as $oPhoto) :
                ?>
                <div class="gallery_photo">
                    <?php echo html::anchor(gallery_helper::BIG_PATH . $oPhoto->filename, html::image(gallery_helper::SMALL_PATH . $oPhoto->filename, array('alt' => $oPhoto->alt)), array('rel' => 'prettyPhoto[' . $oPhoto->id_gallery . $oPhoto->name . ']')); ?>
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