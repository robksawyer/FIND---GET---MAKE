<!-- start of navbar -->
<div id='navbar'>
		<div class="nav-main">
			<ul id="nav-one" class="nav">
				<!--<li><?php //echo $this->Html->link('home',array('controller'=>'/'), array('class'=>'closer'));?></li>-->
				<?php if(!empty($authUser)):?>
				<li class='nav-browsedrop-link-1'><?php echo $this->Html->link('+ create something','#',array('id'=>'nav-browsedrop-1-link','class'=>'nav-browsedrop-lz'));?>
						<ul id='nav-browsedrop-1' class="nav-browsedrop" style='display:none;' index='100'>
							<li><?php echo $this->Html->link('a collection','/collections/add', array('class'=>'nav-browsedrop-indy'));?></li>
							<li><?php echo $this->Html->link('an inspiration','/inspirations/add', array('class'=>'nav-browsedrop-indy'));?></li>
						</ul>
				</li>
				<li class='nav-browsedrop-link-2'><?php echo $this->Html->link('+ add something','#',array('id'=>'nav-browsedrop-2-link','class'=>'nav-browsedrop-lz'));?>
						<ul id='nav-browsedrop-2' class="nav-browsedrop" style='display:none;' index='100'>
							<li><?php echo $this->Html->link('a product','/products/add', array('class'=>'nav-browsedrop-indy'));?></li>
							<li><?php echo $this->Html->link('a source','/sources/add', array('class'=>'nav-browsedrop-indy'));?></li>
							<li><?php echo $this->Html->link('a UFO','/ufos/add', array('class'=>'nav-browsedrop-indy'));?></li>
							<!-- Note: You have to pass a client id before you can add a house. -->
							<!--<li><?php //echo $this->Html->link('add a house',array('controller'=>'houses','action'=>'add'), array('class'=>'nav-browsedrop-indy'));?></li>-->
						</ul>
				</li>
				<?php endif; ?>
				<li class='nav-browsedrop-link-3'>
				<?php 
					echo $this->Html->link('+ explore','#',array('id'=>'nav-browsedrop-3-link','class'=>'nav-browsedrop-lz'));
				if(empty($authUser)){
					echo "<ul id='nav-browsedrop-3' class='nav-browsedrop' style='display:none; left:0px !important;' index='100'>";
				}else{
					echo "<ul id='nav-browsedrop-3' class='nav-browsedrop' style='display:none' index='100'>";
				}
				?>
							<li><?php echo $this->Html->link('collage',array('controller'=>'attachments','action'=>'collage','admin'=>false,'plugin'=>''),array('class'=>'nav-browsedrop-indy'));?></li>
							<li><?php echo $this->Html->link('collections','/collections', array('class'=>'nav-browsedrop-indy'));?></li>
							<li><?php echo $this->Html->link('inspirations','/inspirations', array('class'=>'nav-browsedrop-indy'));?></li>
							<li><?php echo $this->Html->link('products','/products', array('class'=>'nav-browsedrop-indy'));?></li>
							<li><?php echo $this->Html->link('sources','/sources', array('class'=>'nav-browsedrop-indy'));?></li>
							<li><?php echo $this->Html->link('UFOs','/ufos',array('title'=>'Unidentified Found Objects','class'=>'nav-browsedrop-indy'));?></li>
						</ul>
				</li>
				<li class='nav-browsedrop-link-4'>
				<?php 
					echo $this->Html->link('+ forum','#',array('id'=>'nav-browsedrop-3-link','class'=>'nav-browsedrop-lz'));
					if(empty($authUser)){
						echo "<ul id='nav-browsedrop-4' class='nav-browsedrop' style='display:none; left:25px !important;' index='100'>";
					}else{
						echo "<ul id='nav-browsedrop-4' class='nav-browsedrop' style='display:none' index='100'>";
					}
				?>
							<li><?php echo $this->Html->link(__d('forum', 'Home', true), '/forum/home'); ?></li>
							<li><?php echo $this->Html->link(__d('forum', 'Search', true), '/forum/search'); ?></li>
							<li><?php echo $this->Html->link(__d('forum', 'Rules', true), '/forum/home/rules'); ?></li>
							<li><?php echo $this->Html->link(__d('forum', 'Help', true), '/forum/home/help'); ?></li>
							<li><?php echo $this->Html->link(__d('forum', 'Users', true), '/forum/users/listing'); ?></li>
						</ul>
				</li>
				<li class='nav-browsedrop-link-5'>
				<?php 
					echo $this->Html->link('+ search','#',array('id'=>'nav-browsedrop-5-link','class'=>'nav-browsedrop-lz'));
					if(empty($authUser)){
						echo "<ul id='nav-browsedrop-5' class='nav-browsedrop' style='display:none; left:140px !important;' index='100'>";
					}else{
						echo "<ul id='nav-browsedrop-5' class='nav-browsedrop' style='display:none' index='100'>";
					}
				?>
						<li><?php echo $this->Html->link('sources',array('controller'=>'sources','action'=>'find','admin'=>false,'plugin'=>''), array('class'=>'closer'));?></li>
						<li><?php echo $this->Html->link('products',array('controller'=>'products','action'=>'find','admin'=>false,'plugin'=>''), array('class'=>'closer'));?></li>
					</ul>
				</li>
				<?php
					if(!empty($authUser) && Configure::read('FGM.private_solution') == 1):
						echo "<li class='nav-browsedrop-link-6'>";
						echo $this->Html->link('+ rolodex','#',array('id'=>'nav-browsedrop-6-link','class'=>'nav-browsedrop-lz'));
							echo "<ul id='nav-browsedrop-6' class='nav-browsedrop' style='display:none;' index='100'>";
				?>	
								<li><?php echo $this->Html->link('add a client','/clients/add', array('class'=>'nav-browsedrop-indy'));?></li>
								<li><?php echo $this->Html->link('add a contractor','/contractors/add', array('class'=>'nav-browsedrop-indy'));?></li>
								<li><?php echo $this->Html->link('see contractors','/contractors', array('class'=>'nav-browsedrop-indy'));?></li>
								<li><?php echo $this->Html->link('see clients','/clients', array('class'=>'nav-browsedrop-indy'));?></li>
								<li><?php echo $this->Html->link('see houses','/houses', array('class'=>'nav-browsedrop-indy'));?></li>
							</ul>
						</li>
				<?php endif; ?>
				<?php 
				if(!empty($this->params['pass'][0])):
					if($this->params['pass'][0] != 'join'): 
				?>
						<li><?php echo $this->Html->link('join','/join'); ?></li>
				<?php 
					endif;
				else: ?>
				<li><?php echo $this->Html->link('join','/join'); ?></li>
				<?php endif; ?>
				<li><?php echo $this->Html->link('find people','/users/find'); ?></li>
			</ul>
		</div>
	
		<div class='clear'></div>
</div>
<!-- end of navbar -->