<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'add',
            'sTitle'=>Kohana::lang('poll.add_poll')
            ))->render(TRUE);
?>
<div id="admin_poll_add">
    <?php echo form::open_multipart(null, array('method' => 'post', 'id' => 'form_poll_add')); ?>
    <table class="table_form">
        <tr>
            <td class="td_form_left"><label for="question"><?php echo Kohana::lang('poll.question'); ?></label></td>
            <td><?php echo form::input(array('type' => 'text', 'id' => 'question', 'name' => 'question', 'style' => 'width: 250px;')); ?></td>
            <td><div class="error_message" id="question_error"></div></td>
        </tr>
        <?php /*
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('poll.language'); ?></td>
            <td><?php echo form::dropdown(array('name'=>'language', 'style' => 'width: 150px;', 'id'=>'add_poll_language'),$languages, !empty($_POST['lang']) ? $_POST['lang'] : $oCategoryDetails[0]->lang); ?></td>
            <td><div id="langs_error" class="error_message"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('poll.category_name'); ?></td>
            <td><?php echo form::dropdown(array('name' => 'poll_category', 'style' => 'width:255px;', 'id' => 'polls_categories_for_language'),$aCategories, !empty($_POST['poll_category']) ? $_POST['poll_category'] : $oCategoryDetails[0]->id_poll_category); ?></td>
            <td><div id="page_id_error" class="error_message"></div></td>
        </tr>
        */ ?>
        <tr>
            <td class="td_form_left">
                <label for="start_date"><?php echo Kohana::lang('poll.start_date'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('poll.comments.start_date'); ?></span>
            </td>
            <td>
                <?php echo form::input(array('type' => 'text', 'id' => 'start_date', 'name' => 'start_date', 'style' => 'width: 100px;', 'class'=>'datepicker', 'value' => (!empty($_POST['start_date']) ? $_POST['start_date'] : '') )); ?>
            </td>
            <td><div class="error_message" id="start_date_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="end_date"><?php echo Kohana::lang('poll.end_date'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('poll.comments.end_date'); ?></span>
            </td>
            <td>
                <?php echo form::input(array('type' => 'text', 'id' => 'end_date', 'name' => 'end_date', 'style' => 'width: 100px;', 'class'=>'datepicker', 'value' => (!empty($_POST['end_date']) ? $_POST['end_date'] : ''))); ?>
            </td>
            <td><div class="error_message" id="end_date_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="active"><?php echo Kohana::lang('poll.active'); ?></label></td>
            <td>
                <?php echo form::checkbox('active', 'Y'); ?>
            </td>
            <td><div class="error_message" id="active_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="anwswers"><?php echo Kohana::lang('poll.answers'); ?></label></td>
            <td>
                <ul>
                        <?php
                        for($i = 0 ; $i < 10 ; $i++) {
                            echo '<li class="polls">' . form::input(array('type' => 'text','style' => 'width: 250px;', 'id' => 'answer_' . $i, 'name' => 'answer[' . $i . ']')) . '</li>';
                        }
                        ?>
                </ul>
            </td>
            <td><div class="error_message" id="answer_error"><?php if(!empty($answer_error)) {
        echo $answer_error;
    } ?></div></td>
        </tr>
        <tr>
            <td>
                <input type="button" value="Wróć" name="back"  class="btn btn-back"/>
            </td>
            <td>
                <input class="btn btn-save" type="submit" name="submit" value="<?php echo Kohana::lang('admin.add'); ?>" />
                <input class="btn btn-save-and-back" type="submit" name="submit_back" value="<?php echo Kohana::lang('admin.add_back'); ?>" />
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
    <?php echo form::close(); ?>
</div>