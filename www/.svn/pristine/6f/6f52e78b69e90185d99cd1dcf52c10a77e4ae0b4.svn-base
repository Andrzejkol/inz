<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * PunBB pagination style
 *
 * @preview  Pages: 1 … 4 5 6 7 8 … 15
 */
?>

<p class="pagination">

        <?php if ($previous_page): ?>
    <a href="<?php echo str_replace('{page}', $previous_page, $url) ?>" class="more">&laquo;&nbsp;Cofnij</a>
        <?php else: ?><span>&laquo;&nbsp; Cofnij</span>
            <?php endif ?>
        <?php if ($current_page > 2): ?><a href="<?php echo str_replace('{page}', 1, $url) ?>">1</a>
        <?php if ($current_page != 3) echo '&hellip;' ?>
            <?php endif ?>


	<?php for ($i = $current_page - 1, $stop = $current_page + 2; $i < $stop; ++$i): ?>

		<?php if ($i < 1 OR $i > $total_pages) continue ?>

		<?php if ($current_page == $i): ?><strong><?php echo $i ?></strong><?php else: ?><a href="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></a><?php endif ?>

	<?php endfor ?>


	<?php if ($current_page <= $total_pages - 2): ?>
		<?php if ($current_page != $total_pages - 2) echo '&hellip;' ?>
		<a href="<?php echo str_replace('{page}', $total_pages, $url) ?>"><?php echo $total_pages ?></a>
	<?php endif ?>

                	<?php if ($next_page): ?>
		<a href="<?php echo str_replace('{page}', $next_page, $url) ?>" class="more">Dalej&nbsp;&raquo;</a>
	<?php else: ?>
                <span>Dalej&nbsp;&raquo;</span>
	<?php endif ?>

</p>