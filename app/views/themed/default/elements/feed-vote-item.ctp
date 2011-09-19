<?php
//Find the item that was liked. Unliked items are not currently shown in the feed

if(empty($action)) $action = 'view';
if(empty($model_id)) $model_id = $feed_item[$model]['id'];

$target_model = $feed_item['Vote']['model'];
$target_controller = Inflector::pluralize(strtolower($feed_item['Vote']['model']));

$liked_by = "Liked by";
$showLikeDislike = true; //Show the likes for the product

if(!empty($feed_item[$target_model]['Attachment'][0])):
$attachment0 = $feed_item[$target_model]['Attachment'][0];
$target_item = $feed_item[$target_model];
$controller = $target_controller;
?>
<div class='grid-item'>
	<?php
	/*
		TODO Add a like/dislike button in this area. Or, possibly the rating.
	*/
	if($showLikeDislike) echo $this->element('feed-like-dislike',array('cache'=>false,'model'=>$target_model,'model_id'=>$feed_item[$target_model]['id']));
	echo $this->Html->image($attachment0['path'],array(
																	'alt'=>$feed_item[$target_model]['name'],
																	'title'=>$feed_item[$target_model]['name'],
																	'url'=>array(
																					'controller'=>$controller,
																					'action'=>$action,
																					'plugin'=>'',
																					'admin'=>false,
																					$feed_item[$target_model]['id']
																					)));
	?>
	<div class="title"><?php echo $this->Html->link($feed_item[$target_model]['name'],array('controller'=>$controller,
																												'action'=>$action,
																												'plugin'=>'',
																												'admin'=>false,
																												$feed_item[$target_model]['id'])); ?></div>
	<div class="added-by"><?php echo $liked_by." ".$this->Html->link($feed_item['User']['username'],array('admin'=>false,'controller'=>'users','plugin'=>'forum','action'=>'profile',$feed_item['User']['username'])); ?></div>
	<?php if(!empty($target_item['User'])): ?>
	<div class="added-by"><?php echo "Found by ".$this->Html->link($target_item['User']['username'],array('admin'=>false,'controller'=>'users','plugin'=>'forum','action'=>'profile',$target_item['User']['username'])); ?></div>
	<?php endif; ?>
	<div class='bottom-detail'>
		<span class='created'><?php echo $this->Time->timeAgoInWords($feed_item['Feed'][0]['modified']); ?></span>
		<span class="tags">
			<?php
			//Build a tag list of only two tags.
			$limit = 2;
			$counter = 0;
			if(!empty($target_item['Tag'])){
			  	echo " / ";
				foreach($target_item['Tag'] as $tag){
					if($counter == $limit) break;
					if($counter == ($limit - 1) || count($target_item['Tag']) < 2){
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