<?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
<table class="table_form">
    <tr>
        <td class="td_form_left td_form_top">
            <label for="short_description"><?php echo Kohana::lang('product.short_description'); ?></label>
            <span class="label_comment"><?php //echo Kohana::lang('product.comments.short_description');                  ?></span>
        </td>
        <td>
            <textarea name="product_short_description" class="tinyText" id="short_description" rows="5" cols="60"><?php
                if (!empty($POST['product_short_description'])) {
                    echo $POST['product_short_description'];
                } elseif (!empty($oProductDetails->product_short_description)) {
                    echo $oProductDetails->product_short_description;
                } else {
                    echo '';
                }
                ?></textarea>
            <?php /* <ul class="os-languages-list">
              <?php foreach($oLanguages as $lang): ?>
              <li><span onclick="javascript:showI18nDialog('product_short_description_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
              <?php endforeach; ?>
              </ul> */ ?>
        </td>
        <td><div id="short_description_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td class="td_form_left td_form_top">
            <label for="description"><?php echo Kohana::lang('product.description'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.description'); ?></span>
        </td>
        <td>
            <textarea name="product_description" class="tinyText" id="description" rows="5" cols="60"><?php
                if (!empty($_POST['product_description'])) {
                    echo $_POST['product_description'];
                } elseif (!empty($oProductDetails->product_description)) {
                    echo $oProductDetails->product_description;
                } else {
                    echo '';
                }
                ?></textarea>
            <?php echo languages::ShowTranslationBox('product', $oProductDetails->id_product, 'textarea'); ?>
            <?php /*
              <ul class="os-languages-list">
              <?php foreach($oLanguages as $lang): ?>
              <li><span onclick="javascript:showI18nDialog('product_description_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
              <?php endforeach; ?>
              </ul>
             */ ?>
        </td>
        <td><div id="description_error" class="error_message"></div></td>
    </tr>

    <!--
    <tr>
        <td class="td_form_left td_form_top">
            <label for="guarantee"><?php echo Kohana::lang('product.guarantee'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.guarantee'); ?></span>
        </td>
        <td>
            <textarea name="guarantee" id="guarantee" rows="5" cols="60"><?php
    if (!empty($POST['guarantee'])) {
        echo $POST['guarantee'];
    } elseif (!empty($oProductDetails->product_guarantee)) {
        echo $oProductDetails->product_guarantee;
    } else {
        echo '';
    }
    ?></textarea>
            <ul class="os-languages-list">
    <?php foreach ($oLanguages as $lang): ?>
                                                                                    <li><span onclick="javascript:showI18nDialog('product_guarantee_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
    <?php endforeach; ?>
            </ul>
        </td>
        <td><div id="short_description_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td class="td_form_left td_form_top">
            <label for="tags"><?php echo Kohana::lang('product.tags'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.tags'); ?></span>
        </td>
        <td>
            <textarea name="tags" id="tags" rows="5" cols="60"><?php
    if (!empty($_POST['tags'])) {
        echo $_POST['tags'];
    } elseif (!empty($oProductTags)) {
        echo $oProductTags;
    } else {
        echo '';
    }
    ?></textarea>
        </td>
        <td><div id="description_error" class="error_message"></div></td>
    </tr>
    -->
    <tr>
        <td class="td_form_left td_form_top">
            <label for="parameters"><?php echo Kohana::lang('product.parameters'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.parameters'); ?></span>
        </td>
        <td>
            <?php
            $aProductParameters = array();
            foreach ($oProductParameters as $pp) :
                $aProductParameters[$pp->parameter_id] = $pp->value;
            endforeach;
            ?>
            <table class="table_view">
                <?php
                $sCurrentName = '';
                foreach ($oParameters as $p):
                    if ($sCurrentName != $p->parameter_name):
                        $sCurrentName = $p->parameter_name;
                        ?>
                        <tr>
                            <td><?php echo html::specialchars($sCurrentName); ?>:</td>
                            <?php
                        endif;
                        ?>
                        <td><?php //echo Kohana::debug( $oParametersValues[$p->parameter_id] );      ?>
                            <?php
                            if (count($oParametersValues[$p->parameter_id]['parameter_value']) >= 1 &&
                                    !empty($oParametersValues[$p->parameter_id]['parameter_value'][0])) :
                                ?>
                                <?php
                                $dropdownValue = null;
                                if (in_array($p->id_parameter, array_keys($aProductParameters))) {
                                    $dropdownValue = $oParametersValues[$p->parameter_id]['id_parameter_value'];
                                }
                                ?>
                                <?php echo Form::dropdown('nazwa_tymczasowa', array_combine($oParametersValues[$p->parameter_id]['id_parameter_value'], $oParametersValues[$p->parameter_id]['parameter_value']), $dropdownValue) ?>
                            <?php endif; ?>
                            <?php if (in_array($p->id_parameter, array_keys($aProductParameters))) : ?>
                                <?php //echo Kohana::debug($aProductParameters[$p->id_parameter]); ?>
                                <input type="text" name="parameter_value[<?php echo $p->parameter_id; ?>]" value="<?php echo html::specialchars($aProductParameters[$p->id_parameter]); ?>" />
                            <?php else : ?>
                                <input type="text" name="parameter_value[<?php echo $p->parameter_id; ?>]" value="" />
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </table>
        </td>
        <td><div id="parameters_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="submit_tab" value="submit_tab_2" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="btn btn-save"  /></td>
        <td>&nbsp;</td>
    </tr>
</table>
<?php echo form::close(); ?>