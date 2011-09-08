<div id="left-container">
	<?php
		//Index Box Ad (300x250)
		//echo $this->element('index-box-ad',array('cache'=>false));

		//Feed sorter
		//echo $this->element('feed-sorter',array('cache'=>false));

	?>
</div>
<div id="right-container-index">
	<div id="user-feed" class="feed index">
		<div class="header red"><?php 
				__('running bond: what others are posting.');
		?></div>
		<div class="clear"></div>
		<h4>Your running bond.</h4>
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
		if(!empty($feed)){
		?>
		<!-- Start gridded items -->
		<div id="grid-container">
		<?php
			for($i=0;$i<count($feed);$i++):
				$model = $feed[$i]['Feed']['model'];
				//debug($model);
				$feed_item = $feed[$i];
				//Display the items 
				if(!empty($feed_item[$model])):
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
						echo $this->element('feed-image-item',array('cache'=>false,'model'=>'Vote','feed_item'=>$feed_item,'controller'=>'votes'));

					}else if($model == 'Ownership'){
						echo $this->element('feed-ownership-item',array('cache'=>false,'model'=>'Ownership','feed_item'=>$feed_item));

					}
					
				endif;
			endfor;
			?>
		</div>
		<div class="clear"></div>
		<!-- End gridded items -->
		<!-- Paging -->
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
		));
		?>	</p>

		<div class="paging">
			<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
		 | 	<?php echo $this->Paginator->numbers();?>
	 |
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		</div>
		<!-- End Paging -->
		<?php
		}else{
			echo "There is no new feed data to review at this time. Please check back, I'm sure your followers will post something soon.";
		}
	?>
	</div>
</div>
<?php 
	echo $this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<script type="text/javascript">
$(function(){
	var $container = $("#grid-container");
	$container.imagesLoaded(function(){
		$container.masonry({
			//option
			itemSelector: '.grid-item'
		});
	});
});
</script>