<div id="login-wrapper">
	<div class="wrapper">
		<div class="users form">
			<div id="social-login">
				<h3>Log in to <b>FIND | GET | MAKE</b> with Twitter.</h3>
				<span id="twitter-login-wrap">
				<?php 
					//$linkOptions['login'] = 'Sign in with Twitter';
					//echo $this->Twitter->oauthLink($linkOptions); 
					echo "<span class='loading'>Loading...</span>";
					echo $this->Html->link('Connect with Twitter','',array('id'=>'btn-twitter','class'=>'popupwindow','style'=>'display:none'));
				?>
				</span>
			</div>
			<div id="login">
				<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))); ?>
				<fieldset>
					<legend><?php __('Login'); ?></legend>
			
					<?php echo $this->Form->input('username', array('label' => __d('forum', 'Username', true))); ?>
					<?php echo $this->Form->input('password', array('label' => __d('forum', 'Password', true), 'type' => 'password')); ?>
					<?php echo $this->Form->input('auto_login', array('type' => 'checkbox', 'label' => __d('forum', 'Remember Me?', true))); ?>
				</fieldset>
				<?php echo $this->Form->end(__d('forum', 'Login', true)); ?>
			</div>
			<div id="join">
				<div class="group">
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
			onUnload:unloadedPopup,
			center: 1
		}
	}
	
	$.getJSON('http://www.find-get-make.com/twitter_kit/oauth/authenticate_url/twitter', {}, function(data){
   	$('#twitter-login-wrap #btn-twitter').attr('href', data.url);
		$('#twitter-login-wrap #btn-twitter').attr('rel','windowCenter');
		$('#twitter-login-wrap #btn-twitter').show();
   	$('#twitter-login-wrap .loading').hide();
		$('.popupwindow').popupwindow(profiles);
   });

	function unloadedPopup(){
		//Redirect the user to the signup page and continue the process
		window.location="/signup";
	}
});

$("#join").corner("10px");
$(".basic").corner('10px');
$(".basic-sign-up").corner("10px");
$(".plus-sign-up").corner("10px");

//]]>
</script>