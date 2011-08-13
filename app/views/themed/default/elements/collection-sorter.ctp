<div class="sorter">
	<h3>Sort collections by:</h3>
	<ul class="standard-sorter">
		<li><?php echo $this->Html->link('See All',array('controller'=>'collections',
															'action'=>'index'
															)
														); ?></li>
		<li><?php echo $this->Html->link('Newest',array('controller'=>'collections',
															'action'=>'index',
															'page'=>'1',
															'sort'=>'created',
															'direction'=>'desc'
															)
														); ?></li>
		<li><?php echo $this->Html->link('Tags',array('controller'=>'collections',
															'action'=>'tags'
															)
														); ?></li>
	</ul>
	<ul class="rating-sorter">
		<li><?php echo $this->Html->link('Top rated',array('controller'=>'collections',
															'action'=>'index',
															'page'=>'1',
															'sort'=>'rating',
															'direction'=>'desc'
															)
														); ?>
		</li>
	</ul>
</div>