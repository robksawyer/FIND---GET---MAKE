<?php 
	$inspirations = $this->requestAction('/inspirations/userInspirations/'.$user_id.'/10'); 
?>
<div class="inspirations moderate">
	<div class="header grey"><?php __('Latest inspirations');?></div>
	<?php
	if(!empty($inspirations)):
	?>
	<div id="grid-container-inspirations">
	<?php
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
			<div class="title"><?php echo $this->Html->link($inspiration['Inspiration']['name'],array('plugin'=>'','admin'=>false,'controller'=>'inspirations','action'=>'view',$inspiration['Inspiration']['id'])); ?></div>
			<div class="description"><?php echo $string->truncate($inspiration['Inspiration']['description'],150); ?></div>
			<?php if(!empty($inspiration['Inspiration']['designer'])) echo "Designed by ".$inspiration['Inspiration']['designer']; ?><br/>
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
	<?php endforeach; ?>
	</div>
	<div class="clear"></div>
	<?php else: ?>
		<div class="missing-content"><p>Inspirations are tear sheets that depict a space you’d like to step inside. Use the product database to find the elements (tables, chairs, lamps) in your inspiration image. It’s satisfying to find the exact products used, but this isn’t a test: find and attach different products if you’d like.</p></div>
	<?php endif; ?>
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