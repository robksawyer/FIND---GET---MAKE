<style type="text/css">
.attachment-remove{
	position: relative;
	width: 10px;
	height: 10px;
	clear: none;
	padding: 0;
	margin: 0;
	z-index: 3;
}
</style>
<div class="related">
	<!--<h3><?php //__('Related Attachments');?></h3>-->
	<?php 
		if (!empty($item['Attachment'])):
	?>
	<div id="attachments" <?php if(count($item['Attachment']) < 2 && !empty($removeFirst)) echo "style='display:none;'"; ?>>
		<ul class="wrapper">
		<?php
			$i = 0;
			$counter = 0;
			//$sorted_attachments = Set::sort($item['Attachment'],'{n}.id','asc'); 
			foreach ($item['Attachment'] as $attachment):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				
				if(empty($removeFirst) || $counter > 0):
				
			?>
			
				<li><?php 
					if(empty($disableDeleting) && !empty($authUser)){
						echo $this->Html->image('/img/icons/delete.gif',array('alt'=>'Delete',
																							'url'=>array(
																								'controller'=>$controller,
																								'action'=>'removeAttachment',$item[$model]['id'],$attachment['id']
																								),
																							'title'=>'Remove this attachment from the '.strtolower($model).'.',
																							'class'=>'attachment-remove'
																							));
						echo "<br/>";
					}
					if(empty($client)){
						echo $this->Html->image($attachment['path_med'],array(
																								'alt'=>$attachment['name'],
																								'title'=>$attachment['title'],
																								'url' => array(
																										'controller' => 'attachments', 
																										'action' => 'view', $attachment['id']
																										),
																								'class'=>'attachment'
																										));
					}else{
						//Check for keycode
						if(empty($attachment['keycode'])){
							//Generate a keycode
							echo $this->Html->image($attachment['path_med'],array(
																									'alt'=>$attachment['name'],
																									'title'=>$attachment['title'],
																									'url' => array(
																											'controller' => 'attachments', 
																											'action' => 'generateKeycode', $attachment['id']
																											),
																									'class'=>'attachment'
																											));
						}else{
							echo $this->Html->image($attachment['path_med'],array(
																									'alt'=>$attachment['name'],
																									'title'=>$attachment['title'],
																									'url' => array(
																											'controller' => 'attachments', 
																											'action' => 'key', $attachment['keycode']
																											),
																									'class'=>'attachment'
																											));
						}
					}
				?></li>
		<?php 
				endif;
			$counter++;
			endforeach; 
		?>
		</ul>
	</div>
<?php endif; ?>
<?php if(!empty($authUser) && empty($disableAdding)): ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Add Attachment', true), array('controller' => $controller, 'action' => 'add_attachment', $item[$model]['id'],$model));?> </li>
			<!--<li><?php //echo $this->Html->link(__('Add Attachment', true), 'javascript:return false;',array('class'=>'basic-modal-button'));?> </li>-->
		</ul>
	</div>
	
	<!-- ADD ATTACHMENTS MODAL -->
	<div id="basic-modal-content">
		<div class="<?php echo $controller; ?> form">
		<?php 
			/*if(!empty($model) && !empty($item) && !empty($controller)){
				echo $this->Form->create('Attachment',array('type'=>'file','action'=>'add/model:'.$model.'/id:'.$item[$model]['id']));
				$back_path = "/$controller/view/".$item[$model]['id'];
			}else{
				echo $this->Form->create('Attachment',array('type' => 'file'));
			}*/
		?>
			<fieldset>
				<legend><?php __('Add Attachment'); ?></legend>
			<?php
				/*if(!empty($authUser)){
					echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
				}
				echo $this->Form->input('redirect',array('value'=>"$back_path",'type'=>'hidden'));
				
				if(!empty($model) && !empty($item)){
					echo $this->element('add_attachment',array('cache'=>false));
					echo $this->Form->input("$model.0",array('type'=>'hidden','value'=>$item[$model]['id']));
				}else{
					echo "WARNING: There isn't a file name associated with this file.";
					echo $this->element('add_attachment',array('cache'=>false));
				}*/
			?>
			</fieldset>
		<?php //echo $this->Form->end(__('Submit', true)); ?>
		</div>
	</div>
	<!-- preload the images -->
	<div style='display:none'>
		<?php 
			echo $this->Html->image('/img/modal/x.png',array('alt'=>'Close')); 
			echo $this->Html->image('/img/modal/x_on.png',array('alt'=>'Close')); 
		?>
	</div>
	<!-- END ADD ATTACHMENTS MODAL -->
<?php endif; ?>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("img.attachment-remove").hide();
	
	$("#attachments ul li").hover(function(){
		$(this).find("img.attachment-remove").show();
	},function(){
		$(this).find("img.attachment-remove").hide();
	});
	
	// Load dialog on click
	$('.basic-modal-button').click(function (e) {
		$('#basic-modal-content').modal({
			onShow:function(dialog){
				// Access elements inside the dialog
				// Useful for binding events, initializing other plugins, etc.
			}
		});
	});
});

</script>
