<?php
if(empty($action)) $action = 'view';
if(empty($model_id)) $model_id = $feed_item[$model]['id'];
if($model == "Product"){
	$showLikeDislike = true;
}else{
	$showLikeDislike = false;
}

if($model == "Product"){
	$added_by = "Found by ";
}else{
	$added_by = "Added by ";
}
//debug($feed_item);
//if(!empty($feed_item[$model]['Attachment'][0])):
if(!empty($feed_item['Attachment'][0])):
?>
<div class='grid-item'>
	<?php
	/*
		TODO Add a like/dislike button in this area. Or, possibly the rating.
	*/
	if($showLikeDislike) echo $this->element('feed-like-dislike',array('cache'=>false,'user'=>$user,'model'=>$model,'model_id'=>$model_id));
	echo $this->Html->image($feed_item['Attachment'][0]['path'],array(
																	'alt'=>$feed_item[$model]['name'],
																	'title'=>$feed_item[$model]['name'],
																	'url'=>array(
																					'controller'=>$controller,
																					'action'=>$action,
																					'plugin'=>'',
																					'admin'=>false,
																					$model_id
																					)));
	?>
	<div class="title"><?php echo $this->Html->link($feed_item[$model]['name'],array('controller'=>$controller,
																												'action'=>$action,
																												'plugin'=>'',
																												'admin'=>false,
																												$model_id)); ?></div>
	<div class="added-by"><?php echo $added_by.$this->Html->link($feed_item['User']['username'],array('admin'=>false,'controller'=>'users','plugin'=>'forum','action'=>'profile',$feed_item['User']['username'])); ?></div>
	<div class='bottom-detail'>
		<span class='created'><?php echo $this->Time->timeAgoInWords($feed_item[$model]['created'],null,null); ?></span>
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
<?php endif; ?>