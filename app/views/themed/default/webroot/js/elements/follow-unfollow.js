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