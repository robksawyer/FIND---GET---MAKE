<?php
	if($registrationData){
		foreach($registrationData['registration'] as $field => $value){
			if(is_array($value)){
				$value = implode("|", $value);
			}
			echo "<div><strong>$field</strong>: $value</div>";
		}
	} else {
		//echo 'Code: <code>$this->Facebook->registration(array("width" => "500"));</code>';
		echo $this->Facebook->registration(array('width' => '500', 'redirect-uri' => '/signup'));
	}
?>
<div class="forumHeader">
	<h2><?php __d('forum', 'Sign Up'); ?></h2>
</div>

<p><?php __d('forum', 'Signup is quick and easy and if you don\'t like the site, there\'s a money back guarantee*. All fields are required.'); ?></p>

<?php echo $this->Session->flash(); ?>

<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'signup'))); ?>
<?php echo $this->Form->input('username', array('label' => __d('forum', 'Username', true))); ?>
<?php echo $this->Form->input('email', array('label' => __d('forum', 'Email', true))); ?>
<?php echo $this->Form->input('newPassword', array('type' => 'password', 'label' => __d('forum', 'Password', true))); ?>
<?php echo $this->Form->input('confirmPassword', array('type' => 'password', 'label' => __d('forum', 'Confirm Password', true))); ?>
<?php echo $this->Form->input('security', array('after' => ' '. $this->Cupcake->settings['security_question'], 'label' => __d('forum', 'Security Question', true), 'style' => 'width: 10%')); ?>

<?php echo $this->Form->end(__d('forum', 'Sign Up', true)); ?>
<div class="footer">* It's free. As always, we will not sell your email address.</div>