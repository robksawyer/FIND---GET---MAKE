<?php
	// set url arguements
	$this->Paginator->options(array('url' =>  array($filter)));
	if(!empty($this->params['named']['by'])){
		$this->Paginator->options(array('url' => $this->passedArgs));
	}
	
	//Replace the Source paging array if a Tagged array exists
	if(!empty($this->Paginator->params['paging']['Tagged'])){
		$this->Paginator->params['paging']['Inspiration'] = $this->Paginator->params['paging']['Tagged'];
	}
	
	$this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<div class="left-container">
	<?php
		//Index Box Ad (300x250)
		echo $this->element('index-box-ad',array('cache'=>false));	
	
		//Rating sorter
		echo $this->element('inspiration-sorter',array('cache'=>false));
		
		//Alphabet sorter
		echo $this->element('alphabet-sorter',array('cache'=>false));
		
		//Designer sorter
		//echo $this->element('designer-sorter',array('cache'=>false));
	?>
</div>
<div class="right-container-index">
	<div class="inspirations index">
		<div class="header red">
		<?php
		if(empty($this->params['named']['by'])){
			__('Inspirations');
		}else{
			__('Inspirations tagged [ '.$this->params['named']['by'].' ]');
		}
		?>
		</div>
		<h4>Inspirations are: <br/>completed rooms you lust after<br/>lines &amp; shapes you want to use<br/>colors and forms that enthrall you<br/>sketches that one day will be fully realized.</h4>
		<?php
		if(!empty($inspirations)):
		?>
		<div id="grid-container">
		<?php
		$i = 0;
		foreach ($inspirations as $inspiration):
			
		?>
			<div class="grid-item">
				<?php 
					if(!empty($inspiration['Attachment'][0]['path_med'])){
						echo $this->Html->image($inspiration['Attachment'][0]['path_med'],array('alt'=>'','url'=>array('action'=>'view',$inspiration['Inspiration']['id']))); 
					}
				?>
				<div class="title"><?php echo $this->Html->link($inspiration['Inspiration']['name'],array('controller'=>'inspirations','action'=>'view',$inspiration['Inspiration']['id'])); ?></div>
				<div class="description"><?php echo $string->truncate($inspiration['Inspiration']['description'],250); ?></div>
				<?php 
				if(!empty($inspiration['Inspiration']['designer'])){
					echo "<div class='designer'>Designed by ".$inspiration['Inspiration']['designer']."</div>"; 
				}
				?>
				<div class="designer"><?php echo "Added by ".$this->Html->link($inspiration['User']['username'],array('admin'=>false,'plugin'=>'forum','controller'=>'users','action'=>'profile',$inspiration['User']['username'])); ?></div>
				<div class="bottom-detail">
					<span class="date"><?php 
							echo $this->Time->niceShort($inspiration['Inspiration']['created'],null,null);
					?>&nbsp;</span>
					<span class="tags"><?php
						//Build a tag list of only two tags.
						$limit = 2;
						$counter = 0;
						//debug($inspiration['Tag']);
						if(!empty($inspiration['Tag'])){
							echo " / ";
							foreach($inspiration['Tag'] as $tag){
								if($counter == $limit) break;
						
								if($counter == ($limit - 1) || count($inspiration['Tag']) < 2){
									echo $this->Html->link($tag['name'],array('controller'=>'inspirations','action'=>'index/by:'.$tag['keyname']));
								}else{
									echo $this->Html->link($tag['name'],array('controller'=>'inspirations','action'=>'index/by:'.$tag['keyname'])).", ";
								}

								$counter++;
							}
						}
					?></span>
					<?php if(!empty($inspiration['Inspiration']['private'])): ?>
					<div class="lock"><?php echo $this->Html->image('icons/lock.png',array('alt'=>'PRIVATE','title'=>'This inspiration is private.','height'=>'16')); ?></div>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
		<div class="clear"></div>
		
		<!-- Paging -->
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
		<div class="actions">
			<ul>
				<li><?php //echo $this->Html->link(__('New Inspiration', true), array('action' => 'add','admin'=>true)); ?></li>
			</ul>
		</div>
		<?php else: ?>
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