<?php
	/**
	 * SETTINGS
	 * @param disableMainActions The main edit, delete actions.
	 * @param disableRating Disables the rating system
	 * @param disableTagging Disables the image tagging.
	 * @param disableProductDeleting Disable deleting of products
	 * @param disableAttachmentDeleting Disable deleting of attachments
	 * @param disableAttachmentAdding Disable adding of attachments
	 * @param disableSourceAdding Disable adding of sources
	 * @param disableProductAdding Disable adding of products
	*/
	$disableMainActions = true;
	$enableRating = true;
	$hideTags = true;
	$disableTagging = true;
	$disableProductDeleting = true;
	$disableAttachmentDeleting = true;
	$disableAttachmentAdding = true;
	$disableSourceAdding = true;
	$disableProductAdding = true;
	$disableComments = false;
	
	echo $this->Html->css('inspirations/view','stylesheet',array('inline'=>false));
?>
<div class="inspirations view">
	<?php
		if(!empty($disableMainActions)){
			$removeDelete = true;
			$removeEdit = true;
		}
		echo $this->element('top_actions',array('item'=>$inspiration,
															'model'=>'Inspiration',
															'rate'=>$enableRating,
															'removeDelete'=>$removeDelete,
															'removeEdit'=>$removeEdit,
															'cache'=>false
															));
	?>
	<!-- START LEFT CONTAINER -->
	<div class="left-container">
		<!--- TAGGABLE IMAGE SECTION -->
		<div id="taggable-image">
			<?php echo $this->element('taggable_image',array('inspiration'=>$inspiration,'disableTagging'=>$disableTagging)); ?>
		</div>
		<!--- END TAGGABLE IMAGE SECTION -->
		<div class="source">
			<?php echo $this->Html->link('Source',$inspiration['Inspiration']['source_url'],array('target'=>'_blank')); ?>
			&nbsp;
		</div>
	</div>
	<!-- END LEFT CONTAINER -->
	
	<!-- START RIGHT CONTAINER -->
	<div class="right-container">
		<!--- DETAILS SECTION -->
		<div class="details">
			<div id="responseSuccess" class="message" style="display: none"></div>
			<ul id="responseError" class="error-message" style="display: none"></ul>
			<h3><?php  __($inspiration['Inspiration']['name']);?></h3>
			<ul>
			<?php if(!empty($inspiration['Inspiration']['designer'])): ?>
				<li class="designer">
					<?php echo "Designed by ".$inspiration['Inspiration']['designer']; ?>
				</li>
				<?php endif; ?>
				<li class="added-by">
					<?php echo "Added by ".$inspiration['User']['username']; ?>
				</li>
				<li class="address">
					<?php
						if(
							!empty($inspiration['Inspiration']['address1'])
							|| !empty($inspiration['Inspiration']['address2'])
							|| !empty($inspiration['Inspiration']['city'])
							|| !empty($inspiration['Inspiration']['state'])
							|| !empty($inspiration['Inspiration']['zip'])
							|| !empty($inspiration['Country']['name'])
						):
					?>
					Address:
					<ul>
					<?php 
						if(!empty($inspiration['Inspiration']['address1'])){
							echo "<li>".$inspiration['Inspiration']['address1']."</li>"; 
						}
					?>
					<?php if(!empty($inspiration['Inspiration']['address2'])) echo "<li>".$inspiration['Inspiration']['address2']."</li>"; ?>
					<?php 
					
						if(!empty($inspiration['Inspiration']['city'])){
							echo "<li>".$inspiration['Inspiration']['city'];
						}
						
						if(!empty($inspiration['Inspiration']['city']) && !empty($inspiration['Inspiration']['state'])) {
							echo ", ".$inspiration['Inspiration']['state']; 
						}else if(!empty($inspiration['Inspiration']['state'])){
							echo $inspiration['Inspiration']['state']; 
						}
						
						if(!empty($inspiration['Inspiration']['zip']) && !empty($inspiration['Inspiration']['state'])){
							echo " ".$inspiration['Inspiration']['zip']."</li>";
						}else if(!empty($inspiration['Inspiration']['zip'])){
							echo " ".$inspiration['Inspiration']['zip']."</li>";
						}else{
							echo "</li>";
						}
						
						if(!empty($inspiration['Country']['name'])){
							echo "<li>".$inspiration['Country']['name']."</li>";
						}
						
					?>
					</ul>
				</li>
				<?php endif; ?>
				<li class="description"><?php if(!empty($inspiration['Inspiration']['description'])) echo $inspiration['Inspiration']['description']; ?></li>
			</ul>
		</div>
		<!--- END DETAILS SECTION -->
		<?php echo $this->element('social-buttons',array('cache'=>false)); ?>
		<?php 
			if(empty($hideTags)){
				echo $this->element('tags',array('model'=>$inspiration,'cache'=>false)); 
			}
		?>
		<?php
			//PRODUCTS IN THE INSPIRATION
			if(!empty($productsAll) && !empty($products)){
				echo $this->element('inspiration_products',array(
																				'item'=>$inspiration,
																				'model'=>'Inspiration',
																				'products'=>$productsAll,
																				'productList'=>$products,
																				'client'=>true,
																				'disableAdding'=>$disableProductAdding,
																				'disableDeleting'=>$disableProductDeleting,
																				'cache'=>false
																				));
			}else{
				$this->log('You did not set the products or product list values.');
			}
		?>
		<div class="clear"></div>
		<?php
			//SOURCES
			echo $this->element('sources',array('item'=>$inspiration,
															'model'=>'Inspiration',
															'client'=>true,
															'disableAdding'=>$disableSourceAdding,
															'cache'=>false
															));
		?>
	</div>
	<!-- END RIGHT CONTAINER -->
</div>
<div class="clear"></div>
<div class="bar">&nbsp;</div>
<?php
	//ATTACHMENTS
	echo $this->element('attachments',array('item'=>$inspiration,
														'model'=>'Inspiration',
														'controller'=>'inspirations',
														'client'=>true,
														'disableAdding'=>$disableAttachmentAdding,
														'disableDeleting'=>$disableAttachmentDeleting,
														'removeFirst'=>true,
														'cache'=>false
														));
?>
<div class="clear"></div>
<div class="bar">&nbsp;</div>
<?php 
	if(empty($disableComments)){
		echo $this->element('comments',array('cache'=>false,'disable'=>false));
	}
?>
<script type="text/javascript">

$(document).ready(function() {
	//Apply css to the titles
	applyTitleEffects();
	
	//Position the tag map on the image relative to the where it is on the page.
	positionMap();
});

$(window).load(function() {
	
	activateImageSelect();
	
	//Set up imgAreaSelect
	$('.start-tagging').click(function() {
		$('.start-tagging').addClass("hide");
		$('.finish-tagging').removeClass("hide");
	
		//load imgAreaSelect (#imageid must equal the id or class of your image.
		//$('img#imageid').imgAreaSelect({ handles: true, onSelectChange: selectChange, keys: { arrows: 15, shift: 5 }, aspectRatio: '4:3', maxWidth: 150, maxHeight: 100 });
		activateImageSelect();
	});
	
	$('.finish-tagging').click(function(){
		//$("#AttachmentTagAddForm").hide(); //Hide the form
		$('.start-tagging').removeClass("hide");
		
		$('.finish-tagging').addClass("hide");
		$('#title_container').addClass("hide");
		disableImageSelect();
	});
	
	//Close the error box for form pages
	$('a#error-link').click(function() {
		$('#error-box').slideUp('slow');
		return false;
	});
	$('a#warning-link').click(function() {
		$('#warning-box').slideUp('slow');
		return false;
	});

});
</script>