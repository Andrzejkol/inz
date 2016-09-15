<?php if (!empty($pop) && count($pop) > 0): 
    if (!empty($pop)){
                    shuffle($pop);
                }
    ?>
    <div id="banner-pop">    
        
        <div class="pop_content">
            <span id="pop_exit"></span>
            <?php            
                foreach ($pop as $p) {
                    if (!empty($p->link) && $p->link != '') {
                        echo html::anchor($p->link, html::image(banners::BIG_PATH . $p->filename, array('alt' => $p->name)));
                    } else {
                        echo html::image(banners::BIG_PATH . $p->filename, array('alt' => $p->name));
                    }
                }            
            ?>    
        </div>
    </div>
    <div id="pop_up" style="display: block;"></div>
<?php endif; ?>