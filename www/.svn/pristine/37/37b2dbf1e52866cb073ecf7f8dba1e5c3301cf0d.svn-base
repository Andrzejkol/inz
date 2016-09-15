<div id="header_nav">
    <div id="header_menu">
        <?php echo html::anchor('/4dminix/', html::image('img/admin_default/logo45.png', array('alt'=>'Logo'))); ?>
    </div>
    <?php if(!empty($_SESSION['_acl']['logged_in']) && $_SESSION['_acl']['logged_in'] == true) { ?>
    	<div id="header_logout">
    		<?php
    			if(!empty($_SESSION['_acl']['filename'])) {
    	        	echo html::image(users::SMALL_PATH . $_SESSION['_acl']['filename']); 
    	        } else {
    	        	echo html::image('img/admin_default/user-20.png'); 	
    	        }
    	        echo html::anchor('4dminix/wyloguj', $_SESSION['_acl']['email'].' ( '.Kohana::lang('user.logout').' )');
    	    ?>
    	</div>
    <?php } ?>
    <div class="clear"></div>
</div>
