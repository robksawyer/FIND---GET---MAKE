<?php
	// set url arguements
	$this->Paginator->options(array('url' =>  array($filter)));
	if(!empty($this->params['named']['by'])){
		$this->Paginator->options(array('url' => $this->passedArgs));
	}
	
	$this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<div id="left-panel-index">
	<?php
		//Index Box Ad (300x250)
		echo $this->element('index-box-ad',array('cache'=>false));
		
		//Rating sorter
		echo $this->element('product-sorter',array('cache'=>false));
		
		//Alphabet sorter
		echo $this->element('alphabet-sorter',array('cache'=>false));
		
		//Category sorter
		echo $this->element('product-category-sorter',array('cache'=>false,'productCategories'=>$productCategories));
		
		$this->Html->script('jquery.masonry.min',array('inline'=>false));
	?>
</div>
<div id="right-panel">
	<div class="productCategories index">
		<div class="header red">
			<?php  __('Items in the category [ '.ucwords($productCategory['ProductCategory']['name']).' ]');?>
		</div>
		<?php if(empty($products)){
			echo "<br/><br/><br/>";
		}?>

		<!-- Start gridded items -->
		<div id="grid-container">
		<?php
		if(!empty($products)):
		$i = 0;
		foreach ($products as $product):
			//$product = $product['Product'];
		?>
			<div class="grid-item">
				<?php 
					if(!empty($product['Attachment'][0]['path_med'])){
						echo $this->Html->image($product['Attachment'][0]['path_med'],array('alt'=>'','url'=>array('controller'=>'products','action'=>'view',$product['Product']['id']))); 
					}
				?>
				<div class="title"><?php echo $this->Html->link($product['Product']['name'],array('controller'=>'products','action'=>'view',$product['Product']['id'])); ?></div>
				<div class="description"><?php echo $this->String->truncate($product['Product']['description'],250); ?></div>
				<?php if(!empty($product['Product']['designer'])) echo "<div class='designer'>Designed by ".$product['Product']['designer']."</div>"; ?>
				<div class="designer"><?php echo "Found by ".$this->Html->link($product['User']['username'],array('admin'=>false,'plugin'=>'forum','controller'=>'users','action'=>'profile',$product['User']['username'])); ?></div>
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
		?></p>
		<div class="paging">
			<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
		 | 	<?php echo $this->Paginator->numbers();?>
		|
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
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