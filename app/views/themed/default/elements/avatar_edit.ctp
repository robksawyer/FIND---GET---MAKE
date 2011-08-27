<style type="text/css">
#simplemodal-container{
	height: 325px;
}
</style>
<div class="avatar-container">
<?php
if(empty($avatar['Attachment']['path_small'])){
	if ($this->Cupcake->settings['enable_gravatar'] == 1) {
		 // Show the Gravatar as a backup
		if ($avatar = $this->Cupcake->gravatar($this->data['User']['email'])) {
			echo "<div class='avatar'>";
			echo $avatar."<br/>";
			echo $this->Html->link('Change your <span class="gravatar">Gravatar</span>','http://en.gravatar.com/',array('title'=>'Change your Gravatar','escape'=>false,'target'=>'_blank'));
			echo '<br/> or '.$this->Html->link('Upload an image','#',array('class'=>'upload-avatar'));
			echo "</div>";
		} else{
			echo "<div class='avatar'>";
			echo $this->Html->image('no_gravatar.jpg')."<br/>";
			echo $this->Html->link('Get a <span class="gravatar">Gravatar</span>','http://en.gravatar.com/',array('title'=>'Get a Gravatar','escape'=>false,'target'=>'_blank'));
			echo '<br/> or '.$this->Html->link('Upload an image','#',array('class'=>'upload-avatar'));
			echo "</div>";
		}
	} 
}else{
	//Show the local avatar
		echo "<div class='avatar'>";
		echo $this->Html->image($avatar['Attachment']['path_small'],array('alt'=>'Avatar image','height'=>'100'))."<br/>";
		echo $this->Html->link('Use your <span class="gravatar">Gravatar</span>',array('admin'=>true,'controller'=>'users','action'=>'use_gravatar',$avatar['Attachment']['id']),array('title'=>'Use your Gravatar','escape'=>false,'class'=>'use-gravatar'));
		echo '<br/> or '.$this->Html->link('Upload a new image','#',array('class'=>'upload-avatar'));
		echo "</div>";
}
?>
</div>
<!-- ADD AVATAR MODAL CONTENT -->
<div id="basic-modal-content">
	<div class="wrapper">
	<?php 
		echo $this->element('avatar_add',array('cache'=>false,
																				'model'=>'User',
																				'controller'=>'users',
																				'model_id'=>$authUser['User']['id']
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
<!-- END ADD AVATAR MODAL CONTENT -->
<script type="text/javascript">
	// Load dialog on click
	$('.upload-avatar').click(function (e) {
		e.preventDefault();
		//$(".chzn-select").trigger("liszt:updated");
		$('#basic-modal-content').modal({
			onShow:function(dialog){
				// Access elements inside the dialog
				// Useful for binding events, initializing other plugins, etc.
				//$(".chzn-select").chosen();
			}
		});
	});
</script>