<?php
	$this->Html->script('jquery.corner',array('inline'=>false));
?>
<div class="users form">
	<div id="login">
		<?php echo $this->Session->flash(); ?>
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))); ?>
		<fieldset>
			<legend><?php __('Login'); ?></legend>
			<?php echo $this->Form->input('username', array('label' => __d('forum', 'Username', true))); ?>
			<?php echo $this->Form->input('password', array('label' => __d('forum', 'Password', true), 'type' => 'password')); ?>
			<?php echo $this->Form->input('auto_login', array('type' => 'checkbox', 'label' => __d('forum', 'Remember Me?', true))); ?>
			<?php echo $this->Form->end(__d('forum', 'Login', true)); ?>
		</fieldset>
	</div>
	<div id="join">
		<div class="group">
			<div class="basic">
				<?php //echo $this->Html->image('site/free.png',array('class'=>'free')); ?>
				<div class="header">
					<h1>Basic</h1>
					<h2>(for the amateurs and individuals)</h2>
				</div>
				<ul>
					<li>free to use</li>
					<li>public forum access</li>
					<li>easy tools for collecting and identifying products</li>
					<li>community-added content</li>
				</ul>
			</div>
			<div class="basic-sign-up">
				<?php echo $this->Html->link('Sign up for Basic',array('controller'=>'users','action'=>'signup','admin'=>false)); ?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<p style="display:none">
		If you don't already have an account, you can create one <a href="/register">here</a>.
	</p>
</div>
<script type="text/javascript">
	$("#join").corner("10px");
	$(".basic").corner('10px');
	$(".basic-sign-up").corner("10px");
	$(".plus-sign-up").corner("10px");
</script>