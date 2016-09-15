<div>
    <p>
        Voucher na kwotę: <?php echo number_format($oVoucher->voucher_value,2,'.',''); ?> jest już aktywny. Aby skorzystać z vouchera użyj poniższego kodu:<br/>
        <span style="font-size:14px;font-weight:bold"><?php echo $oVoucher->voucher_code; ?></span>
    </p>
</div>