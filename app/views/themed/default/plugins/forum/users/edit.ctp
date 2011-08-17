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
<script language="javascript">
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
</script>