<?php
	$userData = $this->requestAction('/sources/getProfileData/'.$user_id);
?>
<div class="sources moderate">
	<div class="header grey"><?php __('Latest sources');?></div>
	<?php if (!empty($userData)):?>
	<div class="latest">
	<?php
		$i = 0;
		foreach ($userData as $id => $source):
			//debug($source);
		?>
		<div>
			<td><?php echo $this->Html->link($source,array('plugin'=>'','controller'=>'sources','action'=>'view','admin'=>false,$id));?></td>
		</div>
	<?php endforeach; ?>
	</div>
<?php else: ?>
	<div class="missing-content"><p>Keep track of any shop that stocks your favorite brands.</p></div>
<?php endif; ?>
</div>
