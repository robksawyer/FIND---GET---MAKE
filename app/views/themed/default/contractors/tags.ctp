<div id="tags" class="tags view">
	<?php
	//debug($this->Paginator);
	//debug($tags);
	$i = 0;
	$tags = Set::sort($tags, '{n}.Tag.name', 'asc');
	//debug($tags);
	foreach ($tags as $tag):
	?>
		<div class="tag">
			<?php echo $this->Html->link(__($tag['Tag']['name'], true), '/products/index/by:'.$tag['Tag']['name']); ?>
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