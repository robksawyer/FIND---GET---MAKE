<?php
	echo $this->Html->css('settings/style');
?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->element('settings-header',array('cache'=>true,'username'=>$authUser['User']['username'])); ?>
<?php echo $this->element('settings-nav',array('cache'=>false)); ?>
<div id="settings-container">
	<div class="left-panel">
		<?php echo $this->element('avatar_edit',array('cache'=>false)); ?>
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'settings', 'action' => 'profile'))); ?>
		<?php echo $this->Form->input('id', array('type' => 'hidden','label' => false)); ?>
		<?php echo $this->Form->input('fullname', array('label' => __('Full name', true),'after'=>'<div class="after">Enter your full name or usual handle so friends can find you.</div>')); ?>
		<?php echo $this->Form->input('location', array('label' => __('Location', true),'after'=>'<div class="after">Where in the world are you?</div>')); ?>
		<?php 
		if(empty($this->data['User']['url'])){
			$urlData = 'http://';
		}else{
			$urlData = $this->data['User']['url'];
		}
		echo $this->Form->input('url', array('label' => __('Website', true),'value'=>$urlData)); 
		?>
		<div class="gender">
		<?php 
			$options=array('M'=>'Male','F'=>'Female');
			$attributes=array('legend'=>false);
			echo $this->Form->radio('gender', $options,$attributes); 
		?>
		</div>
		
		<?php echo $this->Form->input('about', array('label' => __('Tell us about yourself.', true))); ?>
		<div id="charlimitinfo">You have 125 characters left.</div>
		<div class="clear"></div>
		<!-- Todo: Add Facebook Linkage Details -->
		<?php echo $this->Form->end('Save'); ?>
	</div>
	<div class="right-panel">
		<div class="section">
			<h4>Profile</h4>
			<p>This information appears on your public profile, search results, and beyond.<br/>It helps instantly identify you to those following you, and tells those who aren't more about you.</p>
		</div>
		<hr>
		<div class="section">
			<h4>Tips</h4>
			<p>Filling in your profile information will help people find you on Twitter. For example, you'll be more likely to turn up in a Twitter search if you've added your location or your real name.<br/>Your Twitter profile picture helps instantly identify you to those following you—and tells those who aren't more about you.</p>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php
	echo $this->Html->script('jquery.corner',array('inline'=>false));
?>
<script language="javascript">
//<![CDATA[
$(document).ready(function() {
	

});

$("#settings-container").corner("10px");
$("#settings-container .right-panel").corner("10px");
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