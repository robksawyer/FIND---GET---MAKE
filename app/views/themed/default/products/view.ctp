<div class="products view">
<?php
	echo $this->element('top_actions',array(
														'item'=>$product,
														'model'=>'Product',
														'rate'=>true,
														'cache'=>false
														));
?>
	<!-- START TOP CONTAINER -->
	<div id="view-container-top">
		<h3 class="header"><?php 
				__($product['Product']['name']);
				if(!empty($product['Source']['name'])){
					echo "<span class='light-grey'> &mdash; ".$this->Html->link($product['Source']['name'], array('controller' => 'sources', 'action' => 'view', $product['Source']['id']))."</span>";
				}
			?></h3>
		<div id="right-sidebar">
			<?php
			echo $this->element('like-dislike',array('model_id'=>$product['Product']['id'],
																	'model'=>'Product',
																	'cache'=>false
																	));
			echo $this->element('ownership-counts',array('model_id'=>$product['Product']['id'],
																		'model'=>'Product',
																		'cache'=>false
																		));
			?>
			
			<div class="added-by" style="text-align:center">
				<?php
					echo $this->element('avatar',array('cache'=>false,'user'=>$product,'height'=>'32'));
			 		echo "Found by ".$this->Html->link($product['User']['username'],array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'profile',$product['User']['username']));
				?>
			</div>
		</div>
		<div id="attachment-container">
			<?php if (!empty($product['Attachment'][0])):?>
				<div class="image">
				<?php 
						echo $this->Html->image($product['Attachment'][0]['path'],
															array(
																'alt'=>$product['Product']['name'],
																'url'=>$product['Product']['source_url'],
																'id'=>'attachment0',
																//'width'=>$product['Attachment'][0]['width']
																)
															);
				?>
				</div>
				<div class="clear"></div>
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
		<!-- START RIGHT CONTAINER -->
		<div id="right-container">
				<!--- DETAILS SECTION -->
				<div class="details">
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
						<?php 
						if(!empty($product['Product']['price'])){ 
							echo "Price: ".$product['Product']['price'];
						} 
						if(!empty($product['Product']['purchase_url'])){ 
							echo " &mdash; ".$this->Html->link('Buy',$product['Product']['purchase_url'],
																	array(
																		'title'=>$product['Product']['purchase_url'],'target'=>'_blank'
																	)); 
							}
						?>
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
		</div>
		<!-- END RIGHT CONTAINER -->
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<div id="view-container-bottom">
		<?php 
			//Related inspirations
			echo $this->element('inspirations',array('item'=>$product,'model'=>'Product','cache'=>false));
			
			//Related collections
			echo $this->element('collections',array('item'=>$product,'model'=>'Product','cache'=>false));
		?>
		<div class="clear"></div>
	</div>
	<!-- END BOTTOM CONTAINER -->
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