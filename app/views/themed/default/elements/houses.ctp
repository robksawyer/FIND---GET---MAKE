<div class="related">
	<h3><?php __('Related Houses');?></h3>
	<?php if (!empty($client['House'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<!--<th><?php //__('Description'); ?></th>
		<th><?php //__('Address1'); ?></th>
		<th><?php //__('Address2'); ?></th>-->
		<th><?php __('City'); ?></th>
		<th><?php __('State'); ?></th>
		<!--<th><?php //__('Zip'); ?></th>-->
		<th><?php __('Country Id'); ?></th>
		<!--<th><?php //__('Bedrooms'); ?></th>
		<th><?php //__('Bathrooms'); ?></th>
		<th><?php //__('Amenities'); ?></th>
		<th><?php //__('Phone'); ?></th>
		<th><?php //__('More Details'); ?></th>
		<th><?php //__('Square Footage'); ?></th>
		<th><?php //__('Created'); ?></th>
		<th><?php //__('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>-->
	</tr>
	<?php
		$i = 0;
		foreach ($client['House'] as $house):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($house['name'],array('controller'=>'houses','action'=>'view',$house['id']));?></td>
			<!--<td><?php //echo $house['description'];?></td>
			<td><?php //echo $house['address1'];?></td>
			<td><?php //echo $house['address2'];?></td>-->
			<td><?php echo $house['city'];?></td>
			<td><?php echo $house['state'];?></td>
			<!--<td><?php //echo $house['zip'];?></td>-->
			<td><?php echo $this->Html->link($house['Country']['name'],array('controller'=>'countries','action'=>'view',$house['Country']['id']));?></td>
			<!--<td><?php //echo $house['bedrooms'];?></td>
			<td><?php //echo $house['bathrooms'];?></td>
			<td><?php //echo $house['amenities'];?></td>
			<td><?php //echo $house['phone'];?></td>
			<td><?php //echo $house['more_details'];?></td>
			<td><?php //echo $house['square_footage'];?></td>
			<td><?php //echo $this->Time->niceShort($house['created'],'','');?></td>
			<td><?php //echo $this->Time->niceShort($house['modified'],'','');?></td>-->
			<!--<td class="actions">
				<?php //echo $this->Html->link(__('View', true), array('controller' => 'houses', 'action' => 'view', $house['id'])); ?>
				<?php //echo $this->Html->link(__('Edit', true), array('controller' => 'houses', 'action' => 'edit', $house['id'])); ?>
				<?php //echo $this->Html->link(__('Delete', true), array('controller' => 'houses', 'action' => 'delete', $house['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $house['id'])); ?>
			</td>-->
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<?php if(!empty($client['Client']['id'])): ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New House', true), array('controller' => 'houses', 'action' => 'add',$client['Client']['id'],'admin'=>true));?> </li>
		</ul>
	</div>
	<?php endif; ?>
</div>