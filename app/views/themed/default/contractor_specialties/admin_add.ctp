<div class="contractorSpecialties form">
<?php echo $this->Form->create('ContractorSpecialty');?>
	<fieldset>
		<legend><?php __('Add Contractor Specialty'); ?></legend>
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