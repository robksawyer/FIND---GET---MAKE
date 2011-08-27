<div class="users form">
<?php echo $this->Form->create('User',array('type' => 'file','url'=>"/users/add_avatar/".$authUser['User']['id']));?>
	<fieldset style="border: none;">
		<legend><?php __('Add Your Avatar'); ?></legend>
	<?php
		echo $this->Form->input('id',array('value'=>$model_id));
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->element('add_attachment',array('cache'=>false,'removeSource'=>true,'removeTitle'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>