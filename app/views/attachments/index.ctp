<div class="attachments index">
	<h2><?php __('Attachments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('size');?></th>
			<th><?php echo $this->Paginator->sort('filesize');?></th>
			<th><?php echo $this->Paginator->sort('ext');?></th>
			<th><?php echo $this->Paginator->sort('group');?></th>
			<th><?php echo $this->Paginator->sort('width');?></th>
			<th><?php echo $this->Paginator->sort('height');?></th>
			<th><?php echo $this->Paginator->sort('path');?></th>
			<th><?php echo $this->Paginator->sort('path_small');?></th>
			<th><?php echo $this->Paginator->sort('path_med');?></th>
			<th><?php echo $this->Paginator->sort('uploaded');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($attachments as $attachment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $attachment['Attachment']['id']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['name']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['type']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['size']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['filesize']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['ext']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['group']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['width']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['height']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['path']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['path_small']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['path_med']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['uploaded']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['created']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $attachment['Attachment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $attachment['Attachment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $attachment['Attachment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attachment['Attachment']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Attachment', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Contractors', true), array('controller' => 'contractors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Houses', true), array('controller' => 'houses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New House', true), array('controller' => 'houses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sources', true), array('controller' => 'sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add')); ?> </li>
	</ul>
</div>