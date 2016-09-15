<?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
<table class="table_form">
    <tr>
        <td class="td_form_left">
            <label for="meta_title"><?php echo Kohana::lang('product.meta_title'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.meta_title'); ?></span>
        </td>
        <td>
            <input type="text" name="meta_title" id="meta_title" value="<?php
            if (!empty($oProductDetails->meta_title)) {
                echo $oProductDetails->meta_title;
            }
            ?>" style="width: 300px;" />
            <ul class="os-languages-list">
                <?php foreach ($oLanguages as $lang): ?>
                    <li><span onclick="javascript:showI18nDialog('product_meta_title_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
                <?php endforeach; ?>
            </ul>
        </td>
        <td><div id="meta_title_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td class="td_form_left">
            <label for="meta_description"><?php echo Kohana::lang('product.meta_description'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.meta_description'); ?></span>
        </td>
        <td>
            <input type="text" name="meta_description" id="meta_description" value="<?php
            if (!empty($oProductDetails->meta_description)) {
                echo $oProductDetails->meta_description;
            }
            ?>" style="width: 300px;" />
            <ul class="os-languages-list">
                <?php foreach ($oLanguages as $lang): ?>
                    <li><span onclick="javascript:showI18nDialog('product_meta_description_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
                <?php endforeach; ?>
            </ul>
        </td>
        <td><div id="meta_description_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td class="td_form_left">
            <label for="meta_keywords"><?php echo Kohana::lang('product.meta_keywords'); ?></label>
            <span class="label_comment"><?php echo Kohana::lang('product.comments.meta_keywords'); ?></span>
        </td>
        <td>
            <input type="text" name="meta_keywords" id="meta_keywords" value="<?php
            if (!empty($oProductDetails->meta_keywords)) {
                echo $oProductDetails->meta_keywords;
            }
            ?>" style="width: 300px;" />
            <ul class="os-languages-list">
                <?php foreach ($oLanguages as $lang): ?>
                    <li><span onclick="javascript:showI18nDialog('product_meta_keywords_language_dialog', <?php echo $lang->id_language; ?>, <?php echo $oProductDetails->id_product; ?>);"><?php echo Kohana::lang('language.' . $lang->description); ?></span></li>
                <?php endforeach; ?>
            </ul>
        </td>
        <td><div id="meta_keyword_error" class="error_message"></div></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="submit_tab" value="submit_tab_7" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="btn btn-save"  /></td>
        <td>&nbsp;</td>
    </tr>
</table>
<?php echo form::close(); ?>