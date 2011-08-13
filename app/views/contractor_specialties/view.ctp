<div class="contractorSpecialties view">
<h2><?php  __('Contractor Specialty');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contractorSpecialty['ContractorSpecialty']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contractorSpecialty['ContractorSpecialty']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contractorSpecialty['ContractorSpecialty']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contractorSpecialty['ContractorSpecialty']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contractor Specialty', true), array('action' => 'edit', $contractorSpecialty['ContractorSpecialty']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Contractor Specialty', true), array('action' => 'delete', $contractorSpecialty['ContractorSpecialty']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contractorSpecialty['ContractorSpecialty']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contractor Specialties', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contractor Specialty', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contractors', true), array('controller' => 'contractors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Contractors');?></h3>
	<?php if (!empty($contractorSpecialty['Contractor'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Contractor Specialty Id'); ?></th>
		<th><?php __('Slug'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Address1'); ?></th>
		<th><?php __('Address2'); ?></th>
		<th><?php __('City'); ?></th>
		<th><?php __('State'); ?></th>
		<th><?php __('Zip'); ?></th>
		<th><?php __('Country Id'); ?></th>
		<th><?php __('Phone'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Fax'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($contractorSpecialty['Contractor'] as $contractor):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $contractor['id'];?></td>
			<td><?php echo $contractor['name'];?></td>
			<td><?php echo $contractor['contractor_specialty_id'];?></td>
			<td><?php echo $contractor['slug'];?></td>
			<td><?php echo $contractor['description'];?></td>
			<td><?php echo $contractor['address1'];?></td>
			<td><?php echo $contractor['address2'];?></td>
			<td><?php echo $contractor['city'];?></td>
			<td><?php echo $contractor['state'];?></td>
			<td><?php echo $contractor['zip'];?></td>
			<td><?php echo $contractor['country_id'];?></td>
			<td><?php echo $contractor['phone'];?></td>
			<td><?php echo $contractor['email'];?></td>
			<td><?php echo $contractor['fax'];?></td>
			<td><?php echo $contractor['url'];?></td>
			<td><?php echo $contractor['created'];?></td>
			<td><?php echo $contractor['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'contractors', 'action' => 'view', $contractor['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'contractors', 'action' => 'edit', $contractor['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'contractors', 'action' => 'delete', $contractor['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contractor['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
