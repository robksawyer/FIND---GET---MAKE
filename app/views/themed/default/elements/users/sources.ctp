<div class="sources moderate">
	<div class="header grey"><?php __('Your latest sources');?></div>
	<?php if (!empty($userSources)):?>
	<div class="latest">
		<ul>
	<?php
		$i = 0;
		foreach ($userSources as $id => $source):
			//debug($source);
		?>
		
			<li><?php echo $this->Html->link($source,array('controller'=>'sources','action'=>'view','admin'=>false,$id));?></li>
		
	<?php endforeach; ?>
		</ul>
	</div>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('See All &rsaquo;', true), array('plugin'=>'','admin'=>false,'controller' => 'sources', 'action' => 'users',$authUser['User']['id']),array('escape'=>false));?> </li>
		</ul>
	</div>
	<div class="clear"></div>
<?php else: ?>
<div class="missing-content"><p>Keep track of any shop that stocks your favorite brands.</p></div>
<?php endif; ?>
</div>
<div class="clear"></div>