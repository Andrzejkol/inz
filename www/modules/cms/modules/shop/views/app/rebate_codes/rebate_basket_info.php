<div id="rebate-price" class="cost-summary row">
    <span class="col-xs-7 col-sm-8 text-right"><?php echo Kohana::lang('rebate_codes.REBATE_PRICE'); ?>:</span>
    <span class="col-xs-5 col-sm-4 value">
        <span> <?php echo shop::Price(-$_SESSION['__rebate_cost_summary']); ?></span>
    </span>         
</div>