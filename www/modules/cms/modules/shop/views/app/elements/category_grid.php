<div class="row" id="categories">
    <?php /*    <div class="col-md-12" >
      <h4 class="title"> Wybierz kategorię </h4>
      </div>
     */ ?>
    <?php
    if (!empty($oCategories)) :
        foreach ($oCategories as $oC) :
            $not = array(9, 10);
            if (!in_array($oC->id_category, $not)) :
                ?>
                <div id="box" class="col-md-3 col-sm-3 col-xs-6">
                    <div class="box">
                        <div id="img"><?php echo html::anchor(Kohana::lang('links.lang') . $oC->category_page, html::image(shop::PRODUCT_CATEGORY_SMALL_PATH . $oC->image_filename, array('id' => 'test', 'alt' => $oC->category_name))); ?></div>
                        <h3><?php echo html::anchor(Kohana::lang('links.lang') . $oC->category_page, $oC->category_name); ?></h3>
                        <?php if (!empty($oC->category_page)) { ?>
                            <div class="box-more"><?php echo html::anchor(Kohana::lang('links.lang') . $oC->category_page, Kohana::lang('pw.wiecej') . "  &raquo"); ?></div>
                        <?php } else { ?> 
                            <div class="box-more"><?php echo html::anchor(shop::getFirstProductURL($oC->id_category), Kohana::lang('pw.wiecej') . "  &raquo"); ?></div>
                        <?php } ?>
                    </div>
                </div>
                <?php
            endif;
        endforeach;
    endif;
    ?>
</div>