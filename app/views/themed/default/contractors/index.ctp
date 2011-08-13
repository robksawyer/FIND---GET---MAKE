<?php
	if(!empty($this->params['named']['by'])){
		$this->Paginator->options(array('url' => $this->passedArgs));
	}
	//Replace the Source paging array if a Tagged array exists
	if(!empty($this->Paginator->params['paging']['Tagged'])){
		$this->Paginator->params['paging']['Contractor'] = $this->Paginator->params['paging']['Tagged'];
	}
?>
<div class="contractors index">
	<div class="header teal"><?php __('Contractors');?></div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('contractor_specialty_id');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th><?php echo $this->Paginator->sort('city');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('country_id');?></th>
			<!--<th><?php //echo $this->Paginator->sort('created');?></th>-->
			<!--<th><?php //echo $this->Paginator->sort('modified');?></th>-->
	</tr>
	<?php
	$i = 0;
	foreach ($contractors as $contractor):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<?php //debug($contractor); ?>
		<td><?php echo $this->Html->link($contractor['Contractor']['name'], array('controller'=>'contractors','action'=>'view',$contractor['Contractor']['id'])); ?>&nbsp;</td>
		<td><?php echo $contractor['ContractorSpecialty']['name']; ?>&nbsp;</td>
		<td><?php echo $this->Html->link($contractor['Contractor']['url'],$contractor['Contractor']['url'],array('target'=>'_blank')); ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['city']; ?>&nbsp;</td>
		<td><?php echo $contractor['Contractor']['state']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($contractor['Country']['name'], array('controller' => 'countries', 'action' => 'view', $contractor['Country']['id'])); ?>
		</td>
		<!--<td><?php //echo $this->Time->niceShort($contractor['Contractor']['created'],'',''); ?>&nbsp;</td>-->
		<!--<td><?php //echo $this->Time->niceShort($contractor['Contractor']['modified'],'',''); ?>&nbsp;</td>-->
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
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('New Contractor', true), array('action' => 'add','admin'=>true)); ?></li>
	</ul>
</div>