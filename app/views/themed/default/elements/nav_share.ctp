<!-- start of navbar -->
<div id='navbar'>
		<div class="nav-main">
			<ul  id="nav-one" class="nav">
				<!--<li><?php //echo $this->Html->link('home',array('controller'=>'/'), array('class'=>'closer'));?></li>-->
				<li><?php echo $this->Html->link('blog','	http://findgetmake.tumblr.com/',array('target'=>'_blank'));?></li>
				<?php 
				if(!empty($this->params['pass'][0])):
					if($this->params['pass'][0] != 'join'): 
				?>
						<li><?php echo $this->Html->link('join','/pages/join'); ?></li>
				<?php 
					endif;
				else: 
				?>
				<li><?php echo $this->Html->link('join','/pages/join'); ?></li>
				<?php endif; ?>
			</ul>
		</div>
	
		<div class='clear'></div>
</div>
<!-- end of navbar -->