<div class="contractors form">
<?php echo $this->Form->create('Contractor',array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Add Contractor'); ?></legend>
	<?php
		//debug($this->params);
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('name');
		echo $this->Form->input('contractor_specialty_id',array('empty' => '-- Choose a Specialty --','after'=>'<a href="/contractor_specialties/add" class="add-specialty">Add a specialty</a>'));
		echo $this->Form->input('slug', array('type'=>'hidden'));
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
		echo $this->Form->input('email');
		echo $this->Form->input('phone',array('class'=>'phone','after'=>'<div class="extra">e.g. (503) 123-4567</div>'));
		echo $this->Form->input('fax',array('class'=>'phone','after'=>'<div class="extra">e.g. (503) 123-4567</div>'));
		echo $this->Form->input('url');
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('Other details'); ?></legend>
	<?php
		if(!empty($this->params['named']['id'])){
			echo $this->Form->input('Source.0',array('type'=>'hidden','value'=>$this->params['named']['id']));
		}
		//echo $this->Form->input('Source');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>