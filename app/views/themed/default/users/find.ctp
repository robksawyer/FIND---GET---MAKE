<div id="left-panel-index">
	<?php 
		if(empty($facebookConnectURL)) $facebookConnectURL = "";
		echo $this->element('find-people-nav',array('cache'=>false,'selected'=>'staff_favorites','facebookConnectURL'=>$facebookConnectURL)); 
	?>
</div>
<div id="right-panel">
	<div class="find-people">
		<h3><b>Follow people on FIND|GET|MAKE</b> to discover new products</h3>
		<div id="staff-favorites">
			<?php echo $this->element('staff-favorites',array('cache'=>false)); ?>
		</div>
		<div id="search-results" style="display:none">
			
		</div>
		<div id="find-user-loader" style="display:none"><?php echo $this->Html->image('ajax-loader.gif',array('alt'=>'Loading...')); ?></div>
	</div>
</div>