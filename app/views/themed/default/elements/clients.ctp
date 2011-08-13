<div class="related">
	<h3><?php __('Related Clients');?></h3>
<?php if (!empty($item['Client'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('City'); ?></th>
		<th><?php __('State'); ?></th>
		<th><?php __('Zip'); ?></th>
		<th><?php __('Country Id'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Client'] as $client):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($client['name'],array('controller'=>'clients','action'=>'view',$client['id']),array('title'=>$client['description']));?></td>
			<td><?php echo $client['city'];?></td>
			<td><?php echo $client['state'];?></td>
			<td><?php echo $client['zip'];?></td>
			<td><?php echo $client['Country']['name'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Client', true), array('controller' => 'clients', 'action' => 'add','admin'=>true));?> </li>
		</ul>
	</div>
</div>