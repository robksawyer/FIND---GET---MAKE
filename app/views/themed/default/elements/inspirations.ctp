<div class="related">
	<?php if(empty($header)): ?>
		<h3><?php __('Related Inspirations');?></h3>
	<?php else: ?>
		<h3><?php __($header);?></h3>
	<?php endif; ?>
	<?php if (!empty($item['Inspiration'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Designer'); ?></th>
		<th><?php __('Source URL'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Inspiration'] as $inspiration):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php 
				if(empty($client)){
					echo $this->Html->link($inspiration['name'],array('controller'=>'inspirations','action'=>'view',$inspiration['id']),array('title'=>$inspiration['description']));
				}else{
					//Check for a keycode
					if(empty($inspiration['keycode'])){
						//Generate a keycode
						echo $this->Html->link($inspiration['name'],array('controller'=>'inspirations','action'=>'generateKeycode',$inspiration['id']),array('title'=>$inspiration['description']));
					}else{
						echo $this->Html->link($inspiration['name'],array('controller'=>'inspirations','action'=>'key',$inspiration['keycode']),array('title'=>$inspiration['description']));
					}
				}
				?></td>
			<!--<td><?php //echo $product['city'];?></td>
			<td><?php //echo $product['state'];?></td>
			<td><?php //echo $product['zip'];?></td>
			<td><?php //echo $product['Country']['name'];?></td>-->
			<td><?php echo $inspiration['designer']; ?></td>
			<td><?php echo $this->Html->link($string->truncate($inspiration['source_url']),$inspiration['source_url'],array('target'=>'_blank', 'title'=>$inspiration['source_url']));?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php else: ?>
	<div class="empty">There are no inspirations related to this item.</div>
<?php endif; ?>
<?php if(!empty($authUser) && empty($disableAdding)): ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Inspiration', true), array('controller' => 'inspirations', 'action' => 'add','admin'=>true));?> </li>
		</ul>
	</div>
<?php endif; ?>
</div>