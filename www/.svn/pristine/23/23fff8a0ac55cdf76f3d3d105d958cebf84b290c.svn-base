<table class="table_view">
    <?php if ($oComments->count() > 0): ?>
        <tr>
            <th>
                ID
            </th>
            <th>
                <?php echo Kohana::lang('product.comment_date_added'); ?>
            </th>
            <th>
                <?php echo Kohana::lang('product.comment_nick'); ?>
            </th>
            <th>
                <?php echo Kohana::lang('product.comment_content'); ?>
            </th>
            <th>
                <?php echo Kohana::lang('product.active'); ?>
            </th>
            <th>
                <?php echo Kohana::lang('product.options'); ?>
            </th>
        </tr>
        <?php foreach ($oComments as $c): ?>
            <tr>
                <td>
                    <?php echo $c->id_product_comment; ?>
                </td>
                <td>
                    <?php echo date('Y-m-d, H:i:s', $c->date_added + 0); ?>
                </td>
                <td>
                    <?php echo $c->nick; ?>
                </td>
                <td>
                    <?php echo text::limit_words($c->content, 24); ?>
                </td>
                <td>
                    <?php echo $c->active == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('product.comment_active'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('product.comment_not_active'))); ?>
                </td>
                <td>
                    <?php echo html::anchor('4dminix/edytuj_komentarz/' . $c->id_product_comment, html::image('img/icons/edit.gif', Kohana::lang('product.edit_comment'))); ?>
                    <?php echo html::anchor('4dminix/usun_komentarz/' . $c->id_product_comment, html::image('img/icons/delete.gif', Kohana::lang('product.delete_comment'))); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="info"><?php echo Kohana::lang('product.no_product_comments'); ?></div>
    <?php endif; ?>
</table>