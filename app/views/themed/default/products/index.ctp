<?php
	// set url arguements
	$this->Paginator->options(array('url' =>  array($filter)));
	if(!empty($this->params['named']['by'])){
		$this->Paginator->options(array('url' => $this->passedArgs));
	}
	
	//Replace the Source paging array if a Tagged array exists
	if(!empty($this->Paginator->params['paging']['Tagged'])){
		$this->Paginator->params['paging']['Product'] = $this->Paginator->params['paging']['Tagged'];
	}
	
	echo $this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<div id="left-panel-index">
	<?php
		//Index Box Ad (300x250)
		echo $this->element('index-box-ad',array('cache'=>false));
		
		//Rating sorter
		echo $this->element('product-sorter',array('cache'=>false));
		
		if(empty($this->params['named']['by'])){
			//Alphabet sorter
			echo $this->element('alphabet-sorter',array('cache'=>false));
		}
		
		//Category sorter
		echo $this->element('product-category-sorter',array('cache'=>false,'productCategories'=>$productCategories));
		
		//Designer sorter
		//echo $this->element('designer-sorter',array('cache'=>false));
	?>
</div>
<div id="right-panel">
	<div class="products index">
		<div class="header red"><?php 
			if(empty($this->params['named']['by'])){
				__('Products ('.$total_count.')');
			}else{
				__('Products tagged [ '.$this->params['named']['by'].' ]');
			}
		?></div>
		<div class="clear"></div>
		<h4>Adding a product is an easy way to keep track of an item you’ve been wanting to buy or use in a space.</h4>
		<?php
		if(!empty($products)):
		?>
		<!-- Start gridded items -->
		<div id="grid-container">
		<?php
		$i = 0;
		foreach ($products as $product):
			
		?>
			<div class="grid-item">
				<?php 
					if(!empty($product['Attachment'][0]['path_med'])){
						echo $this->Html->image($product['Attachment'][0]['path_med'],array('alt'=>'','url'=>array('action'=>'view',$product['Product']['id']))); 
					}
				?>
				<div class="title"><?php echo $this->Html->link(__($product['Product']['name'],true),array('controller'=>'products','action'=>'view',$product['Product']['id'])); ?></div>
				<div class="description"><?php echo $this->Text->truncate($product['Product']['description'],250); ?></div>
				<?php if(!empty($product['Product']['designer'])) echo "<div class='designer'>Designed by ".$product['Product']['designer']."</div>"; ?>
				<div class="designer"><?php echo "Found by ".$this->Html->link(__($product['User']['username'],true),array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'profile',$product['User']['username'])); ?></div>
				<div class="bottom-detail">
					<span class="date"><?php echo $this->Time->niceShort($product['Product']['created'],null,null)." / "; ?>&nbsp;</span>
					<span class="tags"><?php
						//Build a tag list of only two tags.
						$limit = 2;
						$counter = 0;
						//debug($product['Tag']);
						if(!empty($product['Tag'])){
							foreach($product['Tag'] as $tag){
								if($counter == $limit) break;
						
								if($counter == ($limit - 1) || count($product['Tag']) < 2){
									echo $this->Html->link(__($tag['name'],true),array('controller'=>'products','action'=>'index/by:'.$tag['keyname']));
								}else{
									echo $this->Html->link(__($tag['name'],true),array('controller'=>'products','action'=>'index/by:'.$tag['keyname'])).", ";
								}

								$counter++;
							}
						}
					?></span>
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
		<!-- End Paging -->
		
		<div class="actions">
			<ul>
				<li><?php //echo $this->Html->link(__('New Product', true), array('action' => 'add','admin'=>true)); ?></li>
			</ul>
		</div>
		<?php else: ?>
			
		<? endif;?>
	</div>
</div>
<script type="text/javascript">
$(function(){
	var $container = $("#grid-container");
	$container.imagesLoaded(function(){
		$container.masonry({
			//option
			itemSelector: '.grid-item'
		});
	});
});
</script>