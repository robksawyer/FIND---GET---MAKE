<div class="sorter">
	<h3>Sort by category:</h3>
	<ul>
		<?php foreach($productCategories as $category): ?>
		<li><?php echo $this->Html->link(ucwords($category['ProductCategory']['name']),array(
															'controller'=>'product_categories',
															'action'=>'view',
															$category['ProductCategory']['id'],$category['ProductCategory']['slug']
															)
														); ?>
		</li>
		<?php endforeach; ?>
	</ul>
</div>