<div id="sorting" style="float: right;">
<?php unset($_GET['filter_name']);?>
<?php unset($_GET['filter_prices']);?>
<?php $get=array();?>
<?php foreach($_GET as $k => $v):?>
<?php $get[] = $k . '=' . $v ;?>
<?php endforeach;?>
Sortowanie:&nbsp;&nbsp;
<?php echo html::anchor(url::current().'?' . implode('&', $get).'&filter_name=ca', html::image('img/sort-up.png', array('alt'=>'Rosnąco', 'title'=>'Rosnąco')));?>
Nazwa
<?php echo html::anchor(url::current().'?' . implode('&', $get).'&filter_name=cd', html::image('img/sort-down.png', array('alt'=>'Malejąco', 'title'=>'Malejąco')));?>&nbsp;
&nbsp;&nbsp;&nbsp;
<?php echo html::anchor(url::current().'?' . implode('&', $get).'&filter_prices=ca', html::image('img/sort-up.png', array('alt'=>'Rosnąco', 'title'=>'Rosnąco')));?>
Cena
<?php echo html::anchor(url::current().'?' . implode('&', $get).'&filter_prices=cd', html::image('img/sort-down.png', array('alt'=>'Malejąco', 'title'=>'Malejąco')));?>
</div>
