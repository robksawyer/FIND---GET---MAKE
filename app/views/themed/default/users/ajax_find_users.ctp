<?php
	if(!empty($results)){
		echo $this->element('follow-all-button',array('cache'=>false));
		echo $this->Html->scriptBlock("$('#SearchQuery').css({border:'3px solid #cdfecd'});");
	}else{
		echo $this->Html->scriptBlock("$('#SearchQuery').css({border:'3px solid #f9b3a8'});");
	}
	echo "<h3>Search results for <span class='query'>$query</span></h3>";
?>
<?php
	if(!empty($results)){
		foreach($results as $result_user){
			echo $this->element('user-block-with-products',array('cache'=>false,'user'=>$result_user));
		}
	}else{
		echo "<h4>Your search contained no results.</h4>";
	}
?>
<?php 
//echo $this->Js->writeBuffer(); // write cached scripts 
?>