<div id="comments">
	<?php 
		//Fallback to simple non-ajax version
		$fallback = false;
		if(empty($fallback)){
			$commentWidget->options(array('target' => '#comments',
													'ajaxAction' => 'comments',
													'allowAnonymousComment' => false
													));
			echo $this->element('ajax', array('plugin' => 'comments'));
		}else{
			$commentWidget->options(array('allowAnonymousComment' => false));
			echo $commentWidget->display();
		}
	?>
</div>