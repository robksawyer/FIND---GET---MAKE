<style type="text/css">
#UserViewForm{
	border: none;
}
</style>
<div class="users form">
	<?php echo $this->Session->flash(); ?>
<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))); ?>
	<fieldset>
		<legend><?php __('Login'); ?></legend>
		
		<?php echo $this->Form->input('username', array('label' => __d('forum', 'Username', true))); ?>
		<?php echo $this->Form->input('password', array('label' => __d('forum', 'Password', true), 'type' => 'password')); ?>
		<?php echo $this->Form->input('auto_login', array('type' => 'checkbox', 'label' => __d('forum', 'Remember Me?', true))); ?>
		<?php echo $this->Form->end(__d('forum', 'Login', true)); ?>
	</fieldset>
	<p>
		The Source is a closed service and was built for my own personal use.
	</p>
	<p style="display:none">
		If you don't already have an account, you can create one <a href="/admin/users/add">here</a>.
	</p>
</div>