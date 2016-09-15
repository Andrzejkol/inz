<div id="main_left">
    <ul>
        <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'backup', 'index')->Value === TRUE) {
                        ?>
            <li>
            <?php
            echo html::anchor('4dminix/backup', html::image('img/admin_default/backup-24.png').' Backupy', (!empty($hover) && $hover == 'backup') ? array('class' => 'hover') : '');
            ?>
            </li>
                <?php
            }?>
        <li>
            <?php            
            echo html::anchor('4dminix/strony', html::image('img/admin_default/pages-24.png').' Strony', (!empty($hover) && $hover == 'pages') ? array('class' => 'hover') : '');
            ?>
        </li>
        <?php
        // sklep
        if (config::CheckIfModuleEnabled('shop') === TRUE) :
            if (User_Model::IsAllowed($_SESSION['_acl'], 'shop', 'index')->Value === TRUE) :
                ?>
                <li>
                    <?php echo html::anchor('#', html::image('img/admin_default/new/shop-24.png').' Sklep', (!empty($hover) && $hover == 'shop') ? array('class' =>'hover') : ''); ?>
                <ul>
                    <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'products', 'index')->Value==true) { ?>
                    <li>
                            <?php echo html::anchor('4dminix/produkty', 'Produkty'); ?>
                    </li>
                    <?php }
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'products_categories', 'index')->Value==true) { ?>
                    <li>
                        <?php echo html::anchor('4dminix/kategorie_produktow', 'Kategorie produktów'); ?>
                    </li>
                    <?php }
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'orders', 'index')->Value==true) { ?>
                    <li>
                        <?php echo html::anchor('4dminix/zamowienia', 'Zamówienia'); ?>
                    </li>
                    <?php }
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'attributes', 'index')->Value==true) { ?>
                    <li>
                            <?php echo html::anchor('4dminix/atrybuty', 'Atrybuty'); ?>
                    </li>
                    <?php } 
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'parameters', 'index')->Value==true) { ?>
                    <li>
                        <?php echo html::anchor('4dminix/parametry', 'Parametry'); ?>
                    </li>
                    <?php }
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'customers', 'index')->Value==true) { ?>
                    <li>
                        <?php echo html::anchor('4dminix/klienci', 'Klienci'); ?>
                    </li>
                    <?php }
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'producers', 'index')->Value==true) { ?>
                    <li>
                        <?php echo html::anchor('4dminix/producenci', 'Producenci'); ?>
                    </li>
                    <?php }
                  /*  if(shop_config::getConfig('rebates_codes')) {
                        if(User_Model::IsAllowed($_SESSION['_acl'], 'rebates_codes', 'index')->Value==true) { ?>
                        <li>
                            <?php echo html::anchor('4dminix/kody_rabatowe', 'Kody rabatowe'); ?>
                        </li>
                        <?php }
                    }
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'rebates_groups', 'index')->Value==true) { ?>
                    <li>
                        <?php echo html::anchor('4dminix/grupy_rabatowe', 'Grupy rabatowe'); ?>
                    </li>
                    <?php }*/
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'products_statuses', 'index')->Value==true) { ?>
                    <li>
                        <?php echo html::anchor('4dminix/statusy_produktow', 'Statusy produktów'); ?>
                    </li>
                    <?php }
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'taxes', 'index')->Value==true) { ?>
                    <li>
                        <?php echo html::anchor('4dminix/stawki_vat', 'Wartości VAT'); ?>
                    </li>
                    <?php }
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'currencies', 'index')->Value==true) { ?>
                    <li>
                            <?php echo html::anchor('4dminix/waluty', 'Waluty'); ?>
                    </li>
                    <?php }
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'delivery_types', 'index')->Value==true) { ?>
                    <li>
                        <?php echo html::anchor('4dminix/typy_dostaw', 'Rodzaje dostaw'); ?>
                    </li>
                    <?php }
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'payment_types', 'index')->Value==true) { ?>
                    <li>
                        <?php echo html::anchor('4dminix/typy_platnosci', 'Rodzaje płatności'); ?>
                    </li>
                    <?php }
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'questions', 'index')->Value==true) { ?>
                    <li>
                        <?php echo html::anchor('4dminix/zapytania_klientow', 'Zapytania klientów'); ?>
                    </li>
                    <?php } ?>
                    <?php /* if(User_Model::IsAllowed($_SESSION['_acl'], 'products', 'index')->Value==true && shop_config::getConfig('voucher') == 1) { ?>
                    <li>
                            <?php echo html::anchor('4dminix/vouchery', 'Vouchery'); ?>
                    </li>
                    <?php } */ ?>
                </ul>
            </li>
                <?php
            endif;
        endif;

        if (User_Model::IsAllowed($_SESSION['_acl'], 'elements', 'index')->Value == true) { ?>
            <li id="menu_elements">
                <?php
                echo html::anchor('#', html::image('img/admin_default/new/elements-24.png').' Elementy', (!empty($hover) && $hover == 'elements') ? array('class' => 'hover') : '');
                ?>
                <ul id="menu_elements_sub">
                <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'news', 'index')->Value == true) { ?>
                        <li>
                    <?php
                    echo html::anchor('4dminix/kategorie_aktualnosci', 'Aktualności');
                    ?>
                        </li>
                <?php }
                if (User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'index')->Value == true) {
                    ?>

                        <li>
                            <?php echo html::anchor('4dminix/galerie', 'Galerie'); ?>
                        </li>
                        <?php }
                        if (User_Model::IsAllowed($_SESSION['_acl'], 'page_content', 'index')->Value == true) {
                            ?>

                        <li>
                            <?php echo html::anchor('4dminix/zawartosc_strony', 'Treść'); ?>
                        </li>
                    <?php }
                    if (User_Model::IsAllowed($_SESSION['_acl'], 'polls', 'index')->Value == true) {
                        ?>
                        <li>
                            <?php echo html::anchor('4dminix/kategorie_sond', 'Sondy'); ?>
                        </li>
                    <?php }
                    if (User_Model::IsAllowed($_SESSION['_acl'], 'contact_forms', 'index')->Value == true) {
                        ?>
                        <li>
                            <?php echo html::anchor('4dminix/formularze_kontaktowe', 'Formularze kontaktowe'); ?>
                        </li>
                    <?php } ?>
                </ul>
            </li>
                    <?php }
                    if (User_Model::IsAllowed($_SESSION['_acl'], 'boxes', 'index')->Value === TRUE) {
                        ?>
            <li>
            <?php
            echo html::anchor('4dminix/boxes', html::image('img/admin_default/boxes-24.png').' Boksy', (!empty($hover) && $hover == 'boxes') ? array('class' => 'hover') : '');
            ?>
            </li>
                <?php
            }
            if (User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'index')->Value == true) {
                ?>
            <li>
                <?php
                echo html::anchor('4dminix/newslettery', html::image('img/admin_default/newsletter-24.png').' Newslettery', (!empty($hover) && $hover == 'newsletter') ? array('class' => 'hover') : '');
                ?>
                <ul>
            <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'index')->Value == true) { ?>
                        <li><?php echo html::anchor('4dminix/newslettery', 'Newslettery'); ?></li>
                <?php }
                if (User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'groups_index')->Value == true) {
                    ?>
                        <li><?php echo html::anchor('4dminix/newsletter_grupy', 'Grupy'); ?></li>
                    <?php
                }
                if (User_Model::IsAllowed($_SESSION['_acl'], 'newsletters', 'emails_index')->Value == true) {
                    ?>
                        <li><?php echo html::anchor('4dminix/emaile', 'Emaile'); ?></li>
                    <?php } ?>
                </ul>
            </li>
                <?php }
                if (User_Model::IsAllowed($_SESSION['_acl'], 'users', 'index')->Value == true) {
                    ?>
            <li>
                    <?php
                    echo html::anchor('#', html::image('img/admin_default/users-24.png').' Uprawnienia', (!empty($hover) && $hover == 'users') ? array('class' => 'hover') : '');
                    ?>
                <ul>
                    <li><?php echo html::anchor('4dminix/uzytkownicy', 'Użytkownicy'); ?></li>
                    <li><?php echo html::anchor('4dminix/role', 'Role'); ?></li>
                </ul>
            </li>
            <?php }
            if (User_Model::IsAllowed($_SESSION['_acl'], 'medias', 'index')->Value == true) {
                ?>
            <li>
                <?php
                echo html::anchor('4dminix/media', html::image('img/admin_default/new/media-24.png').' Media', (!empty($hover) && $hover == 'media') ? array('class' => 'hover') : '');
                ?>
            </li>
            <?php
        }
        if (config::CheckIfModuleEnabled('partners') === TRUE) :
            if (User_Model::IsAllowed($_SESSION['_acl'], 'partners', 'index')->Value === TRUE) :
                ?>
                <li>
                    <?php
                    echo html::anchor('4dminix/partnerzy', html::image('img/admin_default/sliders-24.png').' '.Kohana::lang('admin.partners.partners'), (!empty($hover) && $hover == 'partners') ? array('class' => 'hover') : '');
                    ?>
                </li>
                <?php
            endif;
        endif;
        if (config::CheckIfModuleEnabled('slider') === TRUE) :
            if (User_Model::IsAllowed($_SESSION['_acl'], 'slider', 'index')->Value === TRUE) :
                ?>
                <li>
                    <?php
                    echo html::anchor('4dminix/slider', html::image('img/admin_default/sliders-24.png').' '.Kohana::lang('slider.admin_header_slider'), (!empty($hover) && $hover == 'sliders') ? array('class' => 'hover') : '');
                    ?>
                </li>
                <?php
            endif;
        endif;
        if (User_Model::IsAllowed($_SESSION['_acl'], 'configurations', 'index')->Value == true) {
            ?>
            <li>
                <?php
                echo html::anchor('4dminix/ustawienia', html::image('img/admin_default/new/settings-24.png').' Ustawienia', (!empty($hover) && $hover == 'settings') ? array('class' => 'hover') : '');
                ?>
            </li>
        <?php } ?>
        <?php /*
        <li>
        <?php echo html::anchor('/', 'Podgląd strony', array('target' => '_blank')); ?>
        </li>
        <?php */ ?>
    </ul>
    <br style="clear:both;" />
</div>

<script type="text/javascript">
    $('#menu_elements-off').hover(function() {
        $('#menu_elements_sub-off').toggle("slide", "down")
    });
</script>
