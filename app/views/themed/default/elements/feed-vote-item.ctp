<?php
//Find the item that was liked. Unliked items are not currently shown in the feed

if(empty($action)) $action = 'view';
if(empty($model_id)) $model_id = $feed_item[$model]['id'];

$target_model = $feed_item['Vote']['model'];
$target_controller = Inflector::pluralize(strtolower($feed_item['Vote']['model']));

$target_item = $feed_item[$target_model];
$controller = $target_controller;
if(!empty($feed_item['User']['fullname'])){
	$user_name = $feed_item['User']['fullname'];
}else{
	$user_name = $feed_item['User']['username'];
}

//debug($feed_item);
?>
<div class='grid-item' style="margin: 4px 0 4px 0;padding: 0 0 0 0;">
	<div class="feed-follower-title"><?php echo $this->Html->link($user_name,array('ajax'=>false,'admin'=>false,'controller'=>'users','plugin'=>'','action'=>'profile',$feed_item['User']['username'])); ?> likes the <?php echo strtolower($target_model); ?> <?php echo $this->Html->link($feed_item[$target_model]['name'],array('controller'=>$controller,'action'=>$action,'plugin'=>'','admin'=>false,$feed_item[$target_model]['id'])); ?></div>
</div>