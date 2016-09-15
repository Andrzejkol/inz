<h2>Strona: "<?php echo $pageName; ?>"</h2>
<div id="admin_edit_page_content">
    <ul style="overflow: hidden;">
        <?php 
        if (count($views) > 0) :
            foreach ($views as $element_id => $view) :
                ?>
        
               <li><a href="#tabs-<?php echo $element_id; ?>"><?php echo $view->title; ?></a></li> 
                <?php                
            endforeach;
        endif;
        ?>
                <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'pages', 'settings_edit')->Value === TRUE) : ?>
        	<li><a href="#tabs-settings"><?php echo Kohana::lang('pages.settings'); ?></a></li>
        <?php 
        endif;
        if (User_Model::IsAllowed($_SESSION['_acl'], 'elements', 'add')->Value == true) : ?>
            <li><a href="#tabs-a">+ <?php echo Kohana::lang('pages.add_new_content'); ?></a></li>            
        <?php endif; ?>
    </ul>
    <?php
    if (count($views) > 0) :
        foreach ($views as $element_id => $view) :
            ?>
            <div id="tabs-<?php echo $element_id; ?>" class="ui-tabs-hide">
                <?php
                echo $view;
                ?>
            </div>
        <?php
        endforeach;
    endif;
    ?>
    <div id="tabs-a" class="ui-tabs-hide">
        <ul>
            <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'page_content', 'add')->Value == true) : ?>
                <li><?php echo html::anchor('4dminix/dodaj_zawartosc_strony/' . $iPageId, Kohana::lang('pages.page_content')); ?></li>
            <?php endif; ?>
            <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'add')->Value == true) : ?>
                <li><?php echo html::anchor('4dminix/dodaj_galerie/' . $iPageId, Kohana::lang('pages.gallery')); ?></li>
            <?php endif; ?>
            <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'news_categories', 'add')->Value == true) : ?>
                <li><?php echo html::anchor('4dminix/dodaj_kategorie_aktualnosci/' . $iPageId, Kohana::lang('pages.news')); ?></li>
<?php endif; ?>
        </ul>
    </div>
    <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'pages', 'settings_edit')->Value === TRUE) : ?>
    <div id="tabs-settings" class="ui-tabs-hide">
        <?php 
        	//var_dump($edit); 
        	$edit->render(true);
        ?>
    </div>
    <?php endif; ?>
</div>