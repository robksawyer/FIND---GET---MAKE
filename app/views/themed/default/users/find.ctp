<div class="left-container">
	<ul class="find-people">
		<li><?php echo $this->Html->link('Staff favorites',array('admin'=>false,'controller'=>'users','action'=>'find','staff-favorites')); ?></li>
		<li>Facebook</li>
		<li>Twitter</li>
		<li>Search</li>
</div>
<div class="right-container-index">
	<div class="find-people">
		<h3><b>Follow people on FIND|GET|MAKE</b> to discover new products</h3>
		<div class="staff-favorites">
			<?php echo $this->element('staff-favorites',array('cache'=>false)); ?>
		</div>
	</div>
</div>