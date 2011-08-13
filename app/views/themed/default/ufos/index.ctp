<?php
	// set url arguements
	$this->Paginator->options(array('url' =>  array($filter)));
	if(!empty($this->params['named']['by'])){
		$this->Paginator->options(array('url' => $this->passedArgs));
	}
	//Replace the Source paging array if a Tagged array exists
	if(!empty($this->Paginator->params['paging']['Tagged'])){
		$this->Paginator->params['paging']['Ufo'] = $this->Paginator->params['paging']['Tagged'];
	}
?>
<div class="left-container">
	<?php
		//Index Box Ad (300x250)
		echo $this->element('index-box-ad',array('cache'=>false));
		
		//Rating sorter
		//echo $this->element('ufo-sorter',array('cache'=>false));
		
		//Alphabet sorter
		//echo $this->element('alphabet-sorter',array('cache'=>false));
		
	?>
</div>
<div class="right-container-index">
	<div class="ufos index">
		<div class="header red"><?php __('Ufos');?></div>
		<div class="clear"></div>
		<h4>Unidentified Found Objects are images you’ve collected and studied, but just don’t know who or what to attribute them to. Start by uploading a file from your computer or linking directly to a URL, and hopefully another user can help you identify your precious puzzle.</h4>
		<?php if(!empty($ufos)): ?>
		<div id="grid-container">
		<?php
		$i = 0;
		foreach ($ufos as $ufo):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
			<div class="grid-item">
			<?php
				if(!empty($ufo['Attachment']['path_med'])){
					echo $this->Html->image($ufo['Attachment']['path_med'],array('alt'=>'','url'=>array('action'=>'view',$ufo['Ufo']['id']))); 
				}
			?>
			<?php if(!empty($ufo['Ufo']['name'])): ?>
			<div class="title"><?php echo $this->Html->link($ufo['Ufo']['name'],array('controller'=>'ufos','action'=>'view',$ufo['Ufo']['id'])); ?></div>
			<?php endif; ?>
			<div class="description"><?php echo $string->truncate($ufo['Ufo']['description'],250); ?></div>
			<div class="designer"><?php echo "Added by ".$this->Html->link($ufo['User']['username'],array('admin'=>false,'plugin'=>'forum','controller'=>'users','action'=>'profile',$ufo['User']['id'])); ?></div>
			<div class="bottom-detail">
				<span class="date"><?php 
						echo $this->Time->niceShort($ufo['Ufo']['created'],null,null);
				?>&nbsp;</span>
				<span class="tags"><?php
					//Build a tag list of only two tags.
					$limit = 2;
					$counter = 0;
					//debug($ufo['Tag']);
					if(!empty($ufo['Tag'])){
						echo " / ";
						foreach($ufo['Tag'] as $tag){
							if($counter == $limit) break;
					
							if($counter == ($limit - 1) || count($ufo['Tag']) < 2){
								echo $this->Html->link($tag['name'],array('controller'=>'ufos','action'=>'index/by:'.$tag['keyname']));
							}else{
								echo $this->Html->link($tag['name'],array('controller'=>'ufos','action'=>'index/by:'.$tag['keyname'])).", ";
							}

							$counter++;
						}
					}
				?></span>
				<div class="clear"></div>
			</div>
			</div>
		<?php endforeach; ?>
		</div>
		<div class="clear"></div>
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
		));
		?>	</p>

		<div class="paging">
			<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
		 | 	<?php echo $this->Paginator->numbers();?>
	 |
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		</div>
		<?php endif; ?>
	</div>
</div>
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