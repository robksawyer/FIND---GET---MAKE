<div id="follow-all-btn">
<?php 
	if(empty($user_ids)) $user_ids = null;
	
	//Check to see if the user is following all of the users
	$isFollowingAll = false;
	if(!empty($authUser)){
		//Only show if the user is logged in.
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
	}
	
?>
</div>
<div class="clear"></div>