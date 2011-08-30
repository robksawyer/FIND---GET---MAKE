<?php

?>
<div id="login-container">
	<?php
		if(empty($authUser)){
			if ($this->params['action'] != 'login') {
				echo $this->Html->link('Login','/login',array('title'=>'Login'));
			}
		}else{
			if(!empty($authUser['User']['fullname'])){
				echo "Hi, ".ucwords($authUser['User']['fullname']).". | ";
			}else{
				echo "Hi, ".$authUser['User']['username'].". | ";
			}
			echo $this->Html->link('Your Space','/users/moderate',array('title'=>'Check out your space.'))." | ";
			echo $this->Html->link('Logout','/logout',array('title'=>'Logout'));
		}
	?>
</div>