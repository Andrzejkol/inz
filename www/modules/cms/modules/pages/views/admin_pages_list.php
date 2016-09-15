<?php if(!request::is_ajax()) { ?>
<div id="admin_pages_view">
    <div class="options">
    	<?php echo html::image('img/admin_default/pages-main.png', array('class'=>'main_icon')); ?>
        <h5>
        	<?php echo Kohana::lang('admin.pages.list'); ?>
        </h5>
        <?php
        if(User_Model::IsAllowed($_SESSION['_acl'], 'pages', 'add')->Value==true) {
            echo html::anchor('4dminix/dodaj_strone', html::image('img/admin_default/add-green-40.png', array('alt'=>Kohana::lang('admin.pages.add'), 'title'=>Kohana::lang('admin.pages.add'), 'class'=>'add_button')), array('title'=>Kohana::lang('admin.pages.add')));
        } ?>
        <div style="float:right;">
            <?php echo Kohana::lang('admin.pages.page_search'); ?>:
            <input type="text" name="page_search" id="page_search" />
            <?php echo Kohana::lang('admin.lang'); ?>:
            <?php echo form::dropdown(array('name'=>'lang', 'id'=>'pages_in_language'),$languages); ?>
        </div>
    </div>
<?php
}
if(!empty($pages) && $pages->count()>0) {
?>
    <?php if(!request::is_ajax()) { ?>
    <?php echo form::open('4dminix/usun_strone/'); ?>
    
    <?php } ?>
    <table id="pages_list" class="table_view" >
        <tr>
            <th><?php echo form::checkbox(array('name' => 'pages_check_all', 'class' => 'check_all')); ?></th>
            <th>
            <?php 
            	echo Kohana::lang('admin.pages.name_page');           		
           		layer::GetSort('pages_orderby', 1, 2, '/4dminix/strony');            
           	?>
           	</th>
            <th>
            <?php 
            	echo Kohana::lang('admin.lang');
            	layer::GetSort('pages_orderby', 3, 4, '/4dminix/strony');             
            ?>
			</th>
            <th>
            <?php 
            	echo Kohana::lang('admin.add_date');
            	layer::GetSort('pages_orderby', 5, 6, '/4dminix/strony');            
            ?>
            </th>
            <th>
            <?php 
            	echo Kohana::lang('admin.mod_date'); 
            	layer::GetSort('pages_orderby', 7, 8, '/4dminix/strony');            
            ?>
            </th>            
            <th>
            <?php 
            	echo Kohana::lang('admin.status'); 
            	layer::GetSort('pages_orderby', 9, 10, '/4dminix/strony');            

            ?>
            </th>            
            <th><?php echo Kohana::lang('admin.options'); ?></th>
        </tr>
    <?php
    foreach($pages as $page) {
    ?>
        <tr>
            <td><?php echo form::checkbox(array('name' => 'pages_check[]', 'class' => 'check', 'value' => $page->id_page )); ?></td>
            <td><?php echo $page->name_page; ?></td>
            <td><?php echo Kohana::lang('language.'.$page->description); ?></td>
            <td><?php echo date(config::DATE_FORMAT, $page->date_added); ?></td>
            <td><?php echo (!empty($page->modified_date)) ? date(config::DATE_TIME_FORMAT, $page->modified_date) : '-'; ?></td>
            <td>
                <?php //echo $page->available == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('pages.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('pages.disabled'))); ?>
                <a href="#" class="changeStatus" id="page-<?php echo $page->id_page; ?>"><?php
                    echo ($page->available == 'Y') ? 
                            html::image('img/icons/tick.png', array('alt' => Kohana::lang('pages.enabled'))) : 
                            html::image('img/icons/cross.png', array('alt' => Kohana::lang('pages.disabled'))); 
                ?></a>
            </td>            
            <td>
                <?php 
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'pages', 'edit')->Value==true){
                        echo html::anchor('4dminix/strona/'.$page->id_page, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
                    }                    
                        echo html::anchor($page->url, Kohana::lang('admin.view'), array('target' => '_blank', 'title' =>Kohana::lang('admin.pages.preview'), 'class' => 'btn btn-view')); 

                    if(User_Model::IsAllowed($_SESSION['_acl'], 'pages', 'delete')->Value==true){
                        echo html::anchor('4dminix/usun_strone/'.$page->id_page, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete')));
                    }
                ?>
                
            </td>
        </tr>

    <?php
    }
    ?>
    </table>
    <?php if(!request::is_ajax()) { ?>
    <div class="delete_selected">
    <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'pages', 'delete')->Value==true){
    		echo Kohana::lang('admin.selected'); ?>:     		 
			
			<button name="delete_pages" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>


    <?php } ?>
    </div>
    <?php echo form::close(); ?>
    <?php } ?>
<?php
}
else { ?>
    <div class="info"><?php echo Kohana::lang('pages.no_pages'); ?></div>
<?php }
if(!request::is_ajax()) { ?>
</div>
<?php echo $oPagination; ?>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('.changeStatus').click(function(){
            var page = $(this);
            var id = parseInt(page.attr('id').split('-')[1]);
            $.get("<?php echo url::base() . 'pages_ajax/change_status';?>", 
            { id_page: id }, 
            function(result){
                if(result == 'Y'){
                    $('img', page).attr({'src':"<?php echo url::file('img/icons/tick.png');?>", 'alt':"<?php echo Kohana::lang('pages.enabled');?>"});
                }
                else if(result == 'N'){
                    $('img', page).attr({'src':"<?php echo url::file('img/icons/cross.png');?>", 'alt':"<?php echo Kohana::lang('pages.disabled');?>"});
                }
            });            
            
            return false;
        });                
        
    });  
    
</script>
