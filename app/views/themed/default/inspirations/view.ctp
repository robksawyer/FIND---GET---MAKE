<?php
	echo $this->Html->css('inspirations/view','stylesheet',array('inline'=>false));
?>
<div class="inspirations view">
	<?php
		echo $this->element('top_actions',array('item'=>$inspiration,'model'=>'Inspiration','rate'=>true,'cache'=>false));
	?>
	<!-- START LEFT CONTAINER -->
	<div id="left-container">
		<!--- TAGGABLE IMAGE SECTION -->
		<div id="taggable-image">
			<?php 
				//Check to see if the inspiration is private. Make sure that the user who owns this isn't viewing it.
				if($inspiration['Inspiration']['private'] == 1 && $inspiration['Inspiration']['user_id'] != $authUser['User']['id']){
					$disableTagging = true;
				}else{
					$disableTagging = false;
				}
				echo $this->element('taggable_image',array('inspiration'=>$inspiration,'disableTagging'=>$disableTagging)); 
			?>
			<div class="source">
				<?php echo $this->Html->link('Source',$inspiration['Inspiration']['source_url'],array('target'=>'_blank')); ?>
				&nbsp;
			</div>
		</div>
		<!--- END TAGGABLE IMAGE SECTION -->
		<div class="clear"></div>
	</div>
	<!-- END LEFT CONTAINER -->
	
	<!-- START RIGHT CONTAINER -->
	<div id="right-container">
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
				<div class="clear"></div>
			</ul>
		</div>
		<!--- END DETAILS SECTION -->
		<div class="clear"></div>
		<?php 
			echo $this->element('share-buttons',array('controller'=>'inspirations',
																	'keycode'=>$inspiration['Inspiration']['keycode'],
																	'cache'=>false
																	));
			echo $this->element('social-buttons',array(
																	'controller'=>'inspirations',
																	'keycode'=>$inspiration['Inspiration']['keycode'],
																	'cache'=>false
																	));
		?>
		<?php echo $this->element('tags',array('model'=>$inspiration,'cache'=>false)); ?>
		<div class="clear"></div>
	</div>
	<!-- END RIGHT CONTAINER -->
	
	<div id="right-sidebar">
		<?php
		echo $this->element('like-dislike',array('model_id'=>$inspiration['Inspiration']['id'],
																'model'=>'Inspiration',
																'cache'=>false
																));
		?>
		<div class="added-by" style="text-align:center">
			<?php
				echo $this->element('avatar',array('cache'=>false,'user'=>$inspiration,'height'=>'32'));
		 		echo "Added by ".$this->Html->link($inspiration['User']['username'],array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'profile',$inspiration['User']['username'])); 
			?>
		</div>
	</div>
</div>
<div class="clear"></div>
<div class="bar">&nbsp;</div>
<?php
	//PRODUCTS IN THE INSPIRATION
	if(!empty($productsAll) && !empty($products)){
		//Check to see if the inspiration is private. Make sure that the user who owns this isn't viewing it.
		if($inspiration['Inspiration']['private'] == 1 && $inspiration['Inspiration']['user_id'] != $authUser['User']['id']){
			$disableProductAdding = true;
			$disableProductDeleting = true;
		}else{
			$disableProductAdding = false;
			$disableProductDeleting = false;
		}
		echo $this->element('inspiration_products',array(
																		'item'=>$inspiration,
																		'model'=>'Inspiration',
																		'products'=>$productsAll,
																		'productList'=>$products,
																		'disableAdding'=>$disableProductAdding,
																		'disableDeleting'=>$disableProductDeleting,
																		'cache'=>false
																		));
	}else{
		$this->log('You did not set the products or product list values.');
	}
?>
<div class="clear"></div>
<div class="bar">&nbsp;</div>
<?php
	//SOURCES
	if($inspiration['Inspiration']['private'] == 1 && $inspiration['Inspiration']['user_id'] != $authUser['User']['id']){
		$disableSourceAdding = true;
	}else{
		$disableSourceAdding = false;
	}
	echo $this->element('sources',array('item'=>$inspiration,
													'model'=>'Inspiration',
													'disableAdding'=>$disableSourceAdding,
													'cache'=>false
													));
?>
<div class="clear"></div>
<div class="bar">&nbsp;</div>
<?php
	//ATTACHMENTS
	//Check to see if the inspiration is private. Make sure that the user who owns this isn't viewing it.
	if($inspiration['Inspiration']['private'] == 1 && $inspiration['Inspiration']['user_id'] != $authUser['User']['id']){
		$disableAttachmentAdding = true;
		$disableAttachmentDeleting = true;
	}else{
		$disableAttachmentAdding = false;
		$disableAttachmentDeleting = false;
	}
	echo $this->element('attachments',array('item'=>$inspiration,
														'model'=>'Inspiration',
														'controller'=>'inspirations',
														'disableAdding'=>$disableAttachmentAdding,
														'disableDeleting'=>$disableAttachmentDeleting,
														'removeFirst'=>true,
														'cache'=>false
														));
?>
<div class="clear"></div>
<div class="bar">&nbsp;</div>
<?php echo $this->element('comments',array('cache'=>false,'disable'=>false)); ?>
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