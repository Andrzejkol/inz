<div id="admin_newsletter_send">
    <div id="newsletter_send_title">
        <h2><?php echo Kohana::lang('newsletter.send_newsletter'); ?></h2>
    </div>
    <table class="table_form">
        <tr>
            <td colspan="2"><strong><?php echo $oNewsletter[0]->title; ?></strong></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('newsletter.interval'); ?></td>
            <td><?php echo ($oNewsletter[0]->interval) / 60000; ?> min</td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('newsletter.bulk_size'); ?></td>
            <td><?php echo $oNewsletter[0]->bulk; ?></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <?php echo Kohana::lang('newsletter.groups'); ?>
            </td>
            
            <td>
                <?php if($allNewsletterGroups->count()): ?>
                <ul id="newsletter_groups">
                <?php foreach($allNewsletterGroups as  $ng) { ?>
                    <?php if(in_array($ng->id_newsletter_group, $aNewsletterGroups)) { 
						if (empty($aEmailsCount[$ng->id_newsletter_group])) {
							$ng->name .= ' (<span style="color: red;">brak emaili</span> przypisanych do tej grupy)';
						}
						?>
                    <li><input type="checkbox" name="newsletter_group[<?php echo $ng->id_newsletter_group; ?>]" id="newsletter_group_<?php echo $ng->id_newsletter_group; ?>" checked="checked" /> <label for="newsletter_group_<?php echo $ng->id_newsletter_group; ?>"><?php echo $ng->name; ?></label></li>
                    <?php } else { ?>
                    <li><input type="checkbox" name="newsletter_group[<?php echo $ng->id_newsletter_group; ?>]" id="newsletter_group_<?php echo $ng->id_newsletter_group; ?>" /> <label for="newsletter_group_<?php echo $ng->id_newsletter_group; ?>"><?php echo $ng->name; ?></label></li>
                    <?php } ?>
                <?php } ?>
                </ul>
                <?php else: ?>
                Brak zdefiniowanych grup o tym samym języku co newsletter.
                <?php endif; ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo form::input(array('name' => 'send', 'type' => 'button', 'id' => 'send', 'class' => 'ui-button ui-widget ui-state-default ui-corner-all'), Kohana::lang('newsletter.click_to_send')); ?>
            </td>
            <td>
                <?php echo form::input(array('name' => 'stop', 'id' => 'stop', 'type' => 'button',  'class' => 'ui-button ui-widget ui-state-default ui-corner-all'), Kohana::lang('newsletter.click_to_stop')); ?>
            </td>
        </tr>
    </table>
    <div id="sending_layer" style="padding: 10px;">
        Naciśnij przycisk <strong>start</strong> aby rozpocząć...<br />
    </div>
    <script type="text/javascript">
        var retValue = false;
        var limit = <?php echo $oNewsletter[0]->bulk;  ?>;
        var offset = 0;
		var ajaxInterval = null;
		var stopInterval = true;
		var sendingFinish = false;

        $('#send').click( function() {
            if(sendingFinish){
                $('#sending_layer').html($('#sending_layer').html() + '<strong>Już raz wysłano ten newsletter, odśwież jeśli chcesz wysłać go ponownie</strong> <br />');
                return;
            }
            
            try {
                $('#sending_layer').html($('#sending_layer').html() + 'Wysyłanie e-maili... <br />')
                $('#send').attr('disabled', 'disabled');
                $('#stop').removeAttr('disabled');
                sendNewsletter();
                ajaxInterval = setInterval("sendNewsletter()", <?php echo $oNewsletter[0]->interval;  ?> );
                stopInterval = false;
            } catch(e) {
                alert(e);
            }
        });

        $('#stop').click( function() {
            try {
                $('#stop').attr('disabled', 'disabled');
                $('#send').removeAttr('disabled');
                if(stopInterval == false) {
                    clearInterval(ajaxInterval);
                    stopInterval = true;
                    $('#sending_layer').html( $('#sending_layer').html() + '<strong>Wysyłanie przerwano</strong>' + '<br />');
                    return;
                }
            } catch(e) {
                alert(e);
            }
        });
        
        function sendNewsletter() {
            try {
                $('.error_message').hide();
                var newsletter_groups = $('#newsletter_groups input:checked');
                var ng = new Array();
                for(i = 0 ; i < newsletter_groups.length ; i++) {
                    ng.push(newsletter_groups[i].attributes['id'].value.split('_')[2]);
                }
                newsletter_groups = ng.join(',');
                var dataString = 'id=<?php echo $oNewsletter[0]->id_newsletter;  ?>&groups=' + newsletter_groups + '&limit=' + limit + '&offset=' + offset + '&rand='+ parseInt(Math.random()*9999999);
                $.ajax({
                    type: "POST",
                    url: urlBase+"newsletters_ajax/send",
                    data: dataString,
                    async: false,
                    success: function(serverResponse) {
                        if(trim(serverResponse) == 'EOF') {
                            $('#stop').attr('disabled', 'disabled');
                            $('#send').removeAttr('disabled');
                            stopInterval = true;
                            clearInterval(ajaxInterval);
                            $('#sending_layer').html( $('#sending_layer').html() + '<strong>Wysyłanie zakończono</strong>' + '<br />');
                            sendingFinish = true;
                            return;
                        }
                        $('#sending_layer').html( $('#sending_layer').html() + serverResponse + '<br />');
                        offset += limit
                    }
                });
                return retValue;
            } catch(e) {
                alert(e);
                return false;
            }            
        }
    </script>
</div>