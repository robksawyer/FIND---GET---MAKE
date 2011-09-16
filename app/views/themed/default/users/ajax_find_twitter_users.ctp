<?php
	if(!empty($results) && empty($results['error'])){
		if(!empty($authUser) && !empty($user_ids)){
			//If the user isn't following all of the users listed, show the follow all button.
			echo $this->element('follow-all-button',array('cache'=>false,'user_ids'=>$user_ids));
		}
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