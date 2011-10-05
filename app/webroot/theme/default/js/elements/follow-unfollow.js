/**
* This method handles updating the follow and unfollow values in the view. 
*/
function updateFollowUnfollow(data){
	var data = data.data;
	hideLoader(data.item_id); //Hide that ajax loader
	//alert(data.following);
	console.log(data);
	if(data.following > 0){
		showUnfollow(data.item_id);
	}else{
		showFollow(data.item_id);
	}

	return 0;
}

/**
 * Shows the unfollow button for a certain item id
 * @param 
 * @return 
 * 
*/
function showUnfollow(id){
	$('#follow-'+id).hide();
	$('#unfollow-'+id).show();
}


/**
 * Shows the follow button for a certain item id
 * @param 
 * @return 
 * 
*/
function showFollow(id){
	$('#follow-'+id).show();
	$('#unfollow-'+id).hide();
}

/**
 * Show the ajax loader
 * @param int id The div id to target
 * @return 
 * 
*/
function showLoader(id){
	$('#ajax-status-'+id).show();
}

/**
 * Hide the ajax loader
 * @param int id The div id to target
 * @return 
 * 
*/
function hideLoader(id){
	$('#ajax-status-'+id).hide();
}

/**
 * Submits the like for the user
 * @param int model_id
 * @return 
 * 
*/
function submit_follow(model_id){
	$.ajax({
		beforeSend:function (XMLHttpRequest) {
			showLoader(model_id);
		}, 
		success:function (data, textStatus) {
			updateFollowUnfollow(data);
		}, 
		url:"\/ajax\/user_followings\/followUserID\/"+model_id
	});
	return false;
}

/**
 * Submits the dislike for the user
 * @param int model_id
 * @return 
 * 
*/
function submit_unfollow(model_id){
	$.ajax({
		beforeSend:function (XMLHttpRequest) {
			showLoader(model_id);
		}, 
		success:function (data, textStatus) {
			updateFollowUnfollow(data);
		}, 
		url:"\/ajax\/user_followings\/unfollowUserID\/"+model_id
	});
	return false;
}