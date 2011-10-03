<div id="user-feed">
	<?php 
		if(!empty($feed)):
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
							echo $this->element('feed-image-item',array('cache'=>false,
																					'model'=>'Product',
																					'feed_item'=>$feed_item,
																					'controller'=>'products'
																				));
						}else if($model == 'Inspiration'){
							echo $this->element('feed-image-item',array('cache'=>false,
																						'model'=>'Inspiration',
																						'feed_item'=>$feed_item,
																						'controller'=>'inspirations'
																						));
						}else if($model == 'Source'){
							echo $this->element('feed-text-item',array('cache'=>false,
																					'model'=>'Source',
																					'feed_item'=>$feed_item,
																					'controller'=>'sources'
																					));
						}else if($model == 'Collection'){
							echo $this->element('feed-collection-item',array('cache'=>false,
																							'model'=>'Collection',
																							'feed_item'=>$feed_item,
																							'controller'=>'collections'
																							));
						}else if($model == 'Ufo'){
							//echo $this->element('feed-image-item',array('cache'=>false,'model'=>'Ufo','feed_item'=>$feed_item));
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
				</span>
				<span id="auto_pagination_loader_failure" style="display: none;">More items could not be loaded.&nbsp;<a href="#" onclick="fgm_api.retry_auto_paginator_request('feeds'); return false;">Try again</a>.</span>
			</div>
		<?php
		else:
			echo "<p>There is no new feed data to review at this time. Please check back, I'm sure the people you follow will post something soon.</p>";
		endif;
	?>
</div>
<script type="text/javascript">
var num_items = <?php echo $num_items; ?>;
var limit = <?php echo $limit; ?>;
var is_empty_feed = <?php if(empty($feed)) echo 1; else echo 0; ?>;

fgm_api.feed_init('feeds',num_items,limit,is_empty_feed); //Initialize the feed
</script>