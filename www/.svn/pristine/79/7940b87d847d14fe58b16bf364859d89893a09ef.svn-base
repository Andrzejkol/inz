<?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
<table>
    <tr>
        <td class="td_form_left td_form_top">
            <label for="attributes"><?php echo Kohana::lang('product.attributes'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.attributes'); ?></span>
        </td>
        <td>
            <table class="table_view">
                <?php
                $aProductAttributes = array();
                foreach ($oProductAttributes as $pa) :
                    $aProductAttributes[] = $pa->attribute_value_id;
                endforeach;
                $sCurrentName = '';
                foreach ($oAttributes as $a):
                    if ($sCurrentName != $a->attribute_name):
                        $sCurrentName = $a->attribute_name;
                        ?>
                        <tr>
                            <th colspan="2"><?php echo html::specialchars($sCurrentName); ?></th>
                        </tr>
                        <?php
                    endif;
                    ?>
                    <tr>
                        <td>
                            <?php if (in_array($a->attribute_value_id, $aProductAttributes)) : ?>
                                <input type="checkbox" name="attribute_value[<?php echo $a->attribute_id; ?>][<?php echo $a->attribute_value_id; ?>]" checked="checked" />
                            <?php else : ?>
                                <input type="checkbox" name="attribute_value[<?php echo $a->attribute_id; ?>][<?php echo $a->attribute_value_id; ?>]" />
                            <?php endif; ?>
                        </td>
                        <td><?php echo html::specialchars($a->attribute_value); ?></td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </table>
        </td>
        <td><div id="description_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="submit_tab" value="submit_tab_4" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="btn btn-save"  /></td>
        <td>&nbsp;</td>
    </tr>
</table>
<?php echo form::close(); ?>