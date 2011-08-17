<?php
 //debug($ufo);
?>
<div class="ufos view">
	<?php
		echo $this->element('top_actions',array('item'=>$ufo,'model'=>'Ufo','rate'=>true,'cache'=>false));
	?>
	<div class="attachments box">
		<?php if(!empty($ufo['Ufo']['name'])): ?>
		<h2><?php __($ufo['Ufo']['name']); ?></h2>
		<?php endif; ?>
		<?php
			if(!empty($ufo['Attachment']['source_url'])){
				$source_url = $ufo['Attachment']['source_url'];
			}else{
				$source_url = '';
			}
			if(!empty($ufo['Attachment']['title'])){
				$title = $ufo['Attachment']['title'];
			}else{
				if(!empty($ufo['Ufo']['name'])){
					$title = $ufo['Ufo']['name'];
				}else{
					$title = '';
				}
			}
		?>
		<?php echo $this->Html->image($ufo['Attachment']['path'],array('alt'=>$title,'url'=>$source_url,'title'=>$title)); ?>
	</div>
	<div class="right-sidebar">
		<?php
		echo $this->element('like-dislike',array('model_id'=>$ufo['Ufo']['id'],
																'model'=>'Ufo',
																'cache'=>false
																));
		?>
	</div>
</div>
<div class="clear"></div>
<?php if(!empty($source_url)): ?>
<div class="source">
	<?php echo $this->Html->link('Source', $source_url,array('target'=>'_blank')); ?>
</div>
<?php endif; ?>
<br/>
<?php if(!empty($ufo['Ufo']['description'])): ?>
<div class="description">
	<?php echo "<span class='light-grey'>".$ufo['Ufo']['description']."</span>"; ?>
</div>
<div class="clear"></div>
<?php endif; ?>
<div class="added-by"><?php echo "Found by ".$this->Html->link($ufo['User']['username'],array('admin'=>false,'plugin'=>'forum','controller'=>'users','action'=>'profile',$ufo['User']['username'])); ?></div>
<?php echo $this->element('comments',array('cache'=>false,'disable'=>false)); ?>
