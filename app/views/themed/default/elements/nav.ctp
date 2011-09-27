<div id='nav'>
	<div id="nav-wrapper">
		<ul id="logo-nav">
			<li class='nav-item-find'><?php echo $this->Html->link('FIND','#',array('title'=>'FIND')); ?><span></span></li>
			<li class='nav-item-get'><?php echo $this->Html->link('GET','#',array('title'=>'GET')); ?><span></span></li>
			<li class='nav-item-make'><?php echo $this->Html->link('MAKE','#',array('title'=>'MAKE')); ?><span></span></li>
		</ul>
		<ul id="main-nav">
			<li><?php echo $this->Html->link('Feed','#',array('title'=>'Feed')); ?></li>
			<li><?php echo $this->Html->link('Find People','#',array('title'=>'Find People')); ?></li>
			<li><?php echo $this->Html->link('Forum','#',array('title'=>'Forum')); ?></li>
			<li><?php echo $this->Html->link('Profile','#',array('title'=>'Profile')); ?></li>
			<ul id="product-sub-nav" class="sub-nav" style="display:none">
				<li><?php echo $this->Html->link('Moderate','#',array('title'=>'Moderate')); ?></li>
				<li><?php echo $this->Html->link('Followers','#',array('title'=>'Followers')); ?></li>
				<li><?php echo $this->Html->link('Following','#',array('title'=>'Following')); ?></li>
				<li><?php echo $this->Html->link('Settings','#',array('title'=>'Setting')); ?></li>
			</ul>
		</ul>
	</div>
</div>