<?php
if (!empty($oElement)) {
    if (!empty($oElement->link)) {
        echo html::anchor($oElement->link, html::image(slider_helper::SLIDER_IMAGE_PATH . $oElement->filename, array('alt' => (!empty($oElement->alt) ? $oElement->alt : NULL), 'width' => slider_helper::SLIDER_IMAGE_WIDTH, 'height' => slider_helper::SLIDER_IMAGE_HEIGHT)), array());
    } else {
        echo html::image(slider_helper::SLIDER_IMAGE_PATH . $oElement->filename, array('alt' => (!empty($oElement->alt) ? $oElement->alt : NULL), 'width' => slider_helper::SLIDER_IMAGE_WIDTH, 'height' => slider_helper::SLIDER_IMAGE_HEIGHT));
    }
}
?>