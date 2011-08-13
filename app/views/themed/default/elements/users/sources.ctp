<div class="sources moderate">
	<div class="header lime"><?php __('Your latest sources');?></div>
	<?php if (!empty($userSources)):?>
	<div class="latest">
	<?php
		$i = 0;
		foreach ($userSources as $id => $source):
			//debug($source);
		?>
		<div>
			<td><?php echo $this->Html->link($source,array('controller'=>'sources','action'=>'view','admin'=>false,$id));?></td>
		</div>
	<?php endforeach; ?>
	</div>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('See All &rsaquo;', true), array('plugin'=>'','admin'=>false,'controller' => 'sources', 'action' => 'users',$authUser['User']['id']),array('escape'=>false));?> </li>
		</ul>
	</div>
	<div class="clear"></div>
<?php endif; ?>
</div>
<div class="clear"></div>