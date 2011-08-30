<div class="ufos form">
<?php echo $this->Form->create('Ufo',array('type'=>'file','url'=>'/ufos/add'));?>
	<fieldset>
		<legend><?php __('Add the Unidentified Found Object'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->element('add_attachment',array('cache'=>false));
		echo $this->Form->input('description');
		echo '<div id="charlimitinfo">You have 300 characters left.</div>';
		echo $this->Form->input('tags',array('type'=>'text','label'=>'Keywords','after'=>'<div class="extra">Separate each keyword with a comma e.g., modern, red, furniture.</div>'));
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$authUser['User']['id']));
		}
		
		//echo $this->Form->input('attachment_id',array('type'=>'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript">
$(".chzn-select").chosen();

$('#UfoDescription').keyup(function(){
	limitChars('UfoDescription', 300, 'charlimitinfo');
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