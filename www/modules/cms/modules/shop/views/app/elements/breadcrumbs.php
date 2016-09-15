<div id="breadcrumbs" class="row">
    <div class="col-xs-12">
        <p class="breadcrumb-wrapper"><?php //echo Kohana::lang('app.you_are_here').':';  ?><?php echo html::anchor('', config::getConfig('page_domain')); ?>
            <?php if (!empty($oCats) && $oCats->count() > 0) : ?>
                <?php foreach ($oCats as $c) : ?>
                    <?php echo ' <span>></span> ' . html::anchor('kategoria/' . string::prepareURL($c->category_name) . '/' . $c->id_category, $c->category_name); ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!empty($sHere)) {
                echo ' <span>></span> ' . html::anchor(url::current(), $sHere);
            } ?>
        </p>
    </div>
</div>
<?php
// dodac klas do aktywnego linku ?>