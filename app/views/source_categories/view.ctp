<div class="sourceCategories view">
<h2><?php  __('Source Category');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sourceCategory['SourceCategory']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sourceCategory['SourceCategory']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Slug'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sourceCategory['SourceCategory']['slug']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sourceCategory['SourceCategory']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sourceCategory['SourceCategory']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Source Category', true), array('action' => 'edit', $sourceCategory['SourceCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Source Category', true), array('action' => 'delete', $sourceCategory['SourceCategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sourceCategory['SourceCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Source Categories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source Category', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sources', true), array('controller' => 'sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Sources');?></h3>
	<?php if (!empty($sourceCategory['Source'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Slug'); ?></th>
		<th><?php __('Source Category Id'); ?></th>
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
		<th><?php __('Favorite'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sourceCategory['Source'] as $source):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $source['id'];?></td>
			<td><?php echo $source['name'];?></td>
			<td><?php echo $source['slug'];?></td>
			<td><?php echo $source['source_category_id'];?></td>
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
			<td><?php echo $source['favorite'];?></td>
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
