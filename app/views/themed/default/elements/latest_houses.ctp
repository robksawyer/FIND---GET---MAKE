<div class="latest">
	<fieldset>
		<legend class="pink">Latest Houses</legend>
		<?php $houses = $this->requestAction('houses/index/sort:created/direction:desc/limit:5'); ?>
		<ul class="inline-list latest-houses">
		<?php foreach($houses as $house): ?>
			<li><?php 
				echo $this->Html->link($house['House']['name'],
						array('controller'=>'houses','action'=>'view',$house['House']['id']),
						array('title'=>$house['House']['description'])
						); 
			?></li>
		<?php endforeach; ?>
		</ul>
	<div class="actions">
		<ul>
		<li><?php echo $this->Html->link(__('See All Houses', true), array('controller' => 'houses', 'action' => 'index')); ?> </li>
		</ul>
	</div>
	</fieldset>
</div>