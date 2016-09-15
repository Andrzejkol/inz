<div id="filters">
    <?php echo form::open('produkty/'.$iCategoryId.'/'.string::prepareURL($sCategoryName), array('method'=>'get'));; ?>
    <div>
    <?php echo form::dropdown('filter_producers', $oProducers, (!empty($_GET['filter_producers'])) ? $_GET['filter_producers'] : ''); ?>
    <?php echo form::dropdown('filter_prices', array('ca' => 'Cena rosnąco', 'cd' => 'Cena malejąco'), (!empty($_GET['filter_prices'])) ? $_GET['filter_prices'] : ''); ?>
    <?php echo form::dropdown('filter_results', array(10 => 'Pokaż 10 wyników', 20 => 'Pokaż 20 wyników'), (!empty($_GET['filter_results'])) ? $_GET['filter_results'] : ''); ?>
    </div>
    <div class="filter_submit">
        <input type="submit" name="filter" value="<?php echo Kohana::lang('product.show'); ?>" class="submit small_gray" />
    </div>

    <?php echo form::close(); ?>
</div>