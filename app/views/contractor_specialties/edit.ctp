<div class="contractorSpecialties form">
<?php echo $this->Form->create('ContractorSpecialty');?>
	<fieldset>
		<legend><?php __('Edit Contractor Specialty'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ContractorSpecialty.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ContractorSpecialty.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Contractor Specialties', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Contractors', true), array('controller' => 'contractors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add')); ?> </li>
	</ul>
</div>