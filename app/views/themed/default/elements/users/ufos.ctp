<div class="ufos moderate">
	<div class="header orange"><?php __('Your latest ufos');?></div>
	<div class="clear"></div>
	<?php if (!empty($userUfos)):?>
	<div class="images">
	<?php
	$i = 0;
	foreach ($userUfos as $ufo):
	?>
		<?php
			if(!empty($ufo['Attachment']['path_small'])){
				echo $this->Html->image($ufo['Attachment']['path_small'],array('alt'=>'','url'=>array('controller'=>'ufos','action'=>'view',$ufo['Ufo']['id'],'admin'=>false))); 
			}
		?>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	<div class="clear"></div>
</div>
<div class="clear"></div>