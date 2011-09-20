<?php
if($ajax){
	$commentWidget->options(array('target' => '#comments',
											'ajaxAction' => 'comments'));
	echo $this->element('ajax', array('plugin' => 'comments'));
}else{
	$commentWidget->options(array('allowAnonymousComment' => false));
	echo $commentWidget->display();
}
?>