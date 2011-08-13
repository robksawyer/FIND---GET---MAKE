<div class="forumHeader">
	<h2><?php __d('forum', 'Edit Profile'); ?></h2>
</div>

<?php echo $this->Session->flash(); ?>
<?php // Gravatar
if ($this->Cupcake->settings['enable_gravatar'] == 1) {
	if ($avatar = $this->Cupcake->gravatar($this->data['User']['email'])) {
		echo "<div class='avatar'>";
		echo $avatar."<br/>";
		echo $this->Html->link('Change your <span class="gravatar">Gravatar</span>','http://en.gravatar.com/',array('title'=>'Change your Gravatar','escape'=>false,'target'=>'_blank'));
		echo "</div>";
	} else{
		echo "<div class='avatar'>";
		echo $this->Html->image('no_gravatar.jpg')."<br/>";
		echo $this->Html->link('Get a <span class="gravatar">Gravatar</span>','http://en.gravatar.com/',array('title'=>'Get a Gravatar','escape'=>false,'target'=>'_blank'));
		echo "</div>";
	}
} 
?>
<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'edit'))); ?>
<?php echo $this->Form->input('email', array('label' => __d('forum', 'Email', true))); ?>
<?php echo $this->Form->input($this->Cupcake->columnMap['locale'], array('options' => $this->Cupcake->getLocales(), 'label' => __d('forum', 'Language', true))); ?>
<?php echo $this->Form->input($this->Cupcake->columnMap['timezone'], array('options' => $this->Cupcake->getTimezones(), 'label' => __d('forum', 'Timezone', true))); ?>

<div class="input textarea">
	<?php echo $this->Form->label($this->Cupcake->columnMap['signature'], __d('forum', 'Signature', true)); ?>

	<div id="textarea">
		<?php echo $this->Form->input($this->Cupcake->columnMap['signature'], array('type' => 'textarea', 'rows' => 5, 'label' => false, 'div' => false)); ?>
	</div>

	<span class="clear"><!-- --></span>
	<?php echo $this->element('markitup', array('textarea' => 'UserSignature')); ?>
</div>

<?php echo $this->Form->end(__d('forum', 'Update Account', true)); ?>

<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'edit'))); ?>
<?php echo $this->Form->input('oldPassword', array('type' => 'password', 'label' => __d('forum', 'Old Password', true))); ?>
<?php echo $this->Form->input('newPassword', array('type' => 'password', 'label' => __d('forum', 'New Password', true))); ?>
<?php echo $this->Form->input('confirmPassword', array('type' => 'password', 'label' => __d('forum', 'Confirm Password', true))); ?>
<?php echo $this->Form->end(__d('forum', 'Update Password', true)); ?>