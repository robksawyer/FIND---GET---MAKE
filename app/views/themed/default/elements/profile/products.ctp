<?php 
	$products = $this->requestAction('/products/userProducts/'.$user_id.'/10'); 
?>
<div class="products moderate">
	<div class="header grey"><?php __('Latest products');?></div>
	<?php
	if(!empty($products)):
	?>
	<!-- Start gridded items -->
	<div id="grid-container-products">
	<?php
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
			<div class="title"><?php echo $this->Html->link($product['Product']['name'],array('plugin'=>'','admin'=>false,'controller'=>'products','action'=>'view',$product['Product']['id'])); ?></div>
			<div class="description"><?php echo $string->truncate($product['Product']['description'],250); ?></div>
			<br/>
			<?php if(!empty($product['Product']['designer'])) echo "<div class='designer'>Designed by ".$product['Product']['designer']."</div>"; ?>
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
	<?php endforeach; ?>
	</div>
	<div class="clear"></div>
	<!-- End gridded items -->
	<?php else: ?>
		<div class="missing-content"><p>Adding a product is an easy way to keep track of an item you’ve been wanting to buy or use in a space.</p></div>
	<?php endif; ?>
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