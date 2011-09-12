<ul class="find-people">
	<?php
	$class = " class='selected' ";
	?>
	<li<?php if($selected == "staff_favorites") echo $class; ?>><?php echo $this->Html->link('Staff favorites',array('admin'=>false,'controller'=>'users','action'=>'find','staff-favorites'),array('class'=>'staff-favorites')); ?></li>
	<li<?php if($selected == "facebook") echo $class; ?>>
	<?php 
		if(empty($facebookUser)){
			echo $this->Html->link('Facebook','javascript:addPermissions("user_about_me,user_birthday,email,offline_access,publish_stream")',array('class'=>'facebook'));
		}else{
			echo $this->Js->link('Facebook',array(
														'ajax'=>true,
														'controller'=>'users',
														'action' => 'find_facebook_users'
														),
														array(
															'before'=>'startSocialSearch("facebook");',
															'update'=>'#search-results',
															'complete'=>'socialSearchComplete(event);',
															'success'=>'socialSearchSuccess(data);',
															'type'=>'html',
															'class'=>'facebook'
														));
		}
		
	?></li>
	<li<?php if($selected == "twitter") echo $class; ?>>
	<?php
		if(empty($twitterUser)){
			echo $this->Js->link('Twitter',"#",
														array(
															'id'=>'twitter-allow'
														));
		}else{
			echo $this->Js->link('Twitter',array(
														'ajax'=>true,
														'controller'=>'users',
														'action' => 'find_twitter_users'
														),
														array(
															'before'=>'startSocialSearch("twitter");',
															'update'=>'#search-results',
															'complete'=>'socialSearchComplete(event);',
															'success'=>'socialSearchSuccess(data);',
															'type'=>'html',
															'id'=>'get-twitter-friends',
															'class'=>'twitter'
														));
		}
	?>
	</li>
</ul>
<div id="searchbox">
	<?php
		echo $this->Form->create('Search', array(
																'url' => array_merge(array(
																									'ajax'=>true,
																									'controller'=>'users',
																									'action' => 'find_users'
																									), 
																									$this->params['pass']
																							)
															));
		echo $this->Form->input('User.search', array('div' => false,'label'=>'','value'=>'Find people','style'=>'color:#999','id'=>'SearchQuery'));
		echo $this->Js->get('#SearchQuery')->event('keypress','checkKeyPress(event);',array('stop'=>false));
		echo $this->Js->submit('Submit',array('div'=>false,
															'id'=>'SearchSubmit',
															'style'=>'display:none',
															'url'=>'/ajax/users/find_users',
															'before'=>'startSearch();',
															'complete'=>'searchComplete(event);',
															'success'=>'searchSuccess(data);',
															'update'=>'#search-results',
															'type'=>'json'
															));
	?>
	<div id="search-loader" style="display:none"><?php echo $this->Html->image('search-loader.gif',array('alt'=>'...')); ?></div>
</div>
<?php
echo $this->Html->script('jquery.popupwindow',array('inline'=>false));
?>
<script type="text/javascript">

$(document).ready(function() {
	
	var profiles = {
		windowCenter:{
			height:500,
			width:800, 
			center:1, 
			onUnload:unloadedTwitterPopup,
			center: 1,
			name:'popup'
		}
	}
	
	var currentSiteAddress = "<?php echo $this->String->getCurrentSiteAddress(); ?>";
	$.getJSON(currentSiteAddress+'/twitter_kit/oauth/authenticate_url/twitter', {}, function(data){
   	$('#twitter-allow').attr('href', data.url);
		$('#twitter-allow').attr('rel','windowCenter');
		$('#twitter-allow').popupwindow(profiles);
   });

	function unloadedTwitterPopup(){
		//Find the friends of this twitter user.
		//Make an ajax call and retrieve the user's friends 
		$.ajax({
			url: '/ajax/users/find_twitter_users',
			type:'POST',
			dataType:'html',
			success: function(data,textStatus){
				socialSearchSuccess(data);
				$('#search-results').html(data);
				console.log(data);
			}
		});
		
	}
});


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
		$('#SearchSubmit').click();
		e.preventDefault();
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
	//Show the ajax loader
	//$('#social-search-loader').show();
	$('.selected').removeClass('selected');
	$('.'+className).parent('li').addClass('selected');
	$("#staff-favorites").hide();
	$("#find-user-loader").show();
}

/**
 * 
 * @param 
 * @return 
 * 
*/
function socialSearchComplete(event){
	//Hide the loader
	//$('#social-search-loader').hide();
	$("#find-user-loader").hide();
}

/**
 * 
 * @param 
 * @return 
 * 
*/
function socialSearchSuccess(event){
	$("#find-user-loader").hide();
	//Build the results
	$("#staff-favorites").fadeOut();
	$("#search-results").fadeIn();
}

/**
 * 
 * @param 
 * @return 
 * 
*/
function searchComplete(event){
	//Hide the loader
	$('#search-loader').hide();
}

/**
 * 
 * @param 
 * @return 
 * 
*/
function searchSuccess(event){
	//Build the results
	$("#staff-favorites").fadeOut();
	$("#search-results").fadeIn();
}

function addPermissions(permissions){
	FB.login(function(response) {
		if (response.session) {
			if (response.perms) {
				// user is logged in and granted some permissions.
				startSocialSearch("facebook");
				findFacebookFriends();
			} else {
				// user is logged in, but did not grant any permissions
				
			}
		} else {
			// user is not logged in
		}
	}, {perms:permissions});
}

function findFacebookFriends(){
	//Make an ajax call and retrieve the user's friends 
	$.ajax({
		url: '/ajax/users/find_facebook_users',
		type:'POST',
		dataType:'html',
		success: function(data,textStatus){
			socialSearchSuccess(data);
			$('#search-results').html(data);
			console.log(data);
		}
	});
}

function open_win(the_url){
	window.open(the_url, 'social_window', 'width=700, height=500, menubar=no, status=no, location=no, toolbar=no, scrollbars=no');
}
</script>
