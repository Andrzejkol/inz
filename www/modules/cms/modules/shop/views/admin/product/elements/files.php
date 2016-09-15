<?php echo form::open_multipart(null, array('method' => 'post', 'onsubmit' => "javascript: return requestAjax();")); ?>
<table class="table_form">
    <tr>
        <td class="td_form_left" colspan="3">
            <h1>Pliki</h1>
        </td>
    </tr>
    <tr>
        <td class="td_form_left" colspan="3">
            <ul>
                <?php for ($i = 1; $i <= 5; ++$i) : ?>
                    <li><input type="file" name="file[]" id="file_<?php echo $i; ?>" /> <input type="text" name="new_description[]" id="description_<?php echo $i; ?>" /></li>
                <?php endfor; ?>
            </ul>
        </td>
    </tr>
    <tr>
        <td>
            <?php if (!empty($oProductFiles) && $oProductFiles instanceof Mysql_Result && $oProductFiles->count()): ?>
                <table>
                    <tr>
                        <th>Plik</th>
                        <th>Opis</th>
                        <th>Usuń</th>
                    </tr>
                    <?php foreach ($oProductFiles as $file): ?>
                        <tr>
                            <td>
                                <a href="<?php echo url::base(); ?>files/product_files/<?php echo html::specialchars($file->product_id); ?>/<?php echo html::specialchars($file->real_file_name); ?>"><?php echo html::specialchars($file->real_file_name); ?></a>
                            </td>
                            <td>
                                <input type="text" name="filesDescription[<?php echo $file->id_product_file; ?>]" value="<?php echo html::specialchars($file->description); ?>" />
                            </td>
                            <td>
                                <input type="checkbox" name="delFilesDescription[<?php echo $file->id_product_file; ?>]" name="delFilesDescription_<?php echo $file->id_product_file; ?>" />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="submit_tab" value="submit_tab_6" /><input type="submit" name="submit" value="<?php echo Kohana::lang('product.save'); ?>" class="ui-button ui-widget ui-state-default ui-corner-all"  /></td>
        <td>&nbsp;</td>
    </tr>
</table>
<?php echo form::close(); ?>