<div id='nav'>
	<div id="nav-wrapper">
		<ul id="logo-nav">
			<li class='nav-item-find'>
				<?php echo $this->Html->link('FIND','#',array('title'=>'FIND')); ?>
				<span title='FIND'></span>
				<ul id="find-sub-nav" class="sub-nav">
					<li><?php echo $this->Html->link('Collections',array('controller'=>'collections','action'=>'index'),array()); ?></li>
					<li><?php echo $this->Html->link('Inspirations',array('controller'=>'inspirations','action'=>'index'),array()); ?></li>
					<li><?php echo $this->Html->link('Products',array('controller'=>'products','action'=>'index'),array()); ?></li>
					<li><?php echo $this->Html->link('Sources',array('controller'=>'sources','action'=>'index'),array()); ?></li>
				</ul>
			</li>
			<li class='nav-item-get'>
				<?php echo $this->Html->link('GET','#',array('title'=>'GET')); ?>
				<span title='GET'></span>
				<ul id="get-sub-nav" class="sub-nav">
					<li><?php echo $this->Html->link('Extras',array('controller'=>'tools','action'=>'bookmarklet'),array()); ?></li>
				</ul>
			</li>
			<li class='nav-item-make'>
				<?php echo $this->Html->link('MAKE','#',array('title'=>'MAKE')); ?>
				<span title='MAKE'></span>
				<ul id="make-sub-nav" class="sub-nav">
					<li><?php echo $this->Html->link('A Collection',array('controller'=>'collections','action'=>'add'),array()); ?></li>
					<li><?php echo $this->Html->link('An Inspiration',array('controller'=>'inspirations','action'=>'add'),array()); ?></li>
				</ul>
			</li>
		</ul>
		<ul id="main-nav">
			<li><?php echo $this->Html->link('Feed','#',array('title'=>'Feed')); ?></li>
			<li><?php echo $this->Html->link('Find People',array('controller'=>'users','action'=>'find'),array('title'=>'Find People')); ?></li>
			<!--<li><?php //echo $this->Html->link('Forum','#',array('title'=>'Forum')); ?></li>-->
			<li>
				<?php echo $this->Html->link('Profile','#',array('title'=>'Profile')); ?>
				<ul id="product-sub-nav" class="sub-nav" style="display:none">
					<li><?php echo $this->Html->link('Moderate',array('controller'=>'users','action'=>'moderate'),array('title'=>'Moderate')); ?></li>
					<li><?php echo $this->Html->link('Followers',array('controller'=>'user_followings','action'=>'followers'),array('title'=>'Followers')); ?></li>
					<li><?php echo $this->Html->link('Following',array('controller'=>'user_followings','action'=>'following'),array('title'=>'Following')); ?></li>
					<li><?php echo $this->Html->link('Settings',array('controller'=>'settings','action'=>'account'),array('title'=>'Settings')); ?></li>
				</ul>
			</li>
			
		</ul>
	</div>
</div>
<script type="text/javascript">
fgmHover = function() {
	var navRoot = document.getElementById("logo-nav");
	var navChildren = document.getElementById("logo-nav").getElementsByTagName("li");
	var navPadding = 15;
	var oNavHeight = 20; //Orginal nav height
	for (var i=0; i<navChildren.length; i++) {
		navChildren[i].onmouseover=function() {
			this.className+=" fgm_hover";
			var newHeight = $(this).height();
			navRoot.style.height = Number(newHeight + navPadding)+"px";
			this.style.height = Number(newHeight - navPadding) + "px";
		}
		navChildren[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" fgm_hover\\b"), "");
			var newHeight = Number(this.style.height.substring(0, this.style.height.length-2));
			navRoot.style.height = oNavHeight+"px";
			this.style.height = Number(newHeight + navPadding) + "px";
		}
	}
}
$(document).ready(function(){
	fgmHover();
});
</script>