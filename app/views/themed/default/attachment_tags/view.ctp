<div class="attachmentTags view">
<h2><?php  __('Attachment Tag');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachmentTag['AttachmentTag']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Attachment'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($attachmentTag['Attachment']['name'], array('controller' => 'attachments', 'action' => 'view', $attachmentTag['Attachment']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachmentTag['AttachmentTag']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('X1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachmentTag['AttachmentTag']['x1']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Y1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachmentTag['AttachmentTag']['y1']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('X2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachmentTag['AttachmentTag']['x2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Y2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachmentTag['AttachmentTag']['y2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Width'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachmentTag['AttachmentTag']['width']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Height'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachmentTag['AttachmentTag']['height']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attachment Tag', true), array('action' => 'edit', $attachmentTag['AttachmentTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Attachment Tag', true), array('action' => 'delete', $attachmentTag['AttachmentTag']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attachmentTag['AttachmentTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachment Tags', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment Tag', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments', true), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment', true), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
	</ul>
</div>
