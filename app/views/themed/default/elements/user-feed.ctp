<?php
	//$user_id is passed in from the view
	$feed = $this->requestAction('/feeds/getUserFeed/'.$user_id);
	$num_items = $this->requestAction('/feeds/getUserFeedCount/'.$user_id);
	$limit = 10;
?>
<div id="user-feed">
	<?php 
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
		}else{
			echo "There is no new feed data to review at this time. Please check back, I'm sure the people you follow will post something soon.";
		}
	?>
</div>
<?php 
	echo $this->Html->script('elements/feed-like-dislike');
?>
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
				showMoreLoader();
				//$("#grid-container").append("<div class='batch' style='display:none;'></div>"); //append a container to hold ajax content
				//var url = $("a#next").attr("href"); //extract the URL from the "next" link
				//alert(previous_loaded);
				var url = "/users/more_user_feed_data/"+<?php echo $user_id; ?>+"/"+previous_loaded;
				//$(".paging").remove(); // remove the old pagination links because new ones will be loaded via ajax
				$("#grid-container").load(url, function(response, status, xhr) {
					if (status == "error") {
						var msg = "Sorry but there was an error: ";
						$('#auto_pagination_loader_failure').show();
						$('#auto_pagination_loader_loading').hide();
						//alert(msg + xhr.status + " " + xhr.statusText);
					} else {
						//Hide the loader
						hideMoreLoader();
						//$(this).attr("class","loaded"); //change the class name so it will not be confused with the next batch
						//$(".paging").hide(); //hide the new paging links
						previous_loaded += limit;
						$(this).fadeIn();
						loading = false;
					}
				});
			}
		}
	}else{
		if(!showing_end){
			showing_end = true;
			$("#grid-container").append("<div id='auto-pagination-finished'>There are no more items to load.</div>");
		}
	}
	
	function showMoreLoader(){
		$("#auto-pagination-loader").show();
	}

	function hideMoreLoader(){
		$("#auto-pagination-loader").hide();
	}
	
});

function retry_auto_paginator_request(){
	$.ajax({success:function (data, textStatus) {
			appendData(data);
			loading = false;
		}, 
		url:"/users/more_user_feed_data/"+<?php echo $user_id; ?>+"/"+previous_loaded
	});
	return false;
}

function appendData(data){
	if(data != false){
		//$("#grid-container .batch").append(data);
		$("#grid-container").append(data);
		previous_loaded += limit;
	}
}

</script>