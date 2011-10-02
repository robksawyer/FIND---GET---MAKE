<?php echo $this->Session->flash(); ?>
<?php echo $this->element('settings-header',array('cache'=>true,'username'=>$authUser['User']['username'])); ?>
<?php echo $this->element('settings-nav',array('cache'=>false)); ?>
<div id="settings-container">
	<div id="left-panel">
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'settings', 'action' => 'forum'))); ?>
		<?php echo $this->Form->input('id', array('type' => 'hidden','label' => false)); ?>
		<?php echo $this->Form->input($this->Cupcake->columnMap['locale'], array('options' => $this->Cupcake->getLocales(), 'label' => __('Language', true))); ?>
		<?php echo $this->Form->input($this->Cupcake->columnMap['timezone'], array('options' => $this->Cupcake->getTimezones(), 'label' => __('Timezone', true))); ?>
		
		<div class="input textarea">
			<?php echo $this->Form->label($this->Cupcake->columnMap['signature'], __('Forum Signature', true)); ?>

			<div id="textarea">
				<?php echo $this->Form->input($this->Cupcake->columnMap['signature'], array('type' => 'textarea', 'rows' => 5, 'label' => false, 'div' => false)); ?>
			</div>
			<span class="clear"><!-- --></span>
			<?php echo $this->element('markitup', array('textarea' => 'UserSignature')); ?>
		</div>
		<?php echo $this->Form->end('Save'); ?>
	</div>
	<div class="right-panel">
		<div class="section">
			<h4>Forum</h4>
			<p>Here you can add a signature that lets people know what you're about. This'll show up on every post you make in the forum&mdash;so make it good.</p>
		</div>
		<hr>
		<div class="section">
			<h4>Tips</h4>
			<p>Setting your timezone will ensure that your forum posts contain the proper time.</p>
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
//]]>
</script>