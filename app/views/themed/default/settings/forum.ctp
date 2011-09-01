<?php
	echo $this->Html->css('settings/style');
?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->element('settings-header',array('cache'=>true,'username'=>$authUser['User']['username'])); ?>
<?php echo $this->element('settings-nav',array('cache'=>false)); ?>
<div id="settings-container">
	<div class="left-panel">
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
			<p>Sed eget rutrum tortor. Quisque dolor magna, vulputate et cursus at, aliquet id odio. Maecenas nisi tellus, volutpat sit amet aliquam sed, sollicitudin vitae eros. Praesent nec pretium augue. Vestibulum faucibus viverra diam, non bibendum mi lobortis et. Vestibulum suscipit placerat est a tempus.</p>
		</div>
		<hr>
		<div class="section">
			<h4>Tips</h4>
			<p>Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam vehicula sapien a tellus sollicitudin lobortis.h</p>
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