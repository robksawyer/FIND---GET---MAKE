<?php
	// set url arguements
	$this->Paginator->options(array('url' =>  array($filter)));
	if(!empty($this->params['named']['by'])){
		$this->Paginator->options(array('url' => $this->passedArgs));
	}
?>
<div class="left-container">
	<?php
		//Rating sorter
		echo $this->element('product-sorter',array('cache'=>false));
		
		//Alphabet sorter
		echo $this->element('alphabet-sorter',array('cache'=>false,'controller'=>'products'));
		
		//Category sorter
		echo $this->element('product-category-sorter',array('cache'=>false,'productCategories'=>$productCategories));
		//Designer sorter
		//echo $this->element('designer-sorter',array('cache'=>false));
		
		$this->Html->script('jquery.masonry.min',array('inline'=>false));
	?>
</div>
<div class="right-container-index">
	<div class="productCategories index">
		<div class="header teal">
			<?php  __('Items in the category [ '.ucwords($productCategory['ProductCategory']['name']).' ]');?>
		</div>
		<?php if(empty($productCategory['Product'])){
			echo "<br/><br/><br/>";
		}?>

		<!-- Start gridded items -->
		<div id="grid-container">
		<?php
		if(!empty($productCategory['Product'])):
		$i = 0;
		foreach ($productCategory['Product'] as $productCategory):

		?>
			<div class="grid-item">
				<?php 
					if(!empty($productCategory['Attachment'][0]['path_med'])){
						echo $this->Html->image($productCategory['Attachment'][0]['path_med'],array('alt'=>'','url'=>array('controller'=>'products','action'=>'view',$productCategory['id']))); 
					}
				?>
				<br/>
				<span class="title"><?php echo $this->Html->link($productCategory['name'],array('controller'=>'products','action'=>'view',$productCategory['id'])); ?></span><br/>
				<span class="description"><?php echo $string->truncate($productCategory['description'],250); ?></span><br/>
				<?php if(!empty($productCategory['designer'])) echo "Designed by, ".$productCategory['designer']; ?><br/>
				<div class="bottom-detail">
					<span class="date"><?php echo $this->Time->niceShort($productCategory['created'],null,null)." / "; ?>&nbsp;</span>
					<span class="tags"><?php
						//Build a tag list of only two tags.
						$limit = 2;
						$counter = 0;
						//debug($product['Tag']);
						if(!empty($productCategory['Tag'])){
							foreach($productCategory['Tag'] as $tag){
								if($counter == $limit) break;

								if($counter == ($limit - 1) || count($productCategory['Tag']) < 2){
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
