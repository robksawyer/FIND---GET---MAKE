<div id="user-feed">
	<div class="header red"><?php 
			__('running bond: what others are posting.');
	?></div>
	<h4>Content from the <?php echo $this->Html->link($user['User']['totalUsersFollowing']." users",array('controller'=>'user_followings','action'=>'following','admin'=>false,'plugin'=>'',$user['User']['username'])); ?> that you follow.</h4>
	<?php 
	
		/**
		 * Displays a node for an image type item
		 * @param array data 
		 * @param string key
		 * @return 
		 * 
		*/
		/*function displayImageItem($data=null,$key=null){
			$htmlData = "<div class='feed-item'>";
			$htmlData = $this->Html->image($data['Attachment'][0]['path_med'],array('url'=>''));
			$htmlData = "</div>";
			return $htmlData;
		}*/
		
		//debug($feed); 
		if(!empty($user['User']['totalUsersFollowing'])){
			if(!empty($feed)){
				foreach($feed as $feed_item_key => $feed_item ){
					//Display the items 
					if(key($feed[$feed_item_key]) == 'Product'){
						//Only show the product if an image is associated with it.
						//debug($feed_item);
						echo $this->element('feed-image-item',array('cache'=>false,'model'=>'Product','feed_item'=>$feed_item,'controller'=>'products'));

					}else if(key($feed[$feed_item_key]) == 'Inspiration'){
						echo $this->element('feed-image-item',array('cache'=>false,'model'=>'Inspiration','feed_item'=>$feed_item,'controller'=>'inspirations'));
					}else if(key($feed[$feed_item_key]) == 'Source'){
						echo $this->element('feed-text-item',array('cache'=>false,'model'=>'Source','feed_item'=>$feed_item,'controller'=>'sources'));
					}else if(key($feed[$feed_item_key]) == 'Collection'){
						/*
							TODO Add the multi-image view
						*/
						echo $this->element('feed-image-item',array('cache'=>false,'model'=>'Collection','feed_item'=>$feed_item,'controller'=>'collections'));

					}else if(key($feed[$feed_item_key]) == 'Vote'){
						echo $this->element('feed-image-item',array('cache'=>false,'model'=>'Vote','feed_item'=>$feed_item,'controller'=>'votes'));

					}
				}
			}else{
				echo "There is no new feed data to review at this time. Please check back, I'm sure the people you follow will post something soon.";
			}
		}else{
			//If the user isn't following anyone
			echo "You are not following any users.";
		}
		
	?>
</div>
<?php echo $this->Html->script('elements/feed-like-dislike'); ?>