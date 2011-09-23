<?php
	if(!empty($this->params['named']['by'])){
		$this->Paginator->options(array('url' => $this->passedArgs));
	}
	//Replace the Source paging array if a Tagged array exists
	if(!empty($this->Paginator->params['paging']['Tagged'])){
		$this->Paginator->params['paging']['Collection'] = $this->Paginator->params['paging']['Tagged'];
	}
?>
<div id="left-panel-index">
	<?php
		//Index Box Ad (300x250)
		echo $this->element('index-box-ad',array('cache'=>false));
		
		//Collection sorter
		echo $this->element('collection-sorter',array('cache'=>false));
		
		if(empty($this->params['named']['by'])){
			//Alphabet sorter
			echo $this->element('alphabet-sorter',array('cache'=>false));
		}

		//Designer sorter
		//echo $this->element('designer-sorter',array('cache'=>false));
	?>
</div>
<div id="right-panel">
	<div class="collections index">
		<div class="header red"><?php 
			if(empty($this->params['named']['by'])){
				__('Collections');
			}else{
				__('Collections tagged [ '.$this->params['named']['by'].' ]');
			}
		?></div>
		<div class="clear"></div>
		<h4>Things you’ve grouped together for any reason or season: that’s a collection.</h4>
		<?php
		if(!empty($collections)): 
		?>
		<!-- Start gridded items -->
		<div id="grid-container">
		<?php
		$i = 0;
		foreach ($collections as $collection):
		
		?>
			<div class="grid-item">
				<?php 
					//debug($collection);
					//Check to see if there are any products in the collection
					if(!empty($collection['Product'])){
						//Loop through 5 collection images and add those to a collage
						$limit = 4;
						//debug($collection['Product'][$i]);
						for($i=0;$i<count($collection['Product']);$i++){
							if(!empty($collection['Product'][$i]['Attachment'][0])){
								if($i < $limit){
									if(count($collection['Product']) > 1){
										echo $this->Html->image($collection['Product'][$i]['Attachment'][0]['path_small'],array(
																																						'alt'=>'',
																																						'url'=>array(
																																							'action'=>'view',
																																							$collection['Collection']['id']
																																							),
																																						'style'=>'max-height: 75px;padding:5px;'
																																						));
									}else{
										echo $this->Html->image($collection['Product'][$i]['Attachment'][0]['path_med'],array(
																																						'alt'=>'',
																																						'url'=>array(
																																							'action'=>'view',
																																							$collection['Collection']['id']
																																							),
																																						'style'=>'max-height: 200px'
																																						));
									}
								
								}else{
									break;
								}
							}
						}
					}
				?>
				<br/>
				<div class="title"><?php echo $this->Html->link($collection['Collection']['name'],array('controller'=>'collections','action'=>'view',$collection['Collection']['id'])); ?></div>
				<div class="description"><?php echo $this->String->truncate($collection['Collection']['description'],350); ?></div>
				<?php if(!empty($collection['Collection']['credit'])) echo "<div class='designer'>Credit: ".$collection['Collection']['credit']."</div>"; ?>
					<div class="designer"><?php echo "Added by ".$this->Html->link($collection['User']['username'],array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'profile',$collection['User']['username'])); ?></div>
				<div class="bottom-detail">
					<span class="date"><?php echo $this->Time->niceShort($collection['Collection']['created'],null,null); ?>&nbsp;</span>
					<span class="tags"><?php
						//Build a tag list of only two tags.
						$limit = 2;
						$counter = 0;
						//debug($collection['Tag']);
						if(!empty($collection['Tag'])){
							echo " / ";
							foreach($collection['Tag'] as $tag){
								if($counter == $limit) break;
					
								if($counter == ($limit - 1) || count($collection['Tag']) < 2){
									echo $this->Html->link($tag['name'],array('controller'=>'collections','action'=>'index/by:'.$tag['keyname']));
								}else{
									echo $this->Html->link($tag['name'],array('controller'=>'collections','action'=>'index/by:'.$tag['keyname'])).", ";
								}

								$counter++;
							}
						}
					?></span>
					<?php if(!empty($collection['Collection']['private'])): ?>
					<div class="lock"><?php echo $this->Html->image('icons/lock.png',array('alt'=>'PRIVATE','title'=>'This collection is private.','height'=>'16')); ?></div>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
		<div class="clear"></div>
		<!-- End gridded items -->
	
		<!-- Paging -->
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
		));
		?>	</p>

		<div class="paging">
			<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
		 | 	<?php echo $this->Paginator->numbers();?>
	 |
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		</div>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('New Collection', true), array('action' => 'add','admin'=>true)); ?></li>
			</ul>
		</div>
		<?php else: ?>
			
		<?php endif; ?>
	</div>
</div>