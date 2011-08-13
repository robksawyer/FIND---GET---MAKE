<div class="ufos index">
	<h2><?php __('Ufos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('attachment_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($ufos as $ufo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $ufo['Ufo']['id']; ?>&nbsp;</td>
		<td><?php echo $ufo['Ufo']['name']; ?>&nbsp;</td>
		<td><?php echo $ufo['Ufo']['description']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ufo['Attachment']['name'], array('controller' => 'attachments', 'action' => 'view', $ufo['Attachment']['id'])); ?>
		</td>
		<td><?php echo $ufo['Ufo']['created']; ?>&nbsp;</td>
		<td><?php echo $ufo['Ufo']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $ufo['Ufo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $ufo['Ufo']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $ufo['Ufo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ufo['Ufo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Ufo', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments', true), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment', true), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
	</ul>
</div>