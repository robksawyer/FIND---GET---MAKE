<div class="contractorSpecialties index">
	<h2><?php __('Contractor Specialties');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($contractorSpecialties as $contractorSpecialty):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $contractorSpecialty['ContractorSpecialty']['id']; ?>&nbsp;</td>
		<td><?php echo $contractorSpecialty['ContractorSpecialty']['name']; ?>&nbsp;</td>
		<td><?php echo $contractorSpecialty['ContractorSpecialty']['created']; ?>&nbsp;</td>
		<td><?php echo $contractorSpecialty['ContractorSpecialty']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $contractorSpecialty['ContractorSpecialty']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $contractorSpecialty['ContractorSpecialty']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $contractorSpecialty['ContractorSpecialty']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contractorSpecialty['ContractorSpecialty']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Contractor Specialty', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Contractors', true), array('controller' => 'contractors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add')); ?> </li>
	</ul>
</div>