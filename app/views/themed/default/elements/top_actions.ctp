<style type="text/css">
.links{
	float: right;
	padding: 0;
	margin: 0;
}
</style>
<div class="top-actions">
	<?php if(!empty($authUser)): ?>
	<ul class="links">
		<!-- PRIVATE -->
		<?php if(!empty($item[$model]['private'])): ?>
		<li class="private" title="This <?php echo strtolower($model); ?> is private.">PRIVATE</li>
		<?php endif; ?>
		<!-- END PRIVATE -->
		<!-- RATING -->
		<?php if(!empty($rate)): ?>
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
																					'url'=>array('action' => 'edit', $item[$model]['id'],'admin'=>true)
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
																							'url'=>array('action' => 'edit', $item[$model]['id'],'admin'=>true)
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
			if($authUser['User']['id'] == $item['User']['id'] || Configure::read('FGM.group_change') == 1):
					echo "<li>".$this->Html->link(
							$this->Html->image("icons/delete.gif", array(
																						"alt" => "Delete",
																						"title" => "Delete"
																						)),
							array('action' => 'delete','admin'=>true, $item[$model]['id']),
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
								array('action' => 'delete','admin'=>true, $item[$model]['id']),
								array('escape'=>false),
								sprintf(__('Are you sure you want to delete %s?', true), $item[$model]['name'])
						)."</li>";
					}
				}
			endif;
		endif; 
		?>
		<!-- END DELETE -->
	</ul>
	<?php endif; ?>
</div>
<div class="clear"></div>