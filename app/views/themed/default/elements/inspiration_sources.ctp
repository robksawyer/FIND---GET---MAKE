<div class="related">
	<?php if(!empty($title)): ?>
		<h4><?php __($title);?></h4>
	<?php else: ?>
		<h4><?php __('Sources');?></h4>
	<?php endif; ?>
	<?php if(!empty($item['Product'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Category'); ?></th>
		<!--<th><?php //__('City'); ?></th>
		<th><?php //__('State'); ?></th>
		<th><?php //__('Zip'); ?></th>
		<th><?php //__('Country Id'); ?></th>-->
		<th><?php __('Url'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Product'] as $source):
			$source = $source['Source'];
			if(!empty($source['id'])):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				//debug($source);
		?>
		<tr<?php echo $class;?>>
			<td><?php 
				if(empty($client)){
					echo $this->Html->link($source['name'],array('controller'=>'sources','action'=>'view',$source['id']),array('title'=>$source['description']));
				}else{
					//Check keycode
					if(empty($source['keycode'])){
						//Generate keycode
						echo $this->Html->link($source['name'],array('controller'=>'sources','action'=>'generateKeycode',$source['id']),array('title'=>$source['description']));
					}else{
						echo $this->Html->link($source['name'],array('controller'=>'sources','action'=>'key',$source['keycode']),array('title'=>$source['description']));
					}
				}
				?></td>
			<td><?php 
				if(!empty($source['SourceCategory']['name'])){
					if(empty($client)){
						echo $this->Html->link($source['SourceCategory']['name'],array('controller'=>'sources_categories','action'=>'view',$source['SourceCategory']['id']),array('title'=>$source['SourceCategory']['name']));
					}else{
						echo $source['SourceCategory']['name'];
					}
				}
			?></td>
			<!--<td><?php //echo $source['city'];?></td>
			<td><?php //echo $source['state'];?></td>
			<td><?php //echo $source['zip'];?></td>
			<td><?php //echo $source['Country']['name'];?></td>-->
			<td><?php echo $this->Html->link($source['url'],$source['url'],array('target'=>'_blank'));?></td>
		</tr>
	<?php 
			endif;
		endforeach; 
	?>
	</table>
<?php else: ?>
	<div class="empty">There are no sources attached to this inspiration.</div>
<?php endif; ?>
<?php 
	$disableAdding = true;
	if(empty($disableAdding)): 
?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Source', true), array('controller'=>'sources', 'action' => 'add','model'=>$model,'id'=>$item[$model]['id'],'admin'=>true));?> </li>
		</ul>
	</div>
	<?php endif; ?>
</div>