<div class="sorter">
	<h3>Sort sources by:</h3>
	<ul class="standard-sorter">
		<li><?php echo $this->Html->link('See All',array('controller'=>'sources',
															'action'=>'index'
															)
														); ?></li>
		<li><?php echo $this->Html->link('Newest',array('controller'=>'sources',
															'action'=>'index',
															'page'=>'1',
															'sort'=>'created',
															'direction'=>'desc'
															)
														); ?></li>
		<li><?php echo $this->Html->link('Tags',array('controller'=>'sources',
															'action'=>'tags'
															)
														); ?></li>
	</ul>
	<ul class="rating-sorter">
		<li><?php echo $this->Html->link('Top rated',array('controller'=>'sources',
															'action'=>'index',
															'page'=>'1',
															'sort'=>'rating',
															'direction'=>'desc'
															)
														); ?>
		</li>
	</ul>
</div>