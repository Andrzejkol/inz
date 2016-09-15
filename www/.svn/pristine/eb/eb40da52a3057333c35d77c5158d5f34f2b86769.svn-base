<?php foreach($oValues as $v): ?>
<tr class="attribute_row_<?php echo $v->attr_id; ?>">
    <td><input type="checkbox" name="attribute[<?php echo $v->attr_id; ?>][<?php echo $v->id_attribute_value; ?>]" id="attribute_value_<?php echo $v->id_attribute_value; ?>" value="<?php echo $v->id_attribute_value; ?>"<?php echo !empty($v->price)&&$v->price+0>0?' checked="checked"':''; ?> /></td>
    <td><?php echo $v->attribute_value; ?></td>
    <?php /*
    <td><input type="text" name="attribute[<?php echo $v->attr_id; ?>][<?php echo $v->id_attribute_value; ?>][0]" id="attribute_price_<?php echo $v->id_attribute_value; ?>" value="<?php echo $v->price; ?>" /></td>
    <td><input type="text" name="attribute[<?php echo $v->attr_id; ?>][<?php echo $v->id_attribute_value; ?>][1]" id="attribute_quantity_<?php echo $v->id_attribute_value; ?>" value="<?php echo $v->quantity; ?>" /></td>
     */
    ?>
</tr>
<?php endforeach; ?>