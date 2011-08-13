<?php
	/**
	 * set-ownership 
	 * @author Rob Sawyer
	 * @param $model The name of the Model (in lowercase form) that is using this element e.g, bike,part.
	 * @param $user_id The current logged in user's id
	 * @param $model_id The id of the item that ownership is being looked up on
	 * @return 
	 * 
	*/
	
	$testing = false;
	$ownership_type = $this->requestAction('/ownerships/getType/'.$user_id.'/'.$model.'/'.$model_id);
	echo $this->Html->css('elements/ownerships');
?>
<div class="ownership-form" id="ownership-form">
	<?php
		switch($ownership_type){
			case 'have_it':
				$ownership_button_name = "+ you have it";
				break;
			case 'want_it':
				$ownership_button_name = "+ you want it";
				break;
			case 'had_it':
				$ownership_button_name = "+ you had it";
				break;
			
			default:
				$ownership_button_name = "+ add to list";
				break;
		}
		
		$ownership_button_val = $ownership_type;
		
	?>
	<div class="ownership-button<?php if($ownership_button_name != "+ add to list") echo '-selected'; ?>">
	<a href="#" class="ownership-form-button" id="ownership-form-button" onclick="return false;"><?php echo $ownership_button_name; ?></a>
	</div>
	<div class="clear"></div>
	<div class="messagepop pop" style="display:none">
		<p class="close"><?php echo $this->Html->link('close','javascript:void(0)',array('onclick'=>'return false;', 'title'=>'close')); ?></p> 
		<fieldset class="form-type">
			<legend>Add this to your:</legend>
			<br/>
			<?php 
			if(!empty($testing)){
				$form_options = array(
											'type' => 'post',
											'id'=>'OwnershipSetOwnershipForm',
											'url' => '/admin/ownerships/set_ownership/'.$model.'/'.$model_id
										);
			}else{
				$form_options = array(
											'type' => 'post',
											'id'=>'OwnershipSetOwnershipForm',
											'default' => false
										);
			}
			echo $this->Form->create('Ownership', $form_options);
				$options=array(
					'have_it'=>'Have list',
					'want_it'=>'Want list'
					//'had_it'=>'Had list'
					);
				$attributes=array('legend'=>false,'value'=>$ownership_button_val);
				echo $this->Form->radio('Ownership.ownership',$options,$attributes);
				//echo $this-Form->input('user_id', array('type' => 'hidden', 'value'=>$user['User']['id']));
				echo $this->Form->input('model_id', array('type' => 'hidden', 'value'=>$model_id));
				echo $this->Form->input('model', array('type' => 'hidden', 'value'=>$model));
			?>
			<div class="ownership-submit">
			<?php 
				if(empty($testing)){
					echo $this->Form->submit('Submit',array('onClick'=>"doSubmit('".$model."',".$model_id.");"));
				}else{
					echo $this->Form->end('Submit');
				}
				echo $this->Js->writeBuffer(array('inline' => 'true')); //I'm not sure why this is added here.
			?>
			</div>
		</fieldset>
		<fieldset class="return-type" style="display:none"></fieldset>
		<div class="clear"></div>
	</div>
</div>
<div class="debug-data"></div>
<div class="clear"></div>
<?php echo $this->Html->script('elements/ownership',array('inline'=>false)); ?>