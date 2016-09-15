
<?php if (!empty($_SESSION['__rebate']) && !empty($_SESSION['__rebate']['value'])): ?>


    <strong><?php echo $_SESSION['__rebate']['name']; ?> - <?php echo $_SESSION['__rebate']['value']; ?>%</strong>

<?php else: ?>
    <input class="form-control" type="text" name="rebate_code" value=""id="rebate_code_value" />

    <button type="submit" style="float:right;"  name="recount" class="btn btn-default"> <?php echo Kohana::lang('rebate_codes.send'); ?> </button>
<?php endif; ?>
