<?php
	if(!empty($results)){
		if(!empty($authUser) && !empty($user_ids)){
			//If the user isn't following all of the users listed, show the follow all button.
			echo $this->element('follow-all-button',array('cache'=>false,'user_ids'=>$user_ids));
		}
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