<div id="page-wrapper" class="products view">
	<!-- START TOP CONTAINER -->
	<div id="block_1">
		<?php	echo $this->element('top_actions',array(
																'item'=>$product,
																'model'=>'Product',
																'rate'=>false,
																'cache'=>false
																)); ?>
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
			<?php endif; ?>
		</div>
		<?php echo $this->element('dot',array('cache'=>false,'model'=>'Product','model_id'=>$product['Product']['id'])); ?>
	</div>
	<div id="block_2">
		<h3 class="header">
			<?php if(!empty($product['ProductCategory']['name'])){
				echo $this->Html->link(ucwords($product['ProductCategory']['name']),array('controller'=>'product_categories','action'=>'view',$product['ProductCategory']['id']),array('title'=>$product['ProductCategory']['name'],'class'=>'category')).' &rarr; ';
			} ?>
			<?php 
				__($product['Product']['name']);
				if(!empty($product['Source']['name'])){
					echo "<span class='light-grey'> &rarr; ".$this->Html->link(__($product['Source']['name'],true), array('controller' => 'sources', 'action' => 'view', $product['Source']['id']))."</span>";
				}
			?>
		</h3>
		<div class="added-by">
			<?php
				echo $this->element('avatar',array('cache'=>false,'user'=>$product,'height'=>'20'));
		 		echo "Found by ".$this->Html->link($product['User']['username'],array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'profile',$product['User']['username']));
				if(count($product['Storage']) > 0){
					$users_storing = array();
					foreach($product['Storage'] as $storage){
						if($storage['user_id'] != $product['User']['id']){
							$users_storing[] = $storage;
						}
					}
					if(count($users_storing) > 0){
						if(count($users_storing) == 1){
							echo ' and added by '.$this->Html->link(count($users_storing).' user.','#user_items_block');
						}else{
							echo ' and added by '.$this->Html->link(count($users_storing).' users.','#user_items_block');
						}
					}
				}
			?>
		</div>
		<!--- DETAILS SECTION -->
		<div class="details">
			<ul>
				<?php if(!empty($product['Product']['description'])): ?>
					<li class="description">
					<?php echo $product['Product']['description']; ?>
					<div class="mdash">&mdash;&mdash;</div>
					</li>
				<?php endif; ?>
				<li class="designer">
					<?php if(!empty($product['Product']['designer'])): ?>
					<?php echo "Designed by ".$product['Product']['designer']; ?>
					<?php endif; ?>
				</li>
				<li class="price">
				<?php 
				if(!empty($product['Product']['price'])){ 
					echo "Price: ".$product['Product']['price'];
				} 
				?>
				</li>
				<li class="view-actions">
					<?php
					if(!empty($product['Product']['purchase_url'])){ 
						if(!empty($product['Product']['price'])) echo " &mdash; <br/>";
						echo $this->Html->link('Buy',$product['Product']['purchase_url'],
																array(
																	'title'=>$product['Product']['purchase_url'],'target'=>'_blank','class'=>'buy'
																))."<span class='list-sep'>|</span>"; 
						}
						/*echo $this->element('social-buttons',array(
																				'controller'=>'products',
																				'keycode'=>$product['Product']['keycode'],
																				'cache'=>false
																				));*/
						if(!empty($product['Product']['source_url'])):
							echo $this->Html->link('Source',$product['Product']['source_url'],array('title'=>$product['Product']['source_url'],'target'=>'_blank','class'=>'source'))."<span class='list-sep'>|</span>";
						endif;
						if(!empty($authUser)):
							//Replace the name if the user already has the item
							$isOwner = false;
							foreach($product['Ownership'] as $ownership){
								if($ownership['user_id'] == $authUser['User']['id']){
									$isOwner = true;
								}
							}
							if($isOwner){
								$ownership_title = "You own it.";
								$have_it = 1;
							}else{
								$ownership_title = "Have it?";
								$have_it = 0;
							}
							echo $this->Js->link($ownership_title,array('ajax'=>true,
																						'admin'=>false,
																						'controller'=>'ownerships',
																						'action'=>'toggle_ownership',
																						'Product',$product['Product']['id']),
																					array('title'=>$ownership_title,
																							'class'=>'have-it',
																							'success'=>'fgm_api.ownershipSuccess(data);'
																						)
																					);
							echo "<span class='list-sep'>|</span>";
						endif;
						echo $this->element('share-buttons',array('controller'=>'products',
																				'keycode'=>$product['Product']['keycode'],
																				'cache'=>false
																				));
					?>
				</li>
			</ul>
		</div>
		<!--- END DETAILS SECTION -->
		<?php echo $this->element('tags',array('model'=>$product,'cache'=>false)); ?>
	</div>
	<div id="block_bottom">
		<div id="product-comments" class="inner-block">
			<?php
				echo $this->element('comments',array('ajax'=>false,'cache'=>false));
			?>
		</div>
		<?php if(!empty($product['Source']['name'])): ?>
		<div class="mdash">&mdash;</div>
		<div id="related_source_block" class="inner_block">
			<h4>Other products from <?php echo $this->Html->link(__($product['Source']['name'],true), array('controller' => 'sources', 'action' => 'view', $product['Source']['id'])); ?></h4>
			<?php
				echo $this->element('related-products-grid-block',array('cache'=>false,'items'=>$relatedProducts));
			?>
		</div>
		<?php	endif; ?>
		<?php if(!empty($otherProducts)): ?>
		<div class="mdash">&mdash;</div>
		<div id="other_items_block" class="inner_block">
			<h4>Other products you might like</h4>
			<?php
				echo $this->element('related-products-grid-block',array('cache'=>false,'items'=>$otherProducts));
			?>
		</div>
		<?php	endif; ?>
		<?php if(!empty($usersStoring)): ?>
		<div class="mdash">&mdash;</div>
		<div id="user_items_block" class="inner_block">
			<?php if(count($usersStoring) == 1): ?>
			<h4>This product was added by <?php echo count($usersStoring); ?> user</h4>
			<?php else: ?>
			<h4>This product was added by <?php echo count($usersStoring); ?> users</h4>
			<?php endif; ?>
			<?php
				//debug($usersStoring);
				foreach($usersStoring as $user){
					echo "<div class='user-item'>";
					//debug($user);
					echo $this->element('user-block-with-products',array('cache'=>false,'user'=>$user,'follow'=>true));
					echo "</div>";
				}
			?>
		</div>
		<?php	endif; ?>
		<?php 
			//Related inspirations
			//echo $this->element('inspirations',array('item'=>$product,'model'=>'Product','cache'=>false));
			
			//Related collections
			//echo $this->element('collections',array('item'=>$product,'model'=>'Product','cache'=>false));
		?>
	</div>
	<!-- END BOTTOM CONTAINER -->
</div>
<div class="clear"></div>