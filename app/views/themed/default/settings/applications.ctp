<?php
	echo $this->Html->css('settings/style');
?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->element('settings-header',array('cache'=>true,'username'=>$authUser['User']['username'])); ?>
<?php echo $this->element('settings-nav',array('cache'=>false)); ?>
<div id="settings-container">
	<div class="left-panel">
		<?php //echo $this->Form->create('User', array('url' => array('controller' => 'settings', 'action' => 'applications'))); ?>
		<div class="social-networks">
			<!--
				TODO Actually check to see if the account is linked. Add a revoke link.
			-->
			<?php echo $this->Form->label(__('Social Networks', true)); ?>
			<div class="item">
			<?php if(!empty($authUser['User']['twitter_id'])): ?>
				<span class="twitter">Your <?php echo $this->Html->link('twitter','http://twitter.com/settings/applications',array('target'=>'_blank','class'=>'twitter')); ?> account is linked.</span>
			<?php else: ?>
				<span id="twitter-login-wrap">
				<?php 
					echo "<span class='loading'></span>";
					echo $this->Html->link('Connect with Twitter','',array('id'=>'btn-twitter','class'=>'popupwindow','style'=>'display:none'));
				?>
				</span>
			<?php endif; ?>
			</div>
			<div class="item">
			<?php if(!empty($authUser['User']['facebook_id'])): ?>
				<span class="twitter">Your <?php echo $this->Html->link('facebook','http://www.facebook.com/settings?tab=applications',array('target'=>'_blank','class'=>'facebook'));?> account is linked.</span>
			<?php else: ?>
				<div id="facebook-login-wrap">
				<?php 
					echo $this->Facebook->login(array('perms'=>'user_about_me,user_birthday,email,offline_access,publish_stream','onlogin'=>'facebook_login();'),'Sign in with Facebook');
				?>
				</div>
			<?php endif; ?>
			</div>
		</div>
		
		<?php //echo $this->Form->end('Save'); ?>
	</div>
	<div class="right-panel">
		<div class="section">
			<h4>Applications</h4>
			<p>Linking your favorite social services, allows you to share your data easily and sign in quickly.</p>
		</div>
		<hr/>
		<div class="section">
			<h4>Tips</h4>
			<p>If you've linked a service, try clicking on the respective service button on the login page to bypass entering your user/pass combo during your next login.</p>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php
	echo $this->Html->script('jquery.popupwindow',array('inline'=>false));
	echo $this->Html->script('jquery.corner',array('inline'=>false));
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

$("#settings-container").corner("10px");
$("#settings-container .right-panel").corner("10px");

//]]>
</script>