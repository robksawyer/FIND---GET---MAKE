<style type="text/css">
.links{
	float: right;
	padding: 0;
	margin: 0;
}

#simplemodal-container{
	height: 500px!important;
}

#basic-modal-content .submit{
	position: relative;
	left: 20px;
}
</style>
<?php
	echo $this->Html->css("popup/wide",'stylesheet',array('inline'=>false));
?>
<div class="top-actions">
	<?php if(!empty($authUser)): ?>
	<ul class="links">
		<!-- PRIVATE -->
		<?php if(!empty($item[$model]['private'])): ?>
		<li class="private" title="This <?php echo strtolower($model); ?> is private.">PRIVATE</li>
		<?php endif; ?>
		<!-- END PRIVATE -->
		<!-- RATING -->
		<?php if(!empty($rate) && Configure::read('FGM.allow_rating') == 1): ?>
		<li><?php echo $this->element('rating', array(
														'plugin' => 'rating',
														'model' => $model,
														'id' => $item[$model]['id'],
														'name' => strtolower($model)));
														?></li>
		<?php endif; ?>
		<!-- END RATING -->
		
		<!-- CANCEL -->
		<?php if(!empty($cancel)): ?>
		<li><?php echo $this->Html->link(__('CANCEL',true),$cancel,array('class'=>'cancel')); ?></li>
		<?php endif; ?>
		<!-- END CANCEL -->
		
		<!-- EDIT -->
		<?php 
		if(empty($removeEdit)):
			//Check the logged in user to make sure that the user who created the item matches before showing.
			if($authUser['User']['id'] == $item['User']['id'] || Configure::read('FGM.group_change') == 1):
				echo "<li>".$this->Html->image('icons/edit.gif', array(
																					'alt' => 'Edit',
																					'title' => 'Edit',
																					'url'=>array('action' => 'edit', $item[$model]['id'],'admin'=>false)
																					)
												)."</li>";
			else:
				//Check to see if the private field is set and then check to see if the item is private
				if(isset($item[$model]['private'])){
					if($item[$model]['private'] == 0){
						echo "<li>".$this->Html->image(
														'icons/edit.gif', array(
																							'alt' => 'Edit',
																							'title' => 'Edit',
																							'url'=>array('action' => 'edit', $item[$model]['id'],'admin'=>false)
																							)
														)."</li>";
					}
				}
			endif;
		endif; 
		?>
		<!-- END EDIT -->
		
		<!-- DELETE -->
		<?php 
		if(empty($removeDelete)): 
			//Check the logged in user to make sure that the user who created the item matches before showing.
			if($authUser['User']['id'] == $item['User']['id'] || Configure::read('FGM.group_delete') == 1):
					echo "<li>".$this->Html->link(
							$this->Html->image("icons/delete.gif", array(
																						"alt" => "Delete",
																						"title" => "Delete"
																						)),
							array('action' => 'delete','admin'=>false, $item[$model]['id']),
							array('escape'=>false),
							sprintf(__('Are you sure you want to delete %s?', true), $item[$model]['name'])
					)."</li>";
			else:
				//Check to see if the private field is set and then check to see if the item is private
				if(isset($item[$model]['private'])){
					if($item[$model]['private'] == 0){
						echo "<li>".$this->Html->link(
								$this->Html->image("icons/delete.gif", array(
																							"alt" => "Delete",
																							"title" => "Delete"
																							)),
								array('action' => 'delete','admin'=>false, $item[$model]['id']),
								array('escape'=>false),
								sprintf(__('Are you sure you want to delete %s?', true), $item[$model]['name'])
						)."</li>";
					}
				}
			endif;
		endif; 
		?>
		<!-- END DELETE -->
		
		<!-- FLAG ITEM -->
		<?php 
		if(empty($removeFlag)):
			if($authUser['User']['id'] != $item['User']['id'] || Configure::read('FGM.allow_flagging') == 1):
				if(empty($flagged)){
					echo $this->Html->link('Flag item','#',array(
																		'class'=>'flag-item',
																		'id'=>'flag-'.strtolower($model).'-'.$item[$model]['id'],
																		'title'=>'Flag the item'
																		));
					/*echo $this->Popup->link('Flag item', array(
														'class'=>'flag-item',
														'id'=>'flag-'.strtolower($model).'-'.$item[$model]['id'],
														'title'=>'Flag the item',
														'element'=>'flag-item'
														),
														array(
															'model'=>$model,
															'model_id'=>$item[$model]['id']
															)
														);*/
				}else{
					echo '<span class="flag-item" style="text-decoration: line-through;" title="You\'ve already flagged this item.">Flag item</span>';
				}
			endif;
		endif;
		?>
		<!-- END FLAG ITEM -->
	</ul>
	<?php endif; ?>
</div>
<div class="clear"></div>
<!-- FLAG ITEMS MODAL CONTENT -->
<div id="basic-modal-content">
	<div class="wrapper">
	<?php 
		$redirect = '/'.Inflector::pluralize(strtolower($model)).'/view/'.$item[$model]['id'];
		echo $this->element('flag-item',array('cache'=>false,
															'redirect'=>$redirect,
															'model'=>$model,
															'model_id'=>$item[$model]['id']
															)
														);
		
	?>
	</div>
</div>
<!-- preload the images -->
<div style='display:none'>
	<?php 
		echo $this->Html->image('/img/modal/x.png',array('alt'=>'Close')); 
		echo $this->Html->image('/img/modal/x_on.png',array('alt'=>'Close')); 
	?>
</div>
<!-- END FLAG ITEMS MODAL CONTENT -->
<script type="text/javascript">
	// Load dialog on click
	$('.flag-item').click(function (e) {
		e.preventDefault();
		//$(".chzn-select").trigger("liszt:updated");
		$('#basic-modal-content').modal({
			onShow:function(dialog){
				// Access elements inside the dialog
				// Useful for binding events, initializing other plugins, etc.
				$(".chzn-select").chosen();
			}
		});
	});
</script>