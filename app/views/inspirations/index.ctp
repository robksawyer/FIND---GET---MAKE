<div class="inspirations index">
	<h2><?php __('Inspirations');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('source_url');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($inspirations as $inspiration):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $inspiration['Inspiration']['id']; ?>&nbsp;</td>
		<td><?php echo $inspiration['Inspiration']['name']; ?>&nbsp;</td>
		<td><?php echo $inspiration['Inspiration']['description']; ?>&nbsp;</td>
		<td><?php echo $inspiration['Inspiration']['source_url']; ?>&nbsp;</td>
		<td><?php echo $inspiration['Inspiration']['created']; ?>&nbsp;</td>
		<td><?php echo $inspiration['Inspiration']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $inspiration['Inspiration']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $inspiration['Inspiration']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $inspiration['Inspiration']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inspiration['Inspiration']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Inspiration', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments', true), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment', true), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sources', true), array('controller' => 'sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add')); ?> </li>
	</ul>
</div>