<div id="main_left">
    <h2><?php echo Kohana::lang('pages.pages'); ?></h2>
    <?php 
    if(User_Model::IsAllowed($_SESSION['_acl'], 'pages', 'add')->Value==true) {
        echo html::anchor('4dminix/dodaj_strone', Kohana::lang('pages.add_page'));
    } ?>
    <?php
        foreach($langs as $lang) {
            if(!empty($pages[$lang->name]) && count($pages[$lang->name])>0) :
    ?>
    <h3><?php echo Kohana::lang('pages.'.$lang->description); ?></h3>
    <?php
            echo $pages[$lang->name];
        
            endif;
        }
    ?>
    <br style="clear:both;" />
</div>