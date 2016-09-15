<div id="admin_media_view">

    <div class="options">
        <h5>Media</h5>
        <?php
        if (User_Model::IsAllowed($_SESSION['_acl'], 'medias', 'add')->Value == true) {
            echo html::anchor('4dminix/dodaj_media', html::image('img/admin_default/newobject.gif', array('alt' => 'Dodaj nowe media', 'class' => 'add_button')));
            echo html::anchor('4dminix/dodaj_media', Kohana::lang('media.add_media'), array('class' => 'add_text'));
        }
        ?>
    </div>
    <?php if ($medias->count() > 0) {
        ?>
        <table id="media_list" class="table_view" >
            <tr>
                <th># <?php layer::GetSort('medias_orderby', 1, 2, '/4dminix/media');?></th>
                <th>Miniatura</th>
                <th><?php echo Kohana::lang('media.file_name'); ?></th>
                <th><?php echo Kohana::lang('media.mime_type'); ?><?php layer::GetSort('medias_orderby', 3, 4, '/4dminix/media');?></th>
                <th><?php echo Kohana::lang('media.type'); ?> <?php layer::GetSort('medias_orderby', 5, 6, '/4dminix/media');?></th>
                <th><?php echo Kohana::lang('pages.options'); ?></th>
            </tr>
            <?php
            if (!empty($medias)) :
                foreach ($medias as $media) :
                    ?>
                    <tr>
                        <td><?php echo $media->id_media; ?></td>
                        <td><?php echo (file_exists(media_helper::IMAGE_SMALL_PATH . $media->file_name) ? html::image(media_helper::IMAGE_SMALL_PATH . $media->file_name, array('alt' => 'Zdjęcie', 'style' => 'height:35px;')) : ''); ?></td>
                        <td><input readonly class="input_file_path" value="<?php echo url::base(true, 'http') . media_helper::IMAGE_BIG_PATH . $media->file_name; ?>" /></td>
                        <td><?php echo $media->mime_type; ?></td>
                        <td><?php echo Kohana::lang('media.' . $media->type); ?></td>
                        <td>
            <?php
            if (User_Model::IsAllowed($_SESSION['_acl'], 'medias', 'delete')->Value == true) {
				echo html::anchor('4dminix/usun_media/'.$media->id_media, Kohana::lang('news.delete'), array('title' =>Kohana::lang('news.delete'), 'class' => 'btn btn-delete')); 
            }
            ?>
                        </td>
                    </tr>

            <?php
        endforeach;
    endif;
    ?>
        </table>
            <?php
        } else {
            ?>
        <div class="info"><?php echo Kohana::lang('media.no_medias'); ?></div>
    <?php } ?>
    <?php echo $oPagination; ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('input.input_file_path').bind('focus click', function() {
            $(this).select();
        }).change(function() {
            return false;
        });
    });
</script>