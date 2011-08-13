<div class="sourceCategories form">
<?php echo $this->Form->create('SourceCategory');?>
	<fieldset>
		<legend><?php __('Add Source Category'); ?></legend>
	<?php
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('name');
		echo $this->Form->input('slug',array('type'=>'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>