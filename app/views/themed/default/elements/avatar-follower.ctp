<style type="text/css">

</style>
<?php
	//If the avatar isn't passed along, try to get it.
	if(empty($avatar)) $avatar = $this->requestAction('/users/getAvatar/'.$follower['User']['id']);
?>
<?php
if(empty($avatar['Attachment']['path_small'])){
	// Gravatar
	if ($this->Cupcake->settings['enable_gravatar'] == 1) {
		if ($avatar = $this->Cupcake->gravatar($follower['User']['email'])) {
			echo "<div class='avatar'>";
			echo $this->Html->link($avatar,array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'profile',$follower['User']['username']),array('title'=>$follower['User']['username'],'escape'=>false));
			echo "</div>";
		}else{
			echo "<div class='avatar'>";
			echo $this->Html->image('no_gravatar.jpg',array(
																		'url'=>array('admin'=>false,'plugin'=>'','controller'=>'users',
																							'action'=>'profile',$follower['User']['username']
																							),
																		'title'=>$follower['User']['username']
																	));
			echo "</div>";
		} 
	}
}else{
	//Show the local avatar
	echo "<div class='avatar'>";
	echo $this->Html->image($avatar['Attachment']['path_small'],array(
																							'alt'=>'Avatar image',
																							'url'=>array('admin'=>false,'plugin'=>'','controller'=>'users',
																												'action'=>'profile',$follower['User']['username']
																												),
																							'title'=>$follower['User']['username']
																							));
	echo "</div>";
}
$avatar = null; //Clear the avatar variable
?>