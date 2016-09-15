<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'edit',
            'sTitle' => Kohana::lang('news.edit_news')
        ))->render(TRUE);
?>
<div id="admin_news_view">
    <?php echo form::open_multipart(null, array('id' => 'form_edit_news')); ?>

    <table class="table_form">
        <tr>
            <td></td>
            <td>  
                <?php foreach ($newsimages as $img) : ?>
                    <?php if (!empty($img->filename)): // jesli jest foto dajemy mozliwosc jego usuniecia  ?>



                        <span id="news_image_<?php echo $img->id_news_images; ?>"><?php echo html::image('files/news/small/' . $img->filename, array('alt' => $img->alt)); ?></span>
                        <?php echo html::image('img/icons/cross.png', array('alt' => Kohana::lang('news.delete'), 'id' => 'delete_news_image_' . $img->id_news_images, 'style' => 'cursor:pointer')); ?>



                        <?php
                    endif;
                endforeach;
                ?>
            </td>
        </tr>
        <?php foreach ($news as $ns) { ?>
            <tr>
                <td></td>
                <td>  

                    <?php if (!empty($ns->mainfilename)): ?>
                        <span id="news_image_main"><?php echo html::image('files/news/small/' . $ns->mainfilename); ?></span>
                        <?php echo html::image('img/icons/cross.png', array('alt' => Kohana::lang('news.delete'), 'id' => 'delete_news_image_main', 'style' => 'cursor:pointer')); ?>


                        <?php
                    endif;
                    ?>
                        <input type="hidden" id="del_main_image" name="del_main_image" value="0" />
                    <script>
                        $('#delete_news_image_main').click(function() {
                            $('#news_image_main').hide();
                            $('#del_main_image').attr('value','1');
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('news.add_photo'); ?> główne</td>
                <td><input type="file" name="mainphoto"  id="add_news_photo" /></td>
                <td><div id="error_photo" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('news.photo'); ?></td>
                <td>
                    <input type="file" multiple name="photo[]" id="add_news_photo" />
                </td>
                <td>
                    <div id="error_photo" class="error_message"></div>
                </td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('news.add_photo_alt'); ?></td>
                <td><input type="text" name="alt" id="add_photo_alt" value="<?php
                    if (!empty($_POST)) {
                        echo $_POST['alt'];
                    } else {
                        echo $ns->alt;
                    }
                    ?>" /></td>
                <td><div id="error_alt_photo" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('news.title'); ?></td>
                <td>
                    <input name="title" id="add_news_title" value="<?php
                    if (!empty($_POST)) {
                        echo $_POST['title'];
                    } else {
                        echo $ns->title;
                    }
                    ?>" />
                </td>
                <td><div id="title_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('news.language'); ?></td>
                <td><?php echo form::dropdown(array('name' => 'lang', 'id' => 'add_news_language', 'class' => 'news_language_check'), $languages, !empty($_POST) ? $_POST['lang'] : $ns->lang); ?></td>
                <td><div id="language_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('news.news_categories'); ?></td>
                <td><?php echo form::dropdown(array('name' => 'news_categories[]', 'multiple' => 'multiple', 'id' => 'add_news_news_categories', 'class' => 'news_category_check'), $aNewsCategories, !empty($_POST) ? $_POST['news_categories'] : $aNewsCategoriesSelected); ?>*</td>
                <td><div id="news_categories_error" class="error_message"></div></td>
            </tr>
            
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('news.description'); ?></td>
                <td>
                    <textarea class="tinyText" name="description" cols="40" rows="5" id="add_news_description"><?php
                        if (!empty($_POST)) {
                            echo $_POST['description'];
                        } else {
                            echo $ns->description;
                        }
                        ?></textarea>
                </td>
                <td><div  id="description_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">Dodatkowy opis</td>
                <td>
                    <textarea class="tinyText" name="short_description" cols="40" rows="5" id="add_news_short_description"><?php
                        if (!empty($_POST)) {
                            echo $_POST['short_description'];
                        } else {
                            echo $ns->short_description;
                        }
                        ?></textarea>
                </td>
                <td><div id="short_description_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('news.available'); ?></td>
                <td>
                    <select name="available">
                        <option value="1" <?php
                        if ((isset($_POST['available']) && $_POST['available'] == 1) || (isset($ns->available) && $ns->available == 1)) {
                            echo 'selected="selected"';
                        }
                        ?>><?php echo Kohana::lang('news.available_true'); ?></option>
                        <option value="0" <?php
                        if ((isset($_POST['available']) && $_POST['available'] == 0) || (isset($ns->available) && $ns->available == 0)) {
                            echo 'selected="selected"';
                        }
                        ?>><?php echo Kohana::lang('news.available_false'); ?></option>
                    </select>
                </td>
                <td><div id="available_error" class="error_message"></div></td>
            </tr>

            <tr>
                <td class="td_form_left"><?php echo "Wyświetlana data dodania"; ?></td>
                <td><input type="text" name="date_added" id="date_added" class="datepicker" value="<?php
                    if (!empty($_POST)) {
                        echo $_POST['date_added'];
                    } else if (!empty($ns->date_added)) {
                        echo date(config::DATE_FORMAT, $ns->date_added);
                    }
                    ?>" /></td>
                <td><div id="news_start_date_error" class="error_message"></div></td>
            </tr>

            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('news.news_start_date'); ?></td>
                <td><input type="text" name="news_start_date" id="news_start_date" class="datepicker" value="<?php
                    if (!empty($_POST)) {
                        echo $_POST['news_start_date'];
                    } else if (!empty($ns->news_start_date)) {
                        echo date(config::DATE_FORMAT, $ns->news_start_date);
                    }
                    ?>" /></td>
                <td><div id="news_start_date_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('news.news_end_date'); ?></td>
                <td><input type="text" name="news_end_date" id="news_end_date" class="datepicker" value="<?php
                    if (!empty($_POST)) {
                        echo $_POST['news_end_date'];
                    } else if (!empty($ns->news_end_date)) {
                        echo date(config::DATE_FORMAT, $ns->news_end_date);
                    }
                    ?>" /></td>
                <td><div id="news_end_date_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">
                    <label for="url"><?php echo Kohana::lang('pages.url'); ?></label>
                    <span class="label_comment"><?php echo Kohana::lang('pages.comments.url'); ?></span>
                </td>
                <td>
                    <input type="text" name="url" id="add_news_url" value="<?php
                    if (!empty($_POST['url'])) {
                        echo $_POST['url'];
                    } else {
                        echo $ns->url;
                    }
                    ?>" />
                </td>
                <td><div id="error_url" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">
                    <label for="meta_title"><?php echo Kohana::lang('pages.comments.meta_title'); ?></label>
                </td>
                <td>
                    <input type="text" name="meta_title" id="add_pages_meta_title" value="<?php
                    if (!empty($_POST['meta_title'])) {
                        echo $_POST['meta_title'];
                    } else {
                        echo $ns->meta_title;
                    }
                    ?>" />
                </td>
                <td><div id="error_meta_title" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">
                    <label for="meta_keywords"><?php echo Kohana::lang('pages.comments.meta_keywords'); ?></label>
                </td>
                <td>
                    <textarea name="meta_keywords" cols="40" rows="5" id="add_pages_meta_keywords" ><?php
                        if (!empty($_POST['meta_keywords'])) {
                            echo $_POST['meta_keywords'];
                        } else {
                            echo $ns->meta_keywords;
                        }
                        ?></textarea>
                </td>
                <td><div id="error_meta_kewords" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">
                    <label for="meta_description"><?php echo Kohana::lang('pages.comments.meta_description'); ?></label>
                </td>
                <td>
                    <textarea name="meta_description" cols="40" rows="5" id="add_pages_meta_description" ><?php
                        if (!empty($_POST['meta_description'])) {
                            echo $_POST['meta_description'];
                        } else {
                            echo $ns->meta_description;
                        }
                        ?></textarea>
                </td>
                <td><div id="error_meta_description" class="error_message"></div></td>
            </tr>

            <tr>
                <td><input type="button" value="<?php echo Kohana::lang('news.back'); ?>" name="back" class="btn btn-back" />
                </td>
                <td>
                    <?php /* <input type="hidden" value="<?php echo $ns->element_id; ?>" name="type_id[<?php echo $ns->element_id; ?>]" />
                      <input type="hidden" value="<?php echo $ns->type; ?>" name="type_name[<?php echo $ns->element_id; ?>]" /> */ ?>
                    <input type="submit" value="<?php echo Kohana::lang('news.save'); ?>" name="submit" class="btn btn-save" />
                    <input type="submit" value="<?php echo Kohana::lang('news.save_back'); ?>" name="submit_back" class="btn btn-save-and-back" />
                </td>
            </tr>
        </table>
        <?php
    }
    echo form::close();
    ?>
</div>
<?php if (!empty($news) && $news->count() > 0 && !empty($news[0]->comments)) : ?>
    <div id="news_comments" style="margin:50px 0px;">
        <h3>
            Komentarze
        </h3>
        <?php if (!empty($oNewsComments) AND $oNewsComments->count() > 0) : ?>
            <table class="table_view">
                <thead>
                    <tr>
                        <th><?php echo Kohana::lang('news.nick'); ?></th>
                        <th><?php echo Kohana::lang('news.comment'); ?></th>
                        <th><?php echo Kohana::lang('news.ip_address'); ?></th>
                        <th><?php echo Kohana::lang('news.options'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($oNewsComments as $oComment) : ?>
                        <tr>
                            <td><?php echo $oComment->nick; ?></td>
                            <td><?php echo $oComment->comment; ?></td>
                            <td><?php echo $oComment->client_ip; ?></td>
                            <td>
                                <?php echo html::anchor('4dminix/usun_komentarz/' . $oComment->id_news_comment, Kohana::lang('admin.delete'), array('title' => 'Czy napewno chcesz usunąć?', 'class' => 'btn btn-delete')); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="info">Brak komentarzy.</div>
        <?php endif; ?>
    </div>
<?php endif; ?>