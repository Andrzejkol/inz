<?php
View::factory('admin/elements/form_header')
        ->set(array(
            'sIco'=>'edit',
            'sTitle'=>Kohana::lang('poll.edit_poll')
            ))->render(TRUE);
?>
<div id="admin_poll_edit">
    <?php echo form::open_multipart(null, array('method' => 'post', 'id' => 'form_poll_add')); ?>

    <?php
//    var_dump($oPollDetails);
//    exit();

    foreach($oPollDetails as $p) { ?>
    
    <table class="table_form">
        <tr>
            <td class="td_form_left">
                <label for="question"><?php echo Kohana::lang('poll.question'); ?></label>
            </td>
            <td>
                    <?php echo form::input(array('type' => 'text', 'id' => 'question', 'style' => 'width: 250px;', 'name' => 'question', 'value' => $p->question)); ?>
            </td>
            <td><div class="error_message" id="question_error"></div></td>
        </tr>
        <?php /*
        <tr>
            <td class="td_form_left"><label for="lang"><?php echo Kohana::lang('poll.language'); ?></label></td>
            <td>
                <select name="language" id="language">
    <?php foreach($languages as $langKey => $langValue) { ?>
                            <?php if($langKey == $p->language) { ?>
                    <option value="<?php echo $langKey; ?>" selected="selected"><?php echo $langValue; ?></option>
                                <?php } else { ?>
                    <option value="<?php echo $langKey; ?>"><?php echo $langValue; ?></option>
            <?php } ?>
        <?php } ?>
                </select>
            </td>
            <td><div class="error_message" id="language_error"></div></td>
        </tr>
        */ ?>
        <tr>
            <td class="td_form_left">
                <label for="start_date"><?php echo Kohana::lang('poll.start_date'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('poll.comments.start_date'); ?></span>
            </td>
            <td><?php echo form::input(array('type' => 'text', 'id' => 'start_date', 'name' => 'start_date', 'style' => 'width: 100px;', 'class'=>'datepicker', 'value' => (!empty($_POST['start_date']) ? $_POST['start_date'] : (!empty($p->start_date) ? date(config::DATE_FORMAT, $p->start_date) : '')))); ?></td>
            <td><div class="error_message" id="start_date_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left">
                <label for="end_date"><?php echo Kohana::lang('poll.end_date'); ?></label>
                <span class="label_comment"><?php echo Kohana::lang('poll.comments.end_date'); ?></span>
            </td>
            <td><?php echo form::input(array('type' => 'text', 'id' => 'end_date', 'name' => 'end_date', 'style' => 'width: 100px;', 'class'=>'datepicker', 'value' => (!empty($_POST['end_date']) ? $_POST['end_date'] : (!empty($p->start_date) ? date(config::DATE_FORMAT, $p->end_date) : '')))); ?></td>
            <td><div class="error_message" id="end_date_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="active"><?php echo Kohana::lang('poll.active'); ?></label></td>
            <td>
                <?php echo form::checkbox('active', 'Y', ($p->active == 'Y') ? TRUE : '' ); ?>
            </td>
            <td><div class="error_message" id="active_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><label for="anwswers"><?php echo Kohana::lang('poll.answers'); ?></label></td>
            <td>
                <ul>
                        <?php
                        $i = 0;
                        foreach($oPollAnswers as $a) {
                            echo '<li class="polls">' . form::input(array('type' => 'text', 'id' => 'answer_' . $i,'style' => 'width: 250px;', 'name' => 'answer[' . $i . ']', 'value' => $a->answer)) . '</li>';
                        $i++;
                        }

                        if(!empty($bAllowChange) && $bAllowChange===true) {
                            for($i; $i < 10 ; $i++) {
                                echo '<li class="polls">' . form::input(array('type' => 'text','style' => 'width: 250px;', 'id' => 'answer_' . $i, 'name' => 'answer[' . $i . ']')) . '</li>';
                            }
                        }
                        ?>
                </ul>
            </td>
            <td><div class="error_message" id="answer_error"></div></td>
        </tr>
        <tr>
            <td class="td_form_left"><?php echo Kohana::lang('poll.results'); ?></td>
            <td>
                <?php if(!empty($oPoll) && $oPoll->count()>0 && $oPoll[0]->all_votes>0) : ?>
                <div id="chart_div"></div>
                <script type="text/javascript">

                    google.load("visualization", "1", {packages:["corechart"], 'language' : 'pl'});
                    google.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = new google.visualization.DataTable();

                        data.addColumn('string', 'Answer');
                        data.addColumn('number', 'Votes');
                        data.addRows(<?php echo $oPoll->count(); ?>);
                        <?php $i=0;
                        foreach ($oPoll as $p) : ?>
                        data.setValue(<?php echo $i; ?>, 0, '<?php echo $p->answer; ?>');
                        data.setValue(<?php echo $i; ?>, 1, <?php echo $p->votes; ?>);
                        <?php $i++; endforeach; ?>

                        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                        chart.draw(data, {width: 450, height:300, legend: 'right'});
                    }
                </script>
                <?php else :
                    echo Kohana::lang('poll.no_answers');
                endif; ?>

            </td>
        </tr>
        <tr>
            <td>
                <input type="button" value="Wróć" name="back"  class="btn btn-back"/>
            </td>
            <td>
                <input class="btn btn-save" type="submit" name="submit" value="<?php echo Kohana::lang('poll.save'); ?>" />
                <input class="btn btn-save-and-back" type="submit" name="submit_back" value="<?php echo Kohana::lang('poll.save_back'); ?>" />
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
    <?php } ?>
<?php echo form::close(); ?>
</div>