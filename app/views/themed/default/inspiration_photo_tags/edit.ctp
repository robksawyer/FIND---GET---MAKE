<div class="inspirationPhotoTags form">
<?php echo $this->Form->create('InspirationPhotoTag');?>
	<fieldset>
		<legend><?php __('Edit Inspiration Photo Tag'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('inspiration_id');
		echo $this->Form->input('name');
		echo $this->Form->input('x1');
		echo $this->Form->input('y1');
		echo $this->Form->input('x2');
		echo $this->Form->input('y2');
		echo $this->Form->input('width');
		echo $this->Form->input('height');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('InspirationPhotoTag.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('InspirationPhotoTag.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Inspiration Photo Tags', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Inspirations', true), array('controller' => 'inspirations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inspiration', true), array('controller' => 'inspirations', 'action' => 'add')); ?> </li>
	</ul>
</div>