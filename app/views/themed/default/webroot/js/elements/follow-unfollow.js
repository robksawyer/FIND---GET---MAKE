/**
* This method handles updating the follow and unfollow values in the view. 
*/
function updateFollowUnfollow(data){
	hideLoader(); //Hide that ajax loader
	var data = data.data;
	//alert(data.following);
	console.log(data);
	if(data.following > 0){
		$('.follow').hide();
		$('.unfollow').show();
	}else{
		$('.unfollow').hide();
		$('.follow').show();
	}

	return 0;
}

/**
 * Show the ajax loader
 * @param 
 * @return 
 * 
*/
function showLoader(){
	$('#ajax-status').show();
}

/**
 * Hide the ajax loader
 * @param 
 * @return 
 * 
*/
function hideLoader(){
	$('#ajax-status').hide();
}