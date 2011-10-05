/**
* This method handles updating the staff favorite link in the view
*/
function updateStaffFavoriteLink(data){
	var data;
	console.log(data);
	if(data.success == true){
		data = data.data;
		hideStaffFavoriteLoader(data.model+"-"+data.model_id);
		deactivateStaffFavorite(data.model+"-"+data.model_id);
	}else{
		//activateStaffFavorite(data.item_id);
		//hideStaffFavoriteLoader(data.data.item_id); //Hide that ajax loader
		alert("There was an error. Reload the page and try again.");
	}
	return 0;
}

/**
 * Shows the unfollow button for a certain item id
 * @param 
 * @return 
 * 
*/
function deactivateStaffFavorite(id){
	$('#staff-fav-'+id).unbind('click');
	$('#staff-fav-'+id).removeAttr('href').css('text-decoration','line-through');
}

/**
 * Shows the follow button for a certain item id
 * @param 
 * @return 
 * 
*/
function activateStaffFavorite(id){
	//$('#staff-fav-'+id).removeAttr('href').css('text-decoration','line-through');
}

/**
 * Show the ajax loader
 * @param int id The div id to target
 * @return 
 * 
*/
function showStaffFavoriteLoader(id){
	$('#ajax-status-'+id).show();
}

/**
 * Hide the ajax loader
 * @param int id The div id to target
 * @return 
 * 
*/
function hideStaffFavoriteLoader(id){
	$('#ajax-status-'+id).hide();
}