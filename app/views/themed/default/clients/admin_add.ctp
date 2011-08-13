<div class="clients form">
<?php echo $this->Form->create('Client',array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Add Client'); ?></legend>
	<?php
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('name');
		echo $this->Form->input('slug',array('type'=>'hidden'));
		echo $this->element('add_attachment',array('cache'=>false));
		echo $this->Form->input('tags',array('type'=>'text','label'=>'Keywords','after'=>'<div class="extra">Separate each keyword with a comma e.g., modern, red, furniture.</div>'));
		echo $this->Form->input('description');
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
		echo '<div class="side-by-side clearfix"><div>';
		echo $this->Form->input('country_id',array('empty' => '-- Select a Country --','class'=>'chzn-select'));
		echo '</div></div>';
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('Contact'); ?></legend>
	<?php
		echo $this->Form->input('email',array('class'=>'email'));
		echo $this->Form->input('phone',array('class'=>'phone','after'=>'<div class="extra">e.g. (503) 123-4567</div>'));
		echo $this->Form->input('fax',array('class'=>'phone','after'=>'<div class="extra">e.g. (503) 123-4567</div>'));
		echo $this->Form->input('url');
	?>
	</fieldset>
	<fieldset>
	<legend><?php __('Other details'); ?></legend>
	<?php
		echo $this->Form->input('job_title');
		echo $this->Form->input('total_children');
		//echo $this->Form->input('salary_range');
		echo $this->Form->input('style_description');
		echo $this->Form->input('personal_description');
		echo $this->Form->input('favorite_colors');
		echo $this->Form->input('favorite_patterns');
		echo $this->Form->input('favorite_designers');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript"> $(".chzn-select").chosen(); </script>