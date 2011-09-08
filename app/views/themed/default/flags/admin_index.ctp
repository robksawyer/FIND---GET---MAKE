<?php

?>
<div id="left-container">
	<?php

	?>
</div>
<div id="right-container-index">
	<div class="flags index">
		<div class="header red">
		<?php 
			__('Flags');
		?>
		</div>
		<div class="clear"></div>
		<h4>There are currently <span class="flag-count"><?php echo $total_count; ?></span> flagged items in the system.</h4>
		<ul class="legend">
			Item Types:
			<li class="product-flag flag-key">products</li>
			<li class="source-flag flag-key">source</li>
			<li class="inspiration-flag flag-key">inspiration</li>
			<li class="collection-flag flag-key">collection</li>
			<li class="ufo-flag flag-key">ufo</li>
			<li class="attachment-flag flag-key">attachment</li>
		</ul>
		<!-- 
		   Reasons:
			'duplicate'=>'Duplicate: This is a duplicate of an existing entry. Please paste the URL of the other version below.',
			'unrelated'=>'Unrelated: This isn\'t related to interior design at all.',
			'incorrect'=>'Incorrect: Parts of the data associated with this entry are incorrect. Please describe what you feel should change below.',
			'spam'=>'Spam: This is spam.',
			'other'=>'Other: Just read my description below, you\'ll see what I\'m talking about.',
		-->
		<ul class="legend">
			Reasons: 
			<li class="duplicate-flag flag-key">duplicate</li>
			<li class="unrelated-flag flag-key">unrelated</li>
			<li class="incorrect-flag flag-key">incorrect</li>
			<li class="spam-flag flag-key">spam</li>
			<li class="other-flag flag-key">other</li>
		</ul>
		<?php echo $this->Form->create('Flag',array('action'=>'process'));?>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<!--<th width="25%"><?php //echo $this->Paginator->sort('id');?></th>-->
				<th><?php echo $this->Form->checkbox('all',array('id'=>'FlagAll')); ?></th>
				<th><?php echo $this->Paginator->sort('type');?></th>
				<th><?php echo $this->Paginator->sort('item id');?></th>
				<th><?php echo $this->Paginator->sort('reason');?></th>
				<th><?php echo $this->Paginator->sort('flagged by');?></th>
				<th width="45%"><?php echo $this->Paginator->sort('description');?></th>
				<th width="15%"><?php echo $this->Paginator->sort('total flags');?></th>
				<th width="15%"><?php echo $this->Paginator->sort('created');?></th>
				<th><?php echo $this->Paginator->sort('actions');?></th>
		</tr>
		<?php
		$i = 0;
		$nesting  = false;
		foreach ($flags as $flag):
			$class = null;
			$class = ' class="'.$flag['Flag']['reason'].'"';
			
			//Check to see if the next item is the same as this one. If it is, create a nest
			/*
				TODO Get this nesting working. For now all like items are grouped
			*/
			if(intval($i+1) < count($flags)){
				if($flags[intval($i+1)]['Flag']['model'] == $flag['Flag']['model'] && $flags[intval($i+1)]['Flag']['model_id'] == $flag['Flag']['model_id']){
					if($nesting == false){
						//echo "<tr><td>";
						$nesting  = true;
					}
				}else{
					if($nesting == true){
						//echo "</td></tr>";
						$nesting  = false;
					}
				}
			}else{
				
			}
		?>
		<tr<?php echo $class;?>>
			<!--<td><?php //echo $flag['Flag']['id']; ?>&nbsp;</td>-->
			<td><?php echo $this->Form->checkbox('Flag.id.'.$flag['Flag']['id']); ?></td>
			<td class="<?php echo strtolower($flag['Flag']['model']); ?>"><?php echo $flag['Flag']['model']; ?>&nbsp;</td>
			<td><?php echo $flag['Flag']['model_id']; ?>&nbsp;</td>
			<td><?php echo $flag['Flag']['reason']; ?>&nbsp;</td>
			<td><?php echo $flag['User']['username']; ?>&nbsp;</td>
			<td><?php echo $flag['Flag']['description']; ?>&nbsp;</td>
			<?php $controller = Inflector::pluralize(strtolower($flag['Flag']['model'])); ?>
			<td class="count"><?php echo $flag['Flag']['count']; ?>&nbsp;</td>
			<td><?php echo $this->Time->niceShort($flag['Flag']['created']); ?>&nbsp;</td>
			<td class="actions">
				<?php //echo $this->Html->link(__('Remove flags', true), array('action' => 'admin_remove_flags', $flag['Flag']['id'])); ?>
				<?php echo $this->Html->link(__('See it', true),array(
																			'controller'=>$controller,
																			'action'=>'view',
																			'admin'=>false,
																			$flag['Flag']['model_id']
																			),array('target'=>'_blank')); ?>
				<?php //echo $this->Html->link(__('Deactivate', true), array('action' => 'admin_deactivate_flagged_item', $flag['Flag']['id']), null, sprintf(__('Are you sure you want to deactivate this %s?', true), strtolower($flag['Flag']['model']))); ?>
			</td>
		</tr>
	<?php 
		$i++;
		endforeach; 
	?>
		</table>
		<!-- Form Actions -->
		<div class="side-by-side clearfix"><div>
		<?php
			 echo $this->Form->input('actions', array(
																	'options'=>array(
																							'Delete Flags',
																							'Deactivate Items'
																							),
																	'empty' => '-- Choose an Action --',
																	'class'=>'chzn-select',
																	'style'=>'width:200px;'
																	));
			 echo $this->Form->end('Go');
		?>
		</div></div>
		<!-- End Form Actions -->
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
				<li><?php //echo $this->Html->link(__('New Flag', true), array('action' => 'add','admin'=>true)); ?></li>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">

//$(".chzn-select").chosen();

$(document).ready(function() {
	
	$("#FlagAll").click(function() {
		var checked_status = this.checked;
		//alert(checked_status);
		$('input[type="checkbox"]').each(function(){
			this.checked = checked_status;
		});
	});
});
</script>