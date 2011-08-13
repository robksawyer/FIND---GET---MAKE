<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('remember_me');
		echo $this->Form->input('username');
		echo $this->Form->input('salutation');
		echo $this->Form->input('firstname');
		echo $this->Form->input('initials');
		echo $this->Form->input('lastname');
		echo $this->Form->input('suffix');
		echo $this->Form->input('birthday');
		echo $this->Form->input('url');
		echo $this->Form->input('about');
		echo $this->Form->input('country_id');
		echo $this->Form->input('postal_code');
		echo $this->Form->input('active');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('slug');
		echo $this->Form->input('last_login');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Favorites', true), array('controller' => 'favorites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Favorite', true), array('controller' => 'favorites', 'action' => 'add')); ?> </li>
	</ul>
</div>