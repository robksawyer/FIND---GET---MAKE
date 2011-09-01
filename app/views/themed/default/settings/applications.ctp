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
			<?php if(!empty($this->data['User']['twitter_id'])): ?>
				<span class="twitter">Your <i>Twitter</i> account is linked.</span>
			<?php else: ?>
				<span id="twitter-login-wrap">
				<?php 
					echo "<span class='loading'>Loading...</span>";
					echo $this->Html->link('Connect with Twitter','',array('id'=>'btn-twitter','class'=>'popupwindow','style'=>'display:none'));
				?>
				</span>
			<?php endif; ?>
			<!--
			<?php //if(!empty($this->data['User']['facebook_id'])): ?>
				<span class="twitter">Your <i>Facebook</i> account is linked.</span>
			<?php //else: ?>
				<div id="btn-facebook">
				<?php // echo $this->Facebook->login(array('perms' => 'email','redirect-uri' => '/register'),'Connect with Facebook'); ?>
				</div>
			<?php //endif; ?>
			-->
		</div>
		
		<?php //echo $this->Form->end('Save'); ?>
	</div>
	<div class="right-panel">
		<div class="section">
			<h4>Applications</h4>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		</div>
		<hr>
		<div class="section">
			<h4>Tips</h4>
			<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php
	echo $this->Html->script('jquery.popupwindow',array('inline'=>false));
	echo $this->Html->script('jquery.corner',array('inline'=>false));
?>
<script language="javascript">
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

$("#settings-container").corner("10px");
$("#settings-container .right-panel").corner("10px");

//]]>
</script>