<div class="related">
	<?php if (!empty($item['Collection'])):?>
	<h3><?php __('Related Collections');?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<!--<th><?php //__('Total products'); ?></th>-->
		<th><?php __('Created'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Collection'] as $collection):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php 
				if(empty($client)){
					echo $this->Html->link($collection['name'],array('controller'=>'collections','action'=>'view',$collection['id']),array('title'=>$collection['description']));
				}else{
					//Check for a keycode
					if(empty($collection['keycode'])){
						//Generate a keycode for the collection
						echo $this->Html->link($collection['name'],array('controller'=>'collections','action'=>'generateKeycode',$collection['id']),array('title'=>$collection['description']));
					}else{
						echo $this->Html->link($collection['name'],array('controller'=>'collections','action'=>'key',$collection['keycode']),array('title'=>$collection['description']));
					}
				}
				?></td>
			<td><?php echo $this->Time->niceShort($collection['created'],null,null); ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
<?php if(!empty($authUser) && empty($disableAdding)): ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Collection', true), array('controller' => 'collections', 'action' => 'add','admin'=>true));?> </li>
		</ul>
	</div>
<?php endif; ?>
</div>