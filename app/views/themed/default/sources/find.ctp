<h2>Source Search</h2>
<div id="search-form">
<?php
	echo $this->Form->create('Source', array(
		'url' => array_merge(array('action' => 'find'), $this->params['pass'])
		));
	echo $this->Form->input('name', array('div' => true));
	echo '<div class="side-by-side clearfix"><div>';
	echo $this->Form->input('source_category_id',array('class'=>'chzn-select','empty' => '-- Choose a Category --','style'=>'width:250px;'));
	echo '</div></div>';
	echo $this->Form->input('description', array('div' => true));
	echo $this->Form->input('url', array('div' => true,'label'=>'URL'));
	echo $this->Form->input('tags', array('div' => true));
	echo $this->Form->submit(__('Search', true), array('div' => true));
	echo $this->Form->end();
	
?>
</div>
<?php if(!empty($this->params['named'])): ?>
<div id="search-results">
<?php
	if(!empty($sources)){
?>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th style="display:none"><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th><?php echo $this->Paginator->sort('source_category_id');?></th>
				<th><?php echo $this->Paginator->sort('description');?></th>
				<th><?php echo $this->Paginator->sort('url');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($sources as $source):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class; ?>>
			<td style="display:none"><?php echo $source['Source']['id']; ?>&nbsp;</td>
			<td width="40%"><?php echo $this->Html->link(__($source['Source']['name'], true), array('action' => 'view', $source['Source']['id']),array('title'=>$source['Source']['description'])); ?>&nbsp;</td>
			<td><?php echo $source['SourceCategory']['name'] ?></td>
			<td><?php echo $this->String->truncate($source['Source']['description'],100); ?></td>
			<td><?php echo $this->Html->link($this->String->truncate($source['Source']['url']),$source['Source']['url'],array('target'=>'_blank')); ?></td>
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
<?php 
		}else{
?>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<th></th>
				</tr>
				<tr>
					<td><h3>No results found.</h3></td>
				</tr>
			</table>
<?php
		} 
?>	
</div>
<?php endif; ?>
<script type="text/javascript"> $(".chzn-select").chosen(); </script>