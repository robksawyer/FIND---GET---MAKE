<?php
	/**
	 * SETTINGS
	 * @param disableMainActions The main edit, delete actions.
	 * @param disableRating Disables the rating system
	*/
	$disableMainActions = true;
	$enableRating = false;
?>
<div class="attachments view">
	<?php
		if(!empty($disableMainActions)){
			$removeDelete = true;
			$removeEdit = true;
		}
		echo $this->element('top_actions',array(
															'item'=>$attachment,
															'model'=>'Attachment',
															'rate'=>$enableRating,
															'removeDelete'=>$removeDelete,
															'removeEdit'=>$removeEdit,
															'cache'=>false
															));
	?>
	<div class="attachments box">
		<?php echo $this->Html->image($attachment['Attachment']['path']); ?>
	</div>
	<!-- <a href="#" class="show_hide"><h3>Show Details</h3></a> -->
	<div id="slidingDiv">
		<h3><?php //echo $attachment['Attachment']['name']; ?></h3>
		<?php
			//Related houses
			/*echo $this->element('houses',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));

			//Related contractors
			echo $this->element('contractors',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));

			//Related sources
			echo $this->element('sources',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));

			//Related inspirations
			echo $this->element('clients',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));

			//Related products
			echo $this->element('products',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));

			//Related inspirations
			echo $this->element('inspirations',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));*/
		?>
	</div>
</div>