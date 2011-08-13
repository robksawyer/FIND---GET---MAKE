<div class="attachments form">
<?php 
	if(!empty($model) && !empty($item)){
		echo $this->Form->create('Attachment',array('type' => 'file','action'=>'add/model:'.$model.'/id:'.$item[$model]['id']));
		$back_path = "/$plural_model/view/".$item[$model]['id'];
	}else{
		echo $this->Form->create('Attachment',array('type' => 'file'));
	}
?>
	<?php  
		if(!empty($back_path)){
			echo "<p>".$this->Html->link(__("&laquo; Back",true), $back_path,array('escape' => false))."</p>"; 
		}
	?>
	<fieldset>
		<legend><?php __('Add Attachment'); ?></legend>
	<?php
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
		echo $this->Form->input('uploaded');
		echo $this->Form->input('Contractor');
		echo $this->Form->input('House');
		echo $this->Form->input('Source');*/
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		if(!empty($model) && !empty($item)){
			echo $this->element('add_attachment',array('cache'=>false));
			echo $this->Form->input("$model.0",array('type'=>'hidden','value'=>$item[$model]['id']));
		}else{
			echo "WARNING: There isn't a file name associated with this file.";
			echo $this->element('add_attachment',array('cache'=>false));
		}
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>