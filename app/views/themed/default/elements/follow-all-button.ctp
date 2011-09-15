<div id="follow-all-btn">
<?php 
	if(empty($user_ids)) $user_ids = null;
	
	//Check to see if the user is following all of the users
	if(!empty($authUser)){
		//Only show if the user is logged in.
		if(empty($user_ids)){
			echo $this->Html->link('Unfollow all','#',
															array(
																	'title'=>'Unfollow all',
																	'id'=>'unfollow-all',
																	'onclick'=>'submit_unfollow_all(); return false;'
																	));
			echo $this->Html->link('Follow all','#',
															array(
																	'title'=>'Follow all',
																	'id'=>'follow-all',
																	'onclick'=>'submit_follow_all(); return false;',
																	'style'=>'display:none'
																	));
		}else{
			echo $this->Html->link('Follow all','#',
															array(
																	'title'=>'Follow all',
																	'id'=>'follow-all',
																	'onclick'=>'submit_follow_all(); return false;'
																	));
			echo $this->Html->link('Unfollow all','#',
															array(
																	'title'=>'Unfollow all',
																	'id'=>'unfollow-all',
																	'onclick'=>'submit_unfollow_all(); return false;',
																	'style'=>'display:none'
																	));
		}
	}
	
?>
</div>
<div id="follow-all-ajax-status" style="display:none" class="ajax-status-small"><?php echo $this->Html->image('ajax-loader.gif',array('Loading...')); ?></div>
<div class="clear"></div>
<script type="text/javascript">
/**
 * Show the ajax loader
 * @param int id The div id to target
 * @return 
 * 
*/
function showFollowAllLoader(){
	$('#follow-all-ajax-status').show();
}

/**
 * Hide the ajax loader
 * @param int id The div id to target
 * @return 
 * 
*/
function hideFollowAllLoader(){
	$('#follow-all-ajax-status').hide();
}

/**
 * Shows the unfollow button for a certain item id
 * @param 
 * @return 
 * 
*/
function showUnfollowAll(){
	$('#follow-all').hide();
	$('#unfollow-all').show();
}


/**
 * Shows the follow button for a certain item id
 * @param 
 * @return 
 * 
*/
function showFollowAll(){
	$('#follow-all').show();
	$('#unfollow-all').hide();
}

/**
* This method handles updating the follow and unfollow values in the view. 
*/
function updateFollowUnfollowAll(data){
	//var data = data.data;
	hideFollowAllLoader(); //Hide that ajax loader
	//alert(data.following);
	console.log(data);
	/*if(data.following > 0){
		showUnfollowAll();
	}else{
		showFollowAll();
	}*/

	return 0;
}

/**
 * Submits follow all request 
 * @param Object user_ids
 * @return 
 * 
*/
function submit_follow_all(){
	var user_ids = new Array(<?php echo implode(',',$user_ids['unfollowed_user_ids']); ?>);
	
	$.ajax({
		traditional: true,
		url:"\/ajax\/user_followings\/follow_all",
		type:'post',
		beforeSend:function (XMLHttpRequest) {
			showFollowAllLoader();
		}, 
		success:function (data, textStatus) {
			updateFollowUnfollowAll(data);
		}, 
		data: user_ids
	});
	return false;
}

/**
 * Submits unfollow all request 
 * @param Object user_ids
 * @return 
 * 
*/
function submit_unfollow_all(){
	var user_ids = new Array(<?php echo implode(',',$user_ids['followed_user_ids']); ?>);
	
	$.ajax({
		traditional: true,
		url:"\/ajax\/user_followings\/unfollow_all",
		type:'post',
		beforeSend:function (XMLHttpRequest) {
			showFollowAllLoader();
		}, 
		success:function (data, textStatus) {
			updateFollowUnfollowAll(data);
		}, 
		data: user_ids
	});
	return false;
}
</script>
<?php 
	echo $this->Js->writeBuffer(array('inline'=>true));
?>