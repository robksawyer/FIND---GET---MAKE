var UNDEFINED = "undefined",
	api = {
	  call: function (a) {
			if (typeof a.data == UNDEFINED) a.data = {};
			a.data.api_token = api_token;
			/*return $.ajax({
				 url: "http://api." + DOMAIN + "/v1/" + a.url + ".json",
				 dataType: "jsonp",
				 type: "GET",
				 data: a.data,
				 success: function (b) {
					  if (b.meta.status == 200) if (typeof a.success != UNDEFINED) a.success(b);
					  else ENVIRONMENT === DEVELOPMENT && console.log(b);
					  else if (typeof a.failure != UNDEFINED) a.failure(b);
					  else ENVIRONMENT === DEVELOPMENT && console.log(b)
				 }
			})*/
	  }
};
(function () {
	var d = false,
		g = /xyz/.test(function () {
			return xyz
		}) ? /\b_super\b/ : /.*/;
	this.Class = function () {};
	Class.extend = function (b) {
		function c() {
			!d && this.init && this.init.apply(this, arguments)
		}
		var e = this.prototype;
		d = true;
		var f = new this;
		d = false;
		for (var a in b) f[a] = typeof b[a] == "function" && typeof e[a] == "function" && g.test(b[a]) ?
		function (h, i) {
			return function () {
				var j = this._super;
				this._super = e[h];
				var k = i.apply(this, arguments);
				this._super = j;
				return k
			}
		}(a, b[a]) : b[a];
		c.prototype = f;
		c.prototype.constructor = c;
		c.extend = arguments.callee;
		return c
	}
})();;
var Model = Class.extend({
	init: function (a) {
		for (v in a) this[v] = a[v];
	},
	has_many: function (a, e, b) {
		var c, d;
		switch (typeof a) {
			case "object":
				d = a.success;
				delete a.success;
				break;
			case "function":
				d = a;
				a = {};
				break;
			case "number":
				a = {
					limit: a
				};
				break;
			case "undefined":
				a = {}
		}
		d || (d = function (f) { 
			ENVIRONMENT === DEVELOPMENT && console.log(f); 
		});
		if (typeof b == "undefined" || !b) {
			b = e.split("/");
			c = b[b.length - 1];
		} else { c = b.toLowerCase() + "s" };
		return api.call({
			data: a,
			url: this.type.toLowerCase() + "fgm/" + this.id + "/" + e,
			success: function (f) {
				d(f.response[c])
			}
		})
	}
});;
Model._find = function (a, e, b) {
	/*api.call({
		url: a.toLowerCase() + "fgm/" + e + "/show",
		success: function (c) {
			c = new window[a](c.response[a.toLowerCase()]);
			typeof b != "undefined" ? b(c) : console.log(c)
		}
	});*/
	return true
};;
var User = Model.extend({
	type: "User",
	_can: {},
	can: function (a) {
		return typeof this._can !== UNDEFINED && this._can[a] ? true : false;
    },
	init:function (a) {
		this._super(a);
		this.logged_in = this.id >= 0;
		//alert(this.name); (Rob Sawyer)//Testing to see which name is return on load
	}
});
User.find = function (a, b) {
    return Model._find("User", a, b);
};

/**
 * THE SITE CONTROLLER
 * @param 
 * @return 
 * 
*/
function fgm_api(){
	this.api_initialized = false;
	this.domain_set = false;
	this.DOMAIN = "";
	this.follow_all_user_id_data;
	this.feed_num_items = 0;
	this.feed_limit = 10;
	this.feed_previous_loaded = 0;
	this.feed_loading = false;
	this.feed_showing_end = false;
	this.is_empty_feed = 1;
	
	//Find users
	this.twitterSearchComplete = false;
	this.facebookSearchComplete = false;
	this.facebook_permissions = "user_about_me,user_birthday,email,offline_access,publish_stream";
	this.searchInitiated = false;
	this.allowDeeplinking = true;
	this.lastStateID;
	this.searchInitiated = false;
	this.search_query;
	this.passedParams;
	
	this.init = function() {
		try {
			this.api_initialized = true;
			fgm_api.navInit();
			fgm_api.navUserInit();
		} catch(e) {
			//alert(e);
		}
	};
	
	/**
	 * Set the current site url
	 * @param 
	 * @return 
	 * 
	*/
	this.DOMAIN = function(url){
		//event.customData = getCustomData();
		fgm_api.DOMAIN = url;
		fgm_api.domain_set = true;
	}
	
	/**
	 * Initializes the main nav
	 * @param 
	 * @return 
	 * 
	*/
	this.navInit = function(){
		var navRoot = document.getElementById("main-nav");
		var navChildren = document.getElementById("main-nav").getElementsByTagName("li");
		for (var i=0; i<navChildren.length; i++) {
			navChildren[i].onmouseover=function() {
				this.className+=" fgm_hover";
			}
			navChildren[i].onmouseout=function() {
				this.className=this.className.replace(new RegExp(" fgm_hover\\b"), "");
			}
		}
	}
	
	/**
	 * Initializes the user nav
	 * @param 
	 * @return 
	 * 
	*/
	this.initUserNav = function(){
		var userNavRoot = document.getElementById("user-nav");
		var userNavChildren = document.getElementById("user-nav").getElementsByTagName("li");
		for (var i=0; i<userNavChildren.length; i++) {
			userNavChildren[i].onmouseover=function() {
				this.className+=" fgm_hover";
			}
			userNavChildren[i].onmouseout=function() {
				this.className=this.className.replace(new RegExp(" fgm_hover\\b"), "");
			}
		}
	}
	
	this.init_social_services = function(){
		//Setup the popup window profile
		var profiles = {
			windowCenter:{
				height:500,
				width:800, 
				center:1, 
				onUnload:fgm_api.unloadedTwitterPopup,
				center: 1
			}
		}
		try {
			//Make the popup window
			if(fgm_api.DOMAIN){
				$.getJSON(
					fgm_api.DOMAIN+'/twitter_kit/oauth/authenticate_url/twitter', {}, 
					function(data){
				   		$('#twitter-login-wrap #btn-twitter').attr('href', data.url);
						$('#twitter-login-wrap #btn-twitter').attr('rel','windowCenter');
						$('#twitter-login-wrap #btn-twitter').show();
				   		$('#twitter-login-wrap .loading').hide();
						$('.popupwindow').popupwindow(profiles);
			   		}
				);
			}else{
				//The site url isn't set.
			}
		} catch(e) {
			//alert(e);
		}
	}
	
	/**
	 * Initialize methods needed for the find users page.
	 * @param 
	 * @return 
	 * 
	*/
	this.init_find_users = function(passedParams){
		fgm_api.allowDeeplinking = true;
		fgm_api.lastStateID;
		fgm_api.searchInitiated = false;
		fgm_api.passedParams = passedParams;
		
		var profiles = {
			windowCenter:{
				height:500,
				width:800, 
				center:1, 
				onUnload:fgm_api.unloadedTwitterPopupOnFindUsers,
				center: 1,
				name:'popup'
			}
		}
		
		//If the url contains a search query, do the search
		fgm_api.passedParams = passedParams;
			
		try{
			$('#searchbox #SearchQuery').focus(function(){
				if($(this).val() == 'Find people') {
					$(this).css({color:'#000',border:'1px solid #B9B9B9'}).val('');
				}
			});
			$('#searchbox #SearchQuery').blur(function(){
				if($(this).val() == '') {
					$(this).css({color:'#999',border:'1px solid #B9B9B9'}).val('Find people');
				}
			});

			$('#searchbox #SearchQuery').keydown(function(){
				if($('#searchbox #SearchQuery').val().length > 1){
					$("#SearchQuery").css({border:'1px solid #54d154'});
				}else{
					$("#SearchQuery").css({border:'1px solid #f9b3a8'});
				}
			});

			window.onstatechange = function(event){
				//console.log(event);
				var State = History.getState();
				console.log(State);

				fgm_api.search_query = State.data.query;
				console.log(fgm_api.search_query);
				//Update the results
				if(State.id != fgm_api.lastStateID && fgm_api.lastStateID != null && State.data.bypass != true){
					if(fgm_api.search_query != "facebook-search" && fgm_api.search_query != "twitter-search" && fgm_api.search_query != "staff-favorites" && fgm_api.search_query != undefined){
						//Set the value of the search input.
						$("#SearchQuery").css({color:'#000',border:'1px solid #54d154'}).val(fgm_api.search_query).blur();

						if(!fgm_api.searchInitiated) fgm_api.searchUsers();

					}else if(fgm_api.search_query === undefined){
						$("#SearchQuery").css({color:'#999',border:'1px solid #B9B9B9'}).val('Find people').blur();

						//Show the staff favorites page
						if($("#search-results-twitter").is(":visible")) $("#search-results-twitter").fadeOut();
						if($("#search-results-facebook").is(":visible")) $("#search-results-facebook").fadeOut();
						if($("#search-results").is(":visible")) $("#search-results").fadeOut();
						$("#staff-favorites").fadeIn();
					}
				}
				fgm_api.lastStateID = State.id;
			};

			if(fgm_api.DOMAIN){
				$.getJSON(fgm_api.DOMAIN+'/twitter_kit/oauth/authenticate_url/twitter', {}, function(data){
			   	$('#twitter-allow').attr('href', data.url);
					$('#twitter-allow').attr('rel','windowCenter');
					$('#twitter-allow').popupwindow(profiles);
			   });
			}
			
			//Check to see if any search params were passed 
			if(fgm_api.passedParams.length > 2){
				if(fgm_api.passedParams != "facebook-search" && fgm_api.passedParams != "twitter-search" && fgm_api.passedParams != "staff-favorites" && fgm_api.passedParams != ''){
					if(fgm_api.allowDeeplinking){
						//Set the value of the search input.
						$("#SearchQuery").css({color:'#000',border:'1px solid #54d154'}).val(fgm_api.passedParams).blur();
						if(!fgm_api.searchInitiated) fgm_api.searchUsers();
					}
				}
			}
		}catch(e){
			alert(e);
		}
	}
	
	/**
	 * Initializes the feed
	 * @param string controller The controller to target
	 * @param int num_items
	 * @param int limit
	 * @param bool is_empty_feed
	 * @return 
	 * 
	*/
	this.feed_init = function(controller,num_items,limit,is_empty_feed){
		fgm_api.feed_num_items = num_items;
		fgm_api.feed_limit = limit;
		fgm_api.is_empty_feed = is_empty_feed;
		fgm_api.feed_previous_loaded = fgm_api.feed_limit;
		
		if(!fgm_api.is_empty_feed){
			$(window).scroll(function(){
				var position = ($(document).height() - $(window).height());
				if(fgm_api.feed_previous_loaded < (fgm_api.feed_num_items - fgm_api.feed_limit)){
					if($(window).scrollTop() == position){	 //If scrollbar is at the bottom
						if(!fgm_api.feed_loading){
							fgm_api.feed_loading = true;
							var url;
							if(!controller){
								url = "/ajax/users/more_feed_data/"+fgm_api.feed_previous_loaded;
							}else{
								url = "/ajax/"+controller+"/more_feed_data/"+fgm_api.feed_previous_loaded;
							}	
							$.ajax({
									url: url,
									error: function(response, status, xhr) {
													fgm_api.hideMoreLoader();
													if (status == "error") {
														var msg = "Sorry but there was an error: ";
														$('#auto_pagination_loader_failure').show();
														$('#auto_pagination_loader_loading').hide();
														//alert(msg + xhr.status + " " + xhr.statusText);
													}
												},
									beforeSend: fgm_api.showMoreLoader,
									success: fgm_api.appendFeedData,
									dataType:'html'
							});
						}
					}
				}else{
					if(!fgm_api.feed_showing_end){
						fgm_api.feed_showing_end = true;
						$("#grid-container").append("<div id='auto-pagination-finished'>There are no more items to load.</div>");
					}
				}
			});
		}
	};
	
	/**
	 * Handles hiding the welcome message on the moderate page
	 * @param 
	 * @return 
	 * 
	*/
	this.hideWelcome = function(data){
		if(data.success){
			$('.welcome').hide('slow');
		}
	};
	
	/**
	 * Unloads the twitter popup and does a search to find users.
	 * @param 
	 * @return 
	 * 
	*/
	this.unloadedTwitterPopupOnFindUsers = function(){
		//Find the friends of this twitter user.
		//Make an ajax call and retrieve the user's friends 
		$.ajax({
			url: '/ajax/users/find_twitter_users',
			type:'post',
			dataType:'html',
			success: function(data,textStatus){
				fgm_api.socialSearchSuccess(data);
				$('#search-results-twitter').html(data);
				console.log(data);
			},
			error:function (xhr, ajaxOptions, thrownError){
				fgm_api.socialSearchSuccess();
				fgm_api.socialSearchComplete("twitter",thrownError);
				console.log(xhr.status);
				console.log(thrownError);
			},
			complete: fgm_api.socialSearchComplete("twitter")
		});
	};
	
	/**
	 * Unloads the Twitter popup window
	 * @param 
	 * @return 
	 * 
	*/
	this.unloadedTwitterPopup = function(){
		//Redirect the user to the signup page and continue the process
		window.location="/users/twitter_signup";
	}
	
	/**
	 * The user accepted the requirements. Log them in
	 * @param string login_url 
	 * @return 
	 * 
	*/
	this.facebook_login = function(loginURL){
		var loginURL = loginURL;
		window.location.href = loginURL;
	}
	
	/**
	 * 
	 * @param string controller The controller to target
	 * @return 
	 * 
	*/
	this.retry_auto_paginator_request = function(controller){
		if(!controller) controller = "users";
		$.ajax({
			success:function (data, textStatus) {
				fgm_api.appendFeedData(data);
			}, 
			url:"/ajax/"+controller+"/more_feed_data/"+fgm_api.feed_previous_loaded
		});
		return false;
	};

	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	this.appendFeedData = function(data){
		//Hide the loader
		fgm_api.hideMoreLoader();
		$("#grid-container").append(data);
		fgm_api.feed_previous_loaded += fgm_api.feed_limit;
		fgm_api.feed_loading = false;
	};

	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	this.showMoreLoader = function(){
		$("#auto-pagination-loader").show();
	};

	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	this.hideMoreLoader = function(){
		$("#auto-pagination-loader").hide();
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

		fgm_api.hideFollowAllLoader(); //Hide that ajax loader
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
	};
	
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
	};
	
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
	};

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
	};
	
	/**
	 * Submits an item to the storage from the feed
	 * @param string model
	 * @param int model_id
	 * @return 
	 * 
	*/
	this.storage_submit = function(model, model_id){
		$.ajax({
			beforeSend:function (XMLHttpRequest) {
				fgm_api.showDotLoader("source-369","-green");
			}, 
			success:function (data, textStatus) {
				fgm_api.updateDotLink(data);
			}, 
			url:"\/ajax\/storages\/toggle\/"+model+"\/"+model_id
		});
		return false;
	};
	
	/**
	 * Listens for the enter key to be pressed
	 * @param 
	 * @return 
	 * 
	*/
	this.checkKeyPress = function(e){
		var code = (e.keyCode ? e.keyCode : e.which);
		if(code == 13) { //Enter keycode
			e.preventDefault();
			//Only submit if more than two characters are entered
			if($('#searchbox #SearchQuery').val().length > 1){
				//$('#SearchSubmit').click();
				if(!fgm_api.searchInitiated) fgm_api.searchUsers();
			}else{
				$("#SearchQuery").css({border:'3px solid #f9b3a8'});
			}
			//return true;
		}else{
			return false;
		}
	};

	/**
	 * Fires the standard search
	 * @param 
	 * @return 
	 * 
	*/
	this.searchUsers = function(){
		fgm_api.searchInitiated = true;
		$.ajax({
			url:"\/ajax\/users\/find_users",
			type:"post",
			dataType:"html", 
			data:$("#SearchSubmit").closest("form").serialize(),
			beforeSend:function (XMLHttpRequest) {
				//console.log(XMLHttpRequest);
				fgm_api.onSearchStart();
			},
			success:function (data, textStatus) {
				fgm_api.onSearchSuccess(data,textStatus);
				$("#search-results").html(data);
			},
			complete:function (XMLHttpRequest, textStatus) {
				fgm_api.searchInitiated = false;
				fgm_api.onSearchComplete(XMLHttpRequest,textStatus)
			}
		});
	};
	
	/**
	 * Fired before the search bar search starts
	 * @param 
	 * @return 
	 * 
	*/
	this.onSearchStart = function(){
		fgm_api.searchInitiated = true;
		//Show the ajax loader
		$('#search-loader').show();

		//Change our States
		var search_query = $("#SearchQuery").val();
		History.pushState({query:search_query}, "FIND | MAKE | GET : User Search : "+ search_query, '/users/find/'+search_query);
	};

	/**
	 * 
	 * @param String className The name of the class to target
	 * @return 
	 * 
	*/
	this.startSocialSearch = function(className){

		//Show the ajax loader
		$('.selected').removeClass('selected');
		$('.'+className).parent('li').addClass('selected');
		$("#"+className+"-loader").show();

		if(className == "facebook"){
			//Check to make sure that the user is logged in
			FB.getLoginStatus(function(response) {
				console.log(response);
				if(response.status == "connected") {
					FB.api('/me/permissions', function(perms_response) {
						//console.log(perms_response);
						if(perms_response.data[0].offline_access != 1 && perms_response.data[0].email != 1 && perms_response.data[0].user_about_me != 1){
							fgm_api.facebookSearchComplete = false;
							fgm_api.doFacebookCheck(fgm_api.facebook_permissions,true);
							return false;
						}
					});
				}else{
					fgm_api.facebookSearchComplete = false;
					fgm_api.doFacebookCheck(facebook_permissions,true);
					return false;
				}
			});
		}

		//Check to see if the results have already loaded
		if(fgm_api.facebookSearchComplete){
			if($("#search-results-twitter").is(":visible")) $("#search-results-twitter").fadeOut();
			if($("#search-results").is(":visible")) $("#search-results").fadeOut();
			if($("#staff-favorites").is(":visible")) $("#staff-favorites").fadeOut();
			$("#search-results-facebook").fadeIn();

			return false;
		}else if(fgm_api.twitterSearchComplete){
			if($("#search-results-facebook").is(":visible")) $("#search-results-facebook").fadeOut();
			if($("#search-results").is(":visible")) $("#search-results").fadeOut();
			if($("#staff-favorites").is(":visible")) $("#staff-favorites").fadeOut();
			$("#search-results-twitter").fadeIn();
			return false;
		}
	};
	
	/**
	 * 
	 * @param className The div className to target
	 * @param message A message to send to the results area.
	 * @return 
	 * 
	*/
	this.socialSearchComplete = function(className,message){
		if($("#staff-favorites").is(":visible")) $("#staff-favorites").fadeOut();
		if(className == "twitter"){
			if(!message){
				fgm_api.twitterSearchComplete = true;
			}
			if($("#search-results-facebook").is(":visible")) $("#search-results-facebook").fadeOut();
		}
		if(className == "facebook"){
			if(!message){
				fgm_api.facebookSearchComplete = true;
			}
			if($("#search-results-twitter").is(":visible")) $("#search-results-twitter").fadeOut();
		}
		if($("#search-results").is(":visible")) $("#search-results").fadeOut();

		if(message){
			htmlData = "<h3 style='error'>"+message+"</h3>";
			$("#search-results-"+className).html(htmlData);
		}

		$("#search-results-"+className).fadeIn();

		// Change our States
		History.pushState({query:className+"-search"}, "FIND | MAKE | GET : User Search : " + className, "/users/find/"+className+"-search");

		//Hide the loader
		$("#"+className+"-loader").hide();
	};

	/**
	 * Fired when a the controller returns data
	 * @param String data
	 * @return 
	 * 
	*/
	this.socialSearchSuccess = function(data){
		//Do something
	};

	/**
	 * 
	 * @param ?? XMLHttpRequest
	 * @param String textStatus
	 * @return 
	 * 
	*/
	this.onSearchComplete = function(XMLHttpRequest,textStatus){
		fgm_api.searchInitiated = false;
		//Hide the loader
		$('#search-loader').hide();
	};

	/**
	 * The search returned the success state
	 * @param String data
	 * @param textStatus
	 * @return 
	 * 
	*/
	this.onSearchSuccess = function(data,textStatus){

		if($("#search-results-twitter").is(":visible")) $("#search-results-twitter").fadeOut();
		if($("#search-results-facebook").is(":visible")) $("#search-results-facebook").fadeOut();
		if($("#staff-favorites").is(":visible")) $("#staff-favorites").fadeOut();

		$("#search-results").fadeIn();
	};

	/**
	 * 
	 * @param String permissions
	 * @param Boolean reset Whether or not to reset the session data. 
	 * @return 
	 * 
	*/
	this.doFacebookCheck = function(permissions,reset){
		if(!permissions) permissions = fgm_api.facebook_permissions;
		if(!reset) reset = false;

		// check if the user is logged in + connected to the app
		FB.getLoginStatus(function(response) {
			if(response.status == "connected" && reset != true) {
				// if the user is logged in, continue to check permissions
				FB.api('/me/permissions', function(perms_response) {
					//console.log(perms_response);
					if(perms_response.data[0].offline_access == 1 && perms_response.data[0].email == 1 && perms_response.data[0].user_about_me == 1){
						// user is logged in and granted some permissions.
						fgm_api.findFacebookFriends(response.session.access_token,reset);
					}else{
						fgm_api.doFacebookCheck(false,true);
					}
				});
			}else{
				// user is not connected to the app, so show an auth dialog
				FB.login(function(response) {
					//console.log(response);
					if (response.session) {
						if (response.perms) {
							// user is logged in and granted some permissions.
							//Send the access token to the find method and build the session variable in the controller
							fgm_api.findFacebookFriends(response.session.access_token,reset);
						} else {
							// user is logged in, but did not grant any permissions
							//Add some text that lets the user know that they have to grant permissions
							fgm_api.socialSearchComplete("facebook","You must allow us permission to access your info to continue the search.");
						}
					} else {
						// user is not logged in
						//Add some text that lets the user know that they have to login
						fgm_api.socialSearchComplete("facebook","You must allow us permission to access your info to continue the search.");
					}
				}, {perms:permissions});
				FB.Event.subscribe('auth.login',function(){ return true; });
			}
		});
	};

	/**
	 * 
	 * @param token The Facebook auth/access token
	 * @param reset Whether or not to reset the current session token
	 * @return 
	 * 
	*/
	this.findFacebookFriends = function(token,reset){
		//Make an ajax call and retrieve the user's friends 
		$.ajax({
			url: '/ajax/users/find_facebook_users/'+token+'/'+reset,
			type:'post',
			dataType:'html',
			success: function(data,textStatus){
				fgm_api.socialSearchSuccess(data);
				$('#search-results-facebook').html(data);
				//console.log(data);
			},
			complete: fgm_api.socialSearchComplete("facebook")
		});
	};

	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	this.open_win = function(the_url){
		window.open(the_url, 'social_window', 'width=700, height=500, menubar=no, status=no, location=no, toolbar=no, scrollbars=no');
	};
	
	//Initialize The FIND|GET|MAKE API
	this.init();
}

if(!window.fgm_api_running){
	var fgm_api;
	window.fgm_api_running = true;
	fgm_api = new fgm_api();
}

/**
 * Init History
 * @param 
 * @return 
 * 
*/
(function(window,undefined){
	// Check Location
	if( document.location.protocol === 'file:' ) {
		alert('The HTML5 History API (and thus History.js) do not work on files, please upload it to a server.');
	}

	// Establish Variables
	var History = window.History, // Note: We are using a capital H instead of a lower h
		State = History.getState(),
		$log = $('#log');

	// Log Initial State
	History.log('initial:', State.data, State.title, State.url);

	// Bind to State Change
	History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
		// Log the State
		var State = History.getState(); // Note: We are using History.getState() instead of event.state
		History.log('statechange:', State.data, State.title, State.url);
	});

})(window);