<?php
if(empty($action)) $action = 'view';
if(empty($model_id)) $model_id = $feed_item[$model]['id'];

$showLikeDislike = true; //Allow likes on the collection

$added_by = "Added by ";
/*
	TODO Build an image collage
*/
$product = $feed_item['Product'][0];
//debug($feed_item);
if(!empty($product['Attachment'][0])):
$image_attachment0 = $product['Attachment'][0];
?>
<div class='grid-item'>
	<?php
	if($showLikeDislike) echo $this->element('feed-like-dislike',array('cache'=>false,'model'=>$model,'model_id'=>$model_id));
	//Loop through 5 collection images and add those to a collage
	$limit = 4;
	//debug($collection['Product'][$i]);
	for($i=0;$i<count($product['Attachment']);$i++){
		if(!empty($product['Attachment'][$i])){
			if($i < $limit){
				if(count($product['Attachment']) > 1){
					echo $this->Html->image($product['Attachment'][0]['path_small'],array(
																												'alt'=>$product['Product']['name'],
																												'title'=>$product['Product']['name'],
																												'url'=>array(
																													'controller'=>$controller,
																													'action'=>$action,
																													'plugin'=>'',
																													'admin'=>false,
																													$model_id
																													),
																												'style'=>'max-height: 75px;padding:5px;'
																												));
				}else{
					echo $this->Html->image($product['Attachment'][$i]['path'],array(
																											'alt'=>$product['Product']['name'],
																											'title'=>$product['Product']['name'],
																											'url'=>array(
																												'controller'=>$controller,
																												'action'=>$action,
																												'plugin'=>'',
																												'admin'=>false,
																												$model_id
																												),
																											'style'=>'max-height: 200px'
																											));
				}
			
			}else{
				break;
			}
		}
	}
	?>
	<div class="title"><?php echo $this->Html->link($product['Product']['name'],array('controller'=>$controller,
																												'action'=>$action,
																												'plugin'=>'',
																												'admin'=>false,
																												$model_id)); ?></div>
	<div class="added-by"><?php echo $added_by.$this->Html->link($product['User']['username'],array('admin'=>false,'controller'=>'users','plugin'=>'forum','action'=>'profile',$product['User']['username'])); ?></div>
	<div class='bottom-detail'>
		<span class='created'><?php echo $this->Time->timeAgoInWords($feed_item['Feed'][0]['modified'],null,null); ?></span>
		<span class="tags">
			<?php
			//Build a tag list of only two tags.
			$limit = 2;
			$counter = 0;
			if(!empty($product['Tag'])){
			  	echo " / ";
				foreach($product['Tag'] as $tag){
					if($counter == $limit) break;
					if($counter == ($limit - 1) || count($product['Tag']) < 2){
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