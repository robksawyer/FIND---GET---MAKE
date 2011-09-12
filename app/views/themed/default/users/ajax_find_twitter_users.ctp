<?php
if($results['error']){
	echo "<h3 style='color:red'>There was an error accessing your friend list. It could be a rate limit issue, or it could be a permissions issue. Please try again later.</h3>";
}else{
	if(!empty($results)){
		foreach($results as $result_user){
			echo $this->element('user-block-with-products',array('cache'=>false,'user'=>$result_user));
		}
	}else{
		echo "<h3>Your search contained no results.</h3>";
	}
}

?>