<div class="bottom">
	<?php 
	//debug($source);
	if(!empty($model['Tag'])): 
	?>
	<dl class="keyword-container">
		<dt>
			<!-- Keywords:-->
			<ul class="tags">
			<?php if (!empty($model['Tag'])): ?>
				<?php 
					$totalKeywords = count($model['Tag']);
					$counter = 0;
					foreach ($model['Tag'] as $tag):
						$counter++;
						if($counter != $totalKeywords):
						//debug($tag);
				?>
						<?php echo $this->Html->link('<li>'.$tag['name'].'</li>',array('action'=>'index/by:'.$tag['keyname']),array('escape'=>false)); ?>
					<?php else: ?>
						<?php echo $this->Html->link('<li>'.$tag['name'].'</li>',array('action'=>'index/by:'.$tag['keyname']),array('escape'=>false)); ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			</ul>
		</dt>
	</dl>
	<?php endif; ?>
</div>