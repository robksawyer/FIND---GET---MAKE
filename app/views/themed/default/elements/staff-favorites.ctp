<?php
	if(!empty($authUser)){
		//If the user isn't following all of the users listed, show the follow all button.
		if(!empty($usersNotFollowing)){
			echo $this->element('follow-all-button',array('cache'=>false,'user_ids'=>$usersNotFollowing)); 
		}else{
			//The user is following all of the users listed
		}
	}
?>
<h3>Staff Favorites</h3>
<?php
	if(!empty($favorites)){
		foreach($favorites as $favorite_user){
			echo $this->element('user-block-with-products',array('cache'=>false,'user'=>$favorite_user));
		}
	}else{
		echo "<h4>There are no staff favorites at this time.</h4>";
	}
	
	//debug($favorites);
?>