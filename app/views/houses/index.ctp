<div class="houses index">
	<h2><?php __('Houses');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('client_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('address1');?></th>
			<th><?php echo $this->Paginator->sort('address2');?></th>
			<th><?php echo $this->Paginator->sort('city');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('zip');?></th>
			<th><?php echo $this->Paginator->sort('country_id');?></th>
			<th><?php echo $this->Paginator->sort('bedrooms');?></th>
			<th><?php echo $this->Paginator->sort('bathrooms');?></th>
			<th><?php echo $this->Paginator->sort('amenities');?></th>
			<th><?php echo $this->Paginator->sort('phone');?></th>
			<th><?php echo $this->Paginator->sort('more_details');?></th>
			<th><?php echo $this->Paginator->sort('square_footage');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($houses as $house):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $house['House']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($house['Client']['name'], array('controller' => 'clients', 'action' => 'view', $house['Client']['id'])); ?>
		</td>
		<td><?php echo $house['House']['name']; ?>&nbsp;</td>
		<td><?php echo $house['House']['description']; ?>&nbsp;</td>
		<td><?php echo $house['House']['address1']; ?>&nbsp;</td>
		<td><?php echo $house['House']['address2']; ?>&nbsp;</td>
		<td><?php echo $house['House']['city']; ?>&nbsp;</td>
		<td><?php echo $house['House']['state']; ?>&nbsp;</td>
		<td><?php echo $house['House']['zip']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($house['Country']['name'], array('controller' => 'countries', 'action' => 'view', $house['Country']['id'])); ?>
		</td>
		<td><?php echo $house['House']['bedrooms']; ?>&nbsp;</td>
		<td><?php echo $house['House']['bathrooms']; ?>&nbsp;</td>
		<td><?php echo $house['House']['amenities']; ?>&nbsp;</td>
		<td><?php echo $house['House']['phone']; ?>&nbsp;</td>
		<td><?php echo $house['House']['more_details']; ?>&nbsp;</td>
		<td><?php echo $house['House']['square_footage']; ?>&nbsp;</td>
		<td><?php echo $house['House']['created']; ?>&nbsp;</td>
		<td><?php echo $house['House']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $house['House']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $house['House']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $house['House']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $house['House']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New House', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Clients', true), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client', true), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images', true), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image', true), array('controller' => 'images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags', true), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag', true), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>