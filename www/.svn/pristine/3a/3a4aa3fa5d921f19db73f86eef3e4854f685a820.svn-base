<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Digg pagination style
 * 
 * @preview  « Previous Next »
 */
?>
<table class="pagin blog" cellspacing="5px;">
<tr>
   
	<?php if ($previous_page): ?>
		<td  style="text-align: right;"><a href="<?php echo str_replace('{page}', $previous_page, $url) ?>"><?php echo Kohana::lang('app.previous_post') ?></a></td>
	<?php else: ?>
		<td  style="text-align: right;"><?php echo Kohana::lang('app.previous_post') ?></td>
	<?php endif ?>
    
        <td style="text-align: center;"><?php echo html::anchor('', Kohana::lang('app.home')); ?></td>
    
    <?php if ($next_page): ?>
		<td style="text-align: left;"><a href="<?php echo str_replace('{page}', $next_page, $url) ?>"><?php echo Kohana::lang('app.next_post') ?></a></td>
	<?php else: ?>
		<td style="text-align: left;"><?php echo Kohana::lang('app.next_post') ?></td>
	<?php endif ?>
    
</tr>
</table>
