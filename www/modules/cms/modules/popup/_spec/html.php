<?php
$popup = popup_helper::getElement(1);
if (!empty($popup)):
    ?>

    <div class="popup-element id_<?php echo $popup->id_popup; ?>
         <?php if (!empty($_COOKIE['cookieclicked'])) {
             echo ' popup-hide';
         } ?>" id="main_popup">
        <div class="popup-wrapper">
            <div class="popup-close"></div>
            <?php echo $popup->content; ?>
            <?php if (!empty($popup->link)): ?>
                <a href="<?php echo $popup->link; ?>">Więcej</a>
    <?php endif; ?>
        </div>

        <div class="popup-button">
    <?php echo $popup->button_text; ?>
        </div>

    </div>
    <?php
endif;
?>