<?php 
	if(!empty($user['User']['fullname'])){
		$user_name = $user['User']['fullname'];
	}else{
		$user_name = $user['User']['username'];
	}
?>
<?php echo $this->Html->link($user_name,array('controller'=>'users','action'=>'profile',$user['User']['username'])); ?> followed you
<?php
	//echo $this->element('user-block',array('cache'=>false,'user'=>$user));
?>
<?php echo $user_name; ?> is followed by <?php $followers_known['count']; ?> you know.
<?php
	/*
		TODO Loop through $followers_known and spit out their avatar images.
	*/
?>
<?php 
/*
	TODO Pull the recent items from the feed.
*/
?>
<?php echo $user_name."'s"; ?> recently added the following products <?php $recent_products; ?>:
<?php
	/*
		TODO Loop through $recent_products (max 3) and spit out their images and links.
	*/
?>
Sent from FIND | GET | MAKE (http://www.find-get-make.com) | Edit Email Notifications (http://www.find-get-make.com/settings/notifications)