<div class="betaUsers form">
<?php echo $this->Form->create('BetaUser');?>
	<fieldset>
		<legend><?php __('Edit Beta User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('BetaUser.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('BetaUser.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Beta Users', true), array('action' => 'index'));?></li>
	</ul>
</div>