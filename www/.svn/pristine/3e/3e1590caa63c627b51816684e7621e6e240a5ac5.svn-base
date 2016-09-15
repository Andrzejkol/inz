<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('media.add_media')
            ))->render(TRUE);
?>
<div id="admin_media_add_view">
    <div>
        <?php echo form::open_multipart(null, array('id' => 'admin_media_view_form')); ?>
        <table class="table_form">
            <tr>
                <td class="td_form_left">
                    <?php echo Kohana::lang('media.choose_media'); ?>
                </td>
                <td>
                    <input type="file" name="media" />
                    <?php //echo html::image('img/icons/help.png', array( 'class'=>'help','alt'=>Kohana::lang('media.help'), 'title'=>Kohana::lang('media.hints.add_media'))); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" value="<?php /* echo Kohana::lang('media.back');*/ ?> Wróć" name="back" class="btn btn-back" />
                </td>
                <td>
                    <input type="submit" name="submit" value="<?php /* echo Kohana::lang('media.add_media'); */ ?>Dodaj" class="btn btn-save" />
                    <input type="submit" name="submit_back" value="<?php /* echo Kohana::lang('media.add_media_back'); */ ?> Dodaj i wróć" class="btn btn-save-and-back" />
                </td>
            </tr>
        </table>
        <?php echo form::close();
        ?>
    </div>

</div>