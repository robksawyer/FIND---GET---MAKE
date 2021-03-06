<?php
if(empty($action)) $action = 'view';
if(empty($model_id)) $model_id = $feed_item[$model]['id'];
if($model == "Source"){
	$showLikeDislike = true;
}else{
	$showLikeDislike = false;
}
?>
<div class='grid-item'>
	<?php
	/*
		TODO Add a like/dislike button in this area. Or, possibly the rating.
	*/
	if($showLikeDislike) echo $this->element('feed-like-dislike',array('cache'=>false,'model'=>$model,'model_id'=>$model_id));
	?>
	<div class="feed-text-title"><?php echo $this->Html->link($feed_item[$model]['name'],array('controller'=>$controller,
																												'action'=>$action,
																												'plugin'=>'',
																												'admin'=>false,
																												$model_id)); ?></div>
	<div class="description"><?php echo $string->truncate($feed_item[$model]['description'],150); ?></div>
	<div class="added-by">Added by <?php echo $this->Html->link($feed_item['User']['username'],array('admin'=>false,'controller'=>'users','plugin'=>'forum','action'=>'profile',$feed_item['User']['username'])); ?></div>
	<div class='bottom-detail'>
		<span class='date'><?php echo $this->Time->timeAgoInWords($feed_item[$model]['created'],null,null); ?></span>
		<span class="tags">
			<?php
			//Build a tag list of only two tags.
			$limit = 2;
			$counter = 0;
			if(!empty($feed_item['Tag'])){
			  	echo " / ";
				foreach($feed_item['Tag'] as $tag){
					if($counter == $limit) break;
					if($counter == ($limit - 1) || count($feed_item['Tag']) < 2){
						echo $this->Html->link($tag['name'],array('controller'=>$controller,'action'=>'index/by:'.$tag['keyname']));
					}else{
						echo $this->Html->link($tag['name'],array('controller'=>$controller,'action'=>'index/by:'.$tag['keyname'])).", ";
					}
					$counter++;
				}
			}
			?>
	 	</span>
		<div class="clear"></div>
	</div>
</div>