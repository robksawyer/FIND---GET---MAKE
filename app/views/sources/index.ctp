<div class="sources index">
	<h2><?php __('Sources');?></h2>
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
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('fax');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th><?php echo $this->Paginator->sort('favorite');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($sources as $source):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $source['Source']['id']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['name']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['slug']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['description']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['address1']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['address2']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['city']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['state']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['zip']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($source['Country']['name'], array('controller' => 'countries', 'action' => 'view', $source['Country']['id'])); ?>
		</td>
		<td><?php echo $source['Source']['phone']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['email']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['fax']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['url']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['favorite']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['created']; ?>&nbsp;</td>
		<td><?php echo $source['Source']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $source['Source']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $source['Source']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $source['Source']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $source['Source']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Source', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments', true), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment', true), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contractors', true), array('controller' => 'contractors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags', true), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag', true), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>