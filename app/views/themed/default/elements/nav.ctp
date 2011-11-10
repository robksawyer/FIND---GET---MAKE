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
			<li><?php echo $this->Html->link('Extras',array('controller'=>'tools','action'=>'extras'),array()); ?></li>
			<li><?php echo $this->Html->link('Feed',array('admin'=>false,'controller'=>'feeds','action'=>'site'),array('title'=>'Feed')); ?></li>
			<?php if(!empty($authUser)): ?>
				<li>
					<?php echo $this->Html->link('Make','#',array('title'=>'Make')); ?>
					<ul id="make-sub-nav" class="sub-nav" style="">
						<li><?php echo $this->Html->link('A Collection',array('controller'=>'collections','action'=>'add'),array()); ?></li>
						<li><?php echo $this->Html->link('An Inspiration',array('controller'=>'inspirations','action'=>'add'),array()); ?></li>
					</ul>
				</li>
				<li><?php echo $this->Html->link('Find People',array('controller'=>'users','action'=>'find'),array('title'=>'Find People')); ?></li>
				<!--<li><?php //echo $this->Html->link('Forum','#',array('title'=>'Forum')); ?></li>-->
			<?php endif; ?>
		</ul>
	</div>
	<br class="clear" />
</div>