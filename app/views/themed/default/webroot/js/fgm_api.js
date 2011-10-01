
$(document).ready(function(){
	// fade out good flash messages after 3 seconds  
	$('.flash_good').animate({opacity: 1.0}, 3000).hide("slow");
	//var t=setTimeout("javascript statement",milliseconds);
		
	$(".debuggg").click(function () {
			      $(".debuggg-inner").slideToggle("slow");
			    });
			
	
	// fade out flash 'success' messages
	$('#flashMessage').delay(3000).hide('slow');
	
	$("#slidingDiv").hide();
	$(".show_hide").show();
	
	$('.show_hide').click(function(){
		$(this).next('#slidingDiv').slideToggle();
		if($(this).html() == "<h3>Hide Details</h3>"){
			$(this).html('<h3>Show Details</h3>');
		}else{
			$(this).html('<h3>Hide Details</h3>');
		}
	});
	
	//Add external links icon
	/*$('a[target="_blank"]').filter(function() {
		return this.hostname && this.hostname !== location.hostname;
	}).after(' <img src="/img/icons/external.png" alt="" class="external"/>');*/
	
	$("img").hover(
		function(){
			this.src = this.src.replace("_off", "_on");
		},
		function(){
			this.src = this.src.replace("_on", "_off");
		}
	);
	
	//Get our elements for faster access and set overlay width
	 /*var div = $('div#attachments'),
			 		ul = $('ul.wrapper'),
					// unordered list's left margin
					ulPadding = 15;

	//Remove scrollbars
	div.css({overflow: 'hidden'});
					
	//Get menu width
	var divWidth = div.width();

	//Find last image container
	var lastLi = ul.find('li:last-child');

	//When user move mouse over menu
	div.mousemove(function(e){
		//As images are loaded ul width increases,
		//so we recalculate it each time
		var ulWidth = lastLi[0].offsetLeft + lastLi.outerWidth() + ulPadding;

		var left = (e.pageX - div.offset().left) * (ulWidth-divWidth) / divWidth;
		div.scrollLeft(left);
	});*/
	
});

/**
 * THE API
 * @param 
 * @return 
 * 
*/
function fgm_api(){
	
	var follow_all_user_id_data;
	
	this.init = function() {
		try {
			
		} catch(e) {
			
		}
	};
	
	//THE DOT
	/**
	* This method handles updating the dot link in the view
	*/
	this.updateDotLink = function(data){
		var data;
		console.log(data);
		if(data.success == true){
			data = data.data;
			if(data.Storage.deleted == true){
				fgm_api.hideDotLoader(data.Storage.model.toLowerCase()+"-"+data.Storage.model_id,'-black');
				fgm_api.deactivateDot(data.Storage.model.toLowerCase()+"-"+data.Storage.model_id);
			}else{
				fgm_api.hideDotLoader(data.Storage.model.toLowerCase()+"-"+data.Storage.model_id,'-green');
				fgm_api.activateDot(data.Storage.model.toLowerCase()+"-"+data.Storage.model_id);
			}
		}else{
			//activateStaffFavorite(data.item_id);
			//hideStaffFavoriteLoader(data.data.item_id); //Hide that ajax loader
			alert("There was an error. Reload the page and try again.");
		}
		return 0;
	};

	/**
	 * Shows the dot button that symbolizes that the user has added the item in their storage
	 * @param int id
	 * @return 
	 * 
	*/
	this.deactivateDot = function(id){
		if($('#storage-dot-'+id).hasClass("storage-dot-remove")) {
			$('#storage-dot-'+id).removeClass('storage-dot-remove');
		}
		$('#storage-dot-'+id).addClass('storage-dot-add'); //Show the add button
	};

	/**
	 * Shows the dot button that symbolizes that the user has not added the item in their storage
	 * @param int id
	 * @return 
	 * 
	*/
	this.activateDot = function(id){
		if($('#storage-dot-'+id).hasClass("storage-dot-add")) {
			$('#storage-dot-'+id).removeClass('storage-dot-add');
		}
		$('#storage-dot-'+id).addClass('storage-dot-remove'); //Show the remove button
	};

	/**
	 * Show the ajax loader
	 * @param int id The div id to target
	 * @param string version What version to show (green or black)
	 * @return 
	 * 
	*/
	this.showDotLoader = function(id,version){
		//$('#storage-dot-'+id).fadeOut();
		$('#ajax-dot-status-'+id).show();
	};

	/**
	 * Hide the ajax loader
	 * @param int id The div id to target
	 * @param string version What version to hide (green or black)
	 * @return 
	 * 
	*/
	this.hideDotLoader = function(id,version){
		//$('#storage-dot-'+id).fadeIn();
		if(version == '-green'){
			var newSrc = $('#loader-'+id).attr('src').replace('-green','-black');
		}else{
			var newSrc = $('#loader-'+id).attr('src').replace('-black','-green');
		}
		$('#loader-'+id).attr('src',newSrc);
		$('#ajax-dot-status-'+id).hide();
	};
	
	/**
	* This method handles updating the follow and unfollow values in the view. 
	*/
	this.updateFollowUnfollow = function(data){
		var data = data.data;
		fgm_api.hideLoader(data.item_id); //Hide that ajax loader
		console.log(data);
		if(data.following > 0){
			fgm_api.showUnfollow(data.item_id);
		}else{
			fgm_api.showFollow(data.item_id);
		}
		return 0;
	};

	/**
	 * Shows the unfollow button for a certain item id
	 * @param 
	 * @return 
	 * 
	*/
	this.showUnfollow = function(id){
		$('#follow-'+id).hide();
		$('#unfollow-'+id).show();
	};

	/**
	 * Shows the follow button for a certain item id
	 * @param 
	 * @return 
	 * 
	*/
	this.showFollow = function(id){
		$('#follow-'+id).show();
		$('#unfollow-'+id).hide();
	};

	/**
	 * Show the ajax loader
	 * @param int id The div id to target
	 * @return 
	 * 
	*/
	this.showLoader = function(id){
		if(!id){
			$('#ajax-status').show();
		}else{
			$('#ajax-status-'+id).show();	
		}
	};

	/**
	 * Hide the ajax loader
	 * @param int id The div id to target
	 * @return 
	 * 
	*/
	this.hideLoader = function(id){
		if(!id){
			$('#ajax-status').hide();
		}else{
			$('#ajax-status-'+id).hide();	
		}
	};

	/**
	 * Submits the like for the user
	 * @param int model_id
	 * @return 
	 * 
	*/
	this.submit_follow = function(model_id){
		$.ajax({
			beforeSend:function (XMLHttpRequest) {
				fgm_api.showLoader(model_id);
			}, 
			success:function (data, textStatus) {
				fgm_api.updateFollowUnfollow(data);
			}, 
			url:"\/ajax\/user_followings\/followUserID\/"+model_id
		});
		return false;
	};

	/**
	 * Submits the dislike for the user
	 * @param int model_id
	 * @return 
	 * 
	*/
	this.submit_unfollow = function(model_id){
		$.ajax({
			beforeSend:function (XMLHttpRequest) {
				fgm_api.showLoader(model_id);
			}, 
			success:function (data, textStatus) {
				fgm_api.updateFollowUnfollow(data);
			}, 
			url:"\/ajax\/user_followings\/unfollowUserID\/"+model_id
		});
		return false;
	};
	
	/**
	 * 
	 * @param object
	 * @return 
	 * 
	*/
	this.setFollowAllUserIDs = function(ids){
		fgm_api.follow_all_user_id_data = ids;
	};
	
	/**
	 * Show the ajax loader
	 * @param int id The div id to target
	 * @return 
	 * 
	*/
	this.showFollowAllLoader = function(){
		$('#follow-all-ajax-status').show();
	};

	/**
	 * Hide the ajax loader
	 * @param int id The div id to target
	 * @return 
	 * 
	*/
	this.hideFollowAllLoader = function(){
		$('#follow-all-ajax-status').hide();
	};

	/**
	 * Shows the unfollow button for a certain item id
	 * @param 
	 * @return 
	 * 
	*/
	this.showUnfollowAll = function(){
		$('#follow-all-btn #follow-all').hide();
		$('#follow-all-btn #unfollow-all').show();

		//Show the unfollow button on all user blocks
		$('.unfollow').show();
		$('.follow').hide();
	};

	/**
	 * Shows the follow button for a certain item id
	 * @param 
	 * @return 
	 * 
	*/
	this.showFollowAll = function(){
		$('#follow-all-btn #follow-all').show();
		$('#follow-all-btn #unfollow-all').hide();

		//Show the follow button on all user blocks
		$('.unfollow').hide();
		$('.follow').show();
	};

	/**
	* This method handles updating the follow and unfollow values in the view. 
	*/
	this.updateFollowUnfollowAll = function(data){
		console.log(data);
		var data = data.data;

		//Update the data so that the next click sends the right info
		if(data.followed_user_ids){
			fgm_api.follow_all_user_id_data.followed_user_ids = data.followed_user_ids;
			fgm_api.follow_all_user_id_data.unfollowed_user_ids = '';
		}else if(data.unfollowed_user_ids){
			fgm_api.follow_all_user_id_data.unfollowed_user_ids = data.unfollowed_user_ids;
			fgm_api.follow_all_user_id_data.followed_user_ids = '';
		}

		this.hideFollowAllLoader(); //Hide that ajax loader
		if(data.following > 0){
			fgm_api.showUnfollowAll();
		}else{
			fgm_api.showFollowAll();
		}
		return 0;
	};

	/**
	 * Submits follow all request 
	 * @param Object user_ids
	 * @return 
	 * 
	*/
	this.submit_follow_all = function(){
		var data = fgm_api.follow_all_user_id_data;
		$.ajax({
			url:"\/ajax\/user_followings\/follow_all",
			type:'POST',
			beforeSend:function (XMLHttpRequest) {
				fgm_api.showFollowAllLoader();
			}, 
			success:function (data, textStatus) {
				fgm_api.updateFollowUnfollowAll(data);
			}, 
			data: data,
			dataType: 'json'
		});
		return false;
	};

	/**
	 * Submits unfollow all request 
	 * @param Object user_ids
	 * @return 
	 * 
	*/
	this.submit_unfollow_all = function(){
		var data = fgm_api.follow_all_user_id_data;
		$.ajax({
			url:"\/ajax\/user_followings\/unfollow_all",
			type:'POST',
			beforeSend:function (XMLHttpRequest) {
				fgm_api.showFollowAllLoader();
			}, 
			success:function (data, textStatus) {
				fgm_api.updateFollowUnfollowAll(data);
			}, 
			data: data,
			dataType: 'json'
		});
		return false;
	};
	
	/**
	* This method handles updating the staff favorite link in the view
	*/
	this.updateStaffFavoriteLink = function(data){
		var data;
		console.log(data);
		if(data.success == true){
			data = data.data;
			fgm_api.hideStaffFavoriteLoader(data.model+"-"+data.model_id);
			fgm_api.deactivateStaffFavorite(data.model+"-"+data.model_id);
		}else{
			//activateStaffFavorite(data.item_id);
			//hideStaffFavoriteLoader(data.data.item_id); //Hide that ajax loader
			alert("There was an error. Reload the page and try again.");
		}
		return 0;
	};

	/**
	 * Shows the staff favorite button for a certain item id
	 * @param 
	 * @return 
	 * 
	*/
	this.deactivateStaffFavorite = function(id){
		$('#staff-fav-'+id).unbind('click');
		$('#staff-fav-'+id).removeAttr('href').css('text-decoration','line-through');
	};

	/**
	 * Shows the staff favorite button for a certain item id
	 * @param 
	 * @return 
	 * 
	*/
	this.activateStaffFavorite = function(id){
		//$('#staff-fav-'+id).removeAttr('href').css('text-decoration','line-through');
	};

	/**
	 * Show the ajax loader
	 * @param int id The div id to target
	 * @return 
	 * 
	*/
	this.showStaffFavoriteLoader = function(id){
		$('#ajax-status-'+id).show();
	};

	/**
	 * Hide the ajax loader
	 * @param int id The div id to target
	 * @return 
	 * 
	*/
	this.hideStaffFavoriteLoader = function(id){
		$('#ajax-status-'+id).hide();
	};
	
	/**
	 * Handles updating the ownership link
	 * @param 
	 * @return 
	 * 
	*/
	this.ownershipSuccess = function(data){
		console.log(data);
		var data = data.data;
		if(data.owned == '1' || data.owned == 1){
			$(".view-actions .have-it").text("You own it.");
			$(".view-actions .have-it").attr("title","You own it.");
		}else{
			$(".view-actions .have-it").text("Have it?");
			$(".view-actions .have-it").attr("title","Have it?");
		}
	};
	
	/**
	* This method handles updating the like and dislike values in the view. 
	*/
	this.updateLikeDislike = function(data){
		fgm_api.hideLoader(); //Hide that ajax loader
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
		}else{
			$('.like').show();
			$('.liked').hide();
			$('.dislike').show();
			$('.disliked').hide();
		}

		$('.vote-val-like').text(data.likes);
		$('.vote-val-dislike').text(data.dislikes);
		return 0;
	}
	
	/**
	* This method handles updating the like and dislike values in the view. 
	*/
	this.updateFeedLikeDislike = function(data){
		console.log(data);
		var data = data.data;
		fgm_api.hideLoader(data.id); //Hide that ajax loader
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
	 * Submits the like for the user
	 * @param string model
	 * @param int model_id
	 * @return 
	 * 
	*/
	this.submit_like = function(model, model_id){
		$.ajax({
			beforeSend:function (XMLHttpRequest) {
				fgm_api.showLoader(model_id);
			}, 
			success:function (data, textStatus) {
				fgm_api.updateFeedLikeDislike(data);
			}, 
			url:"\/ajax\/votes\/vote_up\/"+model+"\/"+model_id
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
	this.submit_dislike = function(model, model_id){
		$.ajax({
			beforeSend:function (XMLHttpRequest) {
				fgm_api.showLoader(model_id);
			}, 
			success:function (data, textStatus) {
				fgm_api.updateFeedLikeDislike(data);
			}, 
			url:"\/ajax\/votes\/vote_down\/"+model+"\/"+model_id
		});
		return false;
	}
	
	//Initialize The FIND|GET|MAKE Finder
	this.init();
}

if(!window.fgm_api_running){
	var fgm_api;
	window.fgm_api_running = true;
	fgm_api = new fgm_api();
}