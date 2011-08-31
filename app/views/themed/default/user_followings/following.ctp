<div class="header red">
<?php 
	__('Members '.$user['User']['username'].' is following');
?>
</div>
<div class="clear"></div>
<div id="follower-following">
	<?php if(!empty($following)): ?>
		<!-- Start gridded items -->
		<div id="grid-container">
		<?php foreach($following as $follower): ?>
			<div class="grid-item" style="width:500px !important;">
				<?php echo $this->element('user-block',array('cache'=>false,'user'=>$follower)); ?>
			</div>
		<?php endforeach; ?>
		</div>
		<div class="clear"></div>
		<!-- End gridded items -->
	<?php endif; ?>
</div>
<?php
	$this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<script type="text/javascript">
$(function(){
	var $container = $("#grid-container");
	$container.imagesLoaded(function(){
		$container.masonry({
			//option
			itemSelector: '.grid-item'
		});
	});
});
</script>