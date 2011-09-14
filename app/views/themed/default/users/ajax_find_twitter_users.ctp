<?php
	if(!empty($results) && empty($results['error'])){
		echo $this->element('follow-all-button',array('cache'=>false));
	}
	echo "<h3>Friends from Twitter.</h3>";
?>
<?php
if(!empty($results['error'])){
	echo "<h4 style='color:red'>".$results['error']."</h4>";
}else{
	
	if(!empty($results)){
		foreach($results as $result_user){
			echo $this->element('user-block-with-products',array('cache'=>false,'user'=>$result_user));
		}
	}else{
		echo "<h4>No Twitter friends found.</h4>";
	}
}

?>