<?php
	//Styles for the jquery plugin from http://odyniec.net/projects/imgareaselect/ not supported by neillh.com.au
	echo $this->Html->css(array('inspirations/view','phototagging','imgareaselect-animated'),'stylesheet',array('inline'=>false));
	//Load the inspiration JS dependencies
	echo $this->Html->script("/minify/index?g=inspiration_dependencies_js&".date("His"));
?>
<div class="inspirations view">
	<?php
		echo $this->element('top_actions',array('item'=>$inspiration,'model'=>'Inspiration','rate'=>true,'cache'=>false));
	?>
	<div id="block_1">
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
		</div>
		<!--- END TAGGABLE IMAGE SECTION -->
		<div class="clear"></div>
	</div>
	<div id="block_2">
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
			</ul>
			<div class="added-by">
				<?php
					echo $this->element('avatar',array('cache'=>false,'user'=>$inspiration,'height'=>'20'));
			 		echo "Added by ".$this->Html->link($inspiration['User']['username'],array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'profile',$inspiration['User']['username'])); 
				?>
			</div>
		</div>
		<!--- END DETAILS SECTION -->
		<br class="clear" />
		<ul>
			<li class="view-actions">
		<?php echo $this->Html->link('Source',$inspiration['Inspiration']['source_url'],array('target'=>'_blank')); ?>
			<span class="list-sep">|</span>
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
			</li>
		</ul>
		<br class="clear" />
		<?php echo $this->element('tags',array('model'=>$inspiration,'cache'=>false)); ?>
	</div>
</div>
<div>&mdash;</div>
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
<br class="clear" />
<div>&mdash;</div>
<?php
	//SOURCES
	if($inspiration['Inspiration']['private'] == 1 && $inspiration['Inspiration']['user_id'] != $authUser['User']['id']){
		$disableSourceAdding = true;
	}else{
		$disableSourceAdding = false;
	}
	echo $this->element('inspiration_sources',array('item'=>$inspiration,
													'model'=>'Inspiration',
													'disableAdding'=>$disableSourceAdding,
													'title'=>'Sources in the inspiration',
													'cache'=>false
													));
?>
<div id="inspiration-comments">
<div>&mdash;</div>
<?php
	echo $this->element('comments',array('ajax'=>false,'cache'=>false));
?>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#taggable-image').waitForImages(function() {
		//Apply css to the titles
		applyTitleEffects();
		//Position the tag map on the image relative to the where it is on the page.
		positionMap();
		//Position items and allow selection
		activateImageSelect();
	});
});

$(window).load(function() {
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
