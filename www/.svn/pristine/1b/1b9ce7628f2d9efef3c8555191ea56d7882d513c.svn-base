<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Digg pagination style
 * 
 * @preview  « Previous  1 2 … 5 6 7 8 9 10 11 12 13 14 … 25 26  Next »
 */
?>
<table class="pagin" cellspacing="5px;">
<tr>
	<?php if ($previous_page): ?>
		<td><a href="<?php echo str_replace('{page}', $previous_page, $url) ?>">&laquo;&nbsp;<?php echo Kohana::lang('pagination.previous') ?></a></td>
	<?php else: ?>
		<td>&laquo;&nbsp;<?php echo Kohana::lang('pagination.previous') ?></td>
	<?php endif ?>


	<?php if ($total_pages < 13): /* « Previous  1 2 3 4 5 6 7 8 9 10 11 12  Next » */ ?>

		<?php for ($i = 1; $i <= $total_pages; $i++): ?>
			<?php if ($i == $current_page): ?>
				<td><strong><?php echo $i ?></strong></td>
			<?php else: ?>
				<td><a href="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></a></td>
			<?php endif ?>
		<?php endfor ?>

	<?php elseif ($current_page < 9): /* « Previous  1 2 3 4 5 6 7 8 9 10 … 25 26  Next » */ ?>

		<?php for ($i = 1; $i <= 10; $i++): ?>
			<?php if ($i == $current_page): ?>
				<td><strong><?php echo $i ?></strong></td>
			<?php else: ?>
				<td><a href="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></a></td>
			<?php endif ?>
		<?php endfor ?>

		<td>&hellip;</td>
		<td><a href="<?php echo str_replace('{page}', $total_pages - 1, $url) ?>"><?php echo $total_pages - 1 ?></a></td>
		<td><a href="<?php echo str_replace('{page}', $total_pages, $url) ?>"><?php echo $total_pages ?></a></td>

	<?php elseif ($current_page > $total_pages - 8): /* « Previous  1 2 … 17 18 19 20 21 22 23 24 25 26  Next » */ ?>

		<td><a href="<?php echo str_replace('{page}', 1, $url) ?>">1</a></td>
		<td><a href="<?php echo str_replace('{page}', 2, $url) ?>">2</a></td>
		<td>&hellip;</td>

		<?php for ($i = $total_pages - 9; $i <= $total_pages; $i++): ?>
			<?php if ($i == $current_page): ?>
				<td><strong><?php echo $i ?></strong></td>
			<?php else: ?>
				<td><a href="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></a></td>
			<?php endif ?>
		<?php endfor ?>

	<?php else: /* « Previous  1 2 … 5 6 7 8 9 10 11 12 13 14 … 25 26  Next » */ ?>

		<td><a href="<?php echo str_replace('{page}', 1, $url) ?>">1</a></td>
		<td><a href="<?php echo str_replace('{page}', 2, $url) ?>">2</a></td>
		<td>&hellip;</td>

		<?php for ($i = $current_page - 5; $i <= $current_page + 5; $i++): ?>
			<?php if ($i == $current_page): ?>
				<td><strong><?php echo $i ?></strong></td>
			<?php else: ?>
				<td><a href="<?php echo str_replace('{page}', $i, $url) ?>"><?php echo $i ?></a></td>
			<?php endif ?>
		<?php endfor ?>

		<td>&hellip;</td>
		<td><a href="<?php echo str_replace('{page}', $total_pages - 1, $url) ?>"><?php echo $total_pages - 1 ?></a></td>
		<td><a href="<?php echo str_replace('{page}', $total_pages, $url) ?>"><?php echo $total_pages ?></a></td>

	<?php endif ?>


	<?php if ($next_page): ?>
		<td><a href="<?php echo str_replace('{page}', $next_page, $url) ?>"><?php echo Kohana::lang('pagination.next') ?>&nbsp;&raquo;</a></td>
	<?php else: ?>
		<td><?php echo Kohana::lang('pagination.next') ?>&nbsp;&raquo;</td>
	<?php endif ?>

</tr>
</table>
