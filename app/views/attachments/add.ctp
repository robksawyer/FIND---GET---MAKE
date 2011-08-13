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
		if(!empty($model) && !empty($item)){
			echo $this->Form->input('file', array('type' => 'file'));
			echo $this->Form->input("$model.0",array('type'=>'hidden','value'=>$item[$model]['id']));
		}else{
			echo "WARNING: There isn't a file name associated with this file.";
			echo $this->Form->input('file', array('type' => 'file'));
		}
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Attachments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Contractors', true), array('controller' => 'contractors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Houses', true), array('controller' => 'houses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New House', true), array('controller' => 'houses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sources', true), array('controller' => 'sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add')); ?> </li>
	</ul>
</div>