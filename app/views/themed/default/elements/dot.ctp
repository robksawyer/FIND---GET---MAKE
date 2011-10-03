<?php 
if(Configure::read('FGM.allow_storage_adding') == 1): 
	if(!empty($authUser)):
		//Check to see if the item is in the user's storage already
		$isUserStoring = $this->requestAction("/storages/isStoring/$model/$model_id");
		if(!$isUserStoring){
			$dot_class = 'storage-dot-add';
			$dot_title = 'Add this item to your storage.';
			$loader = '-green';
		}else{
			$dot_class = 'storage-dot-remove';
			$dot_title = 'Remove this item from your storage.';
			$loader = '-black';
		}
?>
	<div id="storage-dot-<?php echo strtolower($model).'-'.$model_id; ?>" class="storage-dot <?php echo $dot_class; ?>">
		<?php 
			//echo $this->Html->link('Add', '/ajax/toggle/'.$model.'/'.$item[$model]['id'],array('title'=>'Add this '.strtolower($model).' to your storage.')); 
			echo $this->Js->link('Add',array(
														'plugin'=>'',
														'admin'=>false,
														'ajax'=>true,
														'controller'=>'storages',
														'action'=>'toggle',$model,$model_id
													),
													array(
														'id'=>'storage-'.strtolower($model).'-'.$model_id,
														'title'=>$dot_title,
														'beforeSend'=>'fgm_api.showDotLoader("'.strtolower($model).'-'.$model_id.'","'.$loader.'");',
														'success'=>'fgm_api.updateDotLink(data);'
													));
		?>
		<span></span>
		<div id="ajax-dot-status-<?php echo strtolower($model).'-'.$model_id; ?>" style="display:none" class="ajax-dot-status">
			<?php echo $this->Html->image('ajax-dot-loader'.$loader.'.gif',array('style'=>'width:36px;height:36px;',
																										'id'=>'loader-'.strtolower($model).'-'.$model_id
																										)
																									); ?>
		</div>
	</div>
<?php
	else:
		//The user isn't logged in
		/*
			TODO Show the deactivated dot
		*/
	endif;
endif;
?>