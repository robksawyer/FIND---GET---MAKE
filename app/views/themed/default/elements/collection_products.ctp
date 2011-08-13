<?php
	echo $this->Html->css('elements/products','stylesheet',array('inline'=>false));
	
	//Make the controller name
	$controller = strtolower(Inflector::pluralize($model));
?>
<div id="products-group">
	<?php if (!empty($item['Product'])):?>
	<div class="products">
	<?php
		$i = 0;
		foreach($item['Product'] as $product):
		?>
		<div class="product">
			<div class="section">
				<?php
					if(!empty($authUser) && empty($removeDelete)):
					echo $this->Html->image('/img/icons/delete.gif',array('alt'=>'Delete',
																							'url'=>array(
																								'controller'=>$controller,
																								'action'=>'removeProduct',$item[$model]['id'],$product['id']
																								),
																							'title'=>'Remove this product from the '.strtolower($model).'.',
																							'class'=>'product-remove'
																							));
					echo "<br/>";
					endif;
					if(!empty($product['Attachment'][0]['path_small'])){
						if(empty($client)){
							echo $this->Html->image($product['Attachment'][0]['path_small'],
															array(
																'alt'=>'product_'.$i,
																'url'=>array(
																'controller'=>'products',
																'action'=>'view',$product['id']
																),
																'title'=>strval($product['description'])
																));
						}else{
							//Check for keycode
							if(empty($product['keycode'])){
								echo $this->Html->image($product['Attachment'][0]['path_small'],
																array(
																	'alt'=>'product_'.$i,
																	'url'=>array(
																	'controller'=>'products',
																	'action'=>'generateKeycode',$product['id']
																	),
																	'title'=>strval($product['description'])
																	));
							}else{
								echo $this->Html->image($product['Attachment'][0]['path_small'],
																array(
																	'alt'=>'product_'.$i,
																	'url'=>array(
																	'controller'=>'products',
																	'action'=>'key',$product['keycode']
																	),
																	'title'=>strval($product['description'])
																	));
							}
						}
					}
					?>
			</div>
			<div class="section">
					<?php 
						if(empty($client)){
							echo $this->Html->link($product['name'],array('controller'=>'products','action'=>'view',$product['id']),array('title'=>$product['description']));
						}else{
							//Check for keycode
							if(empty($product['keycode'])){
								//Generate a keycode
								echo $this->Html->link($product['name'],array('controller'=>'products','action'=>'generateKeycode',$product['id']),array('title'=>$product['description']));
							}else{
								echo $this->Html->link($product['name'],array('controller'=>'products','action'=>'key',$product['keycode']),array('title'=>$product['description']));
							}
						}
					?>
			</div>
			<div class="clear"></div>
		</div>
	<?php endforeach; ?>
	<div class="clear"></div>
	</div>
<?php endif; ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".product-remove").hide();
	
	$(".products .product").hover(function(){
		$(this).find("img.product-remove").show();
	},function(){
		$(this).find("img.product-remove").hide();
	});
	
});
</script>