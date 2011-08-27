<div id="navigation">
	 <span class="fr">
		  <?php // User links
		  $links = array();
		  if($this->Cupcake->user()) {
				//$links[] = $this->Html->link(__('View New Posts', true), array('controller' => 'search', 'action' => 'index', 'new_posts', 'admin' => false));
				$links[] = $this->Html->link(__('View Your Profile', true), array('controller' => 'users', 'action' => 'profile', $this->Cupcake->user('username'), 'admin' => false));
				if($this->params['action']!='edit'){
					$links[] = $this->Html->link(__('Edit Profile', true), array('controller' => 'users', 'action' => 'edit', 'admin' => false));
				}
				//$links[] = $this->Html->link(__('Logout', true), array('controller' => 'users', 'action' => 'logout', 'admin' => false));
		  } else {
				//$links[] = $this->Html->link(__('Login', true), array('controller' => 'users', 'action' => 'login'));
				$links[] = $this->Html->link(__('Register', true), '/register');
				$links[] = $this->Html->link(__('Forgot Password', true), array('controller' => 'users', 'action' => 'forgot'));
		  }
		  
		  $links[] = $this->Time->nice(time(), $this->Cupcake->timezone());
		  echo implode(' - ', $links); ?>
	 </span>
	 
	 <?php echo $this->Html->getCrumbs(' &raquo; '); ?>
	 <span class="clear"><!-- --></span>
</div>
