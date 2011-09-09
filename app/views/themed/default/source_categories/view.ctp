<div id="left-panel-index">
	<?php
		//Rating sorter
		echo $this->element('source-sorter',array('cache'=>false));
		
		//Alphabet sorter
		echo $this->element('alphabet-sorter',array('cache'=>false,'action'=>'view','controller'=>'source_categories','name'=>'sources','arg'=>$sourceCategory['SourceCategory']['id']));
		
		//Category sorter
		echo $this->element('source-category-sorter',array('cache'=>false,'sourceCategories'=>$sourceCategories));
		//Designer sorter
		//echo $this->element('designer-sorter',array('cache'=>false));
		//$sourceCategory = $sourceCategories[0];
	?>
</div>
<div id="right-panel">
	<div class="sourceCategories index">
		<div class="header red">
			<?php  __('Items in the category [ '.ucwords($sourceCategory['SourceCategory']['name']).' ]');?>
		</div>
		<div class="clear"></div>
		<?php if (!empty($sources)):?>
		<table cellpadding = "0" cellspacing = "0">
			<tr>
					<th width="25%"><?php echo $this->Paginator->sort('name');?></th>
					<!--<th width="15%"><?php //echo $this->Paginator->sort('source_category_id');?></th>-->
					<th width="35%"><?php echo $this->Paginator->sort('url');?></th>
					<th><?php echo $this->Paginator->sort('city');?></th>
					<th><?php echo $this->Paginator->sort('state');?></th>
					<th width="15%"><?php echo $this->Paginator->sort('country_id');?></th>
					<?php if(Configure::read('FGM.allow_rating')===true): ?>
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
				//$source = $source['Source'];
			?>
			<tr<?php echo $class;?>>
				<td><?php echo $this->Html->link($source['Source']['name'], array('controller'=>'sources','action' => 'view', $source['Source']['id'])); ?>&nbsp;</td>
				<!--<td><?php //echo $this->Html->link($source['SourceCategory']['name'], array('controller'=>'source_categories','action' => 'view', $source['SourceCategory']['id'])); ?>&nbsp;</td>-->
				<td><?php echo $this->Html->link($source['Source']['url'],$source['Source']['url'],array('target'=>'_blank')); ?>&nbsp;</td>
				<td><?php echo $source['Source']['city']; ?>&nbsp;</td>
				<td><?php echo $source['Source']['state']; ?>&nbsp;</td>
				<td>
					<?php 
						if(!empty($source['Country'])):
							//echo $this->Html->link($source['Country']['name'], array('controller' => 'countries', 'action' => 'view', $source['Country']['id'])); 
							echo $source['Country']['name'];
						endif;
					?>
				</td>
				<?php if(Configure::read('FGM.allow_rating')===true): ?>
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
		<?php endif; ?>
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
		));
		?></p>
		<div class="paging">
			<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
		 | 	<?php echo $this->Paginator->numbers();?>
		|
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		</div>
	</div>
</div>
