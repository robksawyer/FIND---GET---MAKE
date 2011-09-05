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
	echo $this->element('top_actions',array('item'=>$collection,'model'=>'Collection','rate'=>true,'cache'=>false));
?>
<h2><?php  
		__($collection['Collection']['name']." <span class='includes'>includes ".$collection['Collection']['total_products']." product(s)</span>");
		if(!empty($collection['Collection']['credit'])){
			echo "<div class='credit'>&mdash;".$collection['Collection']['credit']."</div>";
		}
		?></h2>
	<div class="right-sidebar">
		<?php
		echo $this->element('like-dislike',array('model_id'=>$collection['Collection']['id'],
																'model'=>'Collection',
																'cache'=>false
																));
		?>
	</div>
	<?php if(!empty($collection['Collection']['description'])): ?>
	<div class="description">
			<?php echo "<span class='light-grey'>".$collection['Collection']['description']."</span>"; ?>
			&nbsp;
	</div>
	<?php endif; ?>
	<div class="added-by">
		<?php echo "Added by ".$this->Html->link($collection['User']['username'],array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'profile',$collection['User']['username'])); ?>
	</div>
	<br/>
	<div class="sharing">
	<?php 
		echo $this->element('share-buttons',array('controller'=>'collections',
																'keycode'=>$collection['Collection']['keycode'],
																'cache'=>false
																));
		echo $this->element('social-buttons',array(
																'controller'=>'collections',
																'keycode'=>$collection['Collection']['keycode'],
																'cache'=>false
																));
	?>
	</div>
	<div class="clear"></div>
	<?php echo $this->element('tags',array('model'=>$collection,'cache'=>false)); ?>
</div>
<div class="clear"></div>
<div class="related collection">
	<?php
		//Check to see if the inspiration is private. Make sure that the user who owns this isn't viewing it.
		if($collection['Collection']['private'] == 1 && $collection['Collection']['user_id'] != $authUser['User']['id']){
			$disableProductAdding = true;
			$disableProductDeleting = true;
		}else{
			$disableProductAdding = false;
			$disableProductDeleting = false;
		}
		
		echo $this->element('collection_products',array('item'=>$collection,
																		'model'=>'Collection',
																		'removeDelete'=>$disableProductDeleting,
																		'cache'=>false
																		));
	?>
</div>
<div class="clear"></div>
<?php 
if(!empty($authUser)): 
	if(!$disableProductAdding):
?>	
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Add Product', true),'javascript:return false;',array('class'=>'add-product-modal-button'));?> </li>
				<li><?php echo $this->Html->link(__('Add Existing Product', true),'javascript:return false;',array('class'=>'product-selector-modal-button')); ?></li>
			</ul>
		</div>
<?php 
	endif;
endif; 
?>
<?php if(!empty($authUser)): ?>
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
<div id="add-product-modal-button" style="display:none">
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
	$('.add-product-modal-button').click(function (e) {
		
		//$(".chzn-select").trigger("liszt:updated");
		$('#add-product-modal-button').modal({
			onShow:function(dialog){
				// Access elements inside the dialog
				// Useful for binding events, initializing other plugins, etc.
				$(".chzn-select").chosen();
				
				setupTagAutocomplete();
			}
		});
	});
</script>
