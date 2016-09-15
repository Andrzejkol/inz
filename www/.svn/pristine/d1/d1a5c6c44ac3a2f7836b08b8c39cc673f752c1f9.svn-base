<div class="comments-block">
    <h4><?php echo Kohana::lang('app.comments') ?> (<?php echo (isset($oNewsComments)) ? $oNewsComments->count() : '0' ?>)</h4>
    <?php if (!empty($oNewsComments) AND $oNewsComments->count() > 0) : ?>
        <div class="comments">
            <?php $i = 1; ?>
            <?php foreach ($oNewsComments as $oComment) : ?>
                <div class="comment <?php if ($i % 2 == 0) echo 'even'; ?>">
                    <div class="author"><?php echo $oComment->nick; ?></div>
                    <div class="comment-desc"><?php echo $oComment->comment; ?></div>
                </div>
                <?php $i++; ?>
            <?php endforeach; ?>
        </div>
    <?php endif;
    ?>
    <div class="row comments-form">
        <p class="col-sm-12" style="font-weight: bold; font-size: 1.2em;"><?php echo Kohana::lang('app.add_your_comment') ?></p>
        <?php echo form::open(); ?>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="comment"><?php echo Kohana::lang('app.comment') ?>:</label>
                <textarea class="form-control" name="comment" id="comment"><?php echo (!empty($_POST['comment'])) ? $_POST['comment'] : NULL; ?></textarea>
            </div>
            <div class="form-group">
                <label for="comment"><?php echo Kohana::lang('app.author') ?>:</label>
                <input class="form-control" type="text" name="nick" id="nick" value="<?php echo!empty($_POST['nick']) ? $_POST['nick'] : NULL; ?>" />
            </div>
            <div class="form-group">
                <?php
                echo $captcha->render(); // Shows the Captcha challenge (image/riddle/etc) 
                ?>
                <input class="form-control" type="text" name="captcha_response" id="captcha_response" value="" />
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn" id="submit" value="<?php echo Kohana::lang('app.add'); ?>" />
            </div>
        </div>
        <?php echo form::close(); ?>
    </div>
</div>