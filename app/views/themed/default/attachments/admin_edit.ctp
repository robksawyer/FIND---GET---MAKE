<div class="attachments form">
<?php
	echo $this->element('top_actions',array('item'=>$attachment,'model'=>'Attachment','removeEdit'=>true,'cache'=>false));
?>
<?php echo $this->Form->create('Attachment',array('type' => 'file')); ?>
	<fieldset>
		<legend><?php __('Edit Attachment'); ?></legend>
	<?php
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		/*echo $this->Form->input('name');
		echo $this->Form->input('type');
		echo $this->Form->input('size');
		echo $this->Form->input('filesize');
		echo $this->Form->input('ext');
		echo $this->Form->input('group');
		echo $this->Form->input('width');
		echo $this->Form->input('height');
		echo $this->Form->input('path');
		echo $this->Form->input('path_small');
		echo $this->Form->input('path_med');
		echo $this->Form->input('uploaded');*/
		echo $this->Form->input('Inspiration');
		echo $this->Form->input('Contractor');
		echo $this->Form->input('House');
		echo $this->Form->input('Source');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>