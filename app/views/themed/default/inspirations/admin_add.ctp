<div class="inspirations form">
	<p class="description">
		An inspiration is an image that contains multiple sources. You should be able to add an image from anywhere and select multiple sources that are inside of the piece of inspiration. 
	</p>
<?php echo $this->Form->create('Inspiration',array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Add Inspiration'); ?></legend>
	<?php
		echo $this->Form->input('name',array('label'=>'Inspiration Name'));
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
		echo $this->element('add_attachment',array('cache'=>false));
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('description');
		echo $this->Form->input('designer',array('after'=>'<div class="extra">e.g. Martyn Lawrence-Bullard</div>'));
		echo $this->Form->input('source_url');
		echo $this->element('add_tags',array('cache'=>false,'controller'=>'inspirations'));
		//echo $this->Form->input('tags',array('type'=>'text','label'=>'Keywords','after'=>'<div class="extra">Separate each keyword with a comma e.g., modern, red, furniture.</div>'));
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
	<div class="side-by-side clearfix"><div>
	<fieldset class="checkboxes">
		<legend class="">Sources</legend>
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
		<legend class="">Products</legend>
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