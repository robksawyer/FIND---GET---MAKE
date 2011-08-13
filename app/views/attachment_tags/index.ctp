<div class="attachmentTags index">
	<h2><?php __('Attachment Tags');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('attachment_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('x1');?></th>
			<th><?php echo $this->Paginator->sort('y1');?></th>
			<th><?php echo $this->Paginator->sort('x2');?></th>
			<th><?php echo $this->Paginator->sort('y2');?></th>
			<th><?php echo $this->Paginator->sort('width');?></th>
			<th><?php echo $this->Paginator->sort('height');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($attachmentTags as $attachmentTag):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $attachmentTag['AttachmentTag']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attachmentTag['Attachment']['name'], array('controller' => 'attachments', 'action' => 'view', $attachmentTag['Attachment']['id'])); ?>
		</td>
		<td><?php echo $attachmentTag['AttachmentTag']['name']; ?>&nbsp;</td>
		<td><?php echo $attachmentTag['AttachmentTag']['x1']; ?>&nbsp;</td>
		<td><?php echo $attachmentTag['AttachmentTag']['y1']; ?>&nbsp;</td>
		<td><?php echo $attachmentTag['AttachmentTag']['x2']; ?>&nbsp;</td>
		<td><?php echo $attachmentTag['AttachmentTag']['y2']; ?>&nbsp;</td>
		<td><?php echo $attachmentTag['AttachmentTag']['width']; ?>&nbsp;</td>
		<td><?php echo $attachmentTag['AttachmentTag']['height']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $attachmentTag['AttachmentTag']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $attachmentTag['AttachmentTag']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $attachmentTag['AttachmentTag']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attachmentTag['AttachmentTag']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Attachment Tag', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments', true), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment', true), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
	</ul>
</div>