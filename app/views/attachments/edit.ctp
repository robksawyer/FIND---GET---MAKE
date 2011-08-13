<div class="attachments form">
<?php echo $this->Form->create('Attachment');?>
	<fieldset>
		<legend><?php __('Edit Attachment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('type');
		echo $this->Form->input('size');
		echo $this->Form->input('filesize');
		echo $this->Form->input('ext');
		echo $this->Form->input('group');
		echo $this->Form->input('width');
		echo $this->Form->input('height');
		echo $this->Form->input('path');
		echo $this->Form->input('path_small');
		echo $this->Form->input('path_med');
		echo $this->Form->input('uploaded');
		echo $this->Form->input('Contractor');
		echo $this->Form->input('House');
		echo $this->Form->input('Source');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Attachment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Attachment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Contractors', true), array('controller' => 'contractors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Houses', true), array('controller' => 'houses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New House', true), array('controller' => 'houses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sources', true), array('controller' => 'sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add')); ?> </li>
	</ul>
</div>