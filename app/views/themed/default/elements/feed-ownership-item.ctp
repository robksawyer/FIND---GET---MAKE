<?php
//You can only own or have products in the system currently

if(empty($action)) $action = 'view';
if(empty($model_id)) $model_id = $feed_item[$model]['id'];

if($feed_item[$model]['have_it'] > 0){
	$status_by = ' owns ';
}

$added_by = "Found by";
$showLikeDislike = true; //Show the likes for the product
$product = $feed_item;
$controller = 'products';

if(!empty($feed_item['User']['fullname'])){
	$user_name = $feed_item['User']['fullname'];
}else{
	$user_name = $feed_item['User']['username'];
}
?>
<div class='grid-item' style="margin: 4px 0 4px 0;padding: 0 0 0 0;">
	<div class="feed-follower-title"><?php echo $this->Html->link($user_name,array('admin'=>false,'controller'=>'users','plugin'=>'','action'=>'profile',$feed_item['User']['username'])).$status_by."the product ".$this->Html->link($product['Product']['name'],array('controller'=>$controller,
																												'action'=>$action,
																												'plugin'=>'',
																												'admin'=>false,
																												'ajax'=>false,
																												$product['Product']['id'])); ?></div>
</div>