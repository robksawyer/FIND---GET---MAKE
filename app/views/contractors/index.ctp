<div class="contractors index">
	<h2><?php __('Contractors');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($contractors as $contractor):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $this->Html->link($contractor['Contractor']['name'], array('controller'=>'contractors',$contractor['Contractor']['id'])); ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['slug']; ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['description']; ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['address1']; ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['address2']; ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['city']; ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['state']; ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['zip']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($contractor['Country']['name'], array('controller' => 'countries', 'action' => 'view', $contractor['Country']['id'])); ?>
		</td>
		<td><?php echo $contractor['Contractor']['phone']; ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['fax']; ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['url']; ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['created']; ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $contractor['Contractor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $contractor['Contractor']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $contractor['Contractor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contractor['Contractor']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Contractor', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tags', true), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sources', true), array('controller' => 'sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add')); ?> </li>
	</ul>
</div>