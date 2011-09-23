<?php
if(!empty($ajax)){
	$commentWidget->options(array('target' => '#product-comments',
											'ajaxAction' => "comments"));
	echo $this->element('ajax', array('plugin' => 'comments'));
}else{
	$commentWidget->options(array('allowAnonymousComment' => false));
	echo $commentWidget->display();
}
?>