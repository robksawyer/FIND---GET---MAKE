<?php
	/**
	 * SETTINGS
	 * @param disableMainActions The main edit, delete actions.
	 * @param disableRating Disables the rating system
	 * @param disableOwnership Disables the setting of ownership (have it, want it)
	 * @param disableOwnershipCount Disables the ownership counts (i.e. How many people want the product.)
	 * @param disableLiking Disables the liking system
	 * @param disableCollectionAdding Disables the ability to add a new collection
	 * @param disableSourceAdding Disable adding of sources
	*/
	$disableMainActions = true;
	$enableRating = true;
	$disableOwnership = true;
	$disableOwnershipCounts = true;
	$disableLiking = true;
	$disableProductDeleting = true;
	$disableProductAdding = true;
	$disableCollectionAdding = true;
	$disableInspirationAdding = true;
	$disableComments = false;
?>
<?php
	echo $this->Html->css('product-selector','stylesheet',array('inline'=>false));
?>
<style type="text/css">
#simplemodal-container {
	height:675px; 
	width:600px; 
	color:#bbb; 
	background-color:#ffffff; 
	border:4px solid #444; 
	padding:12px;
}
</style>
<div class="collections view">
<?php
	if(!empty($disableMainActions)){
		$removeDelete = true;
		$removeEdit = true;
	}
	echo $this->element('top_actions',array(
														'item'=>$collection,
														'model'=>'Collection',
														'rate'=>$enableRating,
														'removeDelete'=>$removeDelete,
														'removeEdit'=>$removeEdit,
														'cache'=>false
														));
?>
<h2><?php  
		__($collection['Collection']['name'].'&mdash;'.$collection['Collection']['total_products']." products");
		if(!empty($collection['Collection']['credit'])){
			echo "<div class='credit'>&mdash;".$collection['Collection']['credit']."</div>";
		}
		?></h2>
	<?php if(!empty($collection['Collection']['description'])): ?>
	<dl class="description">
			<?php echo "<span class='light-grey'>".$collection['Collection']['description']."</span>"; ?>
			&nbsp;
	</dl>
	<?php endif; ?>
	<div class="clear"></div>
	<?php echo $this->element('tags',array('model'=>$collection,'cache'=>false)); ?>
</div>
<div class="clear"></div>
<div class="related collection">
	<?php
		echo $this->element('collection_products',array(
																		'item'=>$collection,
																		'model'=>'Collection',
																		'client'=>true,
																		'removeDelete'=>$disableProductDeleting,
																		'cache'=>false
																		));
	?>
</div>
<div class="clear"></div>
<?php if(!empty($authUser) && empty($disableProductAdding)): ?>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Add Product', true),'javascript:return false;',array('class'=>'basic-modal-button'));?> </li>
		<li><?php echo $this->Html->link(__('Add Existing Product', true),'javascript:return false;',array('class'=>'product-selector-modal-button')); ?></li>
	</ul>
</div>
<?php endif; ?>
<?php if(!empty($authUser) && empty($disableProductAdding)): ?>
<?php
//PRODUCT SELECTOR
echo $this->element('product-selector',array(
														'cache'=>false,
														'model'=>'Collection',
														'controller'=>'collections',
														'id'=>$collection['Collection']['id'],
														'item'=>$collection,
														'products'=>$products,
														'productList'=>$productList
														));
?>
<!-- ADD PRODUCTS MODAL CONTENT -->
<div id="basic-modal-content">
	<div class="wrapper">
	<?php 
		$redirect = '/collections/view/'.$collection['Collection']['id'];
		echo $this->element('products'.DS.'add',array('cache'=>false,
																	'sourceList'=>$sourceList,
																	'productCategoryList' => $productCategoryList,
																	'collection_id'=>$collection['Collection']['id'],
																	'redirect'=>$redirect
																	)
																); 
		//echo $this->element('add_product',array('cache'=>false,'collection'=>$collection,'redirect'=>$redirect)); 
		
	?>
	</div>
</div>
<!-- preload the images -->
<div style='display:none'>
	<?php 
		echo $this->Html->image('/img/modal/x.png',array('alt'=>'Close')); 
		echo $this->Html->image('/img/modal/x_on.png',array('alt'=>'Close')); 
	?>
</div>
<!-- END ADD PRODUCTS MODAL CONTENT -->

<?php endif; ?>
<script type="text/javascript">
	// Load dialog on click
	$('.basic-modal-button').click(function (e) {
		
		//$(".chzn-select").trigger("liszt:updated");
		$('#basic-modal-content').modal({
			onShow:function(dialog){
				// Access elements inside the dialog
				// Useful for binding events, initializing other plugins, etc.
				$(".chzn-select").chosen();
				
				setupTagAutocomplete();
			}
		});
	});
</script>