<?php if(!empty($oValues)): ?>
<?php foreach($oValues as $v): ?>
<tr class="param_row_<?php echo $v->parameter_id; ?>">
    <td><input type="text" name="parameter_value[<?php echo $v->parameter_id; ?>]" id="parameter_value_<?php echo $v->parameter_id; ?>" value="<?php if(!empty($v->value)){echo $v->value;} ?>" class="stdTextBox" /></td>
    <td><?php echo $v->value; ?></td>
</tr>
<?php endforeach; ?>
<?php endif;?>