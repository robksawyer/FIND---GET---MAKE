<?php
	//var_dump($results);
	if(!empty($results)){
		foreach($results as $result_user){
			echo $this->element('user-block-with-products',array('cache'=>false,'user'=>$result_user));
		}
	}else{
		echo "<h3>Your search contained no results.</h3>";
	}
	
?>