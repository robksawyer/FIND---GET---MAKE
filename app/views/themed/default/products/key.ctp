<?php
	/**
	 * SETTINGS
	 * @param disableMainActions The main edit, delete actions.
	 * @param disableRating Disables the rating system
	 * @param disableOwnership Disables the setting of ownership (have it, want it)
	 * @param disableOwnershipCount Disables the ownership counts (i.e. How many people want the product.)
	 * @param disableLiking Disables the liking system
	 * @param disableCategoryLink Disables the link to the category index view
	 * @param disableAttachmentDeleting Disable deleting of attachments
	 * @param disableAttachmentAdding Disable adding of attachments
	 * @param disableCollectionAdding Disables the ability to add a new collection
	 * @param disableSourceAdding Disable adding of sources
	*/
	$disableMainActions = true;
	$enableRating = true;
	$hideTags = true;
	$disableOwnership = true;
	$disableOwnershipCounts = true;
	$disableLiking = true;
	$disableCategoryLink = true;
	$disableProductDeleting = true;
	$disableAttachmentDeleting = true;
	$disableAttachmentAdding = true;
	$disableSourceAdding = true;
	$disableCollectionAdding = true;
	$disableInspirationAdding = true;
	$disableComments = false;
?>
<div class="products view">
<?php
	if(!empty($disableMainActions)){
		$removeDelete = true;
		$removeEdit = true;
	}
	echo $this->element('top_actions',array(
														'item'=>$product,
														'model'=>'Product',
														'rate'=>$enableRating,
														'removeDelete'=>$removeDelete,
														'removeEdit'=>$removeEdit,
														'cache'=>false
														));
?>
	<!-- START LEFT CONTAINER -->
	<div class="left-container">
		<?php if (!empty($product['Attachment'][0])):?>
			<div class="image">
			<?php 
					echo $this->Html->image($product['Attachment'][0]['path'],
														array(
															'alt'=>$product['Product']['name'],
															'url'=>$product['Product']['source_url'],
															'id'=>'attachment0',
															'width'=>$product['Attachment'][0]['width']
															)
														);
			?>
			</div>
			<?php
			if(!empty($authUser) && empty($disableOwnership)){
				echo $this->element('set-ownership',array('data'=>$product['Product'],
																		'user_id'=>$authUser['User']['id'],
																		'model_id'=>$product['Product']['id'],
																		'model'=>'Product',
																		'cache'=>false
																		));
			}
			?>
			<div class="clear"></div>
		<?php endif; ?>
		</div>
		<!-- END LEFT CONTAINER -->
		
		<!-- START RIGHT CONTAINER -->
		<div class="right-container">
				<div class="right-sidebar">
					<?php
					if(empty($disableOwnershipCounts)){
						echo $this->element('ownership-counts',array('model_id'=>$product['Product']['id'],
																					'model'=>'Product',
																					'cache'=>false
																					));
					}
					if(empty($disableLiking)){
						echo $this->element('like-dislike',array('data'=>$product['Product'],
																				'model'=>'Product',
																				'cache'=>false
																				));
					}
					?>
				</div>
				<!--- DETAILS SECTION -->
				<div class="details">
					<h3 class="header"><?php 
							__($product['Product']['name']);
							if(!empty($product['Source']['name'])){
								//Check to see if the keycode exists
								if(!empty($product['Source']['keycode'])){
									echo "<span class='light-grey'> &mdash;".$this->Html->link($product['Source']['name'], array('controller' => 'sources', 'action' => 'key', $product['Source']['keycode']))."</span>";
								}else{
									//Generate a keycode for the source
									echo "<span class='light-grey'> &mdash;".$this->Html->link($product['Source']['name'], array('controller' => 'sources', 'action' => 'generateKeycode', $product['Source']['id']))."</span>";
								}
							}
						?></h3>
					<ul>
						<li class="designer">
							<?php if(!empty($product['Product']['designer'])): ?>
							<?php echo "Designed by ".$product['Product']['designer']; ?>
							<?php endif; ?>
						</li>
						<li class="category">
						<?php if(!empty($product['ProductCategory']['name'])){
							if(empty($disableCategoryLink)){
								echo "Category: ".$this->Html->link(ucwords($product['ProductCategory']['name']),array('controller'=>'product_categories','action'=>'view',$product['ProductCategory']['id']),array('title'=>$product['ProductCategory']['name']));
							}else{
								echo "Category: ".ucwords($product['ProductCategory']['name']);
							}
							
						} ?>
						</li>
						<li class="price">
						<?php if(!empty($product['Product']['price'])){
							echo "Price: ".$product['Product']['price'];
						} ?>
						</li>
						<?php if(!empty($product['Product']['description'])): ?>
							<li class="description">
							<?php echo $product['Product']['description']; ?>
							</li>
						<?php endif; ?>
						<li class="source">
						<?php
						if(!empty($product['Product']['purchase_url'])){
							echo "Buy it:".$this->Html->link($string->truncate($product['Product']['purchase_url']),$product['Product']['purchase_url'],array('title'=>$product['Product']['purchase_url'],'target'=>'_blank'));
						}
						?>
						</li>
						<li class="source"><?php
						if(!empty($product['Product']['source_url'])):
							echo "Source:". $this->Html->link($string->truncate($product['Product']['source_url']),$product['Product']['source_url'],array('title'=>$product['Product']['source_url'],'target'=>'_blank'));
						endif;
						?>
						</li>
					</ul>
					<?php echo $this->element('social-buttons',array('cache'=>false)); ?>
				</div>
				<!--- END DETAILS SECTION -->
				<?php 
					if(empty($hideTags)){
						echo $this->element('tags',array('model'=>$product,'cache'=>false)); 
					}
				?>
				<div class="clear"></div>
			<?php 
				//Related inspirations
				echo $this->element('inspirations',array(
																		'item'=>$product,
																		'model'=>'Product',
																		'disableAdding'=>$disableInspirationAdding,
																		'client'=>true,
																		'cache'=>false
																		));
				
				//Related collections
				echo $this->element('collections',array(
																	'item'=>$product,
																	'model'=>'Product',
																	'disableAdding'=>$disableCollectionAdding,
																	'client'=>true,
																	'cache'=>false
																	));
			?>
		</div>
		<!-- END RIGHT CONTAINER -->
		<div class="clear"></div>
</div>
<div class="clear"></div>
<?php
//ATTACHMENTS
echo $this->element('attachments',array('item'=>$product,
													'model'=>'Product',
													'controller'=>'products',
													'removeFirst'=>true,
													'client'=>true,
													'disableDeleting'=>$disableAttachmentDeleting,
													'disableAdding'=>$disableAttachmentAdding,
													'cache'=>false
													));
?>
<div class="clear"></div>
<?php
	//Ownerships
	if(empty($disableOwnershipCounts)){
		echo $this->element('ownership-extended-counts',array('model'=>'Product','model_id'=>$product['Product']['id'],'cache'=>false));
	}
?>
<div class="bar">&nbsp;</div>
<?php 
	if(empty($disableComments)){
		echo $this->element('comments',array('cache'=>false,'disable'=>false));
	}
?>