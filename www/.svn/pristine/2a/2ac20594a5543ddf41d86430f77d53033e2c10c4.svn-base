<?php 
if(!empty($partner) && $partner->count()) : ?>
<div id="outer-partners">
    <a id="mycarousel-prev" href="#"></a>
<div id="partners">
    
    <ul class="partner">
<?php
foreach($partner as $pat) {
    if(!empty($pat->web_address) && $pat->web_address != '') {
        echo '<li>'.html::anchor($pat->web_address, html::image(partners_helper::SMALL_PATH.$pat->photo, array('alt' => $pat->name, 'title' => $pat->name))).'</li>';
    }
    else {
        echo '<li>'.html::image(partners_helper::SMALL_PATH.$pat->photo, array('alt' => $pat->name, 'title' => $pat->name)).'</li>';
    }  
}
?>
    </ul>
    
</div>
    <a id="mycarousel-next" href="#"></a>
    <div class="clear"></div>
    </div>
<?php endif; ?>
