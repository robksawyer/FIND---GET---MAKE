<div class="ufos form">
<?php echo $this->Form->create('Ufo');?>
	<fieldset>
		<legend><?php __('Edit Ufo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		?>
		<fieldset>
			<legend>Current Attachments</legend>
			<?php
			if(!empty($this->data['Attachment'])){
				echo $this->Html->image($this->data['Attachment']['path_small'],array('alt'=>''));
			}
			?>
		</fieldset>
		<?php
		echo $this->element('add_attachment',array('cache'=>false));
		echo $this->Form->input('description');
		echo '<div id="charlimitinfo">You have 300 characters left.</div>';
		echo $this->Form->input('tags',array('type'=>'text','label'=>'Keywords','after'=>'<div class="extra">Separate each keyword with a comma e.g., modern, red, furniture.</div>'));
		echo $this->Form->input('attachment_id',array('type'=>'hidden'));
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$authUser['User']['id']));
		}
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