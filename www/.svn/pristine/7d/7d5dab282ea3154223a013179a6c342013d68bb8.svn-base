<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'edit',
            'sTitle' => Kohana::lang('pages.edit_page')
        ))->render(TRUE);
?>
<div id="admin_pages_view">
    <?php
    echo form::open_multipart(null, array('id' => 'form_edit_pages'));
    foreach ($pages as $page) {
        ?>
        <table class="table_form">
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('admin.pages.name_page'); ?></td>
                <td><input type="text" name="name_page" id="add_pages_name_page" value="<?php
                    if (!empty($_POST['name_page'])) {
                        echo $_POST['name_page'];
                    } else {
                        echo $page->name_page;
                    }
                    ?>" /></td>
                <td><div id="name_page_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('admin.lang'); ?>     
                </td>
                <td><?php echo form::dropdown(array('name' => 'lang', 'id' => 'add_pages_language'), $languages, !empty($_POST['lang']) ? $_POST['lang'] : $page->lang ); ?></td>
                <td><div id="lang_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('pages.parent_id'); ?></td>
                <td><?php echo form::dropdown(array('name' => 'parent_id', 'id' => 'add_pages_pages'), $parent, !empty($_POST['parent_id']) ? $_POST['parent_id'] : $page->parent_id); ?></td>
                <td><div id="parent_id_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">
                    <span class="show_page_details"><?php echo Kohana::lang('pages.page_details') . '»»'; ?></span>
                </td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <table id="page_details" class="table_form" <?php //if(!empty($_POST['page_details']) ) { echo 'style="display:block"'; } else { echo 'style="display:none;"'; }   ?> >
            <tr>
                <td class="td_form_left">
                    <label for="image">Zdięcie na strone</label>
                </td>
                <td>
                    <?php
                    if (!empty($page->filename)) {
                        echo html::image(pages_helper::THUMB_PATH . $page->filename, array('style' => 'border: 1px solid #afafaf; padding: 2px; display:block;'));
                    }
                    ?>
                    <input type="file" name="image" id="image" accept="image/gif, image/jpeg, image/png, image/pjpeg, image/x-png, image/bmp" />

                </td>
                <td><div id="producer_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left"><?php echo Kohana::lang('pages.available'); ?></td>
                <td>
                    <select name="available">
                        <option value="Y"><?php echo Kohana::lang('pages.page_available'); ?></option>
                        <option value="N" <?php
                    if ((!empty($_POST['available']) && $_POST['available'] == 'N') || $page->available == 'N') {
                        echo 'selected="selected"';
                    }
                    ?>><?php echo Kohana::lang('pages.page_not_available'); ?></option>
                    </select>
                </td>
                <td><div id="error_available" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">
                    <label for="page_position"><?php echo Kohana::lang('pages.page_position'); ?></label>
                    <span class="label_comment"><?php echo Kohana::lang('pages.comments.page_position'); ?></span>
                </td>
                <td><input type="text" name="page_position" id="add_pages_page_position" value="<?php
                    if (!empty($_POST['page_position'])) {
                        echo $_POST['page_position'];
                    } else if (!empty($page->page_position)) {
                        echo $page->page_position;
                    } else {
                        echo '0';
                    }
                    ?>" /></td>
                <td><div id="error_page_position" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">
                    <label for="meta_title"><?php echo Kohana::lang('pages.meta_title'); ?></label>
                    <span class="label_comment"><?php echo Kohana::lang('pages.comments.meta_title'); ?></span>
                </td>
                <td><input type="text" name="meta_title" id="add_pages_meta_title" value="<?php
                       if (!empty($_POST['meta_title'])) {
                           echo $_POST['meta_title'];
                       } else {
                           echo $page->meta_title;
                       }
                       ?>" /></td>
                <td><div id="error_meta_title" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">
                    <label for="meta_keywords"><?php echo Kohana::lang('pages.meta_keywords'); ?></label>
                    <span class="label_comment"><?php echo Kohana::lang('pages.comments.meta_keywords'); ?></span>
                </td>
                <td><textarea name="meta_keywords" cols="40" rows="5" id="add_pages_meta_keywords" ><?php
                       if (!empty($_POST['meta_keywords'])) {
                           echo $_POST['meta_keywords'];
                       } else {
                           echo $page->meta_keywords;
                       }
                    ?></textarea></td>
                <td><div id="error_meta_kewords" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">
                    <label for="meta_description"><?php echo Kohana::lang('pages.meta_description'); ?></label>
                    <span class="label_comment"><?php echo Kohana::lang('pages.comments.meta_description'); ?></span>
                </td>
                <td><textarea name="meta_description" cols="40" rows="5" id="add_pages_meta_description" ><?php
            if (!empty($_POST['meta_description'])) {
                echo $_POST['meta_description'];
            } else {
                echo $page->meta_description;
            }
            ?></textarea></td>
                <td><div id="error_meta_description" class="error_message"></div></td>
            </tr>
            <?php /*
              <tr>
              <td class="td_form_left"><?php echo Kohana::lang('pages.meta_author'); ?></td>
              <td><input type="text" name="meta_author" id="add_pages_meta_author" value="<?php if(!empty($_POST)) { echo $_POST['meta_author']; } else { echo $page->meta_author; } ?>" /></td>
              <td><div id="error_meta_author" class="error_message"></div></td>
              </tr>
              <tr>
              <td class="td_form_left"><?php echo Kohana::lang('pages.meta_generator'); ?></td>
              <td><input type="text" name="meta_generator" id="add_pages_meta_generator" value="<?php if(!empty($_POST)) { echo $_POST['meta_generator']; } else { echo $page->meta_generator; } ?>" /></td>
              <td><div id="error_meta_generator" class="error_message"></div></td>
              </tr>
              <tr>
              <td class="td_form_left"><?php echo Kohana::lang('pages.meta_robots'); ?></td>
              <td><input type="text" name="meta_robots" id="add_pages_meta_robots" value="<?php if(!empty($_POST)) { echo $_POST['meta_robots']; } else { echo $page->meta_robots; } ?>" /></td>
              <td><div id="error_meta_author" class="error_message"></div></td>
              </tr>
             *
             */ ?>
            <tr>
                <td class="td_form_left">
                    <label for="url">Przyjazny url</label>
                    <span class="label_comment">Wpisz alias dla tej podstrony. Jeśli nie wpiszesz, alias zostanie utworzony na podstawie nazwy strony.</span>
                </td>
                <td><input type="text" name="url" id="url" value="<?php
                                if (!empty($_POST['url'])) {
                                    echo $_POST['url'];
                                } else {
                                    echo $page->url;
                                }
                                ?>" /></td>
                <td><div id="error_url" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">Ukryj w menu</td>
                <td>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="show_in_menu" value="0" <?php
                                if ((!empty($_POST['show_in_menu']) && $_POST['show_in_menu'] == 0) || $page->show_in_menu == 0) {
                                    echo 'checked="checked"';
                                }
                                ?> /></td>
                            <td>Ukryj stronę w menu</td>
                        </tr>
                    </table>
                </td>
                <td><div id="parent_id_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">
                    Wyłącz link do strony
                    <span class="label_comment">Strona będzie mogła być widoczna w menu, ale nie będzie linkiem.</span>
                </td>
                <td>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="menu_link_off" value="1" <?php
                                if ((!empty($_POST['menu_link_off']) && $_POST['menu_link_off'] == '1') || $page->menu_link_off == 1) {
                                    echo 'checked="checked"';
                                }
                                ?> /></td>
                            <td>Wyłącz link do strony.</td>
                        </tr>
                    </table>
                </td>
                <td><div id="parent_id_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">Strona główna</td>
                <td>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="homepage" value="1" <?php
                                if ((!empty($_POST['homepage']) && $_POST['homepage'] == 1) || $page->homepage == 1) {
                                    echo 'checked="checked" disabled="disabled"';
                                }
                                ?> /></td>
                            <td>Ustaw jako strona główna</td>
                        </tr>
                    </table>
                </td>
                <td><div id="parent_id_error" class="error_message"></div></td>
            </tr>
            <tr>
                <td class="td_form_left">Typ strony</td>
                <td>
        <?php $aTypes = array('cms' => 'Zwykła strona', 'link' => 'Strona jako link', 'shop' => 'Strona sklepu'); ?>
        <?php echo form::dropdown('page_type', $aTypes, (!empty($_POST['page_type']) ? $_POST['page_type'] : $page->page_type)); ?>
                </td>
                <td><div id="parent_id_error" class="error_message"></div></td>
            </tr>
        </table>
        <br /><br />
        <table>
            <tr>
                <td style="width: 200px;">
                    <input type="button" value="<?php echo Kohana::lang('pages.back'); ?>" name="back" class="btn btn-back" />
                </td>
                <td>
                    <input type="hidden" value="settings" name="type_name" />
                    <input type="submit" value="<?php echo Kohana::lang('pages.save'); ?>" name="submit" class="btn btn-save" />
                    <input type="submit" value="<?php echo Kohana::lang('pages.save_back'); ?>" name="submit_back" class="btn btn-save-and-back" />
                </td>
            </tr>
        </table>
    <?php
}
echo form::close();
?>
</div>