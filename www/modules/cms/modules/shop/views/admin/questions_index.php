<div id="admin_questions_index"><div class="options"><h5>Zapytania klientów</h5></div>
    <table class="table_view">
        <?php if ($oQuestions->count() > 0): ?>
            <tr>
                <th>
                    ID <?php layer::GetSort('questions_orderby', 1, 2, '/4dminix/zapytania_klientow');?>
                </th>
                <th>
                <?php echo Kohana::lang('question.date'); ?> <?php layer::GetSort('questions_orderby', 3, 4, '/4dminix/zapytania_klientow');?>
            </th>
            <th>
                <?php echo Kohana::lang('question.name_phone_email'); ?> <?php layer::GetSort('questions_orderby', 5, 6, '/4dminix/zapytania_klientow');?>
            </th>
            <th>
                <?php echo Kohana::lang('question.message'); ?> <?php layer::GetSort('questions_orderby', 7, 8, '/4dminix/zapytania_klientow');?>
            </th>
            <th>
                <?php echo Kohana::lang('question.responsed'); ?> <?php layer::GetSort('questions_orderby', 9, 10, '/4dminix/zapytania_klientow');?>
            </th>
            <th>
                <?php echo Kohana::lang('question.options'); ?>
            </th>
        </tr>
        <?php foreach ($oQuestions as $q): ?>
                    <tr>
                        <td>
                <?php echo $q->id_question; ?>
                </td>
                <td>
                <?php echo date('Y-m-d, H:i:s', $q->date + 0); ?>
                </td>
                <td>
                <?php echo '<strong>' , $q->name, '</strong><br />', html::mailto($q->email), '<br />', $q->phone; ?>
                </td>
                <td>
                <?php echo text::limit_words($q->message, 24); ?>
                </td>
                <td>
                <?php echo $q->responsed == 'Y' ? html::image('img/icons/tick.png', array('alt' => Kohana::lang('question.responsed'))) : html::image('img/icons/cross.png', array('alt' => Kohana::lang('question.not_responsed'))); ?>
                </td>
                <td>	
				<?php echo html::anchor('4dminix/podglad_zapytania/' . $q->id_question, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.pages.edit'), 'class' => 'btn btn-edit')); 
				echo html::anchor('4dminix/usun_zapytanie/' . $q->id_question, Kohana::lang('admin.delete'), array('class'=>'btn btn-delete', 'title'=>Kohana::lang('admin.pages.delete'))); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
                        <div class="info"><?php echo Kohana::lang('product.no_product_comments'); ?></div>
        <?php endif; ?>
    </table>
</div>