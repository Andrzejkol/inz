<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Classic pagination style
 *
 * @preview  ‹ First  < 1 2 3 >  Last ›
 */
?>

<table class="pagin" cellspacing="5px;">
<tr>

	<?php if ($first_page): ?>
            <td>
		<a href="<?php echo str_replace('{page}', 1, $url) ?>">&lsaquo;&nbsp;Cofnij</a>
            </td>
	<?php endif ?>

	<?php if ($previous_page): ?>
            <td>
		<a href="<?php echo str_replace('{page}', $previous_page, $url) ?>">&lt;</a>
            </td>
	<?php endif ?>


	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
            <td class="current_page">
		<strong><?php echo $i ?></strong>
            </td>

		<?php else: ?>
            <td>
			<a href="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></a>
            </td>
		<?php endif ?>

	<?php endfor ?>


	<?php if ($next_page): ?>
            <td>
            <a href="<?php echo str_replace('{page}', $next_page, $url) ?>">&gt;</a>
            </td>
	<?php endif ?>

	<?php if ($last_page): ?>
            <td>
		<a href="<?php echo str_replace('{page}', $last_page, $url) ?>"><?php echo Kohana::lang('pagination.last') ?>&nbsp;&rsaquo;</a>
            </td>
        <?php endif ?>
</tr>
</table>