<?php
// set url arguements
$this->Paginator->options(array('url' =>  array($filter)));
if(!empty($this->params['named']['by'])){
	$this->Paginator->options(array('url' => $this->passedArgs));
}

//Replace the Source paging array if a Tagged array exists
if(!empty($this->Paginator->params['paging']['Tagged'])){
	$this->Paginator->params['paging']['Source'] = $this->Paginator->params['paging']['Tagged'];
}
?>

<div class="left-container">
	<?php
		//Index Box Ad (300x250)
		echo $this->element('index-box-ad',array('cache'=>false));
		
		//Rating sorter
		echo $this->element('source-sorter',array('cache'=>false));
		
		//Alphabet sorter
		echo $this->element('alphabet-sorter',array('cache'=>false));
		
		//Category sorter
		echo $this->element('source-category-sorter',array('cache'=>false,'sourceCategories'=>$sourceCategories));
		
		//Designer sorter
		//echo $this->element('designer-sorter',array('cache'=>false));
	?>
</div>
<div class="right-container-index">
	<div class="sources index">
		<div class="header red">
		<?php 
			if(empty($this->params['named']['by'])){
				__('Sources ('.$total_count.')');
			}else{
				__('Sources tagged [ '.$this->params['named']['by'].' ]');
			}
		?>
		</div>
		<h4>Keep track of any shop that stocks your favorite brands.</h4>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th width="25%"><?php echo $this->Paginator->sort('name');?></th>
				<th width="15%"><?php echo $this->Paginator->sort('source_category_id');?></th>
				<th width="35%"><?php echo $this->Paginator->sort('url');?></th>
				<th><?php echo $this->Paginator->sort('city');?></th>
				<th><?php echo $this->Paginator->sort('state');?></th>
				<th width="15%"><?php echo $this->Paginator->sort('country_id');?></th>
				<?php if(Configure::read('FGM.allow_rating') == 1): ?>
				<th><?php echo $this->Paginator->sort('rating');?></th>
				<?php endif; ?>
		</tr>
		<?php
		$i = 0;
		foreach ($sources as $source):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($source['Source']['name'], array('action' => 'view', $source['Source']['id'])); ?>&nbsp;</td>
			<td><?php echo $this->Html->link($source['SourceCategory']['name'], array('controller'=>'source_categories','action' => 'view', $source['SourceCategory']['id'])); ?>&nbsp;</td>
			<td><?php echo $this->Html->link($source['Source']['url'],$source['Source']['url'],array('target'=>'_blank')); ?>&nbsp;</td>
			<td><?php echo $source['Source']['city']; ?>&nbsp;</td>
			<td><?php echo $source['Source']['state']; ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($source['Country']['name'], array('controller' => 'countries', 'action' => 'view', $source['Country']['id'])); ?>
			</td>
			<?php if(Configure::read('FGM.allow_rating') == 1): ?>
			<td><?php echo $this->element('rating', array(
															'plugin' => 'rating',
															'model' => 'Source',
															'id' => $source['Source']['id'],
															'name' => strtolower('Source')));
															?></td>
			<?php endif; ?>
		</tr>
	<?php endforeach; ?>
		</table>
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
				<li><?php //echo $this->Html->link(__('New Source', true), array('action' => 'add','admin'=>true)); ?></li>
			</ul>
		</div>
	</div>
</div>