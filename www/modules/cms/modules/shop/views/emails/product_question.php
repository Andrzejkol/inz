Dnia <?php echo date('Y-m-d'); ?> o godzinie <?php echo date('H:i'); ?><br />
została wysłana wiadomość przez <?php echo html::specialchars($email); ?><br />
dotycząca przedmiotu: <?php echo html::specialchars($topic); ?><br />
o następującej treści<br />
<div>
    <?php echo html::specialchars($content); ?>
</div>
