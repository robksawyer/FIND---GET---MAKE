<div class="ufos form">
<?php echo $this->Form->create('Ufo');?>
	<fieldset>
		<legend><?php __('Add Ufo'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('attachment_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Ufos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Attachments', true), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment', true), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
	</ul>
</div>