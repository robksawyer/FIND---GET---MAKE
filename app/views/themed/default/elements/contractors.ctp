<div class="related">
	<h3><?php __('Related Contractors');?></h3>
	<?php if (!empty($item['Contractor'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Contractor'] as $contractor):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($contractor['name'],array('controller'=>'contractors','action'=>'view',$contractor['id']));?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add','model'=>$model,'id'=>$item[$model]['id'],'admin'=>true));?> </li>
		</ul>
	</div>
</div>