/**
 * 
 * @date Sep 14 2011
 * @author Rob Sawyer
 * 
*/
var twitterSearchComplete = false;
var facebookSearchComplete = false;
var facebook_permissions = "user_about_me,user_birthday,email,offline_access,publish_stream";
var searchInitiated = false;

/**
 * Listens for the enter key to be pressed
 * @param 
 * @return 
 * 
*/
function checkKeyPress(e){
	var code = (e.keyCode ? e.keyCode : e.which);
	if(code == 13) { //Enter keycode
		e.preventDefault();
		//Only submit if more than two characters are entered
		if($('#searchbox #SearchQuery').val().length > 1){
			//$('#SearchSubmit').click();
			if(!searchInitiated) searchUsers();
		}else{
			$("#SearchQuery").css({border:'3px solid #f9b3a8'});
		}
		//return true;
	}else{
		return false;
	}
}

/**
 * Fires the standard search
 * @param 
 * @return 
 * 
*/
function searchUsers(){
	searchInitiated = true;
	$.ajax({
		url:"\/ajax\/users\/find_users",
		type:"post",
		dataType:"html", 
		data:$("#SearchSubmit").closest("form").serialize(),
		beforeSend:function (XMLHttpRequest) {
			//console.log(XMLHttpRequest);
			onSearchStart();
		},
		success:function (data, textStatus) {
			onSearchSuccess(data,textStatus);
			$("#search-results").html(data);
		},
		complete:function (XMLHttpRequest, textStatus) {
			searchInitiated = false;
			onSearchComplete(XMLHttpRequest,textStatus)
		}
	});
}

/**
 * Fired before the search bar search starts
 * @param 
 * @return 
 * 
*/
function onSearchStart(){
	searchInitiated = true;
	//Show the ajax loader
	$('#search-loader').show();
	
	//Change our States
	var search_query = $("#SearchQuery").val();
	History.pushState({query:search_query}, "FIND | MAKE | GET : User Search : "+ search_query, '/users/find/'+search_query);
}

/**
 * 
 * @param String className The name of the class to target
 * @return 
 * 
*/
function startSocialSearch(className){
	
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
						facebookSearchComplete = false;
						doFacebookCheck(facebook_permissions,true);
						return false;
					}
				});
			}else{
				facebookSearchComplete = false;
				doFacebookCheck(facebook_permissions,true);
				return false;
			}
		});
	}
	
	//Check to see if the results have already loaded
	if(facebookSearchComplete){
		if($("#search-results-twitter").is(":visible")) $("#search-results-twitter").fadeOut();
		if($("#search-results").is(":visible")) $("#search-results").fadeOut();
		if($("#staff-favorites").is(":visible")) $("#staff-favorites").fadeOut();
		$("#search-results-facebook").fadeIn();
		
		return false;
	}else if(twitterSearchComplete){
		if($("#search-results-facebook").is(":visible")) $("#search-results-facebook").fadeOut();
		if($("#search-results").is(":visible")) $("#search-results").fadeOut();
		if($("#staff-favorites").is(":visible")) $("#staff-favorites").fadeOut();
		$("#search-results-twitter").fadeIn();
		return false;
	}
}

/**
 * 
 * @param className The div className to target
 * @param message A message to send to the results area.
 * @return 
 * 
*/
function socialSearchComplete(className,message){
	if($("#staff-favorites").is(":visible")) $("#staff-favorites").fadeOut();
	if(className == "twitter"){
		if(!message){
			twitterSearchComplete = true;
		}
		if($("#search-results-facebook").is(":visible")) $("#search-results-facebook").fadeOut();
	}
	if(className == "facebook"){
		if(!message){
			facebookSearchComplete = true;
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
}

/**
 * Fired when a the controller returns data
 * @param String data
 * @return 
 * 
*/
function socialSearchSuccess(data){
	//Do something
}

/**
 * 
 * @param ?? XMLHttpRequest
 * @param String textStatus
 * @return 
 * 
*/
function onSearchComplete(XMLHttpRequest,textStatus){
	searchInitiated = false;
	//Hide the loader
	$('#search-loader').hide();
}

/**
 * The search returned the success state
 * @param String data
 * @param textStatus
 * @return 
 * 
*/
function onSearchSuccess(data,textStatus){
	
	if($("#search-results-twitter").is(":visible")) $("#search-results-twitter").fadeOut();
	if($("#search-results-facebook").is(":visible")) $("#search-results-facebook").fadeOut();
	if($("#staff-favorites").is(":visible")) $("#staff-favorites").fadeOut();
	
	$("#search-results").fadeIn();
}

/**
 * 
 * @param String permissions
 * @param Boolean reset Whether or not to reset the session data. 
 * @return 
 * 
*/
function doFacebookCheck(permissions,reset){
	if(!permissions) permissions = facebook_permissions;
	if(!reset) reset = false;

	// check if the user is logged in + connected to the app
	FB.getLoginStatus(function(response) {
		if(response.status == "connected" && reset != true) {
			// if the user is logged in, continue to check permissions
			FB.api('/me/permissions', function(perms_response) {
				//console.log(perms_response);
				if(perms_response.data[0].offline_access == 1 && perms_response.data[0].email == 1 && perms_response.data[0].user_about_me == 1){
					// user is logged in and granted some permissions.
					findFacebookFriends(response.session.access_token,reset);
				}else{
					doFacebookCheck(false,true);
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
						findFacebookFriends(response.session.access_token,reset);
					} else {
						// user is logged in, but did not grant any permissions
						//Add some text that lets the user know that they have to grant permissions
						socialSearchComplete("facebook","You must allow us permission to access your info to continue the search.");
					}
				} else {
					// user is not logged in
					//Add some text that lets the user know that they have to login
					socialSearchComplete("facebook","You must allow us permission to access your info to continue the search.");
				}
			}, {perms:permissions});
			FB.Event.subscribe('auth.login',function(){ return true; });
		}
	});
}

/**
 * 
 * @param token The Facebook auth/access token
 * @param reset Whether or not to reset the current session token
 * @return 
 * 
*/
function findFacebookFriends(token,reset){
	//Make an ajax call and retrieve the user's friends 
	$.ajax({
		url: '/ajax/users/find_facebook_users/'+token+'/'+reset,
		type:'post',
		dataType:'html',
		success: function(data,textStatus){
			socialSearchSuccess(data);
			$('#search-results-facebook').html(data);
			//console.log(data);
		},
		complete: socialSearchComplete("facebook")
	});
}

function open_win(the_url){
	window.open(the_url, 'social_window', 'width=700, height=500, menubar=no, status=no, location=no, toolbar=no, scrollbars=no');
}