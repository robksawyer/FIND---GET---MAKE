<div id="left-panel-index">
	<?php echo $this->element('find-people-nav',array('cache'=>false,'selected'=>'staff_favorites')); ?>
</div>
<div id="right-panel">
	<div class="find-people">
		<h3><b>Follow people on FIND|GET|MAKE</b> to discover new products</h3>
		<div id="staff-favorites">
			<?php echo $this->element('staff-favorites',array('cache'=>false)); ?>
		</div>
		<div id="search-results" style="display:none">
			
		</div>
	</div>
</div>