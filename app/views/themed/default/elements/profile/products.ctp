<div class="products moderate">
	<div class="header pink"><?php __('Latest products');?></div>
	<!-- Start gridded items -->
	<div id="grid-container-products">
	<?php
	if(!empty($products)):
	$i = 0;
	foreach ($products as $product):

	?>
		<div class="grid-item">
			<?php 
				if(!empty($product['Attachment'][0]['path_med'])){
					echo $this->Html->image($product['Attachment'][0]['path_med'],array('alt'=>'','url'=>array('plugin'=>'','admin'=>false,'controller'=>'products','action'=>'view',$product['Product']['id']))); 
				}
			?>
			<br/>
			<span class="title"><?php echo $this->Html->link($product['Product']['name'],array('plugin'=>'','admin'=>false,'controller'=>'products','action'=>'view',$product['Product']['id'])); ?></span>
			<br/>
			<p class="description"><?php echo $string->truncate($product['Product']['description'],250); ?></p>
			<br/>
			<?php if(!empty($product['Product']['designer'])) echo "Designed by, ".$product['Product']['designer']; ?><br/>
			<div class="bottom-detail">
				<span class="date"><?php echo $this->Time->niceShort($product['Product']['created'],null,null); ?>&nbsp;</span>
				<span class="tags"><?php
					//Build a tag list of only two tags.
					$limit = 2;
					$counter = 0;
					//debug($product['Tag']);
					if(!empty($product['Tag'])){
						echo " / ";
						foreach($product['Tag'] as $tag){
							if($counter == $limit) break;

							if($counter == ($limit - 1) || count($product['Tag']) < 2){
								echo $this->Html->link($tag['name'],array('plugin'=>'','admin'=>false,'controller'=>'products','action'=>'index/by:'.$tag['keyname']));
							}else{
								echo $this->Html->link($tag['name'],array('plugin'=>'','admin'=>false,'controller'=>'products','action'=>'index/by:'.$tag['keyname'])).", ";
							}

							$counter++;
						}
					}
				?></span>
				<div class="clear"></div>
			</div>
		</div>
	<?php 
	endforeach; 
	endif;
	?>
	</div>
	<div class="clear"></div>
	<!-- End gridded items -->
</div>
<div class="clear"></div>
<script type="text/javascript">
$(function(){
	var $container = $("#grid-container-products");
	$container.imagesLoaded(function(){
		$container.masonry({
			//option
			itemSelector: '.grid-item'
		});
	});
});
</script>