<?php
	echo $this->Html->css('elements/products','stylesheet',array('inline'=>false));
	
	//Make the controller name
	$controller = strtolower(Inflector::pluralize($model));
?>
<div id="products-group">
	<h3 class="header"><?php __('Products');?></h3>
	<?php if(!empty($item['Product'])):?>
		<div class="products">
		<?php
			$i = 0;
			foreach($item['Product'] as $product):
			?>
			<div class="product">
				<div class="section">
					<?php
						if(!empty($authUser) && empty($disableDeleting)):
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
								//Check for a keycode
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
						echo $this->Html->link($product['name'],array('controller'=>'products','action'=>'view',$product['id']),array('title'=>$product['description']));
						?>
				</div>
				<div class="clear"></div>
			</div>
		<?php endforeach; ?>
		<div class="clear"></div>
		</div>
<?php else: ?>
	<p>If you add products, you can tag the image with your products.</p>
<?php endif; ?>
<?php if(!empty($authUser) && empty($disableAdding)): ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Add Product', true), array('controller' => 'products', 'action' => 'add','model'=>$model,'id'=>$item[$model]['id'],'admin'=>true));?> </li>
		<?php if(!empty($controller) && !empty($model)): ?>
			<li><?php echo $this->Html->link(__('Add Existing Product', true),'javascript:return false;',array('class'=>'button product-selector-modal-button')); ?></li>
			<?php endif; ?>
		</ul>
	</div>
<?php endif; ?>
</div>
<?php
	//PRODUCT SELECTOR
	if(!empty($controller) && !empty($model)){
		if(!empty($products) && !empty($productsAll)){
			echo $this->element('product-selector',array('cache'=>false,
																			'model'=>$model,
																			'controller'=>$controller,
																			'id'=>$inspiration['Inspiration']['id'],
																			'item'=>$inspiration,
																			'products'=>$products,
																			'productList'=>$productList
																			));
		}else{
			debug('ERROR: You did not set the products or product list values.');
		}
	}
?>
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