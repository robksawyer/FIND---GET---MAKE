<?php

?>
<div id="flag-item-container">
	<div id="flashMessage" style="display:none;"></div>
	<div class="flags form">
		<?php echo $this->Form->create('Flag',array('action' => 'flag_item')); ?>
		<fieldset>
			<legend><?php __('I am flagging this because '); ?></legend>
			<?php
				if(!empty($model)){
					echo $this->Form->input("model",array('type'=>'hidden','value'=>$model));
					echo $this->Form->input("name",array('type'=>'hidden','value'=>Inflector::pluralize(strtolower($model))));
				}
				if(!empty($model_id)){
					echo $this->Form->input("model_id",array('type'=>'hidden','value'=>$model_id));
				}
				if(!empty($authUser)){
					echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
				}
				echo $this->Form->input('redirect',array('value'=>'/'.Inflector::pluralize(strtolower($model)).'/view/'.$model_id,'type'=>'hidden'));
				$options = array('duplicate'=>'Duplicate: This is a duplicate of an existing entry. I\'ll paste the other, more complete, version of this entry below.',
										'unrelated'=>'Unrelated: This isn\'t related to interior design at all.',
										'incorrect'=>'Incorrect: Parts of the data associated with this entry are incorrect. I\'ll tell you what information is wrong below.',
										'spam'=>'Spam: This is spam.',
										'other'=>'Other: Just read my description below, you\'ll see what I\'m talking about.'
										);
				echo $this->Form->input('reason', array('type'=>'radio','options'=>$options,'legend'=>''));
				//$current_url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
				//echo $this->Form->input('url',array('value'=>$current_url,'disabled'=>'disabled','label'=>'','style'=>'color:#999;'));
				echo $this->Form->input('description');
				echo '<div id="charlimitinfo">You have 300 characters left.</div>';
			?>
		</fieldset>
		<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>
<script type="text/javascript">
$(".chzn-select").chosen();

$('#FlagDescription').keyup(function(){
	limitChars('FlagDescription', 300, 'charlimitinfo');
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