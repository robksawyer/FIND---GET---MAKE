<div class="clients form">
<?php echo $this->Form->create('Client');?>
	<fieldset>
		<legend><?php __('Edit Client'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('slug',array('type'=>'hidden'));
		echo $this->Form->input('description');
		echo $this->Form->input('address1');
		echo $this->Form->input('address2');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip');
		echo $this->Form->input('country_id');
		echo $this->Form->input('phone');
		echo $this->Form->input('fax');
		echo $this->Form->input('url');
		echo $this->Form->input('job_title');
		echo $this->Form->input('total_children');
		echo $this->Form->input('salary_range');
		echo $this->Form->input('style_description');
		echo $this->Form->input('personal_description');
		echo $this->Form->input('favorite_colors');
		echo $this->Form->input('favorite_patterns');
		echo $this->Form->input('favorite_designers');
		echo $this->Form->input('tags',array('type'=>'text','label'=>'Keywords','after'=>'<div class="extra">Separate each keyword with a comma e.g., modern, red, furniture.</div>'));
		echo $this->Form->input('Attachment.file', array('type' => 'file'));
		//echo $this->Form->input('Attachment');
		//echo $this->Form->input('Tag');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Client.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Client.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Clients', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Houses', true), array('controller' => 'houses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New House', true), array('controller' => 'houses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments', true), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment', true), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags', true), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag', true), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>