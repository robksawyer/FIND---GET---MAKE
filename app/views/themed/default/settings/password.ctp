<?php
	echo $this->Html->css('settings/style');
?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->element('settings-header',array('cache'=>true,'username'=>$authUser['User']['username'])); ?>
<?php echo $this->element('settings-nav',array('cache'=>false)); ?>
<div id="settings-container">
	<div class="left-panel">
		<div id="change-password">
			<?php echo $this->Form->create('User', array('url' => array('controller' => 'settings', 'action' => 'password'))); ?>
			<?php echo $this->Form->input('id', array('type' => 'hidden','label' => false)); ?>
			<?php echo $this->Form->input('oldPassword', array('type' => 'password', 'label' => __('Old Password', true),'after'=>'<a href="/forgot_password" class="after">Forgot your password?</a>')); ?>
			<?php echo $this->Form->input('newPassword', array('type' => 'password', 'label' => __('New Password', true))); ?>
			<?php echo $this->Form->input('confirmPassword', array('type' => 'password', 'label' => __('Confirm Password', true))); ?>
			<?php echo $this->Form->end(__('Update Password', true)); ?>
		</div>
	</div>
	<div class="right-panel">
		<div class="section">
			<h4>Password</h4>
			<p>Your password should be at least 6 characters and try not to use a dictionary word or a common name.</p>
		</div>
		<hr/>
		<div class="section">
			<h4>Tips</h4>
			<p>Change your password often.</p>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php
	echo $this->Html->script('jquery.corner',array('inline'=>false));
?>
<script language="javascript">
//<![CDATA[
$(document).ready(function() {
	

});

$("#settings-container").corner("10px");
$("#settings-container .right-panel").corner("10px");


//]]>
</script>