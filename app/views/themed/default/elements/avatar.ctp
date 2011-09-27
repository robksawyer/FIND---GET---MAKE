<style type="text/css">
	<?php 
		if(empty($height)){ $height = 32; $width = height; } else { $width = $height; }
		$unique_id = uniqid('avatar-'.$height.'-');
	?>
	#<?php echo $unique_id;?> img{ width: <?php echo $height; ?>px; height: <?php echo $height; ?>px; }
</style>
<?php
	//If the avatar isn't passed along, try to get it.
	if(empty($avatar)) $avatar = $this->requestAction('/users/getAvatar/'.$user['User']['id']);
?>
<div id='<?php echo $unique_id; ?>' class="avatar">
<?php
if(empty($avatar['Attachment']['path_small'])){
	// Gravatar
	if ($this->Cupcake->settings['enable_gravatar'] == 1) {
		if ($avatar = $this->Cupcake->gravatar($user['User']['email'])) {
			echo $this->Html->link($avatar,
				array('admin'=>false,
						'plugin'=>'',
						'controller'=>'users',
						'action'=>'profile',$user['User']['username']),
				array(
					'title'=>$user['User']['username'],
					'height'=>$height,
					'width'=>$width,
					'escape'=>false
				));
			if(!empty($follow)){
				if($follow == true){
					echo $this->element('follow-unfollow',array('cache'=>false,'user_id'=>$user['User']['id']));
				}
			}
		}else{
			echo $this->Html->image('no_gravatar.jpg',array(
																		'url'=>array('admin'=>false,'plugin'=>'','controller'=>'users',
																							'action'=>'profile',$user['User']['username']
																							),
																		'title'=>$user['User']['username'],
																		'alt'=>'',
																		'height'=>$height,
																		'width'=>$width
																	));
			if(!empty($follow)){
				if($follow == true){
					echo $this->element('follow-unfollow',array('cache'=>false,'user_id'=>$user['User']['id']));
				}
			}
		} 
	}
}else{
	//Show the local avatar
	echo $this->Html->image($avatar['Attachment']['path_small'],array(
																							'alt'=>'',
																							'url'=>array('admin'=>false,'plugin'=>'','controller'=>'users',
																												'action'=>'profile',$user['User']['username']
																												),
																							'title'=>$user['User']['username'],
																							'height'=>$height,
																							'width'=>$width
																							));
	if(!empty($follow)){
		if($follow == true){
			echo $this->element('follow-unfollow',array('cache'=>false,'user_id'=>$user['User']['id']));
		}
	}
}
?>
</div>