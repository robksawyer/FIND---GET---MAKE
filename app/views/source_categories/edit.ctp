<div class="sourceCategories form">
<?php echo $this->Form->create('SourceCategory');?>
	<fieldset>
		<legend><?php __('Edit Source Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('slug');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SourceCategory.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SourceCategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Source Categories', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Sources', true), array('controller' => 'sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add')); ?> </li>
	</ul>
</div>