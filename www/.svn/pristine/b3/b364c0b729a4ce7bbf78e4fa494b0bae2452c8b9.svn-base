<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Classic pagination style
 *
 * @preview  ‹ First  < 1 2 3 >  Last ›
 */
?>


<table class="pagination pagin" cellspacing="5px;">
    <tr>
        <?php if ($previous_page): ?>
        <td>
            <span title="<?php echo str_replace('{page}', $previous_page, $url) ?>">&laquo;&nbsp;<?php echo Kohana::lang('pagination.previous') ?></span>
        </td>
        <?php else: ?>
        <td>
            &laquo;&nbsp;<?php echo Kohana::lang('pagination.previous') ?>
        </td>
        <?php endif ?>


        <?php if ($total_pages < 13): /* « Previous  1 2 3 4 5 6 7 8 9 10 11 12  Next » */ ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $current_page): ?>
        <td>
            <strong><?php echo $i ?></strong>
        </td>
                <?php else: ?>
        <td>
            <span title="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></span>
        </td>
                <?php endif ?>
            <?php endfor ?>

        <?php elseif ($current_page < 9): /* « Previous  1 2 3 4 5 6 7 8 9 10 … 25 26  Next » */ ?>

            <?php for ($i = 1; $i <= 10; $i++): ?>
                <?php if ($i == $current_page): ?>
        <td>
            <strong><?php echo $i ?></strong>
        </td>
                <?php else: ?>
        <td>
            <span title="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></span>
        </td>
                <?php endif ?>
            <?php endfor ?>
        <td>
            &hellip;
            <span title="<?php echo str_replace('{page}', $total_pages - 1, $url) ?>"><?php echo $total_pages - 1 ?></span>
        </td>
        <td>

            <span title="<?php echo str_replace('{page}', $total_pages, $url) ?>"><?php echo $total_pages ?></span>
        </td>

        <?php elseif ($current_page > $total_pages - 8): /* « Previous  1 2 … 17 18 19 20 21 22 23 24 25 26  Next » */ ?>
        <td>
            <span title="<?php echo str_replace('{page}', 1, $url) ?>">1</span>
        </td>
        <td>
            <span title="<?php echo str_replace('{page}', 2, $url) ?>">2</span>
            &hellip;
        </td>
            <?php for ($i = $total_pages - 9; $i <= $total_pages; $i++): ?>
                <?php if ($i == $current_page): ?>
        <td>
            <strong><?php echo $i ?></strong>
        </td>
                <?php else: ?>
        <td>
            <span title="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></span>
        </td>
                <?php endif ?>
            <?php endfor ?>

        <?php else: /* « Previous  1 2 … 5 6 7 8 9 10 11 12 13 14 … 25 26  Next » */ ?>
        <td>
            <span title="<?php echo str_replace('{page}', 1, $url) ?>">1</span>
        </td>
        <td>
            <span title="<?php echo str_replace('{page}', 2, $url) ?>">2</span>
            &hellip;
        </td>
            <?php for ($i = $current_page - 5; $i <= $current_page + 5; $i++): ?>
                <?php if ($i == $current_page): ?>
        <td>
            <strong><?php echo $i ?></strong>
        </td>
                <?php else: ?>
        <td>
            <span title="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></span>
        </td>
                <?php endif ?>
            <?php endfor ?>
        <td>
            &hellip;
            <span title="<?php echo str_replace('{page}', $total_pages - 1, $url) ?>"><?php echo $total_pages - 1 ?></span>
        </td>
        <td>
            <span title="<?php echo str_replace('{page}', $total_pages, $url) ?>"><?php echo $total_pages ?></span>
        </td>

        <?php endif ?>


        <?php if ($next_page): ?>
        <td>
            <span title="<?php echo str_replace('{page}', $next_page, $url) ?>"><?php echo Kohana::lang('pagination.next') ?>&nbsp;&raquo;</span>
        </td>
        <?php else: ?>
        <td>
                <?php echo Kohana::lang('pagination.next') ?>&nbsp;&raquo;
        </td>
        <?php endif ?>
    </tr>
</table>