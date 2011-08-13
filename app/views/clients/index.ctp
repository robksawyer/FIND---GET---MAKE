<div class="clients index">
	<h2><?php __('Clients');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('slug');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('address1');?></th>
			<th><?php echo $this->Paginator->sort('address2');?></th>
			<th><?php echo $this->Paginator->sort('city');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('zip');?></th>
			<th><?php echo $this->Paginator->sort('country_id');?></th>
			<th><?php echo $this->Paginator->sort('phone');?></th>
			<th><?php echo $this->Paginator->sort('fax');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th><?php echo $this->Paginator->sort('job_title');?></th>
			<th><?php echo $this->Paginator->sort('total_children');?></th>
			<th><?php echo $this->Paginator->sort('salary_range');?></th>
			<th><?php echo $this->Paginator->sort('style_description');?></th>
			<th><?php echo $this->Paginator->sort('personal_description');?></th>
			<th><?php echo $this->Paginator->sort('favorite_colors');?></th>
			<th><?php echo $this->Paginator->sort('favorite_patterns');?></th>
			<th><?php echo $this->Paginator->sort('favorite_designers');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($clients as $client):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $client['Client']['id']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['name']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['slug']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['description']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['address1']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['address2']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['city']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['state']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['zip']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($client['Country']['name'], array('controller' => 'countries', 'action' => 'view', $client['Country']['id'])); ?>
		</td>
		<td><?php echo $client['Client']['phone']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['fax']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['url']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['job_title']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['total_children']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['salary_range']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['style_description']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['personal_description']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['favorite_colors']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['favorite_patterns']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['favorite_designers']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['created']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $client['Client']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $client['Client']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $client['Client']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $client['Client']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Client', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Houses', true), array('controller' => 'houses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New House', true), array('controller' => 'houses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments', true), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment', true), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags', true), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag', true), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>