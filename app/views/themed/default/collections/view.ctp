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
<div id="right-sidebar">
	<?php
	echo $this->element('like-dislike',array('model_id'=>$collection['Collection']['id'],
															'model'=>'Collection',
															'cache'=>false
															));
	?>
	<div class="added-by" style="text-align:center">
		<?php
			echo $this->element('avatar',array('cache'=>false,'user'=>$collection,'height'=>'32'));
	 		echo "Added by ".$this->Html->link($collection['User']['username'],array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'profile',$collection['User']['username'])); 
		?>
	</div>
</div>
<div id="block_2">
	<h2><?php  
			if($collection['Collection']['total_products'] > 1) $ending = "products."; else $ending = "product.";
			__($collection['Collection']['name']." <span class='includes'>includes ".$collection['Collection']['total_products']." ".$ending."</span>");
			if(!empty($collection['Collection']['credit'])){
				echo "<div class='credit'>&mdash; ".$collection['Collection']['credit']."</div>";
			}
			?></h2>
		<?php if(!empty($collection['Collection']['description'])): ?>
		<div class="description">
				<?php echo "<span class='light-grey'>".$collection['Collection']['description']."</span>"; ?>
				&nbsp;
		</div>
		<?php endif; ?>
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
</div>
<div class="mdash">&mdash;&mdash;</div>
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
<?php 
if(!empty($authUser)): 
	if(!$disableProductAdding):
?>	
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Add Existing Product', true),'javascript:return false;',array('class'=>'product-selector-modal-button')); ?></li>
			</ul>
		</div>
<?php 
	endif;
endif; 
?>
<div id="collection-comments" class="inner-block">
	<?php
		echo $this->element('comments',array('ajax'=>false,'cache'=>false));
	?>
</div>
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
<!-- preload the images -->
<div style='display:none'>
	<?php 
		echo $this->Html->image('/img/modal/x.png',array('alt'=>'Close')); 
		echo $this->Html->image('/img/modal/x_on.png',array('alt'=>'Close')); 
	?>
</div>
<!-- END ADD PRODUCTS MODAL CONTENT -->
<?php endif; ?>
