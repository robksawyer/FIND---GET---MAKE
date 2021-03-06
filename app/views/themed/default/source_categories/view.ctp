<div class="left-container">
	<?php
		//Rating sorter
		echo $this->element('source-sorter',array('cache'=>false));
		
		//Alphabet sorter
		echo $this->element('alphabet-sorter',array('cache'=>false,'controller'=>'sources'));
		
		//Category sorter
		echo $this->element('source-category-sorter',array('cache'=>false,'sourceCategories'=>$sourceCategories));
		//Designer sorter
		//echo $this->element('designer-sorter',array('cache'=>false));
	?>
</div>
<div class="right-container-index">
	<div class="sourceCategories index">
		<div class="header red">
			<?php  __('Items in the category [ '.ucwords($sourceCategory['SourceCategory']['name']).' ]');?>
		</div>
		<?php if(empty($sourceCategory['Source'])){
			echo "<br/><br/><br/>";
		}?>
		<?php if (!empty($sourceCategory['Source'])):?>
		<table cellpadding = "0" cellspacing = "0">
			<tr>
					<th width="25%"><?php echo $this->Paginator->sort('name');?></th>
					<th width="15%"><?php echo $this->Paginator->sort('source_category_id');?></th>
					<th width="35%"><?php echo $this->Paginator->sort('url');?></th>
					<th><?php echo $this->Paginator->sort('city');?></th>
					<th><?php echo $this->Paginator->sort('state');?></th>
					<th width="15%"><?php echo $this->Paginator->sort('country_id');?></th>
					<th><?php echo $this->Paginator->sort('rating');?></th>
			</tr>
		<?php
			$i = 0;
			foreach ($sourceCategory['Source'] as $source):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
			<tr<?php echo $class;?>>
				<td><?php echo $this->Html->link($source['name'], array('controller'=>'sources','action' => 'view', $source['id'])); ?>&nbsp;</td>
				<td><?php echo $this->Html->link($source['SourceCategory']['name'], array('controller'=>'source_categories','action' => 'view', $source['SourceCategory']['id'])); ?>&nbsp;</td>
				<td><?php echo $this->Html->link($source['url'],$source['url'],array('target'=>'_blank')); ?>&nbsp;</td>
				<td><?php echo $source['city']; ?>&nbsp;</td>
				<td><?php echo $source['state']; ?>&nbsp;</td>
				<td>
					<?php if(!empty($source['Country'])) echo $this->Html->link($source['Country']['name'], array('controller' => 'countries', 'action' => 'view', $source['Country']['id'])); ?>
				</td>
				<td><?php echo $this->element('rating', array(
																'plugin' => 'rating',
																'model' => 'Source',
																'id' => $source['id'],
																'name' => strtolower('Source')));
																?></td>
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
