<div id="tags" class="tags view">
	<?php
	$i = 0;
	//debug($tags);
	$sourceCategories = Set::sort($sourceCategories, '{n}.SourceCategory.name', 'asc');
	foreach ($sourceCategories as $sourceCategory):
	?>
		<div class="tag">
			<?php echo $this->Html->link(__($sourceCategory['SourceCategory']['name'], true), array('action'=>'view',$sourceCategory['SourceCategory']['id'])); ?>
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