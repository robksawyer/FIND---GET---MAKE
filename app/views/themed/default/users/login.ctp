<?php

?>
<div id="login-wrapper">
	<div class="wrapper">
		<div class="users form">
			<div id="social-login">
				<h3>Log in to <b>FIND | GET | MAKE</b> with Twitter or Facebook.</h3>
				<div id="twitter-login-wrap">
				<?php 
					//$linkOptions['login'] = 'Sign in with Twitter';
					//echo $this->Twitter->oauthLink($linkOptions); 
					echo "<span class='loading'></span>";
					echo $this->Html->link('Connect with Twitter','',array('id'=>'btn-twitter','class'=>'popupwindow','style'=>'display:none'));
				?>
				</div>
				<div id="facebook-login-wrap">
				<?php 
					//echo $this->Html->link('Sign in with Facebook','',array('id'=>'btn-facebook','class'=>'popupwindow','style'=>'display:none')); 
					echo $this->Facebook->login(array('perms'=>'user_about_me,user_birthday,email,offline_access,publish_stream','onlogin'=>'fgm_api.facebook_login("'.$loginURL.'");'),'Sign in with Facebook');
				?>
				</div>
			</div>
			<div id="login">
				<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))); ?>
				<fieldset>
					<legend><?php __('Login'); ?></legend>
			
					<?php echo $this->Form->input('username', array('label' => __('Username', true))); ?>
					<?php echo $this->Form->input('password', array('label' => __('Password', true), 'type' => 'password')); ?>
					<?php echo $this->Form->input('auto_login', array('type' => 'checkbox', 'label' => __('Remember Me?', true))); ?>
					<?php echo $this->Html->link('Forgot your password?',array('admin'=>false,'controller'=>'users','action'=>'forgot'))?>
				</fieldset>
				<?php echo $this->Form->end(__('Login', true)); ?>
			</div>
			<div id="join">
				<div class="basic-group">
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
						<?php 
							//echo $this->Html->link('Sign up for Basic',array('controller'=>'users','action'=>'signup','admin'=>false)); 
							echo $this->Html->link('Sign up for Basic','/register');
						?>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<p style="display:none">
				If you don't already have an account, you can create one <a href="/register">here</a>.
			</p>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
//<![CDATA[
window.addEventListener("FGM_API.SITE_SET", function(){ fgm_api.init_social_services(); },false);
//]]>
</script>