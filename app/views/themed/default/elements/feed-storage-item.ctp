<?php
//Only do stuff if the item has an image associated with it.
if(!empty($feed_item['Product']['Attachment'][0])):

if(empty($action)) $action = 'view';
if(empty($model)) $model = 'Product';
if(empty($model_id)) $model_id = $feed_item[$model]['id'];
//$showLikeDislike = true;
$showDot = false;

if($feed_item[$model]['user_id'] == $feed_item['Storage']['user_id']){
	$showDot = true;
	$added_by = "Found by ";
}else{
	$showDot = true;
	$added_by = "Added by ";
}

?>
<div class='grid-item'>
	<?php
	//if($showLikeDislike) echo $this->element('feed-like-dislike',array('cache'=>false,'model'=>$model,'model_id'=>$model_id));
	if($showDot) echo $this->element('feed-dot',array('cache'=>false,'model'=>$model,'model_id'=>$model_id));
	echo $this->Html->image($feed_item['Product']['Attachment'][0]['path'],array(
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
	<div class="added-by"><?php echo $added_by.$this->Html->link($feed_item['User']['username'],array('admin'=>false,'controller'=>'users','plugin'=>'','action'=>'profile',$feed_item['User']['username'])); ?></div>
	<div class='bottom-detail'>
		<span class='created'><?php 
				echo $this->Time->timeAgoInWords($feed_item['Feed'][0]['modified']); 
		?></span>
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