<?php
if(empty($action)) $action = 'view';
if(empty($model_id)) $model_id = $feed_item[$model]['id'];
?>
<div class='grid-item'>
	<div class="feed-text-title"><?php echo $this->Html->link($feed_item[$model]['name'],array('controller'=>$controller,
																												'action'=>$action,
																												'plugin'=>'',
																												'admin'=>false,
																												$model_id)); ?> started following you.</div>
</div>