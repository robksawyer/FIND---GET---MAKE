<div class="left-container">
	<?php
		//Index Box Ad (300x250)
		echo $this->element('index-box-ad',array('cache'=>false));
		
		//Rating sorter
		echo $this->element('product-sorter',array('cache'=>false));
		
		//Alphabet sorter
		echo $this->element('alphabet-sorter',array('cache'=>false));
		
		//Category sorter
		echo $this->element('product-category-sorter',array('cache'=>false,'productCategories'=>$productCategories));
		
		//Designer sorter
		//echo $this->element('designer-sorter',array('cache'=>false));
	?>
</div>
<div class="right-container-index">
	<div class="index">
		<div id="tags" class="tags view">
			<?php
			//debug($this->Paginator);
			//debug($tags);
	
			//Replace the Source paging array if a Tagged array exists
			if(!empty($this->Paginator->params['paging']['Tagged'])){
				$this->Paginator->params['paging']['Product'] = $this->Paginator->params['paging']['Tagged'];
			}
	
			$i = 0;
			$tags = Set::sort($tags, '{n}.Tag.name', 'asc');
			//debug($tags);
			foreach ($tags as $tag):
			?>
				<div class="tag">
					<?php echo $this->Html->link(__($tag['Tag']['name'], true), '/products/index/by:'.$tag['Tag']['keyname']); ?>
				</div>
			<?php 
			endforeach; 
			?>
			<div class="clear"></div>
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
		</div>
		<div class="clear"></div>
	</div>
</div>