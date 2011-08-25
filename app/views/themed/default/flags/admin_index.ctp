<?php

?>
<div class="left-container">
	<?php

	?>
</div>
<div class="right-container-index">
	<div class="flags index">
		<div class="header red">
		<?php 
			__('Flags ('.$total_count.')');
		?>
		</div>
		<h4>The following items have been flagged in the system.</h4>
		<legend>
			<div class="product-flag">products</div>
			<div class="source-flag">source</div>
			<div class="inspiration-flag">inspiration</div>
			<div class="collection-flag">collection</div>
			<div class="ufo-flag">ufo</div>
			<div class="attachment-flag">attachment</div>
		</legend>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th width="25%"><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('reason');?></th>
				<th><?php echo $this->Paginator->sort('description');?></th>
				<th width="25%"><?php echo $this->Paginator->sort('created');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($flags as $flag):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $flag['Flag']['id']; ?>&nbsp;</td>
			<td><?php echo $flag['Flag']['reason']; ?>&nbsp;</td>
			<td><?php echo $flag['Flag']['description']; ?>&nbsp;</td>
			<td><?php echo $flag['Flag']['created']; ?>&nbsp;</td>
		</tr>
	<?php endforeach; ?>
		</table>
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
				<li><?php //echo $this->Html->link(__('New Flag', true), array('action' => 'add','admin'=>true)); ?></li>
			</ul>
		</div>
	</div>
</div>