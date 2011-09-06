<?php
	$favorites = $this->requestAction('/staff_favorites/getTenUsers');
	$user_ids = array();
	foreach($favorites as $favorite_user){
		$user_ids[] = $favorite_user['User']['id']; 
	}
	//Check to see if the user is already following all of the listed users
	//$isFollowingAll = $this->requestAction('/user_following/isFollowingAll/ids:'.$user_ids);
	//debug($user_ids);
	$user_ids_string = implode(',',$user_ids);
?>
<h3>Staff Favorites</h3>
<div id="follow-all-btn">
<?php 
	//Check to see if the user is following all of the users
	$isFollowingAll = false;
	if($isFollowingAll){
		echo $this->Js->link('Unfollow all',array('controller'=>'user_followings',
																'action'=>'follow_all','ids'=>json_encode($user_ids)
														),
														array(
																'title'=>'Unfollow all',
																'id'=>'unfollow-all',
																'beforeSend'=>'showFollowAllLoader();',
																'success'=>'updateFollowLinks(data);'
																));
	}else{
		echo $this->Js->link('Follow all',array('controller'=>'user_followings',
																'action'=>'follow_all','ids'=>json_encode($user_ids)
														),
														array(
																'title'=>'Follow all',
																'id'=>'follow-all',
																'beforeSend'=>'showFollowAllLoader();',
																'success'=>'updateFollowLinks(data);'
																));
	}
	
?>
</div>
<div class="clear"></div>
<?php
	foreach($favorites as $favorite_user){
		echo $this->element('user-block-with-products',array('cache'=>false,'user'=>$favorite_user));
	}
	//debug($favorites);
?>