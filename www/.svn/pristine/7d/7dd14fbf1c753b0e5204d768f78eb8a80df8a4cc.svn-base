<?php
$tmp = $oElements[$oContent->element_id]->boxes;
$name = boxes::GetBoxSetName($tmp[0]->boxes_set_id);
/*if (!empty($name)) {
    ?>
    <h3 class="boxes_set"><?php echo $name; ?></h3>
<?php } */?>
<div class="small_boxes row" id="boxes-<?php echo $oContent->element_id; ?>">
    <?php foreach ($tmp as $oBox) : ?>

        <div class="small_box col-sm-4">
            <h3 class="box_title"><a href="<?php echo $oBox->link; ?>"><?php echo $oBox->title; ?></a></h3>
            <div  class="small_boxes_img">
                <a href="<?php echo $oBox->link; ?>">
                    <?php echo html::image(boxes::BIG_PATH . $oBox->filename, array('alt' => $oBox->title)); ?>
                </a>
            </div>
        </div>

    <?php endforeach; ?>
</div>