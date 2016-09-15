
     <div class="options">
         <h5><?php echo Kohana::lang('news.category_news_list'); if(isset($sNewsCategoryName)) { echo '"'.$sNewsCategoryName.'"'; } ?></h5>
         <?php 
         if(User_Model::IsAllowed($_SESSION['_acl'], 'news', 'add')->Value==true){
             echo html::anchor('4dminix/dodaj_aktualnosc/'.$iNewsCategoryId, 
             				   html::image('img/admin_default/newobject.gif', 
             				   array('alt'=>Kohana::lang('admin.news.add_news'), 'class'=>'add_button', 'id'=>'add_news_button', 'title'=>Kohana::lang('admin.news.add_news'))));
             echo html::anchor('4dminix/dodaj_aktualnosc/'.$iNewsCategoryId, 
             				   Kohana::lang('admin.news.add_news'), 
             				   array('class'=>'add_text', 'id'=>'add_news_button'));
         }
         ?>

    </div>
    <?php if(!empty($news) && $news->count()>0) { ?>
    <div id="news_table">
        <?php echo form::open('4dminix/usun_aktualnosc/'); ?>
        <input type="hidden" name="category_id" value="<?php echo $iNewsCategoryId; ?>" />
        <table id="news_list" class="table_view">
            <tr>
                <th><input type="checkbox" name="news_check_all" id="news_check_all" class="check_all" value="1" /></th>
                <th><?php echo Kohana::lang('news.photo'); ?></th>
                <th>
                <?php 
                	echo Kohana::lang('news.title'); 
                	layer::GetSort('news_orderby', 1, 2, '/4dminix/aktualnosci/'.$iNewsCategoryId);                	
                ?>
                </th>
                <th>
                <?php 
                	echo Kohana::lang('news.language'); 
                	layer::GetSort('news_orderby', 3, 4, '/4dminix/aktualnosci/'.$iNewsCategoryId);                	
            	?>
            	</th>
                <th>
                <?php 
                	echo Kohana::lang('news.add_date'); 
                	layer::GetSort('news_orderby', 5, 6, '/4dminix/aktualnosci/'.$iNewsCategoryId);                	
            	?>
            	</th>
                <th>
                <?php 
                	echo Kohana::lang('news.modified_date'); 
                	layer::GetSort('news_orderby', 7, 8, '/4dminix/aktualnosci/'.$iNewsCategoryId);                	
            	?>
                </th>
                <th>
                <?php 
                	echo Kohana::lang('news.publication_date'); 
                	layer::GetSort('news_orderby', 9, 10, '/4dminix/aktualnosci/'.$iNewsCategoryId);                	
            	?>
            	</th>
                <th>
                <?php 
                	echo Kohana::lang('news.available'); 
                	layer::GetSort('news_orderby', 11, 12, '/4dminix/aktualnosci/'.$iNewsCategoryId);                	
            	?>
            	</th>
                <th><?php echo Kohana::lang('news.options'); ?></th>
            </tr>
        <?php
        foreach($news as $ns) {
        ?>
            <tr>
                <td><input type="checkbox" name="news_check[]" class="check" value="<?php echo $ns->id_news; ?>" /></td>
                <td>
                        <?php
                        if(!empty($ns->mainfilename)) {
                            echo html::image('files/news/small/'.$ns->mainfilename, array('alt'=>$ns->alt, 'style'=>'width:50px;', 'class'=>'image'));
                        }
                        ?>
                </td>
                <td><?php echo $ns->title; ?></td>
                <td><?php echo Kohana::lang('language.'.$ns->language_description); ?></td>
                <td><?php echo date(config::DATE_FORMAT, $ns->date_added); ?></td>
                <td><?php echo (!empty($ns->modified_date)) ? date(config::DATE_FORMAT, $ns->modified_date) : '-'; ?></td>
                <td><?php echo (!empty($ns->news_start_date)) ? 'od ' . date(config::DATE_FORMAT, $ns->news_start_date) : '';?>
                    <br/>
                    <?php echo (!empty($ns->news_end_date)) ? 'do ' . date(config::DATE_FORMAT, $ns->news_end_date) : ''; ?>
                </td>
                <td>
                    <?php //if(!empty($ns->available)) { echo html::image('img/icons/tick.png', array('alt'=>Kohana::lang('news.available_true'))); } else { echo html::image('img/icons/cross.png', array('alt'=>Kohana::lang('news.available_false'))); } ?>
                    <a href="#" class="changeStatus" id="news-<?php echo $ns->id_news; ?>"><?php
                    echo ($ns->available == 1) ? 
                            html::image('img/icons/tick.png', array('alt' => Kohana::lang('news.available_true'))) : 
                            html::image('img/icons/cross.png', array('alt' => Kohana::lang('news.available_false'))); 
                    ?></a>
                </td>
                
                <td>
                    <?php 
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'news', 'edit')->Value==true){
						echo html::anchor('4dminix/edytuj_aktualnosc/'.$ns->id_news.'/'.$iNewsCategoryId, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
                    }
                    if(User_Model::IsAllowed($_SESSION['_acl'], 'news', 'delete')->Value==true){
						echo html::anchor('4dminix/usun_aktualnosc/'.$ns->id_news.'/'.$iNewsCategoryId, Kohana::lang('admin.delete'), array('title' =>Kohana::lang('admin.pages.delete'), 'class' => 'btn btn-delete')); 
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
        </table>
			<?php if(User_Model::IsAllowed($_SESSION['_acl'], 'news', 'delete')->Value==true):?>
			<div class="delete_selected">
				<?php echo Kohana::lang('news.selected'); ?>: 
				<button name="delete_news" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
			</div>
			<?php endif;?>
        <?php echo form::close(); ?>
    </div>
    <?php } else { ?>
    <div class="info"><?php echo Kohana::lang('news.no_news'); ?></div>
    <?php } ?>
    <?php echo $oPagination; ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.changeStatus').click(function(){
            var news = $(this);
            var id = parseInt(news.attr('id').split('-')[1]);
            $.get("<?php echo url::base() . 'news_ajax/change_status';?>", 
            { id_news: id }, 
            function(result){
                if(result == '1'){
                    $('img', news).attr({'src':"<?php echo url::file('img/icons/tick.png');?>", 'alt':"<?php echo Kohana::lang('news.available_true');?>"});
                }
                else if(result == '0'){
                    $('img', news).attr({'src':"<?php echo url::file('img/icons/cross.png');?>", 'alt':"<?php echo Kohana::lang('news.available_false');?>"});
                }
            });            
            
            return false;
        });
    });
</script>
