<div class="latest">
	<fieldset>
		<legend class="teal">Latest Products</legend>
		<?php $products = $this->requestAction('products/index/sort:created/direction:desc/limit:5'); ?>
		<ul class="inline-list latest-sources">
		<?php foreach($products as $product): ?>
			<?php if(!empty($product['Attachment'][0]['path_med'])): ?>
			<li><?php 
				echo $this->Html->image($product['Attachment'][0]['path_small'],
												array(
													'url'=>array('controller'=>'products','action'=>'view',$product['Product']['id'],'admin'=>false),
													'title'=>$product['Product']['description'],
													'height'=>'100'
													)
												); 
			?></li>
			<?php endif; ?>
		<?php endforeach; ?>
		</ul>
		<div class="actions">
			<ul>
			<li><?php echo $this->Html->link(__('See All Products', true), array('controller' => 'products', 'action' => 'index','admin'=>false)); ?> </li>
			</ul>
		</div>
	</fieldset>
</div>