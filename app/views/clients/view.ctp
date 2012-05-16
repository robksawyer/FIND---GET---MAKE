<div class="clients view">
<h2><?php  __('Client');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Slug'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['slug']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['address1']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['address2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('City'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['city']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('State'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['state']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['zip']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Country'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($client['Country']['name'], array('controller' => 'countries', 'action' => 'view', $client['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Phone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['phone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fax'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['fax']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Job Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['job_title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total Children'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['total_children']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Salary Range'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['salary_range']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Style Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['style_description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Personal Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['personal_description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Favorite Colors'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['favorite_colors']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Favorite Patterns'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['favorite_patterns']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Favorite Designers'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['favorite_designers']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $client['Client']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="bottom">
	
	<?php 
	//debug($house);
	if(!empty($client['Tag'])): 
	?>
	<dl class="keyword-container">
		<dt>
			Keywords: 
			<ul class="tags">
			<?php if (!empty($client['Tag'])): ?>
				<?php 
					$totalKeywords = count($client['Tag']);
					$counter = 0;
					foreach ($client['Tag'] as $tag): 
						$counter++;
						if($counter != $totalKeywords):
				?>
						<!--<li><a href="<?php //echo '/sales/index/by:'.$tag['name']; ?>" title="'".$tag['name']."'"><?php echo $tag['name']; ?></a></li>-->
						<li><?php echo $this->Html->link($tag['name'],array('action'=>'index/by:'.$tag['name'])).''; ?></li>
					<?php else: ?>
						<li><?php echo $this->Html->link($tag['name'],array('action'=>'index/by:'.$tag['name'])); ?></li>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			</ul>
		</dt>
	</dl>
	<?php endif; ?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Client', true), array('action' => 'edit', $client['Client']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Client', true), array('action' => 'delete', $client['Client']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $client['Client']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Houses', true), array('controller' => 'houses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New House', true), array('controller' => 'houses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments', true), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment', true), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags', true), array('controller' => 'tags', 'action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Houses');?></h3>
	<?php if (!empty($client['House'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Client Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Address1'); ?></th>
		<th><?php __('Address2'); ?></th>
		<th><?php __('City'); ?></th>
		<th><?php __('State'); ?></th>
		<th><?php __('Zip'); ?></th>
		<th><?php __('Country Id'); ?></th>
		<th><?php __('Bedrooms'); ?></th>
		<th><?php __('Bathrooms'); ?></th>
		<th><?php __('Amenities'); ?></th>
		<th><?php __('Phone'); ?></th>
		<th><?php __('More Details'); ?></th>
		<th><?php __('Square Footage'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($client['House'] as $house):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $house['id'];?></td>
			<td><?php echo $house['client_id'];?></td>
			<td><?php echo $house['name'];?></td>
			<td><?php echo $house['description'];?></td>
			<td><?php echo $house['address1'];?></td>
			<td><?php echo $house['address2'];?></td>
			<td><?php echo $house['city'];?></td>
			<td><?php echo $house['state'];?></td>
			<td><?php echo $house['zip'];?></td>
			<td><?php echo $house['country_id'];?></td>
			<td><?php echo $house['bedrooms'];?></td>
			<td><?php echo $house['bathrooms'];?></td>
			<td><?php echo $house['amenities'];?></td>
			<td><?php echo $house['phone'];?></td>
			<td><?php echo $house['more_details'];?></td>
			<td><?php echo $house['square_footage'];?></td>
			<td><?php echo $house['created'];?></td>
			<td><?php echo $house['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'houses', 'action' => 'view', $house['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'houses', 'action' => 'edit', $house['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'houses', 'action' => 'delete', $house['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $house['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New House', true), array('controller' => 'houses', 'action' => 'add',$client['Client']['id']));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Attachments');?></h3>
	<?php if (!empty($client['Attachment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Size'); ?></th>
		<th><?php __('Filesize'); ?></th>
		<th><?php __('Ext'); ?></th>
		<th><?php __('Group'); ?></th>
		<th><?php __('Width'); ?></th>
		<th><?php __('Height'); ?></th>
		<th><?php __('Path'); ?></th>
		<th><?php __('Path Small'); ?></th>
		<th><?php __('Path Med'); ?></th>
		<th><?php __('Uploaded'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($client['Attachment'] as $attachment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $attachment['id'];?></td>
			<td><?php echo $attachment['name'];?></td>
			<td><?php echo $attachment['type'];?></td>
			<td><?php echo $attachment['size'];?></td>
			<td><?php echo $attachment['filesize'];?></td>
			<td><?php echo $attachment['ext'];?></td>
			<td><?php echo $attachment['group'];?></td>
			<td><?php echo $attachment['width'];?></td>
			<td><?php echo $attachment['height'];?></td>
			<td><?php echo $attachment['path'];?></td>
			<td><?php echo $attachment['path_small'];?></td>
			<td><?php echo $attachment['path_med'];?></td>
			<td><?php echo $attachment['uploaded'];?></td>
			<td><?php echo $attachment['created'];?></td>
			<td><?php echo $attachment['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'attachments', 'action' => 'view', $attachment['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'attachments', 'action' => 'edit', $attachment['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'attachments', 'action' => 'delete', $attachment['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attachment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Attachment', true), array('controller' => 'attachments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>