<?php
	echo $this->Html->script('sources/check_source_name',array('inline'=>false));
?>
<div id="flashMessage" style="display:none;"></div>
<div class="sources form">
<?php 
	if(!empty($model) && !empty($item)){
		echo $this->Form->create('Source',array('type' => 'file','action'=>'add/model:'.$model.'/id:'.$item[$model]['id']));
		$back_path = "/$plural_model/view/".$item[$model]['id'];
		echo $this->Form->input('redirect',array('value'=>$back_path,'type'=>'hidden'));
	}else{
		echo $this->Form->create('Source',array('type' => 'file'));
	}
	
	if (isset($errors)) {
		$form->error = $errors;
	}
?>
	<fieldset>
		<legend><?php __('Add Source'); ?></legend>
	<?php
		//The user is trying to attach a source to a model
		if(!empty($model) && !empty($item)){
			echo $this->Form->input("$model.0",array('type'=>'hidden','value'=>$item[$model]['id']));
		}
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('name',array('style'=>'width: 90% !important; float: left;'));
		echo '<span class="ajax_status">';
		echo $this->Html->image("/img/ajax-loader.gif",
										array('alt'=>'Checking...')
										);
		echo "</span>";
		echo "<div class='clear'></div>";
		echo '<div class="side-by-side clearfix"><div>';
		echo $this->Form->input('source_category_id',array('class'=>'chzn-select','empty' => '-- Choose a Category --','style'=>'width:250px;'));
		//echo '<a href="/admin/source_categories/add" class="add-specialty" style="float: left;">Add a category</a>';
		echo '</div></div>';
		echo $this->element('add_attachment',array('cache'=>false));
		echo $this->Form->input('slug',array('type' => 'hidden'));
		echo $this->Form->input('description');
		//echo $this->Form->input('tags',array('type'=>'text','label'=>'Keywords','after'=>'<div class="extra">Separate each keyword with a comma e.g., modern, red, furniture.</div>'));
		echo $this->element('add_tags',array('cache'=>false,'controller'=>'sources'));
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('Contact'); ?></legend>
	<?php
		echo $this->Form->input('url');
		echo $this->Form->input('email',array('class'=>'email'));
		echo $this->Form->input('phone',array('class'=>'phone','after'=>'<div class="extra">e.g. (503) 123-4567</div>'));
		echo $this->Form->input('fax',array('class'=>'phone','after'=>'<div class="extra">e.g. (503) 123-4567</div>'));
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
	<?php if(PRIVATE_SOLUTION): ?>
	<fieldset>
		<legend><?php __('Other Details'); ?></legend>
	<?php
		//TODO: Add the multiselect chrome drop down box
		/*echo $this->Form->input('Contractor.name',array(
															'label'=>'',
															'type' => 'select', 
															'multiple' => 'multiple',
															'options' => $contractors,
															'class'=>'chzn-select'
															)
														);*/
	
		echo $this->Form->input('Contractor.name',array('type' => 'text','label'=>'Contractor Name'));
	?>
	</fieldset>
	<?php endif; ?>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript"> $(".chzn-select").chosen(); </script>