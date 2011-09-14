<?php
	if(!empty($results)){
		echo $this->element('follow-all-button',array('cache'=>false));
	}
	echo "<h3>Friends from Facebook.</h3>";
?>
<?php
if(!empty($results)){
	foreach($results as $result_user){
		echo $this->element('user-block-with-products',array('cache'=>false,'user'=>$result_user));
	}
}else{
	echo "<h4>No Facebook friends found.</h4>";
}
?>