<div id="admin_news_view">
     <div class="options">
             <h5><?php echo Kohana::lang('admin.news.categories'); ?></h5>
         <?php 
            if(User_Model::IsAllowed($_SESSION['_acl'], 'news_categories', 'add')->Value==true){
                echo html::anchor('4dminix/dodaj_kategorie_aktualnosci', html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('admin.news.add_category'), 'class'=>'add_button', 'id'=>'add_news_button')));
                echo html::anchor('4dminix/dodaj_kategorie_aktualnosci', Kohana::lang('admin.news.add_category'), array('class'=>'add_text', 'id'=>'add_news_button'));
            }
            if(User_Model::IsAllowed($_SESSION['_acl'], 'news', 'add')->Value==true){
                echo html::anchor('4dminix/dodaj_aktualnosc/', html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('admin.news.add'), 'class'=>'add_button', 'id'=>'add_news_button')));
                echo html::anchor('4dminix/dodaj_aktualnosc/', Kohana::lang('admin.news.add'), array('class'=>'add_text', 'id'=>'add_news_button'));
            }
         ?>
    </div>
    <?php if(!empty($oNewsCategories) && $oNewsCategories->count()>0) { ?>
    <div id="news_table">
        <?php echo form::open('4dminix/usun_kategorie_aktualnosci/'); ?>
        <table id="news_list" class="table_view">
            <tr>
                <th><input type="checkbox" name="news_category_check_all" id="news_category_check_all" class="check_all" value="1" /></th>
                <th>
                <?php 
                	echo Kohana::lang('admin.title');
                	layer::GetSort('cat_orderby', 1, 2, '/4dminix/kategorie_aktualnosci');             
            	?>
            	</th>
                <th>
                <?php 
                	echo Kohana::lang('admin.lang'); 
                	layer::GetSort('cat_orderby', 3, 4, '/4dminix/kategorie_aktualnosci');
            	?>
            	</th>
                <th>
                <?php 
                	echo Kohana::lang('admin.add_date'); 
                	layer::GetSort('cat_orderby', 5, 6, '/4dminix/kategorie_aktualnosci');
                ?>
                </th>
                <th>
                <?php 
                	echo Kohana::lang('admin.mod_date'); 
                	layer::GetSort('cat_orderby', 7, 8, '/4dminix/kategorie_aktualnosci');
                ?>
                </th>
                <th><?php echo Kohana::lang('admin.news.comments'); ?></th>
                <th>
                <?php 
                	echo Kohana::lang('admin.status'); 
                	layer::GetSort('cat_orderby', 9, 10, '/4dminix/kategorie_aktualnosci');
                ?>
                </th>
                <th><?php echo Kohana::lang('admin.options'); ?></th>
            </tr>
        <?php
        foreach($oNewsCategories as $ns) {
        ?>
            <tr>
                <td><input type="checkbox" name="news_category_check[]" class="check" value="<?php echo $ns->id_news_category; ?>" /></td>
                <td><?php echo html::anchor(('4dminix/aktualnosci/'.$ns->id_news_category), $ns->news_category_name); ?></td>
                <td><?php echo Kohana::lang('language.'.$ns->lang); ?></td>
                <td><?php echo date(config::DATE_FORMAT, $ns->date_added); ?></td>
                <td><?php echo (!empty($ns->modified_date)) ? date(config::DATE_TIME_FORMAT, $ns->modified_date) : '-'; ?></td>
                <td>
                    <?php if(!empty($ns->comments)) { echo html::image('img/icons/tick.png', array('alt'=>Kohana::lang('admin.on'))); } else { echo html::image('img/icons/cross.png', array('alt'=>Kohana::lang('admin.off'))); } ?>
                </td>
                <td>
                    <?php if(!empty($ns->available)) { echo html::image('img/icons/tick.png', array('alt'=>Kohana::lang('admin.on'))); } else { echo html::image('img/icons/cross.png', array('alt'=>Kohana::lang('admin.off'))); } ?>
                </td>
                <td>
                    <?php
                        if(User_Model::IsAllowed($_SESSION['_acl'], 'news_categories', 'edit')->Value==true){
                        	echo html::anchor('4dminix/edytuj_kategorie_aktualnosci/'.$ns->id_news_category, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
                        }
                        if(User_Model::IsAllowed($_SESSION['_acl'], 'news_categories', 'delete')->Value==true){
                        	echo html::anchor('4dminix/usun_kategorie_aktualnosci/'.$ns->id_news_category, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete')));
                        }
                    ?>                    
                </td>
            </tr>

        <?php
        }
        ?>
        </table>
        <div class="delete_selected">
    	<?php if(User_Model::IsAllowed($_SESSION['_acl'], 'news_categories', 'delete')->Value==true){
    		echo Kohana::lang('admin.selected'); ?>:     		
			<button name="delete_news" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>

    	<?php } ?>
    	</div>
    
        <?php echo form::close(); ?>
        <?php
            //echo $pagination;
        ?>
    </div>
    <?php } else { ?>
    <div class="info"><?php echo Kohana::lang('admin.news.no_categories'); ?></div>
    <?php } ?>
</div>
<?php echo $oPagination;?>
<div id="form_action"></div>