<div class="inspirationPhotoTags view">
<h2><?php  __('Inspiration Photo Tag');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inspirationPhotoTag['InspirationPhotoTag']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inspiration'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($inspirationPhotoTag['Inspiration']['name'], array('controller' => 'inspirations', 'action' => 'view', $inspirationPhotoTag['Inspiration']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inspirationPhotoTag['InspirationPhotoTag']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('X1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inspirationPhotoTag['InspirationPhotoTag']['x1']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Y1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inspirationPhotoTag['InspirationPhotoTag']['y1']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('X2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inspirationPhotoTag['InspirationPhotoTag']['x2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Y2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inspirationPhotoTag['InspirationPhotoTag']['y2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Width'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inspirationPhotoTag['InspirationPhotoTag']['width']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Height'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inspirationPhotoTag['InspirationPhotoTag']['height']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Inspiration Photo Tag', true), array('action' => 'edit', $inspirationPhotoTag['InspirationPhotoTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Inspiration Photo Tag', true), array('action' => 'delete', $inspirationPhotoTag['InspirationPhotoTag']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inspirationPhotoTag['InspirationPhotoTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Inspiration Photo Tags', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inspiration Photo Tag', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inspirations', true), array('controller' => 'inspirations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inspiration', true), array('controller' => 'inspirations', 'action' => 'add')); ?> </li>
	</ul>
</div>
