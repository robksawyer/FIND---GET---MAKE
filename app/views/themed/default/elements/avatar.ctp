<style type="text/css">
	<?php 
	if(empty($height)){
		$height = 32;
	}
	?>
	.avatar {
		position: relative;
		margin-right: 3px;
		width: auto;
		vertical-align: baseline;
	}
	.avatar img{
		width: auto;
		height: <?php echo $height; ?>px;
		vertical-align: baseline;
		display: inline-block;
	}
</style>
<?php
	//If the avatar isn't passed along, try to get it.
	if(empty($avatar)) $avatar = $this->requestAction('/users/getAvatar/'.$user['User']['id']);
?>
<?php
if(empty($avatar['Attachment']['path_small'])){
	// Gravatar
	if ($this->Cupcake->settings['enable_gravatar'] == 1) {
		if ($avatar = $this->Cupcake->gravatar($user['User']['email'])) {
			echo "<div class='avatar'>";
			echo $this->Html->link($avatar,array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'profile',$user['User']['username']),array('title'=>$user['User']['username'],'escape'=>false));
			if(!empty($follow)){
				if($follow == true){
					echo $this->element('follow-unfollow',array('cache'=>false,'user_id'=>$user['User']['id']));
				}
			}
			echo "</div>";
		}else{
			echo "<div class='avatar'>";
			echo $this->Html->image('no_gravatar.jpg',array(
																		'url'=>array('admin'=>false,'plugin'=>'','controller'=>'users',
																							'action'=>'profile',$user['User']['username']
																							),
																		'title'=>$user['User']['username']
																	));
			if(!empty($follow)){
				if($follow == true){
					echo $this->element('follow-unfollow',array('cache'=>false,'user_id'=>$user['User']['id']));
				}
			} 
			echo "</div>";
		} 
	}
}else{
	//Show the local avatar
	echo "<div class='avatar'>";
	echo $this->Html->image($avatar['Attachment']['path_small'],array(
																							'alt'=>'Avatar image',
																							'url'=>array('admin'=>false,'plugin'=>'','controller'=>'users',
																												'action'=>'profile',$user['User']['username']
																												),
																							'title'=>$user['User']['username'],
																							'height'=>$height
																							));
	if(!empty($follow)){
		if($follow == true){
			echo $this->element('follow-unfollow',array('cache'=>false,'user_id'=>$user['User']['id']));
		}
	}
	echo "</div>";
}
?>