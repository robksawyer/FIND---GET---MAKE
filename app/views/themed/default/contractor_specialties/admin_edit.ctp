<div class="contractorSpecialties form">
<?php
	echo $this->element('top_actions',array('item'=>$contractorSpecialty,'model'=>'ContractorSpecialty','removeEdit'=>true,'cache'=>false));
?>
<?php echo $this->Form->create('ContractorSpecialty');?>
	<fieldset>
		<legend><?php __('Edit Contractor Specialty'); ?></legend>
	<?php
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>