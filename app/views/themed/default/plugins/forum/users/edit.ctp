<?php
	$this->Html->script('jquery.corner',array('inline'=>false));
?>
<div id="formWrapper">
	<div class="forumHeader">
		<h2><?php __d('forum', 'Edit Profile'); ?></h2>
	</div>

	<?php echo $this->Session->flash(); ?>
	<?php // Gravatar
	if ($this->Cupcake->settings['enable_gravatar'] == 1) {
		if ($avatar = $this->Cupcake->gravatar($this->data['User']['email'])) {
			echo "<div class='avatar'>";
			echo $avatar."<br/>";
			echo $this->Html->link('Change your <span class="gravatar">Gravatar</span>','http://en.gravatar.com/',array('title'=>'Change your Gravatar','escape'=>false,'target'=>'_blank'));
			echo "</div>";
		} else{
			echo "<div class='avatar'>";
			echo $this->Html->image('no_gravatar.jpg')."<br/>";
			echo $this->Html->link('Get a <span class="gravatar">Gravatar</span>','http://en.gravatar.com/',array('title'=>'Get a Gravatar','escape'=>false,'target'=>'_blank'));
			echo "</div>";
		}
	} 
	?>
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'edit'))); ?>
	<?php echo $this->Form->input('fullname', array('label' => __d('forum', 'Full name', true),'after'=>'<div class="after">So that your friends can find you.</div>')); ?>
	<?php echo $this->Form->input('email', array('label' => __d('forum', 'Email', true))); ?>
	<?php 
	if(empty($this->data['User']['url'])){
		$urlData = 'http://';
	}else{
		$urlData = $this->data['User']['url'];
	}
	echo $this->Form->input('url', array('label' => __d('forum', 'Website', true),'value'=>$urlData)); 
	?>
	<div class="gender">
	<?php 
		$options=array('M'=>'Male','F'=>'Female');
		$attributes=array('legend'=>false);
		echo $this->Form->radio('gender', $options,$attributes); 
	?>
	</div>
	<?php echo $this->Form->input('location', array('label' => __d('forum', 'Location', true))); ?>
	<?php echo $this->Form->input('about', array('label' => __d('forum', 'Tell us about yourself.', true))); ?>
	<div id="charlimitinfo">You have 125 characters left.</div>
	<?php echo $this->Form->input($this->Cupcake->columnMap['locale'], array('options' => $this->Cupcake->getLocales(), 'label' => __d('forum', 'Language', true))); ?>
	<?php echo $this->Form->input($this->Cupcake->columnMap['timezone'], array('options' => $this->Cupcake->getTimezones(), 'label' => __d('forum', 'Timezone', true))); ?>

	<div class="input textarea">
		<?php echo $this->Form->label($this->Cupcake->columnMap['signature'], __d('forum', 'Forum Signature', true)); ?>

		<div id="textarea">
			<?php echo $this->Form->input($this->Cupcake->columnMap['signature'], array('type' => 'textarea', 'rows' => 5, 'label' => false, 'div' => false)); ?>
		</div>

		<span class="clear"><!-- --></span>
		<?php echo $this->element('markitup', array('textarea' => 'UserSignature')); ?>
	</div>
	<div class="social-networks">
		<!--
			TODO Actually check to see if the account is linked.
		-->
		<?php echo $this->Form->label(__d('forum', 'Social Networks', true)); ?>
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
	<!--
		TODO Build out this section
	-->
	<div class="email-notifications">
		<?php //echo $this->Form->label(__d('forum', 'Email Notifications', true)); ?>
		<?php 
			//echo $this->Form->input('email_on_follow',array('type'=>'checkbox','label'=>'Email when someone follows you')); 
			//echo $this->Form->checkbox('email_on_show',array('before'=>'Email when someone shows you a product')); 
			//echo $this->Form->checkbox('email_on_follow',array('before'=>'Email when someone comments on an item you\'ve added')); 
		?>
	</div>
		
	<div class="feed-notifications">
		<?php //echo $this->Form->label(__d('forum', 'Feed Notifications', true)); ?>
		<?php
			//echo $this->Form->input('notify_on_add',array('label'=>'Notify when someone adds a product you found','type'=>'checkbox')); 
			//echo $this->Form->input('notify_on_follow',array('label'=>'Notify when someone follows you','type'=>'checkbox')); 
		?>
	</div>

	<?php echo $this->Form->end(__d('forum', 'Update Account', true)); ?>
	<div class="change">Click to change password</div>
	<div id="change-password" style="display:none">
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'edit'))); ?>
		<?php echo $this->Form->input('oldPassword', array('type' => 'password', 'label' => __d('forum', 'Old Password', true))); ?>
		<?php echo $this->Form->input('newPassword', array('type' => 'password', 'label' => __d('forum', 'New Password', true))); ?>
		<?php echo $this->Form->input('confirmPassword', array('type' => 'password', 'label' => __d('forum', 'Confirm Password', true))); ?>
		<?php echo $this->Form->end(__d('forum', 'Update Password', true)); ?>
	</div>
</div>
<?php
	echo $this->Html->script('jquery.popupwindow',array('inline'=>false));
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

$(".change").toggle(function(){
	$("#change-password").show();
},function(){
	$("#change-password").hide();
});
$("#formWrapper").corner("10px");
$('#UserAbout').keyup(function(){
	limitChars('UserAbout', 125, 'charlimitinfo');
})

function limitChars(textid, limit, infodiv) {
	var text = $('#'+textid).val(); 
	var textlength = text.length;
	if(textlength > limit) {
		$('#' + infodiv).html('You cannot write more then '+limit+' characters!');
		$('#'+textid).val(text.substr(0,limit));
		return false;
	} else {
		$('#' + infodiv).html('You have '+ (limit - textlength) +' characters left.');
		return true;
	}
}
//]]>
</script>