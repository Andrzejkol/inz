<?php echo $main_left; ?>

<div id="main_content" <?php if(!empty($content_class_main)) { echo 'class="'.$content_class_main.'"'; } ?>>
    <?php if(!empty($msg)) {
                    echo $msg;
                } ?>
    <?php echo $main_content; ?>
</div>

<?php echo $main_right; ?>
