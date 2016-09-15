<?php
if (!empty($msg)) {
    echo $msg;
}
/*
if (!empty($vBreadcrumbs)) {
    echo $vBreadcrumbs;
}*/

if (!empty($vSlider)) {
    echo $vSlider;
}
/*
//kategorie
if (!empty($vSeeCategories)) {
    echo $vSeeCategories;
}

//wszystkie
if (!empty($vProductListing)) {
    echo $vProductListing;
}
*/
if (!empty($oContents) && $oContents->count() > 0) {
    
    echo '<div id="main-content-wrapper">';
    foreach ($oContents as $oContent) {
        if ($oContent->type == 'boxes') :
            $oBoxes = View::factory('app/elements/boxes_block');
            $oBoxes->oContent = $oContent;
            $oBoxes->oElements = $oElements;
            $oBoxes->render(TRUE);
        endif;
    }
    foreach ($oContents as $oContent) {
        if ($oContent->type == 'page_content') {
            View::factory('app/elements/page_content')
                    ->set(array(
                        'oContent' => $oContent,
                        'oElements' => $oElements
                    ))->render(TRUE);
        }
    }

    foreach ($oContents as $oContent) {
        if ($oContent->type == 'galleries') {
            View::factory('app/elements/gallery_front')
                    ->set(array(
                        'oContent' => $oContent,
                        'oElements' => $oElements
                    ))->render(TRUE);
        }
    }

    

    echo '</div>';
}
?>
