<div class="inspirations moderate">
	<div class="header teal"><?php __('Latest inspirations');?></div>
	<div id="grid-container-inspirations">
	<?php
	if(!empty($inspirations)):
	$i = 0;
	foreach ($inspirations as $inspiration):
	?>
		<div class="grid-item">
			<?php 
				if(!empty($inspiration['Attachment'][0]['path_med'])){
					echo $this->Html->image($inspiration['Attachment'][0]['path_med'],array('alt'=>'','url'=>array('plugin'=>'','admin'=>false,'controller'=>'inspirations','action'=>'view',$inspiration['Inspiration']['id']))); 
				}
			?>
			<br/>
			<span class="title"><?php echo $this->Html->link($inspiration['Inspiration']['name'],array('plugin'=>'','admin'=>false,'controller'=>'inspirations','action'=>'view',$inspiration['Inspiration']['id'])); ?></span><br/>
			<span class="description"><?php echo $string->truncate($inspiration['Inspiration']['description'],150); ?></span><br/>
			<?php if(!empty($inspiration['Inspiration']['designer'])) echo "Designed by, ".$inspiration['Inspiration']['designer']; ?><br/>
			<div class="bottom-detail">
				<span class="date"><?php echo $this->Time->niceShort($inspiration['Inspiration']['created'],null,null); ?>&nbsp;</span>
				<span class="tags"><?php
					//Build a tag list of only two tags.
					$limit = 2;
					$counter = 0;
					//debug($inspiration['Tag']);
					if(!empty($inspiration['Tag'])){
						echo " / ";
						foreach($inspiration['Tag'] as $tag){
							if($counter == $limit) break;

							if($counter == ($limit - 1) || count($inspiration['Tag']) < 2){
								echo $this->Html->link($tag['name'],array('plugin'=>'','admin'=>false,'controller'=>'inspirations','action'=>'index/by:'.$tag['keyname']));
							}else{
								echo $this->Html->link($tag['name'],array('plugin'=>'','admin'=>false,'controller'=>'inspirations','action'=>'index/by:'.$tag['keyname'])).", ";
							}

							$counter++;
						}
					}
				?></span>
				<?php if(!empty($inspiration['Inspiration']['private'])): ?>
				<div class="lock"><?php echo $this->Html->image('icons/lock.png',array('alt'=>'PRIVATE','title'=>'This inspiration is private.','height'=>'16')); ?></div>
				<?php endif; ?>
				<div class="clear"></div>
			</div>
		</div>
	<?php 
	endforeach; 
	endif;
	?>
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>
<script type="text/javascript">
$(function(){
	var $container = $("#grid-container-inspirations");
	$container.imagesLoaded(function(){
		$container.masonry({
			//option
			itemSelector: '.grid-item'
		});
	});
});
</script>