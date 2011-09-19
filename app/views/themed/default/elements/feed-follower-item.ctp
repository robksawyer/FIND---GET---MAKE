<?php
if(empty($action)) $action = 'view';
if(empty($model_id)) $model_id = $feed_item[$model]['id'];

if(!empty($feed_item['User']['fullname'])){
	$follower_name = $feed_item['User']['fullname'];
}else{
	$follower_name = $feed_item['User']['username'];
}
if(!empty($feed_item['UserFollowed']['User'])){
	if($authUser['User']['username'] == $feed_item['UserFollowed']['User']['username']){
		$followed_user_name = "you";
	}else{
		if(!empty($feed_item['UserFollowed']['User']['fullname'])){
			$followed_user_name = $feed_item['UserFollowed']['User']['fullname'];
		}else{
			$followed_user_name = $feed_item['UserFollowed']['User']['username'];
		}
	}
}
?>
<div class='grid-item' style="margin: 4px 0 4px 0;padding: 0 0 0 0;">
	<div class="feed-follower-title"><?php echo $this->Html->link($follower_name,array('controller'=>'users',
																												'action'=>'profile',
																												'plugin'=>'',
																												'ajax'=>false,
																												'admin'=>false,
																												$feed_item['User']['username'])); ?> started following <?php echo $this->Html->link($followed_user_name,array('controller'=>'users', 'action'=>'profile', 'plugin'=>'','ajax'=>false,'admin'=>false,$feed_item['UserFollowed']['User']['username'])); ?>.</div>
</div>

