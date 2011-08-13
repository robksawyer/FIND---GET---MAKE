<?php
	$userUfos = $this->requestAction('/ufos/getUfosFromUser/'.$user_id.'/10');
?>
<div class="ufos moderate">
	<div class="header grey"><?php __('latest ufos');?></div>
	<div class="clear"></div>
	<?php if (!empty($userUfos)):?>
	<div class="images">
	<?php
	$i = 0;
	foreach ($userUfos as $ufo):
	?>
		<?php
			if(!empty($ufo['Attachment']['path_small'])){
				echo $this->Html->image($ufo['Attachment']['path_small'],array('alt'=>'','url'=>array('plugin'=>'','controller'=>'ufos','action'=>'view',$ufo['Ufo']['id'],'admin'=>false))); 
			}
		?>
		<?php endforeach; ?>
	</div>
	<?php else: ?>
		<div class="missing-content"><p><b>U</b>nidentified <b>F</b>ound <b>O</b>bjects are images you’ve collected and studied, but just don’t know who or what to attribute them to. Start by uploading a file from your computer or linking directly to a URL, and hopefully another user can help you identify your precious puzzle.</p></div>
	<?php endif; ?>
	<div class="clear"></div>
</div>
<div class="clear"></div>