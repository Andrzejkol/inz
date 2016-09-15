<?php if (!empty($aElements) AND count($aElements)) : 
     var_dump($aElements);
    ?>
    <div id="slider-bg">
        <?php
        $i = 0;
        foreach ($aElements as $oElement) :
            if (!empty($oElement)) :
                ?>
                <?php echo html::image(slider_helper::GetImagePathForType($oElement->slider_type_id, 'big') . $oElement->filename, array('id' => 'slideimg-' . $i, 'alt' => (!empty($oElement->alt) ? $oElement->alt : NULL), 'class' => ($i === 0) ? '' : NULL)); ?>
                <?php
                $i++;
            endif;
        endforeach;
        ?>
    </div>
    <div id="slider"><h1>SLIDER</h1>
        <div class="centered" style="margin: 185px auto 0px; width: 980px; position:relative;min-height: 350px;">
            <a href="#" id="mycarousel-prev"></a>
            <div id="mycarousel" class="jcarousel-skin-tango">
                <ul>
                    <?php
                    $j = 0;
                    foreach ($aElements as $oElement) :
                        $sClass = '';
                        switch ($oElement->slider_type_id) {
                            case slider_helper::ELEMENT_TYPE_NEWS:
                                $sClass = 'news';
                                break;
                            case slider_helper::ELEMENT_TYPE_SLIDER_NEWS:
                                $sClass = 'slider-news';
                                break;
                            case slider_helper::ELEMENT_TYPE_IMAGE:
                                $sClass = 'image';
                                break;
                        }
                        ?>
                        <li<?php echo!empty($sClass) ? (' class="' . $sClass . '"') : NULL; ?> id="slide-<?php echo $j++; ?>">
                            <?php
                            switch ($oElement->slider_type_id) {
                                case slider_helper::ELEMENT_TYPE_NEWS:
                                    echo view::factory('app/elements/carousel_news')->set('oElement', $oElement);
                                    break;
                                case slider_helper::ELEMENT_TYPE_SLIDER_NEWS:
                                    echo view::factory('app/elements/carousel_news')->set('oElement', $oElement);
                                    break;
                                case slider_helper::ELEMENT_TYPE_IMAGE:
                                    echo view::factory('app/elements/carousel_image')->set('oElement', $oElement);
                                    break;
                            }
                            ?>
                        </li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </div>


            <a href="#" id="mycarousel-next"></a>
            <div class="jcarousel-control"><?php for ($i = 1; $i <= count($aElements); $i++) : ?><a href="#"><?php echo $i; ?></a><?php endfor; ?></div>
            <div class="clear"></div>
        </div>
    </div>
    <style type="text/css">
        #mycarousel .jcarousel-skin-tango{
            float: left;
        }
        #mycarousel #mycarousel-prev, #mycarousel #mycarousel-next {
            display: block;
        }
        #mycarousel li {
            width: 386px;

        }
        #mycarousel {
            width: 386px;
            border: 0px;
            overflow: hidden;
        }
        #mycarousel .news {
            border: none;
            padding: 0;
            margin: 0;
            width: 386px;
            position: static;
        }
        .jcarousel-control .active {
            font-weight: bold; background-color:#b40909;  color: white;font-size: 16px;

        }
        .jcarousel-control a{color: black; font-size: 16px; margin-left: 3px; margin-right: 3px;padding-left: 7px; padding-right: 7px; padding-top: 2px; padding-bottom: 2px;}
        .jcarousel-control{color: white;font-weight: bold;bottom: 25px;right: 15px;position: absolute;}

    </style>
    <script type="text/javascript">
        var totalitems = <?php echo count($aElements); ?>;
        var activeId = 0;
        var slideChanger;
        /**
         * change
         */
        function changeSlide() {
            if (totalitems > 1) {
                activeId++;
                if (activeId >= totalitems) {
                    activeId = 0;
                }
                jQuery('#slider li').fadeOut(500);
                jQuery('#slider-bg img').delay(300).fadeOut(600);
                jQuery('.jcarousel-control a').removeClass('active');
                Cufon.refresh();
                jQuery('#slider-bg img').promise().done(function() {
                    jQuery('#slider-bg img#slideimg-' + activeId + '').fadeIn(500);
                    jQuery('#slide-' + activeId).delay(300).fadeIn(600);
                    jQuery('.jcarousel-control a:eq(' + activeId + ')').addClass('active');
                    Cufon.refresh();
                });
            }


        }

        $(document).ready(function() {

            jQuery('#slider-bg img#slideimg-' + activeId + '').fadeIn(500);
            jQuery('#slide-' + activeId).delay(300).fadeIn(600);
            jQuery('.jcarousel-control a:eq(' + activeId + ')').addClass('active');

            jQuery('.jcarousel-control a').bind('click', function() {
                activeId = parseInt(jQuery.jcarousel.intval(jQuery(this).text())) - 2;
                //alert(activeId);
                clearInterval(slideChanger);
                changeSlide();
                slideChanger = self.setInterval(function() {
                    changeSlide();
                }, 6000);
            });


            slideChanger = self.setInterval(function() {
                changeSlide();
            }, 6000);


            //            var totalitems = <?php //echo count($aElements);    ?>;
            //            jQuery("#mycarousel").jcarousel({
            //                initCallback: mycarousel_initCallback,
            //                wrap: 'circular',
            //                scroll: 1,
            //                size: totalitems, // previously set in var
            //                auto: 7,
            //                itemVisibleOutCallback: {
            //                    onBeforeAnimation: function(c, o, i, s) {
            //                        //jQuery('.news_short_description').fadeOut(300);
            //                        //jQuery('.news-title').fadeOut(400);
            //                        jQuery('#slider-bg img').fadeOut(500, function() {
            //                            jQuery('#slider-bg img').removeClass('img-active');
            //                        });
            //                    },
            //                },
            //                itemVisibleInCallback: {
            //                    
            //                    onAfterAnimation: function(c, o, i, s) {
            //                        Cufon.refresh();
            //                        var size = c.options.size;
            //                        i = (((i - 1) % size) + size) % size;
            //                        jQuery('.jcarousel-control a').removeClass('active');
            //                        
            //                        jQuery('#slider-bg img').promise().done(function() {
            //                                jQuery('#slider-bg img#slideimg-' + i + '').fadeIn(500).addClass('img-active');
            //                        });
            //                        jQuery('.news_short_description').fadeIn(500);
            //                        jQuery('.news-title').fadeIn(500);
            //                        jQuery('.jcarousel-control a:eq(' + i + ')').addClass('active');
            //                        
            //                        Cufon.refresh();
            //                    }
            //                }
            //            });
            //            var carousel = jQuery('#mycarousel').data('jcarousel');
            //            function mycarousel_initCallback(carousel) {
            //                jQuery('.jcarousel-control ul li a').bind('click', function() {
            //                    carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
            //                    return false;
            //                });
            //                carousel.clip.hover(function() {
            //                    carousel.stopAuto();
            //                }, function() {
            //                    carousel.startAuto();
            //                });
            //            }
            //            ;
            //            jQuery('.jcarousel-control a').bind('click', function() {
            //                carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
            //                return false;
            //            });
            //
            //
            //            jQuery('#mycarousel-next').bind('click', function() {
            //                carousel.next();
            //                return false;
            //            });
            //
            //            jQuery('#mycarousel-prev').bind('click', function() {
            //                carousel.prev();
            //                return false;
            //            });

        });
    </script>
<?php endif;
?>