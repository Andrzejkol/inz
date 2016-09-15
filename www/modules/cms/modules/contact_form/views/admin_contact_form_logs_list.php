<div id="admin_contact_form_logs">
    <h2>Lista logów formularzy kontaktowych</h2>
    <?php if (!empty($oLogs) && $oLogs->count() > 0) : ?>
        <table id="contact_form_list" class="table_view">
            <tr>
				<th>#</th>
				<th><?php echo Kohana::lang('contact_form.ip_address'); ?></th>
				<th><?php echo Kohana::lang('contact_form.sent_date'); ?></th>
                <th><?php echo 'Nazwa nadawcy' ?></th>
                <th><?php echo Kohana::lang('contact_form.sender_email'); ?></th>
				<th><?php echo Kohana::lang('contact_form.phone') ?></th>
				<th><?php echo Kohana::lang('contact_form.topic') ?></th>
				<th><?php echo Kohana::lang('contact_form.message'); ?></th>
            </tr>
			<?php foreach ($oLogs as $log) : ?>
				<tr>
					<td><?php echo !empty($log->id_contact_form_log) ? $log->id_contact_form_log : 'brak' ?></td>
					<td><?php echo !empty($log->ip_address) ? htmlspecialchars($log->ip_address) : 'brak'; ?></td>
					<td><?php echo !empty($log->date_sent) ? date(config::DATE_TIME_FORMAT, $log->date_sent) : 'brak'; ?></td>
					<td><?php echo !empty($log->date_sent) ? htmlspecialchars($log->name) : 'brak'; ?></td>
					<td><?php echo !empty($log->email) ? htmlspecialchars($log->email) : 'brak'; ?></td>
					<td><?php echo !empty($log->phone) ? htmlspecialchars($log->phone) : 'brak' ?></td>
					<td><?php echo !empty($log->topic) ? $log->topic : 'brak' ?></td>
					<td style="width: 250px;"><?php echo htmlspecialchars($log->message); ?></td>
				</tr>
			<?php endforeach; ?>
        </table>
    <?php else : ?>
		<div class="info"><?php echo Kohana::lang('contact_form.log_table_empty'); ?></div>
	<?php endif; ?>
<?php echo !empty($oPagination) ? $oPagination : '';?>
</div>