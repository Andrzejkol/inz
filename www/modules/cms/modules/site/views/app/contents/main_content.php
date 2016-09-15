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
        if ($oContent->type == 'page_content') {
            View::factory('app/elements/page_content')
                    ->set(array(
                        'oContent' => $oContent,
                        'oElements' => $oElements
                    ))->render(TRUE);
        }
    }

    foreach ($oContents as $oContent) {
        if ($oContent->type == 'news') {
            View::factory('app/elements/news_list')
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

    foreach ($oContents as $oContent) {
        if ($oContent->type == 'boxes') :
            $oBoxes = View::factory('app/elements/boxes_block');
            $oBoxes->oContent = $oContent;
            $oBoxes->oElements = $oElements;
            $oBoxes->render(TRUE);
        endif;
    }
    foreach ($oContents as $oContent) {

        if ($oContent->type == 'contact_form') :
            if ($oElements[$oContent->element_id]->contact_form[0]->show_title == 'Y') :
                ?>
                <h3 class="cufon"><?php echo $oElements[$oContent->element_id]->contact_form[0]->title; ?></h3>
                <?php
            endif;
            echo $oElements[$oContent->element_id]->contact_form->view->render(true);
        endif;
    }
    echo '</div>';
}

if (!empty($oNewsDetails)) {
    View::factory('app/elements/news')
            ->set(array(
                'oNewsDetails' => $oNewsDetails,
                'vNewsComments' => (!empty($vNewsComments) ? $vNewsComments : NULL)
            ))->render(TRUE);
}

if (!empty($vMap)) {
    echo $vMap;
}
?>
