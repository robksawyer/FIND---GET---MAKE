<?php
	echo $this->Html->css('settings/style');
?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->element('settings-header',array('cache'=>true,'username'=>$authUser['User']['username'])); ?>
<?php echo $this->element('settings-nav',array('cache'=>false)); ?>
<div id="settings-container">
	<div id="left-panel">
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'settings', 'action' => 'account'))); ?>
		<?php echo $this->Form->input('id', array('type' => 'hidden','label' => false)); ?>
		<div class="full-name">
		<label>Name</label>
		<?php echo $this->data['User']['fullname'];?>
		<div class="after">You can change your name on the <?php echo $this->Html->link('profile settings','/settings/profile');?> page.</div>
		</div>
		<?php echo $this->Form->input('username', array('label' => __('Username', true),'after'=>'<div class="warning">Spaces aren\'t accepted.</div><div class="after">Your public profile: http://www.find-get-make.com/profile/<span class="username-preview">'.$this->Form->value('User.username').'</span></div>')); ?>
		<?php echo $this->Form->input('email', array('label' => __('Email', true))); ?>

		<?php echo $this->Form->end('Save'); ?>
	</div>
	<div class="right-panel">
		<div class="section">
			<h4>Account</h4>
			<p>Use this panel to change account settings such as your email address or your username. Please note that these are important settings, so be sure to double check your spelling.</p>
		</div>
		<div class="section">
			<h4>Notes</h4>
			<p>If you change your username, all further feed info will contain this name. Also, be sure to notify your followers that your name changed.</p>
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
	$("#UserUsername").keyup(function(){
		$('.username-preview').text($(this).val());
	});
});

$("#settings-container").corner("10px");
$("#settings-container .right-panel").corner("10px");

//]]>
</script>