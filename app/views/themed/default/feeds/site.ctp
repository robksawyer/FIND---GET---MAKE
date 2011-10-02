<?php
$this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<div id="site-feed">
	<div id="block_1">
		<h3>
		<?php __('what others are posting'); ?>
		</h3>
		<div class="clear"></div>
		<?php
		echo $this->element('site-feed',array('cache'=>false,'limit'=>$limit,'feed'=>$feed,'num_items'=>$num_items));
		?>
	</div>
	<div id="block_2">
		
	</div>
</div>