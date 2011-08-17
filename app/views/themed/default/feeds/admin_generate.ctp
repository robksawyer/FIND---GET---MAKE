<div id="feed">
	<?php if($success == 1): ?>
		<h3>The feed has been generated. <?php echo count($records); ?> were created.</h3>
	<?php else: ?>
		<h3>There was an error generating the feed.</h3>
	<?php endif; ?>
</div>