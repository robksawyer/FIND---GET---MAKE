<?php
	if(!empty($this->params['named']['by'])){
		$this->Paginator->options(array('url' => $this->passedArgs));
	}
	//Replace the Source paging array if a Tagged array exists
	if(!empty($this->Paginator->params['paging']['Tagged'])){
		$this->Paginator->params['paging']['Client'] = $this->Paginator->params['paging']['Tagged'];
	}
?>
<div class="clients index">
	<div class="header pink"><?php __('Clients');?></div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th width="15%"><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('country_id');?></th>
			<th width="15%"><?php echo $this->Paginator->sort('url');?></th>
			<th><?php echo $this->Paginator->sort('job_title');?></th>
			<th><?php echo $this->Paginator->sort('total_children');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($clients as $client):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		if(!empty($client['Client']['name'])):
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $this->Html->link($client['Client']['name'], array('action' => 'view', $client['Client']['id'])); ?></td>
		<td>
			<?php echo $this->Html->link($client['Country']['name'], array('controller' => 'countries', 'action' => 'view', $client['Country']['id'])); ?>
		</td>
		<td><?php echo $this->Html->link($client['Client']['url'],$client['Client']['url'],array('target'=>'_blank')); ?>&nbsp;</td>
		<td><?php echo $client['Client']['job_title']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['total_children']; ?>&nbsp;</td>
	</tr>
	
<?php 
	endif;
	endforeach; 
?>
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
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('New Client', true), array('action' => 'add','admin'=>true)); ?></li>
	</ul>
</div>