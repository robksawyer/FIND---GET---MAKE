<?php
	$this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<div id="grid-collage">
<div class="collage">
	<?php 
	//debug($random_paths); 
	foreach($random_paths as $path){
		echo "<div class='item'>";
		echo $this->Html->image($path['Attachment']['path_small'],array(
																						'alt'=>'',
																						'url'=>array('action'=>'view',$path['Attachment']['id'])
																						)
																						);
		echo "</div>";
	}
	?>
	
</div>
</div>
<script type="text/javascript">
$(function(){
	var $container = $("#grid-collage");
	$container.imagesLoaded(function(){
		$container.masonry({
			//option
			itemSelector: '.item'
		});
	});
});
</script>