<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('pages.add_page')
            ))->render(TRUE);
?>
<div id="admin_pages_view">
    <?php echo form::open_multipart(null, array('id'=>'form_add_pages')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.pages.name_page'); ?></td>
            <td><input type="text" name="name_page" id="add_pages_name_page" value="<?php if(!empty($_POST['name_page'])) { echo $_POST['name_page']; } ?>"  /></td>
            <td><div id="name_page_error" class="error_message"></div></td>

        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('admin.lang'); ?></td>
            <td><?php echo form::dropdown(array('name'=>'lang', 'id'=>'add_pages_language'),$languages, !empty($_POST) ? $_POST['lang'] : ''); ?></td>
            <td><div id="lang_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('pages.parent_id'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'parent_id', 'id' => 'add_pages_pages'),$pages, !empty($_POST) ? $_POST['parent_id'] : ''); ?></td>
            <td><div id="parent_id_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('pages.elements'); ?></td>
            <td>
                <table>
                    <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'page_content', 'add')->Value==true):?>
                    <tr>
                        <td><input type="checkbox" name="page_content" value="Y" <?php if(!empty($_POST['page_content']) && $_POST['page_content']=='Y') { echo 'checked="checked"'; } ?> /></td>
                        <td><?php echo Kohana::lang('pages.page_content'); ?></td>
                    </tr>
                    <?php endif;?>
                    <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'news', 'add')->Value==true):?>
                    <tr>
                        <td><input type="checkbox" name="news" value="Y" <?php if(!empty($_POST['news']) && $_POST['news']=='Y') { echo 'checked="checked"'; } ?> /></td>
                        <td><?php echo Kohana::lang('pages.news'); ?></td>
                    </tr>
                    <?php endif;?>
                    <?php if(User_Model::IsAllowed($_SESSION['_acl'], 'galleries', 'add')->Value==true):?>
                    <tr>
                        <td><input type="checkbox" name="gallery" value="Y" <?php if(!empty($_POST['gallery']) && $_POST['gallery']=='Y') { echo 'checked="checked"'; } ?> /></td>
                        <td><?php echo Kohana::lang('pages.gallery'); ?></td>
                    </tr>
                    <?php endif;?>
                </table>
            </td>
            <td><div id="parent_id_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <span class="show_page_details"><?php echo Kohana::lang('pages.page_details'). '»»'; ?></span>
            </td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table id="page_details" class="table_form" <?php //if(!empty($_POST['page_details'])) { echo 'style="display:block"'; } else { echo 'style="display:none;"'; } ?> >
         <tr>
            <td class="td_form_left">
                <label for="image">Zdjęcie na stronę</label>
            </td>
            <td>
                <input type="file" name="image" id="image" accept="image/gif, image/jpeg, image/png, image/pjpeg, image/x-png, image/bmp" />
            </td>
            <td><div id="producer_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('pages.available'); ?></td>
            <td>
                <select name="available">
                    <option value="Y"><?php echo Kohana::lang('pages.page_available'); ?></option>
                    <option value="N" <?php if(!empty($_POST) && $_POST['available']=='N') { echo 'selected="selected"'; } ?>><?php echo Kohana::lang('pages.page_not_available'); ?></option>
                </select>
            </td>
            <td><div id="error_available" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="page_position"><?php echo Kohana::lang('pages.page_position'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('pages.comments.page_position'); ?></span>
            </td>
            <td><input type="text" name="page_position" id="add_pages_page_position" value="<?php if(!empty($_POST)) { echo $_POST['page_position']; } else { echo '0'; } ?>" /></td>
            <td><div id="error_page_position" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="meta_title"><?php echo Kohana::lang('pages.meta_title'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('pages.comments.meta_title'); ?></span>
            </td>
            <td><input type="text" name="meta_title" id="add_pages_meta_title" value="<?php if(!empty($_POST)) { echo $_POST['meta_title']; }  ?>" /></td>
            <td><div id="error_meta_title" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="meta_keywords"><?php echo Kohana::lang('pages.meta_keywords'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('pages.comments.meta_keywords'); ?></span>
            </td>
            <td>
                <textarea name="meta_keywords" cols="40" rows="5" id="add_pages_meta_keywords" ><?php if(!empty($_POST)) { echo $_POST['meta_keywords']; }  ?></textarea>
            </td>
            <td><div id="error_meta_kewords" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="meta_description"><?php echo Kohana::lang('pages.meta_description'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('pages.comments.meta_description'); ?></span>
            </td>
            <td>
                <textarea name="meta_description" cols="40" rows="5" id="add_pages_meta_description" ><?php if(!empty($_POST)) { echo $_POST['meta_description']; }  ?></textarea>
            </td>
            <td><div id="error_meta_description" class="error_message"></div></td>
        </tr>
        <?php /*
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('pages.meta_author'); ?></td>
            <td><input type="text" name="meta_author" id="add_pages_meta_author" /></td>
            <td><div id="error_meta_author" class="error_message"></div></td>
        </tr>
        <tr>
        
          <tr><td class="td_form_left"><?php echo Kohana::lang('pages.meta_generator'); ?></td>
            <td><input type="text" name="meta_generator" id="add_pages_meta_generator" /></td>
            <td><div id="error_meta_generator" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('pages.meta_robots'); ?></td>
            <td><input type="text" name="meta_robots" id="add_pages_meta_robots" /></td>
            <td><div id="error_meta_author" class="error_message"></div></td>
        </tr>
         *
         */ ?>
        <tr>
            <td class="td_form_left">
                <label for="url">Przyjazny url</label>
                <span class="label_comment">Wpisz alias dla tej podstrony. Jeśli nie wpiszesz, alias zostanie utworzony na podstawie nazwy strony.</span>
            </td>
            <td><input type="text" name="url" id="url" value="<?php if(!empty($_POST)) { echo $_POST['url']; }  ?>" /></td>
            <td><div id="error_url" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">Ukryj w menu</td>
            <td>
                <table>
                    <tr>
                        <td><input type="checkbox" name="show_in_menu" value="0" <?php if(!empty($_POST['show_in_menu']) && $_POST['show_in_menu']=='0') { echo 'checked="checked"'; } ?> /></td>
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
                        <td><input type="checkbox" name="menu_link_off" value="1" <?php if(!empty($_POST['menu_link_off']) && $_POST['menu_link_off']=='1') { echo 'checked="checked"'; } ?> /></td>
                        <td>Wyłącz link do strony.</td>
                    </tr>
                </table>
            </td>
            <td><div id="parent_id_error" class="error_message"></div></td>
        </tr>
    </table>
    <br /><br />
    <table>
        <tr>
            <td style="width: 200px">
                <input type="button" value="<?php echo Kohana::lang('pages.back'); ?>" name="back" class="btn btn-back"/>
            </td>
            <td>
                <input type="submit" value="<?php echo Kohana::lang('admin.add'); ?>" name="submit" class="btn btn-save" />
                <input type="submit" value="<?php echo Kohana::lang('admin.add_back'); ?>" name="submit_back" class="btn btn-save-and-back" />
            </td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>