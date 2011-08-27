<div class="products view">
<?php
	echo $this->element('top_actions',array(
														'item'=>$product,
														'model'=>'Product',
														'rate'=>true,
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
			if(!empty($authUser)){
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
		<div class="source"><?php
		if(!empty($product['Product']['source_url'])):
			echo $this->Html->link('Source',$product['Product']['source_url'],array('title'=>$product['Product']['source_url'],'target'=>'_blank'));
		endif;
		?>
		</div>
		</div>
		<!-- END LEFT CONTAINER -->
		<!-- START RIGHT CONTAINER -->
		<div class="right-container">
				<div class="right-sidebar">
					<?php
					echo $this->element('ownership-counts',array('model_id'=>$product['Product']['id'],
																				'model'=>'Product',
																				'cache'=>false
																				));
					echo $this->element('like-dislike',array('model_id'=>$product['Product']['id'],
																			'model'=>'Product',
																			'cache'=>false
																			));
					?>
				</div>
				<!--- DETAILS SECTION -->
				<div class="details">
					<h3 class="header"><?php 
							__($product['Product']['name']);
							if(!empty($product['Source']['name'])){
								echo "<span class='light-grey'> &mdash;".$this->Html->link($product['Source']['name'], array('controller' => 'sources', 'action' => 'view', $product['Source']['id']))."</span>";
							}
						?></h3>
					<ul>
						<?php if(!empty($product['Product']['description'])): ?>
							<li class="description">
							<?php echo $product['Product']['description']; ?>
							</li>
						<?php endif; ?>
						<li class="designer">
							<?php if(!empty($product['Product']['designer'])): ?>
							<?php echo "Designed by ".$product['Product']['designer']; ?>
							<?php endif; ?>
						</li>
						<li class="category">
						<?php if(!empty($product['ProductCategory']['name'])){
							echo "Category:  ".$this->Html->link(ucwords($product['ProductCategory']['name']),array('controller'=>'product_categories','action'=>'view',$product['ProductCategory']['id']),array('title'=>$product['ProductCategory']['name']));
						} ?>
						</li>
						<li class="price">
						<?php if(!empty($product['Product']['price'])){
							echo "Price: ".$product['Product']['price'];
						} ?>
						</li>
						<li class="source">
						<?php
						if(!empty($product['Product']['purchase_url'])){
							echo $this->Html->link('Buy',$product['Product']['purchase_url'],array('title'=>$product['Product']['purchase_url'],'target'=>'_blank'));
						}
						?>
						</li>
						<li class="found-by">
							Found by <?php echo $this->Html->link($product['User']['username'],array('plugin'=>'forum','controller'=>'users','action'=>'profile',$product['User']['username'])); ?>
						</li>
					</ul>
				</div>
				<!--- END DETAILS SECTION -->
				<?php echo $this->element('tags',array('model'=>$product,'cache'=>false)); ?>
				<div class="clear"></div>
				<?php 
					echo $this->element('social-buttons',array(
																			'controller'=>'products',
																			'keycode'=>$product['Product']['keycode'],
																			'cache'=>false
																			));
					echo $this->element('share-buttons',array('controller'=>'products',
																			'keycode'=>$product['Product']['keycode'],
																			'cache'=>false
																			));
				?>
			<?php 
				//Related inspirations
				echo $this->element('inspirations',array('item'=>$product,'model'=>'Product','cache'=>false));
				
				//Related collections
				echo $this->element('collections',array('item'=>$product,'model'=>'Product','cache'=>false));
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
													'cache'=>false
													));
?>
<div class="clear"></div>
<?php
//Ownerships
echo $this->element('ownership-extended-counts',array('model'=>'Product','model_id'=>$product['Product']['id'],'cache'=>false));
?>
<div class="bar">&nbsp;</div>
<?php echo $this->element('comments',array('cache'=>false,'disable'=>false)); ?>