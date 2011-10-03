<div class="sources view">
	<?php
		echo $this->element('top_actions',array('item'=>$source,'model'=>'Source','rate'=>true,'cache'=>false));
	?>
	<div id="right-sidebar">
		<?php
		echo $this->element('like-dislike',array('model_id'=>$source['Source']['id'],
																'model'=>'Source',
																'cache'=>false
																));
		?>
	</div>
	<div id="block_1">
		<h3><?php 
					__($source['Source']['name']);
					if(!empty($source['SourceCategory']['name'])){
						echo "<span class='light-grey'> &mdash; ".$this->Html->link(__($source['SourceCategory']['name'],true),array('controller'=>'source_categories','action'=>'view',$source['SourceCategory']['id']))."</span>";
					}
					if(!empty($source['Source']['url'])):
						echo "<br/>&#x21B3;"."<span class='link'>".$this->Html->link($source['Source']['url'],$source['Source']['url'],array('target'=>'_blank'))."</span>";
					endif;
				?></h3>
	</div>
	<div id="block_2">
		<!--- DETAILS SECTION -->
		<div class="details">
			<ul>
			<?php if(!empty($source['Source']['description'])): ?>
				<li class="description">
					<?php echo $source['Source']['description']; ?>
					<div class="mdash">&mdash;&mdash;</div>
				</li>
			<?php endif; ?>
			<?php if(!empty($source['User']['username'])): ?>
				<li class="added-by">
					<?php
						echo $this->element('avatar',array('cache'=>false,'user'=>$source,'height'=>'20'));
				 		echo "Found by ".$this->Html->link($source['User']['username'],array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'profile',$source['User']['username']));
						/*if(count($source['Storage']) > 0){
							$users_storing = array();
							foreach($source['Storage'] as $storage){
								if($storage['user_id'] != $source['User']['id']){
									$users_storing[] = $storage;
								}
							}
							if(count($users_storing) > 0){
								echo ' and '.count($users_storing).' others.';
							}
						}*/
					?>
				</li>
			<?php else: ?>
				<li class="added-by"><?php echo "Found by unknown"; ?></li>
			<?php endif; ?>
			<?php echo $this->element('tags',array('model'=>$source,'cache'=>false)); ?>
				<li class="mdash">&mdash;</li>
				<li class="address">
					<h3><?php echo __('Address',true); ?></h3>
					<ul>
						<li>
							<?php 
							//__('Address: '); 
							echo $source['Source']['address1']; 
							?>
						</li>
						<?php 
						if(!empty($source['Source']['address2'])): 
						?>
						<li>
						<?php 
							//__('Address2: ');
							echo $source['Source']['address2']; 
						?>
						</li>
						<?php endif; ?>
						<li>
						<?php 
							//__('City: '); 
							echo $source['Source']['city'];
							?>
						</li>
						<li>
						<?php 
							//__('State: ');
							echo $source['Source']['state']; 
						?>
						</li>
						<li>
							<?php 
								//__('Zip: '); 
								echo $source['Source']['zip']; 
							?>
						</li>
						<li>
							<?php 
							//__('Country: ');
							//echo $this->Html->link($source['Country']['name'], array('controller' => 'countries', 'action' => 'view', $source['Country']['id'])); 
							echo $source['Country']['name'];
							?>
						</li>
					</ul>
				</li>
				<li class="mdash">&mdash;</li>
				<li class="contact">
					<h3><?php echo __('Contact',true); ?></h3>
					<ul>
						<li>
							<?php 
							__('Phone: ');
							echo $source['Source']['phone']; 
							?>
						</li>
					<?php if(!empty($source['Source']['fax'])): ?>
						<li>
							<?php 
							__('Fax: '); 
							echo $source['Source']['fax']; 
							?>
						</li>
					<?php endif; ?>
						<li>
							<?php 
							__('Email: '); 
							echo $this->Html->link($source['Source']['email'],'mailto:'.$source['Source']['email']); 
							?>
						</li>
					</ul>
				</li>
				<li class="mdash">&mdash;</li>
				<li class="view-actions">
				<?php 
					echo $this->element('share-buttons',array('controller'=>'sources',
																			'keycode'=>$source['Source']['keycode'],
																			'cache'=>false
																			));
					echo $this->element('social-buttons',array(
																			'controller'=>'sources',
																			'keycode'=>$source['Source']['keycode'],
																			'cache'=>false
																			));
				?>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php 
	//Related products
	if(!empty($source['Product'])){
		echo $this->element('products',array('item'=>$source,'model'=>'Source','title'=>'Products from this source','cache'=>false));
	}
	//Related inspirations
	//echo $this->element('inspirations',array('item'=>$source,'title'=>'Inspirations that use this source.','model'=>'Source','cache'=>false));
	
	if(Configure::read('FGM.private_solution') == 1){
		//CONTRACTORS
		echo $this->element('contractors',array('item'=>$source,'model'=>'Source','cache'=>false));
	}
	
	//ATTACHMENTS
	//echo $this->element('attachments',array('item'=>$source,'model'=>'Source','controller'=>'sources','cache'=>false));
?>
<?php //debug($source); ?>
<div class="clear"></div>
<div id="source-comments">
<?php
	echo $this->element('comments',array('ajax'=>false,'cache'=>false));
?>
</div>