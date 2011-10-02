<div id='nav'>
	<div id="nav-wrapper">
		<ul id="logo-nav">
			<li class='nav-item'>
				<?php echo $this->Html->link('FIND | GET | MAKE','/',array('title'=>'MAKE')); ?>
				<span title='FIND | GET | MAKE'></span>
			</li>
		</ul>
		<ul id="main-nav">
			<li>
				<?php echo $this->Html->link('Explore','#',array('title'=>'Explore')); ?>
				<ul id="explore-sub-nav" class="sub-nav" style="">
					<li><?php echo $this->Html->link('Collections',array('controller'=>'collections','action'=>'index'),array()); ?></li>
					<li><?php echo $this->Html->link('Inspirations',array('controller'=>'inspirations','action'=>'index'),array()); ?></li>
					<li><?php echo $this->Html->link('Products',array('controller'=>'products','action'=>'index'),array()); ?></li>
					<li><?php echo $this->Html->link('Sources',array('controller'=>'sources','action'=>'index'),array()); ?></li>
				</ul>
			</li>
			<li><?php echo $this->Html->link('Extras',array('controller'=>'tools','action'=>'bookmarklet'),array()); ?></li>
			<li>
				<?php echo $this->Html->link('Make','#',array('title'=>'Make')); ?>
				<ul id="make-sub-nav" class="sub-nav" style="">
					<li><?php echo $this->Html->link('A Collection',array('controller'=>'collections','action'=>'add'),array()); ?></li>
					<li><?php echo $this->Html->link('An Inspiration',array('controller'=>'inspirations','action'=>'add'),array()); ?></li>
				</ul>
			</li>
			<li><?php echo $this->Html->link('Feed',array('admin'=>false,'controller'=>'feeds','action'=>'site'),array('title'=>'Feed')); ?></li>
			<li><?php echo $this->Html->link('Find People',array('controller'=>'users','action'=>'find'),array('title'=>'Find People')); ?></li>
			<!--<li><?php //echo $this->Html->link('Forum','#',array('title'=>'Forum')); ?></li>-->
			<li>
				<?php echo $this->Html->link('Profile','#',array('title'=>'Profile')); ?>
				<ul id="product-sub-nav" class="sub-nav" style="">
					<li><?php echo $this->Html->link('Moderate',array('controller'=>'users','action'=>'moderate'),array('title'=>'Moderate')); ?></li>
					<li><?php echo $this->Html->link('Followers',array('controller'=>'user_followings','action'=>'followers'),array('title'=>'Followers')); ?></li>
					<li><?php echo $this->Html->link('Following',array('controller'=>'user_followings','action'=>'following'),array('title'=>'Following')); ?></li>
					<li><?php echo $this->Html->link('Settings',array('controller'=>'settings','action'=>'account'),array('title'=>'Settings')); ?></li>
				</ul>
			</li>
			
		</ul>
	</div>
	<br class="clear" />
</div>
<script type="text/javascript">
$(document).ready(function(){
	fgm_api.nav_init();
});
</script>