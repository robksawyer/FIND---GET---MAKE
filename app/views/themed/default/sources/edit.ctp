<div class="sources form">
<?php
	echo $this->element('top_actions',array('item'=>$source,'model'=>'Source','removeEdit'=>true,'cache'=>false));
?>
<?php echo $this->Form->create('Source');?>
	<fieldset>
		<legend><?php __('Edit Source'); ?></legend>
	<?php
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo '<div class="side-by-side clearfix"><div>';
		echo $this->Form->input('source_category_id',array('class'=>'chzn-select','empty' => '-- Choose a Category --','style'=>'width:250px;'));
		//echo '<a href="/admin/source_categories/add" class="add-specialty" style="float: left;">Add a category</a>';
		echo '</div></div>';
		?>
		<fieldset>
			<legend>Current Attachments</legend>
			<?php
			foreach($source['Attachment'] as $attachment){
				echo $this->Html->image($attachment['path_small'],array('alt'=>''));
			}
			?>
		</fieldset>
		<?php
		echo $this->element('add_attachment',array('cache'=>false));
		echo $this->Form->input('slug',array('type' => 'hidden'));
		echo $this->Form->input('description');
		echo '<div id="charlimitinfo">You have 300 characters left.</div>';
		echo $this->element('add_tags',array('cache'=>false,'controller'=>'sources'));
	?>
	</fieldset>
	<fieldset>
		<legend><?php __('Contact'); ?></legend>
	<?php
		echo $this->Form->input('url');
		echo $this->Form->input('email');
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
	<?php if(Configure::read('FGM.private_solution') == 1): ?>
	<fieldset>
		<legend><?php __('Other details'); ?></legend>
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
			//echo $this->Form->input('Image');
		?>
	</fieldset>
	<?php endif; ?>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript">
$(".chzn-select").chosen();

$('#SourceDescription').keyup(function(){
	limitChars('SourceDescription', 300, 'charlimitinfo');
});

function limitChars(textid, limit, infodiv) {
	var text = $('#'+textid).val(); 
	var textlength = text.length;
	if(textlength > limit) {
		$('#' + infodiv).html('You cannot write more then '+limit+' characters!');
		$('#'+textid).val(text.substr(0,limit));
		return false;
	} else {
		$('#' + infodiv).html('You have '+ (limit - textlength) +' characters left.');
		return true;
	}
}
</script>