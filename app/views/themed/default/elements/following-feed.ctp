<?php
	$feed = $this->requestAction('/feeds/getUsersFollowingFeedData');
	$num_items = $this->requestAction('/feeds/getUsersFollowingFeedCount');
	$limit = 10;
?>
<div id="user-feed">
	<?php 
		//debug($feed); 
		if(!empty($authUser['User']['totalUsersFollowing'])){
			if(!empty($feed)){
			?>
				<!-- Start gridded items -->
				<div id="grid-container">
				<?php
					for($i=0;$i<count($feed);$i++):
						$model = key($feed[$i]);

						$feed_item = $feed[$i];
						//Display the items 
						if(!empty($feed_item)):
							if($model == 'Product'){
								//Only show the product if an image is associated with it.
								//debug($feed_item);
								echo $this->element('feed-image-item',array('cache'=>false,'model'=>'Product','feed_item'=>$feed_item,'controller'=>'products'));
							}else if($model == 'Inspiration'){
								echo $this->element('feed-image-item',array('cache'=>false,'model'=>'Inspiration','feed_item'=>$feed_item,'controller'=>'inspirations'));
							}else if($model == 'Source'){
								echo $this->element('feed-text-item',array('cache'=>false,'model'=>'Source','feed_item'=>$feed_item,'controller'=>'sources'));
							}else if($model == 'Collection'){
								echo $this->element('feed-collection-item',array('cache'=>false,'model'=>'Collection','feed_item'=>$feed_item,'controller'=>'collections'));
							}else if($model == 'Vote'){
								echo $this->element('feed-vote-item',array('cache'=>false,'model'=>'Vote','feed_item'=>$feed_item,'controller'=>'votes'));
							}else if($model == 'Ownership'){
								echo $this->element('feed-ownership-item',array('cache'=>false,'model'=>'Ownership','feed_item'=>$feed_item));
							}
						endif;
					endfor;
					?>
				</div>
				<div class="clear"></div>
				<!-- End gridded items -->
				<div id="auto-pagination-loader" style="display: none;">
					<span id="auto_pagination_loader_loading">
						<div class="spinner"></div>
						Loading more items...
					</span>
					<span id="auto_pagination_loader_failure" style="display: none;">
					More items could not be loaded.&nbsp;<a href="#" onclick="retry_auto_paginator_request(); return false;">Try again</a>.                </span>
				</div>
				<?php 
					/*echo $this->Js->link('More',
													'/users/more_feed_data/'.$limit,
													array('title'=>'See more',
															'id'=>'more-button',
															//'beforeSend'=>'showMoreLoader',
															'success'=>'appendData(data)'
														)
													);*/
				?>
			<?php
			}else{
				echo "There is no new feed data to review at this time. Please check back, I'm sure the people you follow will post something soon.";
			}
		}else{
			//If the user isn't following anyone
			echo "You are not following any users.";
		}
		
	?>
</div>
<script type="text/javascript">
var num_items = <?=$num_items?>;
var limit = <?=$limit?>;
var previous_loaded = limit;
var loading = false;
var showing_end = false;
$(window).scroll(function(){
	var position = ($(document).height() - $(window).height());
	if(previous_loaded < num_items - 10){
		if($(window).scrollTop() == position){	 //If scrollbar is at the bottom
			if(!loading){
				loading = true;
				//Show the loader
				//showMoreLoader();
				//$("#grid-container").append("<div class='batch' style='display:none;'></div>"); //append a container to hold ajax content
				var url = "/users/more_feed_data/"+previous_loaded;
				$.ajax({
						url: url,
						error: function(response, status, xhr) {
										hideMoreLoader();
										if (status == "error") {
											var msg = "Sorry but there was an error: ";
											$('#auto_pagination_loader_failure').show();
											$('#auto_pagination_loader_loading').hide();
											//alert(msg + xhr.status + " " + xhr.statusText);
										}
									},
						beforeSend: showMoreLoader,
						success:appendData,
						dataType:'html'
				});
			}
		}
	}else{
		if(!showing_end){
			showing_end = true;
			$("#grid-container").append("<div id='auto-pagination-finished'>There are no more items to load.</div>");
		}
	}
	
});

function retry_auto_paginator_request(){
	$.ajax({
		success:function (data, textStatus) {
			appendData(data);
		}, 
		url:"/users/more_feed_data/"+previous_loaded
	});
	return false;
}

function appendData(data){
	//Hide the loader
	hideMoreLoader();
	$("#grid-container").append(data);
	//var grid_container = document.getElementById("grid-container");
	//grid_container.innerHTML += data;
	
	previous_loaded += limit;
	loading = false;
}

function showMoreLoader(){
	$("#auto-pagination-loader").show();
}

function hideMoreLoader(){
	$("#auto-pagination-loader").hide();
}

</script>