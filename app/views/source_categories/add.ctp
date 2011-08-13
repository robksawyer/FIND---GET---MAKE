<div class="sourceCategories form">
<?php echo $this->Form->create('SourceCategory');?>
	<fieldset>
		<legend><?php __('Add Source Category'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('slug');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Source Categories', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Sources', true), array('controller' => 'sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add')); ?> </li>
	</ul>
</div>