<?php if (!empty($partner) && $partner->count()) : ?>
    <div id="partners">
        <h3>Nasi partnerzy</h3>
        <div id="slider-partners">
            <ul class="partner">
                <?php
                foreach ($partner as $pat) {
                    if (!empty($pat->web_address) && $pat->web_address != '') {
                        echo '<li>' . html::anchor($pat->web_address, html::image(partners_helper::XSMALL_PATH . $pat->photo, array('alt' => $pat->name, 'title' => $pat->name, 'target'=>'_blank'))) . '</li>';
                    } else {
                        echo '<li>' . html::image(partners_helper::XSMALL_PATH . $pat->photo, array('alt' => $pat->name, 'title' => $pat->name)) . '</li>';
                    }
                }
                ?>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <?php if ($partner->count() > 4) : ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#slider-partners ul').bxSlider({
                    slideWidth: 160,
                    minSlides: 1,
                    maxSlides: 4,
                    moveSlides: 1,
                    slideMargin: 0,
                    pager: false,
                    autoStart: true,
                    auto: true
                });
            });
        </script>
    <?php endif; ?>
<?php endif; ?>