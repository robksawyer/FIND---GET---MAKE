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
			echo "<br/>";
			echo $this->Html->link(__('ACL Management', true), '/admin/acl/')." | ";
			if ($this->Cupcake->user() && $this->Cupcake->hasAccess('admin')):
				echo $this->Html->link(__('Forum Admin', true), '/admin/forum/home')." | ";
			endif;
			echo $this->Html->link('Flag Management','/admin/flags',array('title'=>'Manage the items that people have flagged.'))." | ";
			echo $this->Html->link('Add a bug','http://find-get-make.lighthouseapp.com',array('title'=>'Add a bug','target'=>'_blank'));
			
		}
	?>
</div>