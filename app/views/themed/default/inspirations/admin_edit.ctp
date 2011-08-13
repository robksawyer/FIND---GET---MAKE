<div class="inspirations form">
<?php
	echo $this->element('top_actions',array('item'=>$inspiration,'model'=>'Inspiration','removeEdit'=>true,'cancel'=>'/inspirations/view/'.$inspiration['Inspiration']['id'],'cache'=>false));
?>
<?php echo $this->Form->create('Inspiration');?>
	<fieldset>
		<legend><?php __('Edit Inspiration'); ?></legend>
	<?php
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		$options = array('0'=>'Public','1'=>'Private');
		$attributes = array(
								'options'=>$options,
								'class'=>'chzn-select',
								'style'=>'width: 300px',
								'label'=>'<div class="after">Public: <i>Allow members to edit.</i> Private: <i>Allow no one to edit.</i></div>'
								);
		echo '<div class="side-by-side clearfix"><div>';
		echo $this->Form->input('private',$attributes);
		echo '</div></div>';
		echo $this->Form->input('description');
		echo $this->Form->input('designer',array('after'=>'<div class="extra">e.g. Martyn Lawrence-Bullard</div>'));
		echo $this->Form->input('source_url');
		?>
		<fieldset>
			<legend>Current Attachments</legend>
			<?php
			foreach($inspiration['Attachment'] as $attachment){
				echo $this->Html->image($attachment['path_small'],array('alt'=>''));
			}
			?>
		</fieldset>
		<?php
		echo $this->element('add_attachment',array('cache'=>false));
		//echo $this->Form->input('tags',array('type'=>'text','label'=>'Keywords','after'=>'<div class="extra">Separate each keyword with a comma e.g., modern, red, furniture.</div>'));
		echo $this->element('add_tags',array('cache'=>false,'controller'=>'inspirations'));
		//echo $this->Form->input('Attachment');
		//echo $this->Form->input('Source');
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
		echo $this->Form->input('country_id',array('empty' => '-- Select a Country --','class'=>'chzn-select'));
	?>
	</fieldset>
	<div class="side-by-side clearfix"><div>
	<fieldset class="checkboxes">
		<legend>Sources</legend>
		<?php
			/*echo $this->Form->input('Source',array(
																'label'=>'',
																'type' => 'select', 
																'multiple' => 'checkbox',
																'options' => $sources
																)
															);*/
			echo $this->Form->input('Source',array(
																'label'=>'',
																'type' => 'select', 
																'multiple' => 'multiple',
																'options' => $sources,
																'class'=>'chzn-select'
																)
															);
		?>
	</fieldset>
	<fieldset class="checkboxes">
		<legend>Products</legend>
		<?php
			/*echo $this->Form->input('Product',array(
																'label'=>'',
																'type' => 'select', 
																'multiple' => 'checkbox',
																'options' => $products
																)
															);*/
			echo $this->Form->input('Product',array(
																'label'=>'',
																'type' => 'select', 
																'multiple' => 'multiple',
																'options' => $products,
																'class'=>'chzn-select'
																)
															);
		?>
	</fieldset>
	</div></div>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript"> $(".chzn-select").chosen(); </script>