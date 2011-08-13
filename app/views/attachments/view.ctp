<div class="attachments view">
<h2><?php  __('Attachment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Size'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['size']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Filesize'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['filesize']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ext'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['ext']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['group']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Width'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['width']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Height'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['height']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['path']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Path Small'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['path_small']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Path Med'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['path_med']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Uploaded'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['uploaded']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attachment', true), array('action' => 'edit', $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Attachment', true), array('action' => 'delete', $attachment['Attachment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contractors', true), array('controller' => 'contractors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contractor', true), array('controller' => 'contractors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Houses', true), array('controller' => 'houses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New House', true), array('controller' => 'houses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sources', true), array('controller' => 'sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Contractors');?></h3>
	<?php if (!empty($attachment['Contractor'])):?>
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
		foreach ($attachment['Contractor'] as $contractor):
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
	<?php if (!empty($attachment['House'])):?>
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
		foreach ($attachment['House'] as $house):
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
	<?php if (!empty($attachment['Source'])):?>
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
		foreach ($attachment['Source'] as $source):
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
