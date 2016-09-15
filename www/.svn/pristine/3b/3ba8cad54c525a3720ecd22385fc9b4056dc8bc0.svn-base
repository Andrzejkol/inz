<div class="row menu-user">
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-sm-10 col-md-11">
                <div class="user-menu">
                    <?php if (empty($_SESSION['_customer']['logged_in'])): ?>
                        <?php echo html::anchor(Kohana::lang('links.lang') . 'logowanie', Kohana::lang('shop_app.account.login')) ?> <?php echo html::anchor(Kohana::lang('links.lang') . 'rejestracja', Kohana::lang('shop_app.account.registration'), array('class' => 'red')); ?> 
                    <?php else: ?>
                        <?php echo html::anchor(Kohana::lang('links.lang') . 'twoje_konto', $_SESSION['_customer']['email']) ?> <?php echo html::anchor(Kohana::lang('links.lang') . 'wyloguj', Kohana::lang('shop_app.account.logout'), array('class' => 'red')); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xs-4 col-sm-2 col-md-1">
                <div class="social">
                    <?php echo html::anchor('https://www.facebook.com/olicom', html::image('img/fb.png', array('alt' => 'Facebook'))); ?>
                    <?php echo html::anchor('', html::image('img/tweet.png', array('alt' => 'Tweeter'))); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row page-menu">
    <div class="container">
        <div class="row">
            <div class="logo col-md-2 col-xs-7">
                <h1 id="logo">
                    <?php echo html::anchor(Kohana::lang('links.lang') . '/', html::image('img/logo.png', array('alt' => config::getConfig('page_name')))); ?>
                </h1>
            </div>
            <div class="col-md-6 col-xs-12 page-nav">
                <nav id="nav">
                    <?php
                    foreach ($oPages as $oPage) :
                        echo $oPage;
                    endforeach;
                    ?>
                </nav>
            </div>
            <div class="col-xs-6  col-sm-3 shop-nav">
                <div id="shop-nav"> 
                    <?php if (!empty($currencies) && $currencies->count() > 1) {
                        ?>
                        <div id="currency"> 
                            <form method="post" action="">
                                <select name="currency_sel" id="currency_sel" onchange="this.form.submit()">
                                    <?php foreach ($currencies as $cr) { ?>
                                        <option value="<?php echo $cr->currency_code; ?>"<?php echo (!empty($act_cur) && $act_cur == $cr->currency_code) ? 'selected="selected"' : ''; ?>><?php echo $cr->currency_code; ?></option>
                                    <?php } ?>
                                </select>
                            </form>
                        </div>
                    <?php } ?>
                    <?php /* TODO: dorobić sprawdzanie języków tak jak wyżej jest dla walut
                      <div id="lang-selection">
                      <select name="lang_sel" id="lang_sel" onchange="location = this.options[this.selectedIndex].value;">
                      <option value="<?php echo url::base(true); ?>"  <?php echo (!empty($lang) && $lang == 'pl') ? 'selected="selected"' : ''; ?>>PL</option>
                      <option value="<?php echo url::base(true); ?>en"  <?php echo (!empty($lang) && $lang == 'en') ? 'selected="selected"' : ''; ?>>EN</option>
                      <option value="<?php echo url::base(true); ?>de"  <?php echo (!empty($lang) && $lang == 'de') ? 'selected="selected"' : ''; ?>>DE</option>
                      </select>
                      </div> */ ?>

                    <div class="search">
                        <?php echo form::open('szukaj', array('method' => 'get')); ?>
                        <input type="text" name="search_phrase" value="" placeholder="Szukaj" />
                        <button type="submit" name="search-submit"><?php echo html::image('img/ico-search.png', array('alt' => 'Szukaj')); ?></button>
                        <?php echo form::close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-1 shop-basket">
                <div class="basket">
                    <?php echo html::anchor(Kohana::lang('links.lang') . 'zamowienie/koszyk', html::image('img/basket.png') . '<span class="count-basket">(' . (!empty($productsCount) ? $productsCount : 0) . ')</span>', array('class' => 'cart-link')); ?>
                    <?php
                    if (!empty($productsCount) && $productsCount > 0) {
                        $ile = $productsCount;
                        if (!empty($productDetails) && count($productDetails)) :
                            ?>
                            <div id="cart-drop">
                                <div class="sub-arrow"></div>
                                <div id="cart-drop2">
                                    <h4><?php echo html::anchor(Kohana::lang('links.lang') . 'zamowienie/koszyk', Kohana::lang('shop_app.added_to_cart')); ?></h4>
                                    <div id="cart-details">                        
                                        <table>
                                            <?php
                                            $i = 1;
                                            foreach ($productDetails as $key => $det) {
//var_dump($det);
                                                echo '<tr>';
                                                echo '<td style="width:60px;text-align:center;"' . (($i < $ile) ? ' class="crtrow"' : '') . '>' . html::anchor(Kohana::lang('links.lang') . 'produkt/' . $det['id_product'] . '/' . string::prepareURL($det['product_name']), html::image(array('src' => Product_Model::PRODUCT_IMG_XSMALL . $det['filename']), array('alt' => $det['product_name'])), array('class' => 'hcimg')) . '</td>';
                                                //echo '<td>'.html::anchor(Kohana::lang('links.lang').'produkt/' . $det['id_product'] . '/' . string::prepareURL($det['product_name']),text::limit_chars($det['product_name'], 25, '...',true), array('class'=>'hclink')).'</td>';
                                                echo '<td style="text-align: left;"' . (($i < $ile) ? ' class="crtrow"' : '') . '>
                                    
                                    <p class="productn">' . $det['product_name'] . '</p>'
                                                . '<p class="producta">' . implode(' ', $det['attributes']) . '</p>';
//                                    <p class="productc">' . Kohana::lang('app.number') . '</p>';
                                                //<p class="producern">' . $det['producer_name'] . '</p>
                                                echo '<p class="productp">';
//                                    if (Kohana::lang('order.currency_txt') != 'pln') {
//                                        echo $det['price_eur'] . ' ';
//                                    } else {
                                                echo $det['price'] . ' zł';
//                                    }
                                                //if($det['currency'] == 'eur') {echo '&euro;';}else {echo 'zł';}
                                                //echo Kohana::lang('order.currency');
                                                echo '</p></td>';

                                                //echo '<td>'.html::anchor(Kohana::lang('links.lang').'zamowienie/usun/' . $key, 'X', array('class'=>'hcdel')).'</td>';                            
                                                echo '</tr>';
                                                if ($i < $ile) {
//                                        echo '<tr><td colspan="2" class="cart-row"></td></tr>';
                                                }
                                                $i++;
                                            }
                                            ?>
                                            <tr><td colspan="2" style="padding:10px 0px;text-align:center;"><?php echo html::anchor(Kohana::lang('links.lang') . 'zamowienie/koszyk', 'TWÓJ KOSZYK', array('class' => 'btn black-btn')); ?></td></tr>

                                        </table>
                                    </div>
                                    <?php //echo html::anchor(Kohana::lang('links.lang') . 'zamowienie/koszyk', Kohana::lang('app.your_shopping_cart'), array('class' => 'goto_cart'));     ?>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php
                    } else {
                        //echo html::anchor(Kohana::lang('links.lang') . 'zamowienie/koszyk', '0', array('class' => 'cart-hover'));
                    }
                    ?>   
                </div>
            </div>
            <div id="burger"></div>
        </div>
    </div>
</div>

<?php if (!empty($vSlider)) { ?>
    <div class="row slider">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div id="slider">
                        <?php echo $vSlider; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
?>