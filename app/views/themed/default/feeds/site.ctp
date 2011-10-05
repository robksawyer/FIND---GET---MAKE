<div id="site-feed">
	<div id="block_1">
		<h3>
		<?php __('<b>Running Bond:</b> It\'s more than just a tile pattern&mdash;it\'s what\'s happening.'); ?>
		</h3>
		<?php
		echo $this->element('site-feed',array('cache'=>false,'limit'=>$limit,'feed'=>$feed,'num_items'=>$num_items));
		?>
	</div>
</div>