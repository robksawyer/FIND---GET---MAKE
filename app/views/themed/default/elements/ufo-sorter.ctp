<div class="sorter">
	<h3>Sort ufos by:</h3>
	<ul class="standard-sorter">
		<?php if(!empty($authUser)): ?>
		<li><?php echo $this->Html->link('See Yours Only',array('controller'=>'ufos',
															'action'=>'users',$authUser['User']['id']
															)
														); ?></li>
		<?php endif; ?>
		<li><?php echo $this->Html->link('See All',array('controller'=>'ufos',
															'action'=>'index'
															)
														); ?></li>
		<li><?php echo $this->Html->link('Newest',array('controller'=>'ufos',
															'action'=>'index',
															'page'=>'1',
															'sort'=>'created',
															'direction'=>'desc'
															)
														); ?></li>
		<li><?php echo $this->Html->link('Tags',array('controller'=>'ufos',
															'action'=>'tags'
															)
														); ?></li>
	</ul>
	<?php if(Configure::read('FGM.allow_rating')==1): ?>
	<ul class="rating-sorter">
		<li><?php echo $this->Html->link('Top rated',array('controller'=>'ufos',
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