<div class="sorter">
	<h3>Sort products by:</h3>
	<ul class="standard-sorter">
		<li><?php echo $this->Html->link('See All',array('controller'=>'products',
															'action'=>'index'
															)
														); ?></li>
		<li><?php echo $this->Html->link('Newest',array('controller'=>'products',
															'action'=>'index',
															'page'=>'1',
															'sort'=>'created',
															'direction'=>'desc'
															)
														); ?></li>
		<li><?php echo $this->Html->link('Designer',array('controller'=>'products',
															'action'=>'index',
															'page'=>'1',
															'sort'=>'designer',
															'direction'=>'desc'
															)
														); ?></li>
		<li><?php echo $this->Html->link('Tags',array('controller'=>'products',
															'action'=>'tags'
															)
														); ?></li>
	</ul>
	<?php if(Configure::read('FGM.allow_rating')==1): ?>
	<ul class="rating-sorter">
		<li><?php echo $this->Html->link('Top rated',array('controller'=>'products',
															'action'=>'index',
															'page'=>'1',
															'sort'=>'rating',
															'direction'=>'desc'
															)
														); ?>
		</li>
	</ul>
	<?php endif; ?>
</div>