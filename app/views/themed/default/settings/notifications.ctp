<?php
	echo $this->Html->css('settings/style');
?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->element('settings-header',array('cache'=>true,'username'=>$authUser['User']['username'])); ?>
<?php echo $this->element('settings-nav',array('cache'=>false)); ?>
<div id="settings-container">
	<div id="left-panel">
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'settings', 'action' => 'notifications'))); ?>
		<?php echo $this->Form->input('id', array('type' => 'hidden','label' => false)); ?>
		<!--
			TODO Build out this section
		-->
		<div class="email-notifications">
			<?php echo $this->Form->label(__('Email Notifications', true)); ?>
			<?php 
				echo $this->Form->input('email_on_follow',array('type'=>'checkbox','label'=>'Email when someone follows you')); 
				echo $this->Form->input('email_on_product_have_want',array('type'=>'checkbox','label'=>'Email when someone has or wants a product that you\'ve added'));
				echo $this->Form->input('email_on_like',array('type'=>'checkbox','label'=>'Email when someone likes an item that you\'ve added'));
				echo $this->Form->input('email_on_comment',array('type'=>'checkbox','label'=>'Email when someone comments on an item you\'ve added')); 
			?>
		</div>
		
		<div class="feed-notifications">
			<?php echo $this->Form->label(__('Feed Notifications', true)); ?>
			<?php
				echo $this->Form->input('notify_on_follow',array('label'=>'Notify when someone follows you','type'=>'checkbox'));
				echo $this->Form->input('notify_on_like',array('label'=>'Notify when someone likes an inspiration you found','type'=>'checkbox'));
				echo $this->Form->input('notify_on_product_have_want',array('type'=>'checkbox','label'=>'Notify when someone has or wants a product that you\'ve added'));
			?>
		</div>
		
		<?php echo $this->Form->end('Save'); ?>
	</div>
	<div class="right-panel">
		<div class="section">
			<h4>Notifications</h4>
			<p>How often, and through what means, do you want to be contacted by this site? As always, we won't share your information with third parties.</p>
		</div>
		<hr>
		<div class="section">
			<h4>Notes</h4>
			<p>Be sure your email is correct in <?php echo $this->Html->link('account settings','/settings/account',array());?> to receive emails.</p>
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
	

});

$("#settings-container").corner("10px");
$("#settings-container .right-panel").corner("10px");

//]]>
</script>