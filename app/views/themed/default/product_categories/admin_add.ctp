<div class="productCategories form">
<?php echo $this->Form->create('ProductCategory');?>
	<fieldset>
		<legend><?php __('Add Product Category'); ?></legend>
	<?php
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>