<div id="user-nav-wrapper">
	<div id="nav-admin" class="user-nav">
		<ul id="user-nav">
			<li>
			<?php
				if(!empty($authUser)){
					if(!empty($authUser['User']['fullname'])){
						echo "Hi, ".ucwords($authUser['User']['fullname']).". | ";
					}else{
						echo "Hi, ".$authUser['User']['username'].". | ";
					}
					echo $this->Html->link('Your Space','/users/moderate',array('title'=>'Check out your space.'))." | ";
				}
			?>
			</li>
			<?php if(!empty($authUser)): ?>
			<li>
				<?php echo $this->Html->link('Profile','#',array('title'=>'Profile'))." | "; ?>
				<ul id="product-sub-nav" class="sub-nav" style="">
					<li><?php echo $this->Html->link('Followers',array('controller'=>'user_followings','action'=>'followers',$authUser['User']['username']),array('title'=>'Followers')); ?></li>
					<li><?php echo $this->Html->link('Following',array('controller'=>'user_followings','action'=>'following',$authUser['User']['username']),array('title'=>'Following')); ?></li>
					<li><?php echo $this->Html->link('Settings',array('controller'=>'settings','action'=>'account'),array('title'=>'Settings')); ?></li>
				</ul>
			</li>
			<li>
				<?php echo $this->Html->link('Administer','#',array('title'=>'Administer'))." | "; ?>
				<ul id="admin-sub-nav" class="sub-nav" style="">
					<li><?php echo $this->Html->link(__('ACL Management', true), '/admin/acl/'); ?></li>
					<li><?php echo $this->Html->link('Add a bug','http://find-get-make.lighthouseapp.com',array('title'=>'Add a bug','target'=>'_blank')); ?></li>
					<li><?php echo $this->Html->link('Flag Management','/admin/flags',array('title'=>'Manage the items that people have flagged.')); ?></li>
					<li><?php 
						if ($this->Cupcake->user() && $this->Cupcake->hasAccess('admin')):
							echo $this->Html->link(__d('forum', 'Forum Admin', true), '/admin/forum/home')." | ";
						endif;
					?></li>
				</ul>
			</li>
			<?php endif; ?>
			<li>
			<?php
				if(empty($authUser)){
					if ($this->params['action'] != 'login') {
						echo $this->Html->link('Login','/login',array('title'=>'Login'));
					}
				}else{
					echo $this->Html->link('Logout','/logout',array('title'=>'Logout'));
				}
			?>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
//<![CDATA[
window.addEventListener("FGM_API.INITIALIZED", function(){ fgm_api.init_user_nav(); },false);
//]]>
</script>