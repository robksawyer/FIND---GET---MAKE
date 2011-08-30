
<div class="forumHeader">
	<h2><?php __('Edit User'); ?></h2>
</div>

<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'edit', 'admin' => false))); ?>
<?php echo $this->Form->input('username', array('label' => __('Username', true))); ?>
<?php echo $this->Form->input('email', array('label' => __('Email', true))); ?>
<?php echo $this->Form->input($this->Cupcake->columnMap['status'], array('label' => __('Status', true), 'options' => $this->Cupcake->options(5))); ?>
<?php echo $this->Form->input($this->Cupcake->columnMap['totalPosts'], array('label' => __('Total Posts', true))); ?>
<?php echo $this->Form->input($this->Cupcake->columnMap['totalTopics'], array('label' => __('Total Topics', true))); ?>
<?php echo $this->Form->end(__('Update', true)); ?>