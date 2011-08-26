
<div class="forumHeader">
	<h2><?php __('Forgot Password'); ?></h2>
</div>

<p><?php __('Please enter either your username or email to retrieve your information. Once you retrieved, you should receive an email with your login credentials.'); ?></p>

<?php echo $this->Session->flash(); ?>

<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'forgot'))); ?>
<?php echo $this->Form->input('username', array('label' => __('Username', true))); ?>
<?php echo $this->Form->input('email', array('label' => __('Email', true))); ?>
<?php echo $this->Form->end(__('Retrieve', true)); ?>