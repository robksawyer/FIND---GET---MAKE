<div class="latest">
	<fieldset>
		<legend class="orange">Latest Sources</legend>
		<?php $sources = $this->requestAction('sources/index/sort:created/direction:desc/limit:5'); ?>
		<ul class="inline-list latest-sources">
		<?php foreach($sources as $source): ?>
			<li><?php 
				echo $this->Html->link($source['Source']['name'],
												array('controller'=>'sources','action'=>'view',$source['Source']['id']),
												array('title'=>$source['Source']['description'])
												); 
			?></li>
		<?php endforeach; ?>
		</ul>
	<div class="actions">
		<ul>
		<li><?php echo $this->Html->link(__('See All Sources', true), array('controller' => 'sources', 'action' => 'index')); ?> </li>
		</ul>
	</div>
	</fieldset>
</div>