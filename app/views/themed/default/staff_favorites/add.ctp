<div class="staffFavorites form">
<?php echo $this->Form->create('StaffFavorite');?>
	<fieldset>
		<legend><?php __('Add Staff Favorite'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('model');
		echo $this->Form->input('name');
		echo $this->Form->input('model_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Staff Favorites', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>