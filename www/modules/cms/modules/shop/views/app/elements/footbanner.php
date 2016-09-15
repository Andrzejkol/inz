<div id="footer-banner">
<?php
if(!empty($banner) && count($banner) > 0){
    if (!empty($banner)){
                    shuffle($banner);
                }
        foreach($banner as $ban) {
            if(!empty($ban->link) && $ban->link != '') {
        echo html::anchor($ban->link, html::image(banners::BIG_PATH.$ban->filename, array('alt' => $ban->name)));
    }
    else {
        echo html::image(banners::BIG_PATH.$ban->filename, array('alt' => $ban->name));
    }  
        }
    }
?>
    <div class="clear"></div>
</div>