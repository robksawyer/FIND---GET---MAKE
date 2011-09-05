<?php
?>
<div id="login-wrapper">
	<div class="wrapper">
		<div class="users form">
			<div id="social-login">
				<h3>Log in to <b>FIND | GET | MAKE</b> with Twitter.</h3>
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
					echo $this->Facebook->login(array('perms'=>'offline_access,publish_stream','onlogin'=>'facebook_login();'),'Sign in with Facebook');
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
<?php
	echo $this->Html->script('jquery.corner',array('inline'=>false));
	echo $this->Html->script('jquery.popupwindow',array('inline'=>false));
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	
	var profiles = {
		windowCenter:{
			height:500,
			width:800, 
			center:1, 
			onUnload:unloadedTwitterPopup,
			center: 1
		}
	}
	
	var currentSiteAddress = "<?php echo $this->String->getCurrentSiteAddress(); ?>";
	$.getJSON(currentSiteAddress+'/twitter_kit/oauth/authenticate_url/twitter', {}, function(data){
   	$('#twitter-login-wrap #btn-twitter').attr('href', data.url);
		$('#twitter-login-wrap #btn-twitter').attr('rel','windowCenter');
		$('#twitter-login-wrap #btn-twitter').show();
   	$('#twitter-login-wrap .loading').hide();
		$('.popupwindow').popupwindow(profiles);
   });

	function unloadedTwitterPopup(){
		//Redirect the user to the signup page and continue the process
		window.location="/users/twitter_signup";
	}
});

/**
 * The user accepted the requirements. Log them in
 * @param 
 * @return 
 * 
*/
function facebook_login(){
	var loginURL = "<?php echo $loginURL; ?>";
	window.location.href = loginURL;
}

$("#join").corner("10px");
$(".basic").corner('10px');
$(".basic-sign-up").corner("10px");

//]]>
</script>