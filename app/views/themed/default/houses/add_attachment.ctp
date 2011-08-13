<div class="<?php echo $controller; ?> form">
<?php  
	echo "<p>".$this->Html->link(__("&laquo; Back",true), "/$controller/view/$id",array('escape' => false))."</p>"; 
?>
<?php echo $this->Form->create('House',array('type' => 'file','url'=>"/$controller/add_attachment/$id/$model"));?>
	<fieldset>
		<legend><?php __('Add Attachment'); ?></legend>
	<?php
		echo $this->Form->input('id',array('value'=>$item[$model]['id']));
		echo $this->element('add_attachment',array('cache'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>