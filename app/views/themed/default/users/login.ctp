<div id="login-wrapper">
	<div class="wrapper">
		<div class="users form">
			<div id="social-login">
				<h3>Log in to <b>FIND | GET | MAKE</b>.</h3><br/>
				<!--<div id="twitter-login-wrap">
				<?php 
					//echo "<span class='loading'></span>";
					//echo $this->Html->link('Connect with Twitter','',array('id'=>'btn-twitter','class'=>'popupwindow','style'=>'display:none'));
				?>
				</div>-->
				<!--<div id="facebook-login-wrap">
				<?php 
					//echo $this->Facebook->login(array('perms'=>'user_about_me,user_birthday,email,offline_access,publish_stream','onlogin'=>'fgm_api.facebook_login("'.$loginURL.'");'),'Sign in with Facebook');
				?>
				</div>-->
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
				<div class="basic-group" style="width: 400px; color: #ffffff;">
					<div class="basic">
						<?php //echo $this->Html->image('site/free.png',array('class'=>'free')); ?>
						<h3 style="color: #056453;font-size: 14px; line-height: normal; margin-bottom: 10px; ">FIND-GET-MAKE is a customizable tool that was built to help interior design firms collaborate in a more effective manner.</h3>
						<h4 style="color: #ffffff !important;font-size: 20px;">Why should I contact you and have it setup for my firm?</h4>
						<ul>
							<li>1. the simple and easy to use interface</li>
							<li>2. easily build collections of items that can be shared across the team</li>
							<li>3. keep contractor/artist/resource contacts in one place</li>
							<!--<li>public forum access</li>-->
							<li>4. easy tools for collecting and identifying products (ex. bookmarklet tool)</li>
							<li>5. team-added content is taggable, shareable, and easily incorporated into your own collections</li>
							<li>6. the running bond (feed) – see what teammates are finding</li>
							<li>7. customizable interface that can be setup to match your firms branding</li>
							<li>8. client review system built-in</li>
						</ul>
					</div>
					<div class="basic-sign-up">
						<?php 
							//echo $this->Html->link('Sign up for Basic',array('controller'=>'users','action'=>'signup','admin'=>false)); 
							echo $this->Html->link('Contact Us','mailto:robksawyer+fgm@gmail.com');
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
/*var login_int = window.setInterval("init()",100);
function init(){
	if(fgm_api.site_url_set){
		window.clearInterval(login_int);
		fgm_api.init_social_services();
	}
}*/
//]]>
</script>