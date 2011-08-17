<!--
	TODO Build a page that shows the likes for products and sources and anything else.
-->
<?php
	$this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<div class="left-container">
	<?php
		//Rating sorter
		//echo $this->element('product-sorter',array('cache'=>false));
		
		//Alphabet sorter
		//echo $this->element('alphabet-sorter',array('cache'=>false));
		
		//Category sorter
		//echo $this->element('product-category-sorter',array('cache'=>false,'productCategories'=>$productCategories));
		
		//Designer sorter
		//echo $this->element('designer-sorter',array('cache'=>false));
		
		//Index Box Ad (300x250)
		echo $this->element('index-box-ad',array('cache'=>false));
	?>
</div>
<div class="right-container-index">
	<div class="products index">
		<div class="header red"><?php 
			__('Products liked by '.$user['User']['username']);
		?></div>
		
		<!-- Start gridded items -->
		<div id="grid-container">
		<?php
		if(!empty($products)):
		$i = 0;
		foreach ($products as $product):
			
		?>
			<div class="grid-item">
				<?php 
					if(!empty($product['Attachment'][0]['path_med'])){
						echo $this->Html->image($product['Attachment'][0]['path_med'],array('alt'=>'','url'=>array('controller'=>'products','action'=>'view',$product['Product']['id']))); 
					}
				?>
				<br/>
				<span class="title"><?php echo $this->Html->link($product['Product']['name'],array('controller'=>'products','action'=>'view',$product['Product']['id'])); ?></span>
				<br/>
				<p class="description"><?php echo $string->truncate($product['Product']['description'],250); ?></p>
				<br/>
				<?php if(!empty($product['Product']['designer'])) echo "Designed by ".$product['Product']['designer']; ?><br/>
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
									echo $this->Html->link($tag['name'],array('controller'=>'products','action'=>'index/by:'.$tag['keyname']));
								}else{
									echo $this->Html->link($tag['name'],array('controller'=>'products','action'=>'index/by:'.$tag['keyname'])).", ";
								}

								$counter++;
							}
						}
					?></span>
					<div class="clear"></div>
				</div>
			</div>
		<?php 
		endforeach; 
		else:
		?>
		<div id="empty">
			<p></p>
		</div>
		<?php
		endif;
		?>
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