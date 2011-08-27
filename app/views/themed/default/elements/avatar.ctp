<style type="text/css">

</style>
<?php
	//If the avatar isn't passed along, try to get it.
	if(empty($avatar)) $avatar = $this->requestAction('/users/getAvatar/'.$user['User']['id']);
?>
<?php
if(empty($avatar['Attachment']['path_small'])){
	if ($this->Cupcake->settings['enable_gravatar'] == 1) {
		 // Show the Gravatar as a backup
		if ($avatar = $this->Cupcake->gravatar($user['User']['email'])) {
			echo "<div class='avatar'>";
			echo $avatar."<br/>";
			echo "</div>";
		} else{
			echo "<div class='avatar'>";
			echo $this->Html->image('no_gravatar.jpg')."<br/>";
			echo "</div>";
		}
	} 
}else{
	//Show the local avatar
		echo "<div class='avatar'>";
		echo $this->Html->image($avatar['Attachment']['path_small'],array('alt'=>'Avatar image','height'=>'100'))."<br/>";
		echo "</div>";
}
?>