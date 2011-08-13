/**
* This method handles updating the like and dislike values in the view. 
*/
function updateLikeDislike(data){
	hideLoader(); //Hide that ajax loader
	//var data = jQuery.parseJSON(data);
	//alert(data.type);
	var data = data.data;
	//alert(data.likes);
	//alert(data.user_dislikes);
	console.log(data);
	if(data.user_likes > 0){
		$('.like').hide();
		$('.liked').show();
		$('.dislike').show();
		$('.disliked').hide();
	}else if(data.user_dislikes > 0){
		$('.like').show();
		$('.liked').hide();
		$('.dislike').hide();
		$('.disliked').show();
	}
	
	$('.vote-val-like').text(data.likes);
	$('.vote-val-dislike').text(data.dislikes);
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