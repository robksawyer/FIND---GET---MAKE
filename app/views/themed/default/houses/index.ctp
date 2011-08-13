<?php
	if(!empty($this->params['named']['by'])){
		$this->Paginator->options(array('url' => $this->passedArgs));
	}
	//Replace the Source paging array if a Tagged array exists
	if(!empty($this->Paginator->params['paging']['Tagged'])){
		$this->Paginator->params['paging']['House'] = $this->Paginator->params['paging']['Tagged'];
	}
?>
<div class="houses index">
	<div class="header lime"><?php __('Houses');?></div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th width="20%"><?php echo $this->Paginator->sort('name');?></th>
			<th width="15%"><?php echo $this->Paginator->sort('client_id');?></th>
			<!--<th><?php //echo $this->Paginator->sort('description');?></th>
			<th><?php //echo $this->Paginator->sort('address1');?></th>
			<th><?php //echo $this->Paginator->sort('address2');?></th>-->
			<th width="15%"><?php echo $this->Paginator->sort('city');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('zip');?></th>
			<th width="25%"><?php echo $this->Paginator->sort('country_id');?></th>
			<!--<th><?php //echo $this->Paginator->sort('bedrooms');?></th>
			<th><?php //echo $this->Paginator->sort('bathrooms');?></th>
			<th><?php //echo $this->Paginator->sort('amenities');?></th>
			<th><?php //echo $this->Paginator->sort('phone');?></th>
			<th><?php //echo $this->Paginator->sort('more_details');?></th>
			<th><?php //echo $this->Paginator->sort('square_footage');?></th>
			<th><?php //echo $this->Paginator->sort('created');?></th>
			<th><?php //echo $this->Paginator->sort('modified');?></th>-->
	</tr>
	<?php
	$i = 0;
	foreach ($houses as $house):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $this->Html->link($house['House']['name'], array('action' => 'view', $house['House']['id'])); ?></td>
		<td>
			<?php echo $this->Html->link($house['Client']['name'], array('controller' => 'clients', 'action' => 'view', $house['Client']['id'])); ?>
		</td>
		<!--<td><?php //echo $house['House']['description']; ?>&nbsp;</td>
		<td><?php //echo $house['House']['address1']; ?>&nbsp;</td>
		<td><?php //echo $house['House']['address2']; ?>&nbsp;</td>-->
		<td><?php echo $house['House']['city']; ?>&nbsp;</td>
		<td><?php echo $house['House']['state']; ?>&nbsp;</td>
		<td><?php echo $house['House']['zip']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($house['Country']['name'], array('controller' => 'countries', 'action' => 'view', $house['Country']['id'])); ?>
		</td>
		<!--<td><?php //echo $house['House']['bedrooms']; ?>&nbsp;</td>
		<td><?php //echo $house['House']['bathrooms']; ?>&nbsp;</td>
		<td><?php //echo $house['House']['amenities']; ?>&nbsp;</td>
		<td><?php //echo $house['House']['phone']; ?>&nbsp;</td>
		<td><?php //echo $house['House']['more_details']; ?>&nbsp;</td>
		<td><?php //echo $house['House']['square_footage']; ?>&nbsp;</td>-->
		<!--<td><?php //echo $house['House']['created']; ?>&nbsp;</td>
		<td><?php //echo $house['House']['modified']; ?>&nbsp;</td>-->
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
<!--
<div class="actions">
	<ul>
		<li><?php //echo $this->Html->link(__('New House', true), array('action' => 'add')); ?></li>
	</ul>
</div>
-->