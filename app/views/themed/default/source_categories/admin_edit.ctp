<div class="sourceCategories form">
	<?php
		echo $this->element('top_actions',array('item'=>$sourceCategory,'model'=>'SourceCategory','removeEdit'=>true,'cache'=>false));
	?>
<?php echo $this->Form->create('SourceCategory');?>
	<fieldset>
		<legend><?php __('Edit Source Category'); ?></legend>
	<?php
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('slug',array('type'=>'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>