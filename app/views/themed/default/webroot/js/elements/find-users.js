/**
 * 
 * @date Sep 14 2011
 * @author Rob Sawyer
 * 
*/
var twitterSearchComplete = false;
var facebookSearchComplete = false;

$('#searchbox #SearchQuery').focus(function(){
	if($(this).val() == 'Find people') {
		$(this).val('');
		$(this).css('color','#000');
	}
});
$('#searchbox #SearchQuery').blur(function(){
	if($(this).val() == '') {
		$(this).val('Find people');
		$(this).css('color','#999');
		$("#SearchQuery").css({border:'1px solid #B9B9B9'});
	}
});

$('#searchbox #SearchQuery').keydown(function(){
	if($('#searchbox #SearchQuery').val().length > 1){
		$("#SearchQuery").css({border:'1px solid #54d154'});
	}else{
		$("#SearchQuery").css({border:'1px solid #f9b3a8'});
	}
});

/**
 * 
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
			$('#SearchSubmit').click();
		}else{
			$("#SearchQuery").css({border:'3px solid #f9b3a8'});
		}
		//return true;
	}else{
		return false;
	}
}

/**
 * 
 * @param 
 * @return 
 * 
*/
function startSearch(){
	//Show the ajax loader
	$('#search-loader').show();
}

/**
 * 
 * @param className The name of the class to select
 * @return 
 * 
*/
function startSocialSearch(className){
	
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
	
	//Show the ajax loader
	$('.selected').removeClass('selected');
	$('.'+className).parent('li').addClass('selected');
	$("#"+className+"-loader").show();
}

/**
 * 
 * @param 
 * @return 
 * 
*/
function socialSearchComplete(className){
	if($("#staff-favorites").is(":visible")) $("#staff-favorites").fadeOut();
	if(className == "twitter"){
		twitterSearchComplete = true;
		if($("#search-results-facebook").is(":visible")) $("#search-results-facebook").fadeOut();
	}
	if(className == "facebook"){
		facebookSearchComplete = true;
		if($("#search-results-twitter").is(":visible")) $("#search-results-twitter").fadeOut();
	}
	if($("#search-results").is(":visible")) $("#search-results").fadeOut();
	$("#search-results-"+className).fadeIn();
	processAjaxData(null, '/users/find/'+className+"-search");
	
	//Hide the loader
	$("#"+className+"-loader").hide();
}

/**
 * 
 * @param 
 * @return 
 * 
*/
function socialSearchSuccess(event){

}

/**
 * 
 * @param 
 * @return 
 * 
*/
function searchComplete(XMLHttpRequest,textStatus){
	//Hide the loader
	$('#search-loader').hide();
}

/**
 * 
 * @param 
 * @return 
 * 
*/
function searchSuccess(data,textStatus){
	var searchVal = $("#SearchQuery").val();
	processAjaxData(data, '/users/find/'+searchVal);

	if($("#search-results-twitter").is(":visible")) $("#search-results-twitter").fadeOut();
	if($("#search-results-facebook").is(":visible")) $("#search-results-facebook").fadeOut();
	if($("#staff-favorites").is(":visible")) $("#staff-favorites").fadeOut();
	
	$("#search-results").fadeIn();
}

/**
 * http://stackoverflow.com/questions/824349/modify-the-url-without-reloading-the-page
 * @param response
 * @param urlPath The path to add
 * @return 
 * 
*/
function processAjaxData(response, urlPath){
	if(response){
		document.getElementById("search-results").innerHTML = response.html;
		response.pageTitle = document.title;
		window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
	}else{
		window.history.pushState({"html":document.getElementById("container").innerHTML,"pageTitle":document.title},"", urlPath);
	}
	
	//document.title = response.pageTitle;
	//window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
	
}

/**
 * Handles what happens when the back button is clicked.
 * @param 
 * @return 
 * 
*/
window.onpopstate = function(e){
	//alert(e);
	if(e.state){
		document.getElementById("search-results").innerHTML = e.state.html;
		document.title = e.state.pageTitle;
	}
};

function doFacebookCheck(permissions){
	startSocialSearch("facebook");
	// check if the user is logged in + connected to the app
	FB.getLoginStatus(function(response) {
		//console.log(response);
		if(response.status == "connected") {
			// if the user is logged in, continue to check permissions
			FB.api('/me/permissions', function(perms_response) {
				//console.log(perms_response);
				if(perms_response.data[0].offline_access == 1 && perms_response.data[0].email == 1 && perms_response.data[0].user_about_me == 1){
					// user is logged in and granted some permissions.
					findFacebookFriends(response.session.access_token);
				}else{
					socialSearchComplete("facebook");
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
						findFacebookFriends(response.session.access_token);
					} else {
						// user is logged in, but did not grant any permissions
						//Add some text that lets the user know that they have to grant permissions
						socialSearchComplete("facebook");
					}
				} else {
					// user is not logged in
					//Add some text that lets the user know that they have to login
					socialSearchComplete("facebook");
				}
			}, {perms:permissions});
			FB.Event.subscribe('auth.login',function(){ return true; });
		}
	});
}

function findFacebookFriends(token){
	//Make an ajax call and retrieve the user's friends 
	$.ajax({
		url: '/ajax/users/find_facebook_users/'+token,
		type:'POST',
		dataType:'html',
		success: function(data,textStatus){
			socialSearchSuccess(data);
			$('#search-results').html(data);
			//console.log(data);
		},
		complete: socialSearchComplete("facebook")
	});
}

function open_win(the_url){
	window.open(the_url, 'social_window', 'width=700, height=500, menubar=no, status=no, location=no, toolbar=no, scrollbars=no');
}