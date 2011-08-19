<div class="betaUsers view">
<h2><?php  __('Beta User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $betaUser['BetaUser']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $betaUser['BetaUser']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $betaUser['BetaUser']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $betaUser['BetaUser']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Beta User', true), array('action' => 'edit', $betaUser['BetaUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Beta User', true), array('action' => 'delete', $betaUser['BetaUser']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $betaUser['BetaUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Beta Users', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Beta User', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
