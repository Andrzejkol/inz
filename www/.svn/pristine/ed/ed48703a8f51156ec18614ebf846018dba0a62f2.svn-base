<div id="admin_question_preview">
    <?php echo form::open(null, array('method' => 'post')); ?>
    <div id="question_preview_title">
        <h2><?php echo Kohana::lang('question.preview'); ?></h2>
    </div>
    <table class="questions" cellspacing="0">
    <?php foreach($oQuestionDetails as $q) : ?>
        <tr>
            <th><?php echo Kohana::lang('question.product_info'); ?></th>
            <td><?php echo $q->product_info; ?></td>
        </tr>
        <tr>
            <th><?php echo Kohana::lang('question.customer_details'); ?></th>
            <td><?php echo '<strong>' , $q->name, '</strong><br />', html::mailto($q->email), '<br />', $q->phone; ?></td>
        </tr>
        <tr>
            <th><?php echo Kohana::lang('question.question_date'); ?></th>
            <td><?php echo date(config::DATE_TIME_FORMAT, $q->date+0); ?></td>
        </tr>
        <tr>
            <th><?php echo Kohana::lang('question.message'); ?></th>
            <td><?php echo $q->message; ?></td>
        </tr>
        <tr>
            <th><?php echo Kohana::lang('question.is_responsed'); ?></th>
            <td><?php echo form::dropdown('responsed', array('Y' => Kohana::lang('question.responsed'), 'N' => Kohana::lang('question.not_responsed')), $q->responsed); ?></td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td><input type="button" value="<?php echo Kohana::lang('admin.back'); ?>" name="back" class="btn btn-back" /></td>
            <td><input type="submit" name="submit" value="<?php echo Kohana::lang('admin.save'); ?>" class="btn btn-save" /></td>
            <td>&nbsp;</td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>