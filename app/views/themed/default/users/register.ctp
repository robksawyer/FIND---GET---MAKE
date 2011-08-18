<div id="register">
	<?php debug($registrationData); ?>
	<?php debug($facebookUser); ?>
	<div class="social-register">
		<h1>Register now and start posting.</h1>
			<!--<a id="btn_twitter" class="btn_oauth_login" data-requires-credential="twitter" href="/auth/register_with_twitter">Sign in with Twitter</a>-->
		<?php 
			$linkOptions['login'] = 'Sign in with Twitter';
			echo $this->Twitter->oauthLink($linkOptions); 
		?>
		<?php //echo $this->Html->link('Sign in with Twitter','/auth/register_with_twitter',array('id'=>'btn-twitter')); ?>
		<!--<a id="btn_facebook" class="btn_oauth_login" data-requires-credential="facebook" href="/auth/facebook_connect">Login with Facebook</a>-->
		<div id="btn-facebook">
		<?php echo $this->Facebook->login(array('perms' => 'email','redirect-uri' => '/register'),'Connect with Facebook'); ?>
		</div>
		<div id="not-social">
		<?php echo "Not social? Sign up the ".$this->Html->link('old fashioned way.','/signup',array('title'=>'Signup the old fashioned way.')); ?>
		</div>
		<div class="footnote">We will <b>never</b> post anything on your wall or Twitter feed without your permission.</div>
	</div>
	<div class="sign-in">
		<h2>Have an account?</h2>
		<?php echo $this->Html->link('Login Here','/login',array('title'=>'Login Here'));?>
	</div>
</div>