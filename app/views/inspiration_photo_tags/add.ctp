<div class="inspirationPhotoTags form">
<?php echo $this->Form->create('InspirationPhotoTag');?>
	<fieldset>
		<legend><?php __('Add Inspiration Photo Tag'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Inspiration Photo Tags', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Inspirations', true), array('controller' => 'inspirations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inspiration', true), array('controller' => 'inspirations', 'action' => 'add')); ?> </li>
	</ul>
</div>