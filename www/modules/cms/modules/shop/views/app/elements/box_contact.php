<div id="contact">
    <h2><?php echo Kohana::lang('app.contact'); ?></h2>
    <p>
        Nie znalazłeś szukanego produktu?<br />
        Skontaktuj się z nami: <br />
        <?php echo config::getConfig('short_contact_details'); ?>
    </p>
    <div id="ask_question">
        <?php echo html::anchor('zadaj_pytanie', Kohana::lang('app.ask_question').'&nbsp;&nbsp;&raquo;'); ?>
    </div>
</div>