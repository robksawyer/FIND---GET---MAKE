<div class="sourceCategories index">
	<h2><?php __('Source Categories');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('slug');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($sourceCategories as $sourceCategory):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $sourceCategory['SourceCategory']['id']; ?>&nbsp;</td>
		<td><?php echo $sourceCategory['SourceCategory']['name']; ?>&nbsp;</td>
		<td><?php echo $sourceCategory['SourceCategory']['slug']; ?>&nbsp;</td>
		<td><?php echo $sourceCategory['SourceCategory']['created']; ?>&nbsp;</td>
		<td><?php echo $sourceCategory['SourceCategory']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $sourceCategory['SourceCategory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $sourceCategory['SourceCategory']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $sourceCategory['SourceCategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sourceCategory['SourceCategory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Source Category', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sources', true), array('controller' => 'sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add')); ?> </li>
	</ul>
</div>