<div class="inspirationPhotoTags index">
	<h2><?php __('Inspiration Photo Tags');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('inspiration_id');?></th>
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
	foreach ($inspirationPhotoTags as $inspirationPhotoTag):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $inspirationPhotoTag['InspirationPhotoTag']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($inspirationPhotoTag['Inspiration']['name'], array('controller' => 'inspirations', 'action' => 'view', $inspirationPhotoTag['Inspiration']['id'])); ?>
		</td>
		<td><?php echo $inspirationPhotoTag['InspirationPhotoTag']['name']; ?>&nbsp;</td>
		<td><?php echo $inspirationPhotoTag['InspirationPhotoTag']['x1']; ?>&nbsp;</td>
		<td><?php echo $inspirationPhotoTag['InspirationPhotoTag']['y1']; ?>&nbsp;</td>
		<td><?php echo $inspirationPhotoTag['InspirationPhotoTag']['x2']; ?>&nbsp;</td>
		<td><?php echo $inspirationPhotoTag['InspirationPhotoTag']['y2']; ?>&nbsp;</td>
		<td><?php echo $inspirationPhotoTag['InspirationPhotoTag']['width']; ?>&nbsp;</td>
		<td><?php echo $inspirationPhotoTag['InspirationPhotoTag']['height']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $inspirationPhotoTag['InspirationPhotoTag']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $inspirationPhotoTag['InspirationPhotoTag']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $inspirationPhotoTag['InspirationPhotoTag']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inspirationPhotoTag['InspirationPhotoTag']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Inspiration Photo Tag', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Inspirations', true), array('controller' => 'inspirations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inspiration', true), array('controller' => 'inspirations', 'action' => 'add')); ?> </li>
	</ul>
</div>