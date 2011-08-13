<div class="collections moderate">
	<div class="header grey"><?php __('Your latest Collections'); ?></div>
	<?php
	if(!empty($collections)):
	?>
	<!-- Start gridded items -->
	<div id="grid-container-collections">
	<?php
	$i = 0;
	foreach ($collections as $collection):
	
	?>
		<div class="grid-item">
			<?php 
				//debug($collection);
				//Check to see if there are any products in the collection
				if(!empty($collection['Product'])){
					//Loop through 5 collection images and add those to a collage
					$limit = 4;
					//debug($collection['Product'][$i]);
					for($i=0;$i<count($collection['Product']);$i++){
						if(!empty($collection['Product'][$i])){
							if($i < $limit){
								if(count($collection['Product']) > 1){
									echo $this->Html->image($collection['Product'][$i]['Attachment'][0]['path_small'],array(
																																					'alt'=>'',
																																					'url'=>array(
																																						'action'=>'view',
																																						$collection['Collection']['id']
																																						),
																																					'style'=>'max-height: 75px;padding:5px;'
																																					));
								}else{
									echo $this->Html->image($collection['Product'][$i]['Attachment'][0]['path_med'],array(
																																					'alt'=>'',
																																					'url'=>array(
																																						'action'=>'view',
																																						$collection['Collection']['id']
																																						),
																																					'style'=>'max-height: 200px'
																																					));
								}
							
							}else{
								break;
							}
						}
					}
				}
			?>
			<br/>
			<span class="title"><?php echo $this->Html->link($collection['Collection']['name'],array('controller'=>'collections','action'=>'view',$collection['Collection']['id'])); ?></span>
			<br/>
			<p class="description"><?php echo $string->truncate($collection['Collection']['description'],350); ?></p>
			<br/>
			<?php if(!empty($collection['Collection']['designer'])) echo "Designed by ".$collection['Collection']['designer']; ?><br/>
			<div class="bottom-detail">
				<span class="date"><?php echo $this->Time->niceShort($collection['Collection']['created'],null,null); ?>&nbsp;</span>
				<span class="tags"><?php
					//Build a tag list of only two tags.
					$limit = 2;
					$counter = 0;
					//debug($collection['Tag']);
					if(!empty($collection['Tag'])){
						echo " / ";
						foreach($collection['Tag'] as $tag){
							if($counter == $limit) break;
				
							if($counter == ($limit - 1) || count($collection['Tag']) < 2){
								echo $this->Html->link($tag['name'],array('controller'=>'collections','action'=>'index/by:'.$tag['keyname']));
							}else{
								echo $this->Html->link($tag['name'],array('controller'=>'collections','action'=>'index/by:'.$tag['keyname'])).", ";
							}

							$counter++;
						}
					}
				?></span>
				<?php if(!empty($collection['Collection']['private'])): ?>
				<div class="lock"><?php echo $this->Html->image('icons/lock.png',array('alt'=>'PRIVATE','title'=>'This collection is private.','height'=>'16')); ?></div>
				<?php endif; ?>
				<div class="clear"></div>
			</div>
		</div>
	<?php endforeach;  ?>
	</div>
	<div class="clear"></div>
	<!-- End gridded items -->
	<?php else: ?>
		<div class="missing-content"><p>Things you’ve grouped together for any reason or season: that’s a collection.<p></div>
	<?php
	endif;
	?>
</div>
<div class="clear"></div>
<script type="text/javascript">
$(function(){
	var $container = $("#grid-container-collections");
	$container.imagesLoaded(function(){
		$container.masonry({
			//option
			itemSelector: '.grid-item'
		});
	});
});
</script>