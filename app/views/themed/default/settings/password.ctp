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
			<p>Be tricky! Your password should be at least 6 characters and not a dictionary word or common name. Change your password on occasion.
			<b>Note:</b> If you have trusted a third-party Twitter service or software with your password and you change it here, you'll need to re-authenticate to make that software work. (Never enter your password in a third-party service or software that looks suspicious.)</p>
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