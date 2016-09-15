<div id="admin_news_view">
    <div class="options">
        <?php echo html::anchor('4dminix/dodaj_aktualnosc', html::image('img/admin_default/newobject.gif', array('alt'=>'Dodaj nową stronę', 'class'=>'add_button', 'id'=>'add_news_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_aktualnosc', Kohana::lang('news.add_news'), array('class'=>'add_text', 'id'=>'add_news_button')); ?>

    </div>
    <?php if(!empty($news) && $news->count()>0) { ?>
    <div id="news_table">
        <table id="news_list" class="table_view">
            <tr>
                <th>#</th>
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
                <td><?php echo $ns->id_news; ?></td>
                <td>
                            <?php
                            if(!empty($ns->filename)) {
                                echo html::image('files/news/small/'.$ns->filename, array('alt'=>$ns->alt, 'style'=>'width:50px;'));
                            }
                            ?>
                </td>
                <td><?php echo $ns->title; ?></td>
                <td><?php echo Kohana::lang('language.'.$ns->language_description); ?></td>
                <td><?php echo date(config::DATE_FORMAT, $ns->date_added); ?></td>
                <td><?php echo (!empty($ns->modified_date)) ? date(config::DATE_TIME_FORMAT, $ns->modified_date) : '-'; ?></td>
                <td><?php echo $ns->available; ?></td>
                <td>
                            <?php echo html::image('img/icons/edit.gif', array('alt'=>Kohana::lang('news.edit'), 'id'=>'edit_news_button_'.$ns->id_news, 'class' => 'click')); ?>
                            <?php echo html::anchor('4dminix/edytuj_aktualnosc/'.$ns->id_news,html::image('img/icons/edit.gif', array('alt'=>Kohana::lang('news.edit'), 'id'=>'edit_news_button_'.$ns->id_news))); ?>
                            <?php echo html::anchor('4dminix/usun_aktualnosc/'.$ns->id_news, html::image('img/icons/delete.gif', array('alt'=>Kohana::lang('news.delete'), 'id'=>'delete_news_button')), array('class'=>'delete_button', 'title'=>Kohana::lang('news.delete_button_info'))); ?>
                </td>
            </tr>

                    <?php
                }
                ?>
        </table>
            <?php
            echo $pagination;
            ?>
    </div>
    <?php } else { ?>
    <div class="info"><?php echo Kohana::lang('news.no_news'); ?></div>
    <?php } ?>
</div>
<div id="form_action"></div>