/**
* This method handles updating the dot link in the view
*/
function updateDotLink(data){
	var data;
	console.log(data);
	if(data.success == true){
		data = data.data;
		if(data.Storage.deleted == true){
			hideDotLoader(data.Storage.model.toLowerCase()+"-"+data.Storage.model_id,'-black');
			deactivateDot(data.Storage.model.toLowerCase()+"-"+data.Storage.model_id);
		}else{
			hideDotLoader(data.Storage.model.toLowerCase()+"-"+data.Storage.model_id,'-green');
			activateDot(data.Storage.model.toLowerCase()+"-"+data.Storage.model_id);
		}
	}else{
		//activateStaffFavorite(data.item_id);
		//hideStaffFavoriteLoader(data.data.item_id); //Hide that ajax loader
		alert("There was an error. Reload the page and try again.");
	}
	return 0;
}

/**
 * Shows the dot button that symbolizes that the user has added the item in their storage
 * @param int id
 * @return 
 * 
*/
function deactivateDot(id){
	if($('#storage-dot-'+id).hasClass("storage-dot-remove")) {
		$('#storage-dot-'+id).removeClass('storage-dot-remove');
	}
	$('#storage-dot-'+id).addClass('storage-dot-add'); //Show the add button
}

/**
 * Shows the dot button that symbolizes that the user has not added the item in their storage
 * @param int id
 * @return 
 * 
*/
function activateDot(id){
	if($('#storage-dot-'+id).hasClass("storage-dot-add")) {
		$('#storage-dot-'+id).removeClass('storage-dot-add');
	}
	$('#storage-dot-'+id).addClass('storage-dot-remove'); //Show the remove button
}

/**
 * Show the ajax loader
 * @param int id The div id to target
 * @param string version What version to show (green or black)
 * @return 
 * 
*/
function showDotLoader(id,version){
	//$('#storage-dot-'+id).fadeOut();
	$('#ajax-dot-status-'+id).show();
}

/**
 * Hide the ajax loader
 * @param int id The div id to target
 * @param string version What version to hide (green or black)
 * @return 
 * 
*/
function hideDotLoader(id,version){
	//$('#storage-dot-'+id).fadeIn();
	if(version == '-green'){
		var newSrc = $('#loader-'+id).attr('src').replace('-green','-black');
	}else{
		var newSrc = $('#loader-'+id).attr('src').replace('-black','-green');
	}
	$('#loader-'+id).attr('src',newSrc);
	$('#ajax-dot-status-'+id).hide();
}