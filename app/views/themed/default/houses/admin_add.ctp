<div class="houses form">
<?php echo $this->Form->create('House',array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Add House'); ?></legend>
	<?php
		echo $this->Form->input('client_id',array('type'=>'hidden','value'=>$client_id));
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->element('add_attachment',array('cache'=>false));
		echo $this->Form->input('tags',array('type'=>'text','label'=>'Keywords','after'=>'<div class="extra">Separate each keyword with a comma e.g., modern, red, furniture.</div>'));
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('Address'); ?></legend>
	<?php
		echo $this->Form->input('address1');
		echo $this->Form->input('address2');
		echo $this->Form->input('city',array('class'=>'city'));
		echo $this->Form->input('state',array('class'=>'state'));
		echo $this->Form->input('zip',array('class'=>'zip'));
		echo $this->Form->input('country_id',array('empty' => '-- Select a Country --'));
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('Contact'); ?></legend>
	<?php
		echo $this->Form->input('phone',array('class'=>'phone','after'=>'<div class="extra">e.g. (503) 123-4567</div>'));
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('Other Details'); ?></legend>
	<?php
		echo $this->Form->input('bedrooms');
		echo $this->Form->input('bathrooms');
		echo $this->Form->input('amenities');
		echo $this->Form->input('more_details');
		echo $this->Form->input('square_footage');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>