<?php 
debug($facebookUser); 
//debug($registrationData);
?>
<div id="register">
	<div class="social-register">
		<h1>Register now and start posting.</h1>
			<!--<a id="btn_twitter" class="btn_oauth_login" data-requires-credential="twitter" href="/auth/register_with_twitter">Sign in with Twitter</a>-->
		<div id="twitter-login-wrap">
		<?php 
			//$linkOptions['login'] = 'Sign in with Twitter';
			//echo $this->Twitter->oauthLink($linkOptions); 
			echo "<span class='loading'></span>";
			echo $this->Html->link('Connect with Twitter','',array('id'=>'btn-twitter','class'=>'popupwindow','style'=>'display:none'));
		?>
		</div>
		<!--<a id="btn_facebook" class="btn_oauth_login" data-requires-credential="facebook" href="/auth/facebook_connect">Login with Facebook</a>-->
		<div id="btn-facebook">
		<?php echo $this->Facebook->login(array('perms' => 'offline_access,publish_stream','onlogin'=>'Facebook.login()'),'Connect with Facebook'); ?>
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
<?php
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
	
	var currentSiteAddress = "<?php echo $this->String->getCurrentSiteAddress(); ?>";
	$.getJSON(currentSiteAddress+'/twitter_kit/oauth/authenticate_url/twitter', {}, function(data){
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

//]]>
</script>