<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco' => 'add',
            'sTitle' => Kohana::lang('slider.admin_slider_add_site_title')
        ))->render(TRUE);
?>
<?php echo (!empty($msg) ? $msg : NULL); ?>
<div id="admin_slider_add" class="admin_slider">
    <ul style="overflow: hidden;">
        <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'slider_elements', 'news_all')->Value === TRUE) : ?>
            <li><a href="#tabs-1"><?php echo Kohana::lang('slider.form_news_title'); ?></a></li>
        <?php endif; ?>
        <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'slider_elements', 'news_for_slider_all')->Value === TRUE) : ?>
           <li><a href="#tabs-2"><?php echo Kohana::lang('slider.form_slider_news_title'); ?></a></li> 
        <?php endif; ?>
        <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'slider_elements', 'image_all')->Value === TRUE) : ?>
            <li><a href="#tabs-3"><?php echo Kohana::lang('slider.form_slider_image_title'); ?></a></li>
        <?php endif; ?>
        
        
        
    </ul>
    <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'slider_elements', 'news_all')->Value === TRUE) : ?>
    <div id="tabs-1" class="ui-tabs-hide">
        <?php echo form::open_multipart(); ?>
        <ul>
            <?php if (!empty($aNewsTitles) AND count($aNewsTitles)) : ?>
                <li>
                    <?php
                    echo form::label(array('for' => 'news_title'), Kohana::lang('slider.news_title'));
                    echo form::dropdown(array('name' => 'news_element_id', 'id' => 'news_title'), $aNewsTitles, (!empty($_POST) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_NEWS AND isset($_POST['news_element_id'])) ? $_POST['news_element_id'] : NULL);
                    ?>
                    <span class="label_comment"><?php echo Kohana::lang('slider.news_title_info') ?></span>
                </li>
                <li>
                    <input type="hidden" name="slider_type_id" id="news_type_id" value="<?php echo slider_helper::ELEMENT_TYPE_NEWS; ?>" />
                    <input type="submit" value="<?php echo Kohana::lang('slider.save'); ?>" name="submit" class="btn btn-save" />
                </li>
            <?php else :
                ?>
                <div class="info"><?php echo Kohana::lang('slider.no_news_to_add'); ?></div>
                <span class="label_comment"><?php echo Kohana::lang('slider.news_title_info') ?></span>
            <?php endif; ?>
        </ul>
        <?php echo form::close(); ?>
    </div>
    <?php endif; ?>
    <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'slider_elements', 'news_for_slider_all')->Value === TRUE) : ?>
    <div id="tabs-2" class="ui-tabs-hide">
        <?php echo form::open_multipart(); ?>
        <ul>
            <li>
                <label for="add_news_photo"><?php echo Kohana::lang('slider.choose_image'); ?></label>
                <input type="file" name="photo" id="add_news_photo" />
                <span class="label_comment"><?php echo Kohana::lang('slider.slider_news_image_info'); ?></span>
            </li>
            <li>
                <label for="add_photo_alt"><?php echo Kohana::lang('slider.add_photo_alt'); ?></label>
                <input type="text" name="alt" id="add_photo_alt" value="<?php echo (!empty($_POST) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_SLIDER_NEWS AND isset($_POST['alt'])) ? $_POST['alt'] : NULL; ?>" />
            </li>
            <li>
                <?php echo form::label('news_link', Kohana::lang('slider.link')); ?>
                <input type="text" value="<?php echo ((!empty($_POST) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_SLIDER_NEWS AND isset($_POST['link'])) ? $_POST['link'] : NULL); ?>" id="news_link" name="link" />
                <span class="label_comment"><?php echo Kohana::lang('slider.link_info') ?></span>
            </li>
            <li>
                <label for="add_news_title"><?php echo Kohana::lang('slider.news_title'); ?></label>
                <input name="title" id="add_news_title" value="<?php echo (!empty($_POST['title']) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_SLIDER_NEWS) ? $_POST['title'] : NULL; ?>">
            </li>
            <li>
                <label for="add_news_short_description"><?php echo Kohana::lang('slider.short_description'); ?></label>
                <textarea name="short_description" cols="40" rows="5" id="add_news_short_description"><?php echo (!empty($_POST) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_SLIDER_NEWS AND isset($_POST['short_description'])) ? $_POST['short_description'] : NULL; ?></textarea>
            </li>
            <li style="display:none;">
                <label for="add_news_description"><?php echo Kohana::lang('slider.description'); ?></label>
                <textarea name="description" cols="40" rows="5" id="add_news_description"><?php echo (!empty($_POST) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_SLIDER_NEWS AND isset($_POST['description'])) ? $_POST['description'] : NULL; ?></textarea>
            </li>
            <li>
                <input type="hidden" name="slider_type_id" id="slider_news_type_id" value="<?php echo slider_helper::ELEMENT_TYPE_SLIDER_NEWS; ?>" />
                <input type="submit" value="<?php echo Kohana::lang('slider.save'); ?>" name="submit" class="btn btn-save" />
            </li>
        </ul>
        <?php echo form::close(); ?>
    </div>
    <?php endif; ?>
    <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'slider_elements', 'image_all')->Value === TRUE) : ?>
    <div id="tabs-3" class="ui-tabs-hide">
        <?php echo form::open_multipart(); ?>
        <ul>
            <li>
                <?php echo form::label('add_photo', Kohana::lang('slider.choose_image')); ?>
                <input type="file" name="image" id="add_photo" />
                <span class="label_comment"><?php echo Kohana::lang('slider.slider_image_info') ?></span>
            </li>
            <li>
                <label for="add_photo_alt_image"><?php echo Kohana::lang('slider.add_photo_alt'); ?></label>
                <input type="text" name="alt" id="add_photo_alt_image" value="<?php echo (!empty($_POST) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_IMAGE AND isset($_POST['alt'])) ? $_POST['alt'] : NULL; ?>" />
            </li>
            <li>
                <?php echo form::label('add_photo_title', Kohana::lang('slider.title')); ?>
                <input type="text" name="title" id="add_photo_title" value="<?php echo (!empty($_POST) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_IMAGE AND isset($_POST['title'])) ? $_POST['title'] : NULL; ?>" />
            </li>
            <li>
                <?php echo form::label('link', Kohana::lang('slider.link')); ?>
                <input type="text" id="link" name="link" value="<?php echo ((!empty($_POST) AND $_POST['slider_type_id'] == slider_helper::ELEMENT_TYPE_IMAGE AND isset($_POST['link'])) ? $_POST['link'] : NULL); ?>" />
                <span class="label_comment"><?php echo Kohana::lang('slider.link_info') ?></span>
            </li>
            <li>
                <?php
                echo form::label('language', Kohana::lang('slider.language'));
                echo form::dropdown(array('name' => 'lang', 'id' => 'language'), $languages, !empty($_POST) ? $_POST['lang'] : '');
                ?>                            
            </li>
            <li>
                <input type="hidden" name="slider_type_id" id="slider_image_type_id" value="<?php echo slider_helper::ELEMENT_TYPE_IMAGE; ?>" />
                <input type="submit" value="<?php echo Kohana::lang('slider.save'); ?>" name="submit" class="btn btn-save" />
            </li>
        </ul>
        <?php echo form::close(); ?>
    </div>
    <?php endif; ?>
</div>
<input type="button" value="<?php echo Kohana::lang('slider.back'); ?>" name="back" class="btn btn-back" style="display: inline-block; margin: 1em 0;" />
<script type="text/javascript">
    $(document).ready(function() {
<?php
if (!empty($_POST)) {
    switch ($_POST['slider_type_id']) {
        case slider_helper::ELEMENT_TYPE_NEWS:
            $iSelected = 0;
            break;
        case slider_helper::ELEMENT_TYPE_SLIDER_NEWS:
            $iSelected = 1;
            break;
        case slider_helper::ELEMENT_TYPE_IMAGE:
            $iSelected = 2;
            break;
    }
}
?>
        $('#admin_slider_add').tabs({
            selected: <?php echo (!empty($_POST)) ? $iSelected : 0 ?>
        });
    });
</script>