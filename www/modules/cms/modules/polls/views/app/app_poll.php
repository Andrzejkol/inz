<?php //echo '<pre>';var_dump($oPoll);echo '</pre>';exit; ?>
<div id="polls">
    <h2 class="cufon"><?php echo Kohana::lang('poll.poll_title') ?></h2>
    <div id="polls_question">
        <div class="polls_question_text"><strong><?php echo $oPoll[0]->question; ?></strong></div>
        <?php
        if($oCheck == false) {
            ?>
        <div id="answers">
                <?php echo form::open_multipart(NULL, array('id'=>'poll_form')); ?>
                <?php 
                foreach ($oPoll as $p) {
                    echo form::radio('answer', $p->id_answer).$p->answer.'<br />';
                }
                ?>
                <?php echo form::submit(array('name' => 'submit', 'id' =>'add_vote', 'class'=> 'vote_button', 'value'=>  Kohana::lang('poll.vote')), ''); ?>
                <input type="hidden" name="question_id" value="<?php echo $oPoll[0]->question_id; ?>" id="pool_question_id" />
                <?php echo form::close(); ?>
        </div>
        <div id="chart_div"></div>
            <?php
        }
        else {
            ?>
        <div id="chart_div"></div>		
        <script type="text/javascript">
			google.load("visualization", "1", {packages:["corechart"], 'language' : 'pl'});
			google.setOnLoadCallback(drawChart2);
			function drawChart2() {
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
				chart.draw(data, {width: 200, height:200, legend: 'none',is3D: true});
			}
		</script> 
            <?php } ?>
    </div>
</div>

<?php
/*
<div id="app_poll">
    <?php echo form::open('polls/show_results/' . $oQuestion[0]->id_question, array('method' => 'post')) ?>
    <p><?php echo $oQuestion[0]->question; ?></p>
    <ul>
        <?php foreach($oAnswers as $a) { ?>
        <li><input type="radio" name="vote" value="<?php echo $a->id_answer; ?>" id="vote_<?php echo $a->id_answer; ?>" /> <label for="vote_<?php echo $a->id_answer; ?>"><?php echo $a->answer; ?></label></li>
        <?php } ?>
    </ul><input type="submit" name="submit" id="submit" value="<?php echo Kohana::lang('poll.vote'); ?>" />
    <?php echo form::close(); ?>
</div>
*/
?>




