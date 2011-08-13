<div class="sorter">
	<h3>Sort by category:</h3>
	<ul>
		<?php foreach($sourceCategories as $category): ?>
		<li><?php echo $this->Html->link(ucwords($category['SourceCategory']['name']),array(
															'controller'=>'source_categories',
															'action'=>'view',
															$category['SourceCategory']['id'],$category['SourceCategory']['slug']
															)
														); ?>
		</li>
		<?php endforeach; ?>
	</ul>
</div>