<div id="confirm_newsletter">
    <h4><span class="cufon_chapa">Newsletter</span></h4>
    <?php echo form::open(); ?>    			
    <div id="subscribe_summary">				
        <?php echo Kohana::lang('app.subscription_title');?>
        <p><?php echo Kohana::lang('app.your_email');?> <strong><?php echo $_POST['newsletter_email']; ?></strong></p>
        <input type="hidden" value="<?php echo $_POST['newsletter_email']; ?>" name="newsletter_email" />
        <table>
            <tbody>
                <tr>
                    <td valign="top"><input type="checkbox" value="1" id="newsletter_zgoda" name="newsletter_zgoda" style="margin: 2px 3px 0 0; width: 13px; height: 13px; overflow: hidden;"></td>
                    <td style="vertical-align: top; font-size: 10px; line-height: 12px;">
                        <label for="newsletter_zgoda">
                            <?php echo Kohana::lang('app.newsletter_zgoda');?>
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>				
        <br/>
        <input type="hidden" name="subscription" value="confirm_subscription" />        
        <input type="submit" name="submit" id="submit" value="Zapisz" />
    </div>
    <?php echo form::close(); ?>
</div>	