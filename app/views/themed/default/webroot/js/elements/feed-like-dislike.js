/**
* This method handles updating the like and dislike values in the view. 
*/
function updateLikeDislike(data){
	console.log(data);
	var data = data.data;
	hideLoader(data.id); //Hide that ajax loader
	if(data.user_likes > 0){
		$('.like.vote-'+data.id).hide();
		$('.dislike.vote-'+data.id).show();
	}else if(data.user_dislikes > 0){
		$('.like.vote-'+data.id).show();
		$('.dislike.vote-'+data.id).hide();
	}
	
	$('.vote-val-like-'+data.id).text(data.likes);
	return 0;
}

/**
 * Show the ajax loader
 * @param 
 * @return 
 * 
*/
function showLoader(id){
	$('#ajax-status-'+id).show();
}

/**
 * Hide the ajax loader
 * @param 
 * @return 
 * 
*/
function hideLoader(id){
	$('#ajax-status-'+id).hide();
}

/**
 * Submits the like for the user
 * @param string model
 * @param int model_id
 * @return 
 * 
*/
function submit_like(model, model_id){
	$.ajax({
		beforeSend:function (XMLHttpRequest) {
			showLoader(model_id);
		}, 
		success:function (data, textStatus) {
			updateLikeDislike(data);
		}, 
		url:"\/votes\/vote_up\/"+model+"\/"+model_id
	});
	return false;
}

/**
 * Submits the dislike for the user
 * @param string model
 * @param int model_id
 * @return 
 * 
*/
function submit_dislike(model, model_id){
	$.ajax({
		beforeSend:function (XMLHttpRequest) {
			showLoader(model_id);
		}, 
		success:function (data, textStatus) {
			updateLikeDislike(data);
		}, 
		url:"\/votes\/vote_down\/"+model+"\/"+model_id
	});
	return false;
}