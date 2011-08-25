<?php
//Traverse the array and return the html 
for($i=0;$i<count($feed);$i++):
	$model = key($feed[$i]);
	$feed_item = $feed[$i];
	//Display the items 
	if(!empty($feed_item)):
		if($model == 'Product'){
			//Only show the product if an image is associated with it.
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
		}else if($model == 'Ufo'){
			//echo $this->element('feed-ownership-item',array('cache'=>false,'model'=>'Ownership','feed_item'=>$feed_item));
		}
	endif;
endfor;
?>