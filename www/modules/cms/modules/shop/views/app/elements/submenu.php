<?php /*
  <div id="left-submenu">
  <h4><span class="cufon_chapa"><?php echo Kohana::lang('app.menu');?></span></h4>
  <ul>
  <li><?php echo html::anchor(Kohana::lang('links.lang').Kohana::lang('links.partners'), Kohana::lang('app.partners')); ?></li>
  <li><?php echo html::anchor(Kohana::lang('links.lang').Kohana::lang('links.facts'), Kohana::lang('app.facts')); ?></li>
  <li><?php echo html::anchor(Kohana::lang('links.lang').Kohana::lang('links.mission'), Kohana::lang('app.mission')); ?></li>
  <li><?php echo html::anchor(Kohana::lang('links.lang').Kohana::lang('links.history'), Kohana::lang('app.history')); ?></li>
  <li><?php echo html::anchor(Kohana::lang('links.lang').Kohana::lang('links.links'), Kohana::lang('app.links')); ?></li>
  </ul>
  </div> */ ?>
<div id="left-submenu">
    <h4><span class="cufon_chapa"><?php echo Kohana::lang('app.menu'); ?></span></h4>
    <?php if (!empty($sMenu)) echo $sMenu; ?>
</div>