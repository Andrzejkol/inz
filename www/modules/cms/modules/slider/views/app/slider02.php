<?php
//prosty slider
//938 x 330

if (!empty($aElements) AND count($aElements)) :
    ?>
    <ul class="bxslider">
        <?php
        $j = 0;
        foreach ($aElements as $oElement) :
            $sClass = '';
            switch ($oElement->slider_type_id) {
                case slider_helper::ELEMENT_TYPE_NEWS:
                    $sClass = 'news';
                    break;
                case slider_helper::ELEMENT_TYPE_SLIDER_NEWS:
                    $sClass = 'slider-news';
                    break;
                case slider_helper::ELEMENT_TYPE_IMAGE:
                    $sClass = 'image';
                    break;
            }
            ?>
            <li<?php echo!empty($sClass) ? (' class="' . $sClass . '"') : NULL; ?> id="slide-<?php echo $j++; ?>">
                <?php
                switch ($oElement->slider_type_id) {
                    case slider_helper::ELEMENT_TYPE_NEWS:
                        echo view::factory('app/elements/carousel_news')->set('oElement', $oElement);
                        break;
                    case slider_helper::ELEMENT_TYPE_SLIDER_NEWS:
                        echo view::factory('app/elements/carousel_news')->set('oElement', $oElement);
                        break;
                    case slider_helper::ELEMENT_TYPE_IMAGE:
                        echo view::factory('app/elements/carousel_image')->set('oElement', $oElement);
                        break;
                }
                ?>
            </li>
            <?php
        endforeach;
        ?>
    </ul>

<?php endif; ?>
