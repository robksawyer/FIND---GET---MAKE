<div class="groups view">
<h2><?php  __('Group');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group', true), array('action' => 'edit', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Group', true), array('action' => 'delete', $group['Group']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Users');?></h3>
	<?php if (!empty($group['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Group Id'); ?></th>
		<th><?php __('Auto Login'); ?></th>
		<th><?php __('Attachment Id'); ?></th>
		<th><?php __('Username'); ?></th>
		<th><?php __('Fullname'); ?></th>
		<th><?php __('Birthday'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Location'); ?></th>
		<th><?php __('Gender'); ?></th>
		<th><?php __('About'); ?></th>
		<th><?php __('Active'); ?></th>
		<th><?php __('Banned'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Password'); ?></th>
		<th><?php __('Slug'); ?></th>
		<th><?php __('Hide Competitions'); ?></th>
		<th><?php __('Hide Welcome'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Signature'); ?></th>
		<th><?php __('Locale'); ?></th>
		<th><?php __('Timezone'); ?></th>
		<th><?php __('TotalProducts'); ?></th>
		<th><?php __('TotalSources'); ?></th>
		<th><?php __('TotalCollections'); ?></th>
		<th><?php __('TotalInspirations'); ?></th>
		<th><?php __('TotalUfos'); ?></th>
		<th><?php __('TotalPosts'); ?></th>
		<th><?php __('TotalTopics'); ?></th>
		<th><?php __('TotalProductLikes'); ?></th>
		<th><?php __('TotalProductDislikes'); ?></th>
		<th><?php __('TotalSourceLikes'); ?></th>
		<th><?php __('TotalSourceDislikes'); ?></th>
		<th><?php __('TotalInspirationLikes'); ?></th>
		<th><?php __('TotalInspirationDislikes'); ?></th>
		<th><?php __('TotalUfoLikes'); ?></th>
		<th><?php __('TotalUfoDislikes'); ?></th>
		<th><?php __('TotalCollectionLikes'); ?></th>
		<th><?php __('TotalCollectionDislikes'); ?></th>
		<th><?php __('TotalFollowers'); ?></th>
		<th><?php __('TotalUsersFollowing'); ?></th>
		<th><?php __('Staff Favorite'); ?></th>
		<th><?php __('CurrentLogin'); ?></th>
		<th><?php __('LastLogin'); ?></th>
		<th><?php __('Facebook Id'); ?></th>
		<th><?php __('Twitter Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['group_id'];?></td>
			<td><?php echo $user['auto_login'];?></td>
			<td><?php echo $user['attachment_id'];?></td>
			<td><?php echo $user['username'];?></td>
			<td><?php echo $user['fullname'];?></td>
			<td><?php echo $user['birthday'];?></td>
			<td><?php echo $user['url'];?></td>
			<td><?php echo $user['location'];?></td>
			<td><?php echo $user['gender'];?></td>
			<td><?php echo $user['about'];?></td>
			<td><?php echo $user['active'];?></td>
			<td><?php echo $user['banned'];?></td>
			<td><?php echo $user['email'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['slug'];?></td>
			<td><?php echo $user['hide_competitions'];?></td>
			<td><?php echo $user['hide_welcome'];?></td>
			<td><?php echo $user['created'];?></td>
			<td><?php echo $user['modified'];?></td>
			<td><?php echo $user['status'];?></td>
			<td><?php echo $user['signature'];?></td>
			<td><?php echo $user['locale'];?></td>
			<td><?php echo $user['timezone'];?></td>
			<td><?php echo $user['totalProducts'];?></td>
			<td><?php echo $user['totalSources'];?></td>
			<td><?php echo $user['totalCollections'];?></td>
			<td><?php echo $user['totalInspirations'];?></td>
			<td><?php echo $user['totalUfos'];?></td>
			<td><?php echo $user['totalPosts'];?></td>
			<td><?php echo $user['totalTopics'];?></td>
			<td><?php echo $user['totalProductLikes'];?></td>
			<td><?php echo $user['totalProductDislikes'];?></td>
			<td><?php echo $user['totalSourceLikes'];?></td>
			<td><?php echo $user['totalSourceDislikes'];?></td>
			<td><?php echo $user['totalInspirationLikes'];?></td>
			<td><?php echo $user['totalInspirationDislikes'];?></td>
			<td><?php echo $user['totalUfoLikes'];?></td>
			<td><?php echo $user['totalUfoDislikes'];?></td>
			<td><?php echo $user['totalCollectionLikes'];?></td>
			<td><?php echo $user['totalCollectionDislikes'];?></td>
			<td><?php echo $user['totalFollowers'];?></td>
			<td><?php echo $user['totalUsersFollowing'];?></td>
			<td><?php echo $user['staff_favorite'];?></td>
			<td><?php echo $user['currentLogin'];?></td>
			<td><?php echo $user['lastLogin'];?></td>
			<td><?php echo $user['facebook_id'];?></td>
			<td><?php echo $user['twitter_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
