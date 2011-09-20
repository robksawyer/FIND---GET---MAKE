<div class="comments index">
	<h2><?php __('Comments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('parent_id');?></th>
			<th><?php echo $this->Paginator->sort('model_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('lft');?></th>
			<th><?php echo $this->Paginator->sort('rght');?></th>
			<th><?php echo $this->Paginator->sort('model');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('is_spam');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('slug');?></th>
			<th><?php echo $this->Paginator->sort('body');?></th>
			<th><?php echo $this->Paginator->sort('author_name');?></th>
			<th><?php echo $this->Paginator->sort('author_url');?></th>
			<th><?php echo $this->Paginator->sort('author_email');?></th>
			<th><?php echo $this->Paginator->sort('language');?></th>
			<th><?php echo $this->Paginator->sort('comment_type');?></th>
			<th><?php echo $this->Paginator->sort('rating');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($comments as $comment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $comment['Comment']['id']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['parent_id']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['model_id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($comment['User']['username'], array('controller' => 'users', 'action' => 'view', $comment['User']['id'])); ?>
		</td>
		<td><?php echo $comment['Comment']['lft']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['rght']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['model']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['approved']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['is_spam']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['title']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['slug']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['body']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['author_name']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['author_url']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['author_email']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['language']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['comment_type']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['rating']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['created']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $comment['Comment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $comment['Comment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $comment['Comment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comment['Comment']['id'])); ?>
		</td>
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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Comment', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>