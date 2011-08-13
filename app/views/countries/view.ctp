<div class="countries view">
<h2><?php  __('Country');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
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
<div class="related">
	<h3><?php __('Related Clients');?></h3>
	<?php if (!empty($country['Client'])):?>
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
		<th class="actions"><?php __('Actions');?></th>
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
			<td><?php echo $client['id'];?></td>
			<td><?php echo $client['name'];?></td>
			<td><?php echo $client['slug'];?></td>
			<td><?php echo $client['description'];?></td>
			<td><?php echo $client['address1'];?></td>
			<td><?php echo $client['address2'];?></td>
			<td><?php echo $client['city'];?></td>
			<td><?php echo $client['state'];?></td>
			<td><?php echo $client['zip'];?></td>
			<td><?php echo $client['country_id'];?></td>
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
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'clients', 'action' => 'view', $client['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'clients', 'action' => 'edit', $client['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'clients', 'action' => 'delete', $client['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $client['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Client', true), array('controller' => 'clients', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Contractors');?></h3>
	<?php if (!empty($country['Contractor'])):?>
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
		<th class="actions"><?php __('Actions');?></th>
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
			<td><?php echo $contractor['id'];?></td>
			<td><?php echo $contractor['name'];?></td>
			<td><?php echo $contractor['slug'];?></td>
			<td><?php echo $contractor['description'];?></td>
			<td><?php echo $contractor['address1'];?></td>
			<td><?php echo $contractor['address2'];?></td>
			<td><?php echo $contractor['city'];?></td>
			<td><?php echo $contractor['state'];?></td>
			<td><?php echo $contractor['zip'];?></td>
			<td><?php echo $contractor['country_id'];?></td>
			<td><?php echo $contractor['phone'];?></td>
			<td><?php echo $contractor['email'];?></td>
			<td><?php echo $contractor['fax'];?></td>
			<td><?php echo $contractor['url'];?></td>
			<td><?php echo $contractor['created'];?></td>
			<td><?php echo $contractor['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'contractors', 'action' => 'view', $contractor['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'contractors', 'action' => 'edit', $contractor['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'contractors', 'action' => 'delete', $contractor['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contractor['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Houses');?></h3>
	<?php if (!empty($country['House'])):?>
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
		foreach ($country['House'] as $house):
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
			<li><?php echo $this->Html->link(__('New House', true), array('controller' => 'houses', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Sources');?></h3>
	<?php if (!empty($country['Source'])):?>
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
		<th class="actions"><?php __('Actions');?></th>
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
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'sources', 'action' => 'view', $source['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'sources', 'action' => 'edit', $source['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'sources', 'action' => 'delete', $source['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $source['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
