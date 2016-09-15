<div id="admin_news_view">
    <div class="options">
        <?php
            if(User_Model::IsAllowed($_SESSION['_acl'], 'news', 'add')->Value==true){
                echo html::anchor('4dminix/dodaj_aktualnosc'.((!empty($iCategoryId) && !empty($iPageId)) ? '/'.$iCategoryId.'/'.$iPageId : ''), html::image('img/admin_default/newobject.gif', array('alt'=>Kohana::lang('news.add_news'), 'class'=>'add_button', 'id'=>'add_news_button')));
                echo html::anchor('4dminix/dodaj_aktualnosc'.((!empty($iCategoryId) && !empty($iPageId)) ? '/'.$iCategoryId.'/'.$iPageId : ''), Kohana::lang('news.add_news'), array('class'=>'add_text', 'id'=>'add_news_button'));
            }            
        ?>
    </div>
    <?php if(!empty($news) && $news->count()>0) { ?>
    <div id="news_table">
        <?php echo form::open('4dminix/usun_aktualnosc/'); ?>
        <input type="hidden" name="category_id" value="<?php echo $iCategoryId; ?>" />
        <input type="hidden" name="page_id" value="<?php echo $iPageId; ?>" />
        <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'news', 'delete')->Value==true):?>
			<div class="delete_selected">
				<?php echo Kohana::lang('news.selected'); ?>: <input type="submit" name="delete_news" value="<?php echo Kohana::lang('news.delete'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  />
			</div>
		<?php endif;?>		
        <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'news', 'index')->Value==true):?>
        <table id="news_list" class="table_view">
            <tr>
                <th><input type="checkbox" name="news_check_all" id="news_check_all" class="check_all" value="1" /></th>
                <th><?php echo Kohana::lang('news.photo'); ?></th>
                <th><?php echo Kohana::lang('news.title'); ?></th>
                <th><?php echo Kohana::lang('news.language'); ?></th>
                <th><?php echo Kohana::lang('news.add_date'); ?></th>
                <th><?php echo Kohana::lang('news.modified_date'); ?></th>
                <th><?php echo Kohana::lang('news.available'); ?></th>
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
                                echo html::image('files/news/small/'.$ns->mainfilename, array('alt'=>$ns->alt, 'style'=>'width:50px;'));
                            }
                            ?>
                </td>
                <td><?php echo $ns->title; ?></td>
                <td><?php echo Kohana::lang('language.'.$ns->lang); ?></td>
                <td><?php echo date(config::DATE_FORMAT, $ns->date_added); ?></td>
                <td><?php echo (!empty($ns->modified_date)) ? date(config::DATE_TIME_FORMAT, $ns->modified_date) : '-'; ?></td>
                <td>
                    <?php //echo $ns->available == 1 ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('news.enabled'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('news.disabled'))); ?>
                    <a href="#" class="changeStatus" id="news-<?php echo $ns->id_news; ?>"><?php
                    echo ($ns->available == 1) ? 
                            html::image('img/icons/tick.png', array('alt' => Kohana::lang('news.enabled'))) : 
                            html::image('img/icons/cross.png', array('alt' => Kohana::lang('news.disabled'))); 
                    ?></a>
                </td>
                <td>
                        <?php 
						if(User_Model::IsAllowed($_SESSION['_acl'], 'news', 'edit')->Value==true) {
							echo html::anchor('4dminix/edytuj_aktualnosc/'.$ns->id_news.((!empty($iCategoryId) && !empty($iPageId)) ? '/'.$iCategoryId.'/'.$iPageId : ''),html::image('img/icons/edit.gif', array('alt'=>Kohana::lang('news.edit'), 'id'=>'edit_news_button_'.$ns->id_news))); 
						}
						?>
                        <?php 
						if(User_Model::IsAllowed($_SESSION['_acl'], 'news', 'delete')->Value==true) {
							echo html::anchor('4dminix/usun_aktualnosc/'.$ns->id_news.((!empty($iCategoryId) && !empty($iPageId)) ? '/'.$iCategoryId.'/'.$iPageId : ''), html::image('img/icons/delete.gif', array('alt'=>Kohana::lang('news.delete'), 'id'=>'delete_news_button')), array('class'=>'delete_button', 'title'=>Kohana::lang('news.delete_button_info')));
						} 
						?>
                </td>
            </tr>

                    <?php
                }
                ?>
        </table>
        <?php endif;?>
			<?php if(User_Model::IsAllowed($_SESSION['_acl'], 'news', 'delete')->Value==true):?>
				<div class="delete_selected">
					<?php echo Kohana::lang('news.selected'); ?>: <input type="submit" name="delete_news" value="<?php echo Kohana::lang('news.delete'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  />
				</div>
			<?php endif;?>
        <?php echo form::close(); ?>
            <?php echo $pagination; ?>
    </div>
    <?php } else { ?>
    <div class="info"><?php echo Kohana::lang('news.no_news'); ?></div>
    <?php } ?>
    <?php echo form::input(array('class' => 'ui-button ui-widget ui-state-default ui-corner-all', 'name' => 'back', 'value' => 'Wróć', 'type' => 'button')); ?>
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
