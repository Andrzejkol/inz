<?php
//prosty slider
//938 x 330

if (!empty($oPhotos)) :
    ?>
    <div>
        <ul class="bxslider">
            <?php foreach ($oPhotos as $Photo) :
                if ($Photo->available == 1) {
                    ?>        
                    <li>
                                <?php
                                if (!empty($Photo->link)) {
                                    echo html::anchor($Photo->link, html::image(slider_helper::SLIDER_IMAGE_PATH . $Photo->filename, array('alt' => (!empty($Photo->alt) ? $Photo->alt : NULL))), array());
                                } else {
                                    echo html::image(slider_helper::SLIDER_IMAGE_PATH . $Photo->filename, array('alt' => (!empty($Photo->alt) ? $Photo->alt : NULL)));
                                }
                                ?>
                    </li>
                    <?php
                }
            endforeach;
            ?>
        </ul>
    </div>
<?php endif; ?>
