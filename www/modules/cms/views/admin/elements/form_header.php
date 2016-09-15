<div class="options">
    <?php
    switch ($sIco) {
        case 'add':
            echo html::image('img/admin_default/add-green-40.png', array('class' => 'main_icon'));
            break;
        case 'edit':
            echo html::image('img/admin_default/new/edit-icon.png', array('class' => 'main_icon'));
            break;
        case 'position':
            echo html::image('img/admin_default/sort-green-40.png', array('class' => 'main_icon'));
            break;
        case 'backup_add':
            echo html::image('img/admin_default/backup_add.png', array('class' => 'main_icon'));
            break;
        default:
            echo $sIco;
            break;
    }
    ?>
    <h5><?php echo $sTitle; ?></h5>
</div>