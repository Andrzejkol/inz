<div id="breadcrumbs">
    <?php
    $i = 1;
    if(!empty($aBreadcrumb) && count($aBreadcrumb)>0) :
        echo Kohana::lang('app.you_are_here') . ': ';
        foreach($aBreadcrumb as $aP) :
            echo html::anchor($aP['page_link'], ((!empty($aP['select']) && $aP['select']===true) ? '<strong>'.$aP['page_name'].'</strong>' : $aP['page_name']));
            if($i<count($aBreadcrumb)) { echo ' > '; $i++; }
        endforeach;
    endif;
    ?>
</div>