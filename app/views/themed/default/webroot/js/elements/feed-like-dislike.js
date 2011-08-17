/**
* This method handles updating the like and dislike values in the view. 
*/
function updateLikeDislike(data){
	//var data = jQuery.parseJSON(data);
	//alert(data.type);
	var data = data.data;
	//alert(data.likes);
	//alert(data.user_dislikes);
	hideLoader(data.id); //Hide that ajax loader
	console.log(data);
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