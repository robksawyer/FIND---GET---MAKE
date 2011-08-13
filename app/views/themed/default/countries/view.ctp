<div class="countries view">
<h2><?php  __('Items related to '.$country['Country']['name']);?></h2>
</div>
<div class="actions">
	<!--<h3><?php //__('Actions'); ?></h3>-->
	<ul style="display: none">
		<li><?php echo $this->Html->link(__('Edit Country', true), array('action' => 'edit', $country['Country']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Country', true), array('action' => 'delete', $country['Country']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $country['Country']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients', true), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client', true), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contractors', true), array('controller' => 'contractors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Houses', true), array('controller' => 'houses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New House', true), array('controller' => 'houses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sources', true), array('controller' => 'sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php if (!empty($country['Client'])):?>
<div class="related">
	<h3><?php __('Related Clients');?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Address1'); ?></th>
		<th><?php __('Address2'); ?></th>
		<th><?php __('City'); ?></th>
		<th><?php __('State'); ?></th>
		<th><?php __('Zip'); ?></th>
		<th><?php __('Country'); ?></th>
		<th><?php __('Phone'); ?></th>
		<th><?php __('Fax'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Job Title'); ?></th>
		<th><?php __('Total Children'); ?></th>
		<th><?php __('Salary Range'); ?></th>
		<th><?php __('Style Description'); ?></th>
		<th><?php __('Personal Description'); ?></th>
		<th><?php __('Favorite Colors'); ?></th>
		<th><?php __('Favorite Patterns'); ?></th>
		<th><?php __('Favorite Designers'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($country['Client'] as $client):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($client['name'],array('controller'=>'clients','action'=>'view',$client['id']));?></td>
			<td><?php echo $client['description'];?></td>
			<td><?php echo $client['address1'];?></td>
			<td><?php echo $client['address2'];?></td>
			<td><?php echo $client['city'];?></td>
			<td><?php echo $client['state'];?></td>
			<td><?php echo $client['zip'];?></td>
			<td><?php echo $country['Country']['name'];?></td>
			<td><?php echo $client['phone'];?></td>
			<td><?php echo $client['fax'];?></td>
			<td><?php echo $client['url'];?></td>
			<td><?php echo $client['job_title'];?></td>
			<td><?php echo $client['total_children'];?></td>
			<td><?php echo $client['salary_range'];?></td>
			<td><?php echo $client['style_description'];?></td>
			<td><?php echo $client['personal_description'];?></td>
			<td><?php echo $client['favorite_colors'];?></td>
			<td><?php echo $client['favorite_patterns'];?></td>
			<td><?php echo $client['favorite_designers'];?></td>
			<td><?php echo $client['created'];?></td>
			<td><?php echo $client['modified'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<div class="actions" style="display:none;">
		<ul>
			<li><?php //echo $this->Html->link(__('New Client', true), array('controller' => 'clients', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<?php endif; ?>

<?php if (!empty($country['Contractor'])):?>
<div class="related">
	<h3><?php __('Related Contractors');?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Address1'); ?></th>
		<th><?php __('Address2'); ?></th>
		<th><?php __('City'); ?></th>
		<th><?php __('State'); ?></th>
		<th><?php __('Zip'); ?></th>
		<th><?php __('Country Id'); ?></th>
		<th><?php __('Phone'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Fax'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($country['Contractor'] as $contractor):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($contractor['name'],array('controller'=>'contractors','action'=>'view',$contractor['id']));?></td>
			<td><?php echo $contractor['description'];?></td>
			<td><?php echo $contractor['address1'];?></td>
			<td><?php echo $contractor['address2'];?></td>
			<td><?php echo $contractor['city'];?></td>
			<td><?php echo $contractor['state'];?></td>
			<td><?php echo $contractor['zip'];?></td>
			<td><?php echo $country['Country']['name'];?></td>
			<td><?php echo $contractor['phone'];?></td>
			<td><?php echo $contractor['email'];?></td>
			<td><?php echo $contractor['fax'];?></td>
			<td><?php echo $contractor['url'];?></td>
			<td><?php echo $contractor['created'];?></td>
			<td><?php echo $contractor['modified'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<div class="actions" style="display:none;">
		<ul>
			<li><?php //echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<?php endif; ?>

<?php if (!empty($country['House'])):?>
<div class="related">
	<h3><?php __('Related Houses');?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Client'); ?></th>
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
	</tr>
	<?php
		$i = 0;
		foreach ($country['House'] as $house):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($house['Client']['name'],array('controller'=>'clients','action'=>'view',$house['Client']['id']));?></td>
			<td><?php echo $this->Html->link($house['name'],array('controller'=>'houses','action'=>'view',$house['id']));?></td>
			<td><?php echo $house['description'];?></td>
			<td><?php echo $house['address1'];?></td>
			<td><?php echo $house['address2'];?></td>
			<td><?php echo $house['city'];?></td>
			<td><?php echo $house['state'];?></td>
			<td><?php echo $house['zip'];?></td>
			<td><?php echo $country['Country']['name'];?></td>
			<td><?php echo $house['bedrooms'];?></td>
			<td><?php echo $house['bathrooms'];?></td>
			<td><?php echo $house['amenities'];?></td>
			<td><?php echo $house['phone'];?></td>
			<td><?php echo $house['more_details'];?></td>
			<td><?php echo $house['square_footage'];?></td>
			<td><?php echo $this->Time->niceShort($house['created'],'','');?></td>
			<td><?php echo $this->Time->niceShort($house['modified'],'','');?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<div class="actions" style="display:none;">
		<ul>
			<li><?php //echo $this->Html->link(__('New House', true), array('controller' => 'houses', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<?php endif; ?>

<?php if (!empty($country['Source'])):?>
<div class="related">
	<h3><?php __('Related Sources');?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Slug'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Address1'); ?></th>
		<th><?php __('Address2'); ?></th>
		<th><?php __('City'); ?></th>
		<th><?php __('State'); ?></th>
		<th><?php __('Zip'); ?></th>
		<th><?php __('Country Id'); ?></th>
		<th><?php __('Phone'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Fax'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($country['Source'] as $source):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $source['id'];?></td>
			<td><?php echo $source['name'];?></td>
			<td><?php echo $source['slug'];?></td>
			<td><?php echo $source['description'];?></td>
			<td><?php echo $source['address1'];?></td>
			<td><?php echo $source['address2'];?></td>
			<td><?php echo $source['city'];?></td>
			<td><?php echo $source['state'];?></td>
			<td><?php echo $source['zip'];?></td>
			<td><?php echo $source['country_id'];?></td>
			<td><?php echo $source['phone'];?></td>
			<td><?php echo $source['email'];?></td>
			<td><?php echo $source['fax'];?></td>
			<td><?php echo $source['url'];?></td>
			<td><?php echo $source['created'];?></td>
			<td><?php echo $source['modified'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<div class="actions" style="display:none;">
		<ul>
			<li><?php //echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<?php endif; ?>
