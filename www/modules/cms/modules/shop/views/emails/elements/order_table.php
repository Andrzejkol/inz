<table style="width: 100%">
<tr>
        <th style="width:10%; text-align:left;">Lp</th>
        <th style="width:30%; text-align:left;"><?php echo Kohana::lang('shop_app.email.prodname'); ?></th>
        <th style="width:10%; text-align:left;"><?php echo Kohana::lang('shop_app.email.quantity'); ?></th>
        <th style="width:20%; text-align:left;"><?php echo Kohana::lang('shop_app.email.price'); ?></th>
        <th style="width:10%; text-align:left;"><?php echo Kohana::lang('shop_app.email.rebate'); ?></th>
        <th style="width:20%; text-align:left;"><?php echo Kohana::lang('shop_app.email.total'); ?></th>
    </tr>
    <?php $i = 1;
    foreach ($aProducts as $p) :
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td>
                <span><?php echo $p['name']; ?></span><br/>
                <span style="font-size: 10px;">
                    <?php
                    //var_dump($oOP);
                    if (!empty($p['attributes'])) {
                        $aAttr = explode(';', $p['attributes']);
                        foreach ($aAttr as $aA) {
                            $aVals = explode(':', $aA);
                            echo $aProductAttr[$aVals[0]] . ': ' . $aVals[1] . '<br/>';
                        }
                    }
                    ?>
                </span>
            </td>
            <td><?php echo $p['count']; ?></td>
            <td>
                <?php
                if ($sCurrency != 'zł' && $sCurrency != 'PLN') {
                    echo number_format($dFactor * (number_format($p['price'], 2, '.', '')), 2, '.', '') . ' ' . $sCurrency . '<br />(' . number_format($p['price'], 2, '.', '') . ' PLN)';
                } else {
                    echo number_format($p['price'], 2, '.', '') . ' zł';
                }
                ?>
                <?php //echo number_format($p['price'], 2, '.', '');?>
            </td>
            <td>
                <?php
                if (!empty($p['product_rebate'])) {
                    echo $p['product_rebate'] . '%';
                } else { echo ' - ';}
                ?>
                <?php //echo number_format($p['total'], 2, '.', '');?>
            </td>
            <td>
                <?php
                if ($sCurrency != 'zł' && $sCurrency != 'PLN') {
                    echo number_format($dFactor * (number_format($p['total'], 2, '.', '')), 2, '.', '') . ' ' . $sCurrency . '<br />(' . number_format($p['total'], 2, '.', '') . ' PLN)';
                } else {
                    echo number_format($p['total'], 2, '.', '') . ' zł';
                }
                ?>
                <?php //echo number_format($p['total'], 2, '.', '');?>
            </td>
        </tr>
                <?php $i++;
            endforeach; ?>
</table>