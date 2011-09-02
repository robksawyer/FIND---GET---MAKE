<?php
//You can only own or have products in the system currently

if(empty($action)) $action = 'view';
if(empty($model_id)) $model_id = $feed_item[$model]['id'];

if($feed_item[$model]['have_it'] > 0){
	$status_by = 'Owned by';
}else if($feed_item[$model]['want_it'] > 0){
	$status_by = 'Wanted by';
}

$added_by = "Found by";
$showLikeDislike = true; //Show the likes for the product
if(!empty($feed_item['Product']['Attachment'][0])):
$product_attachment0 = $feed_item['Product']['Attachment'][0];
$product = $feed_item;
$controller = 'products';
?>
<div class='grid-item'>
	<?php
	/*
		TODO Add a like/dislike button in this area. Or, possibly the rating.
	*/
	if($showLikeDislike) echo $this->element('feed-like-dislike',array('cache'=>false,'model'=>'Product','model_id'=>$product['Product']['id']));
	echo $this->Html->image($product_attachment0['path'],array(
																	'alt'=>$product['Product']['name'],
																	'title'=>$product['Product']['name'],
																	'url'=>array(
																					'controller'=>$controller,
																					'action'=>$action,
																					'plugin'=>'',
																					'admin'=>false,
																					$product['Product']['id']
																					)));
	?>
	<div class="title"><?php echo $this->Html->link($product['Product']['name'],array('controller'=>$controller,
																												'action'=>$action,
																												'plugin'=>'',
																												'admin'=>false,
																												$product['Product']['id'])); ?></div>
	<div class="added-by"><?php echo $status_by." ".$this->Html->link($feed_item['User']['username'],array('admin'=>false,'controller'=>'users','plugin'=>'forum','action'=>'profile',$feed_item['User']['username'])); ?></div>
	<div class="added-by"><?php echo $added_by." ".$this->Html->link($product['User']['username'],array('admin'=>false,'controller'=>'users','plugin'=>'forum','action'=>'profile',$product['User']['username'])); ?></div>
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