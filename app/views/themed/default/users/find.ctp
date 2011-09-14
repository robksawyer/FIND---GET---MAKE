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
				echo $this->element('staff-favorites',array('cache'=>false,'usersNotFollowing'=>$usersNotFollowing)); 
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
			var allowDeeplinking = true;
			if(allowDeeplinking){

				//Set the value of the search input.
				$("#SearchQuery").val(passedParams);

				$.ajax({
					beforeSend:function (XMLHttpRequest) {
							startSearch(XMLHttpRequest)
					}, 
					complete:function (XMLHttpRequest, textStatus) {
						searchComplete(XMLHttpRequest,textStatus)
					}, 
					data:$("#SearchSubmit").closest("form").serialize(), 
					dataType:"html", 
					success:function (data, textStatus) {
						searchSuccess(data,textStatus);
						$("#search-results").html(data);
					}, 
					type:"post", 
					url:"\/ajax\/users\/find_users"
				});
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
</script>