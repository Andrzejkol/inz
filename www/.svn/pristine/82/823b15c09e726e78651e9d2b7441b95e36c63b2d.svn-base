<div class="row search-widget widget">
    <div class="col-md-12 widget-wrapper">
        <h1 class="widget-title"><?php echo Kohana::lang('shop_app.search'); ?></h1>
        <div class="widget-content">
            <?php echo form::open('szukaj', array('method' => 'get')); ?>
            <?php /*
            <div class="search-box">
                <div class="search-title">Producent</div>
                <div class="search-params">
                    <select id="producer_id" name="producer_id">
                        <?php foreach ($oProducers as $pp): ?>
                            <?php if ($pp->id_producer == 1): ?>
                                <option value="<?php echo $pp->id_producer; ?>" selected="selected"><?php echo $pp->producer_name; ?></option>
                            <?php else: ?>
                                <option value="<?php echo $pp->id_producer; ?>"><?php echo $pp->producer_name; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>*/ ?>
            <?php
            $aProductParameters = array();
            $sCurrentName = '';
            foreach ($oParameters as $p):
                if ($sCurrentName != $p->parameter_name):
                    $sCurrentName = $p->parameter_name;
                    ?>
                    <div class="search-box">
                        <div class="search-title"><?php echo html::specialchars($sCurrentName); ?>:</div>
                        <?php
                    endif;
                    ?>
                    <div class="search-params">
                        <?php
                        if (count($oParametersValues[$p->parameter_id]['parameter_value']) >= 1 &&
                                !empty($oParametersValues[$p->parameter_id]['parameter_value'][0])) :
                            ?>
                            <?php
                            $dropdownValue = null;
                            if (in_array($p->id_parameter, array_keys($aProductParameters))) {
                                $dropdownValue = $oParametersValues[$p->parameter_id]['id_parameter_value'];
                            }
                            $z = 0;
//                            var_dump($oParametersValues[$p->parameter_id]['id_parameter_value']);
                            if (!empty($p->parameter_id) && !empty($_GET['pp'][$p->parameter_id])) {
                                $aSelected = $_GET['pp'][$p->parameter_id];
                            }
                            ?>
                            <?php foreach ($oParametersValues[$p->parameter_id]['parameter_value'] as $val): ?>

                                <label><input type="checkbox" <?php echo((!empty($aSelected) && in_array($val, $aSelected)) ? 'checked="checked"' : ''); ?> 
                                              name="pp[<?php echo $p->parameter_id; ?>][]" value="<?php echo $val; ?>" id=""/> <?php echo $val; ?></label>
                                    <?php //echo Form::dropdown('nazwa_tymczasowa', array_combine($oParametersValues[$p->parameter_id]['id_parameter_value'], $oParametersValues[$p->parameter_id]['parameter_value']), $dropdownValue) ?>
                                    <?php
                                    $z++;
                                endforeach;
                                ?>
                            <?php endif; ?>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
            <div class="search-box">
                <div class="search-title">Przedział cenowy</div>
                <div class="search-params">
                    <?php /*
                    <label><input type="checkbox" name="price[]" value="0-269" id=""/> Poniżej 269zł</label>
                    <label><input type="checkbox" name="price[]" value="269-499" id=""/> od 269 do 499zł</label>
                    <label><input type="checkbox" name="price[]" value="499-749" id=""/> od 499 do 749zł</label>
                    <label><input type="checkbox" name="price[]" value="749-1499" id=""/> od 749 do 1 499zł</label>
                    <label><input type="checkbox" name="price[]" value="1499-999999" id=""/> powyżej 1 499zł</label>
                     * 
                     */ ?>
                    od <input type="text" name="price_from" value="<?php echo(!empty($_GET['price_from']))?$_GET['price_from']:''; ?>" /> 
                    do <input type="text" name="price_to" value="<?php echo(!empty($_GET['price_to']))?$_GET['price_to']:''; ?>" />
                </div>
            </div>
            <div class="btnbox">
                <button type="submit" class="btn">FILTRUJ</button>
                <?php echo html::anchor('szukaj', 'WYCZYŚĆ', array('class'=>'btn btn-white')); ?>
            </div>
            <?php echo form::close(); ?>
        </div>    
    </div>
</div>
