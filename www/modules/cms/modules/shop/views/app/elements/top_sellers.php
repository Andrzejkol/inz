<div id="top_sellers">
<?php
if (!empty($title)) {
    echo '<h3>' . $title . '</h3>';
}
if (!empty($oProducts) && $oProducts->count() > 0) {
    echo '<ul>';
    foreach ($oProducts as $prod) {
        echo '<li>';
        if (!empty($prod->filename)) {
            if (file_exists(Product_Model::PRODUCT_IMG_XXMEDIUM . $prod->filename)) {
                echo html::anchor(Kohana::lang('links.lang') . 'produkt/' . $prod->id_product . '/' . string::prepareURL($prod->product_name), html::image(Product_Model::PRODUCT_IMG_XXMEDIUM . $prod->filename, $prod->product_name));
            } else {
                echo html::anchor(Kohana::lang('links.lang') . 'produkt/' . $prod->id_product . '/' . string::prepareURL($prod->product_name), html::image(Product_Model::PRODUCT_IMG_XXMEDIUM . $prod->filename, $prod->product_name), array('class' => 'no-img'));
            }
        } else {
            echo html::anchor(Kohana::lang('links.lang') . 'produkt/' . $prod->id_product . '/' . string::prepareURL($prod->product_name), html::image('img/zaslepka_s.jpg', array('alt' => $prod->product_name)));
        }
        echo '</li>';
    }
    echo '</ul>';
}
?>
</div>