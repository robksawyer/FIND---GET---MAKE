<?php
	debug($facebookUser);
?>
<div id="signup-wrapper">
	<div class="wrapper">
		<div class="sign-up">
			<div class="forumHeader">
				<?php if(empty($facebookUser)): ?>
				<h2><?php __d('forum', 'Sign Up'); ?></h2>
				<?php else: ?>
				<h2><?php __d('forum', 'You\'re almost done. This is the last step.'); ?></h2>
				<?php endif; ?>
			</div>

			<p><?php __d('forum', 'Signup is quick and easy and if you don\'t like the site, there\'s a money back guarantee*. All fields are required.'); ?></p>

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'facebook_signup'))); ?>
			<?php echo $this->Form->input('fullname', array('label' => __d('forum', 'Real Name', true))); ?>
			<?php echo $this->Form->input('username', array('label' => __d('forum', 'Username', true),'after'=>'<div class="after">Your public profile: http://www.find-get-make.com/profile/<span class="username-preview">'.$this->Form->value('User.username').'</span></div>')); ?>
			<?php echo $this->Form->input('location', array('label' => __d('forum', 'Location', true))); ?>
			<?php echo $this->Form->input('email', array('label' => __d('forum', 'Email', true))); ?>
			<?php echo $this->Form->input('newPassword', array('type' => 'password', 'label' => __d('forum', 'Password', true))); ?>
			<?php echo $this->Form->input('confirmPassword', array('type' => 'password', 'label' => __d('forum', 'Confirm Password', true))); ?>
			<?php
			//Only show the security questions when not using oauth service
			if(empty($facebookUser)){
				echo $this->Form->input('security', array('after' => ' '. $this->Cupcake->settings['security_question'], 'label' => __d('forum', 'Security Question', true), 'style' => 'width: 10%')); 
			}else{
				echo $this->Form->input('facebook_id', array('value'=>$facebookUser['id'],'type'=>'hidden')); 
				echo $this->Form->input('security', array('value'=>'2','type'=>'hidden')); 
			}
			?>

			<?php echo $this->Form->end(__d('forum', 'Sign Up', true)); ?>
			<div class="footer">* It's free. As always, we will not sell your email address.</div>
		</div>
		<div class="sign-in">
			<h2>Have an account?</h2>
			<?php echo $this->Html->link('Login Here','/login',array('title'=>'Login Here'));?>
		</div>
	</div>
</div>
<script type="text/javascript">
$("#UserUsername").keyup(function(){
	$('.username-preview').text($(this).val());
});
</script>