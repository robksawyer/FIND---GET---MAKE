<div class="collections form">
<?php echo $this->Form->create('Collection');?>
	<fieldset>
		<legend><?php __('Edit Collection'); ?></legend>
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
		echo $this->Form->input('credit',array('after'=>'<div class="extra">Give credit where credit is due.</div>'));
		echo $this->Form->input('description');
		echo '<div id="charlimitinfo">You have 300 characters left.</div>';
		echo $this->Form->input('tags',array('type'=>'text','label'=>'Keywords','after'=>'<div class="extra">Separate each keyword with a comma e.g., modern, red, furniture.</div>'));
		//echo $this->Form->input('Product',array('after'=>'<div class="extra">Select one or more (hold SHIFT) of the products below to add them to the collection. Hold COMMAND and click to remove a selection.</div>'));
	?>
		<div class="side-by-side clearfix"><div>
		<fieldset class="checkboxes">
			<legend class="">Products</legend>
			<?php
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
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript">
$(".chzn-select").chosen();

$('#CollectionDescription').keyup(function(){
	limitChars('CollectionDescription', 300, 'charlimitinfo');
})

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