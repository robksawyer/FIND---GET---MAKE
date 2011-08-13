<div id="tags" class="tags view">
	<?php
	$i = 0;
	//debug($tags);
	$productCategories = Set::sort($productCategories, '{n}.ProductCategory.name', 'asc');
	foreach ($productCategories as $productCategory):
	?>
		<div class="tag">
			<?php echo $this->Html->link(__($productCategory['ProductCategory']['name'], true), array('action'=>'view',$productCategory['ProductCategory']['id'])); ?>
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