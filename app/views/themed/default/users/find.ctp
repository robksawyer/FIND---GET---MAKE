<style type="text/css">
	#search-results-container .query{
		font-weight: bold;
		font-style: italic;
	}
</style>
<div id="left-panel-index">
	<?php 
		if(empty($facebookConnectURL)) $facebookConnectURL = "";
		echo $this->element('find-people-nav',array('cache'=>false,'selected'=>'staff_favorites','facebookConnectURL'=>$facebookConnectURL)); 
	?>
</div>
<div id="right-panel">
	<div class="find-people">
		<h3><b>Follow people on FIND|GET|MAKE</b> to discover new products</h3>
		<div id="staff-favorites">
			<?php 
				echo $this->element('staff-favorites',array('cache'=>false,'user_ids'=>$user_ids,'favorites'=>$staff_favorites_details)); 
			?>
		</div
		<div id="search-results-container">
			<div id="search-results" style="display:none"></div>
			<div id="search-results-twitter" style="display:none"></div>
			<div id="search-results-facebook" style="display:none"></div>
		</div>
		<div id="find-user-loader" style="display:none"><?php //echo $this->Html->image('ajax-loader.gif',array('alt'=>'Loading...')); ?></div>
	</div>
</div>
<?php
echo $this->Html->script('elements/follow-unfollow',array('inline'=>false)); //This isn't getting loadded during the ajax call
echo $this->Html->script('jquery.popupwindow',array('inline'=>false));
echo $this->Html->script('elements/find-users');
echo $this->Js->writeBuffer();
?>
<script type="text/javascript">
var allowDeeplinking = true;
var lastStateID;
var searchInitiated = false;

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
	
	var search_query = State.data.query;
	console.log(search_query);
	//Update the results
	if(State.id != lastStateID && lastStateID != null && State.data.bypass != true){
		if(search_query != "facebook-search" && search_query != "twitter-search" && search_query != "staff-favorites" && search_query != undefined){
			//Set the value of the search input.
			$("#SearchQuery").css({color:'#000',border:'1px solid #54d154'}).val(search_query).blur();

			if(!searchInitiated) searchUsers();
			
		}else if(search_query === undefined){
			$("#SearchQuery").css({color:'#999',border:'1px solid #B9B9B9'}).val('Find people').blur();
			
			//Show the staff favorites page
			if($("#search-results-twitter").is(":visible")) $("#search-results-twitter").fadeOut();
			if($("#search-results-facebook").is(":visible")) $("#search-results-facebook").fadeOut();
			if($("#search-results").is(":visible")) $("#search-results").fadeOut();
			$("#staff-favorites").fadeIn();
		}
	}
	lastStateID = State.id;
};

$(window).load(function(){
	//If the url contains a search query, do the search
	var passedParams = '';
	<?php 
		if(!empty($this->params['pass'][0])){
			echo "passedParams = '".$this->params['pass'][0]."';";
		}
	?>
	//Check to see if any search params were passed 
	if(passedParams.length > 2){
		if(passedParams != "facebook-search" && passedParams != "twitter-search" && passedParams != "staff-favorites" && passedParams != ''){
			if(allowDeeplinking){
				//Set the value of the search input.
				$("#SearchQuery").css({color:'#000',border:'1px solid #54d154'}).val(passedParams).blur();
				if(!searchInitiated) searchUsers();
			}
		}
	}
});

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
	
	//TODO: Add this to the popup and generate it on the fly and redirect to the returned address
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
			type:'post',
			dataType:'html',
			success: function(data,textStatus){
				socialSearchSuccess(data);
				$('#search-results-twitter').html(data);
				console.log(data);
			},
			error:function (xhr, ajaxOptions, thrownError){
				socialSearchSuccess();
				socialSearchComplete("twitter",thrownError);
				console.log(xhr.status);
				console.log(thrownError);
			},
			complete: socialSearchComplete("twitter")
		});
	}
});
</script>