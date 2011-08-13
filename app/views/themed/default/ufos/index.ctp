<?php
	if(!empty($this->params['named']['by'])){
		$this->Paginator->options(array('url' => $this->passedArgs));
	}
	//Replace the Source paging array if a Tagged array exists
	if(!empty($this->Paginator->params['paging']['Tagged'])){
		$this->Paginator->params['paging']['Ufo'] = $this->Paginator->params['paging']['Tagged'];
	}
?>
<div class="ufos index">
	<div class="header orange"><?php __('Ufos');?></div>
	<div class="images">
	<?php
	$i = 0;
	foreach ($ufos as $ufo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
		<?php
			if(!empty($ufo['Attachment']['path_small'])){
				echo $this->Html->image($ufo['Attachment']['path_small'],array('alt'=>'','url'=>array('action'=>'view',$ufo['Ufo']['id']))); 
			}
		?>
<?php endforeach; ?>
	</div>
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