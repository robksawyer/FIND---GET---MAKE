<div id="block_1">
	<div class="header profile">
		<div class="user-details">
			<div class="name">
				<?php echo $this->Html->link($user['User']['username'],array('plugin'=>'','controller'=>'users','action'=>'profile',$user['User']['username'])); ?>
			</div>
			<?php
				echo $this->element('avatar',array('cache'=>false,'user'=>$user,'follow'=>true));
			?>
			<ul class="follower-details">
				<li><?php 
					echo $user['User']['totalFollowers']." Followers";
				?></li>
				<li><?php 
					echo $user['User']['totalProducts']." Products, ".$user['User']['totalSources']." Sources";
				?></li>
				<li><?php 
					echo $user['User']['totalCollections']." Collections, ".$user['User']['totalInspirations']." Inspirations";
				?></li>
			</ul>
		</div>
	</div>
</div>
<div class="mdash">&mdash;&mdash;</div>
<div id="block_2">
	<h4>
	<?php 
		if(count($followers) > 1){
			__(count($followers).' members are following '.$user['User']['username']);
		}else{
			__(count($followers).' member is following '.$user['User']['username']);
		}
	?>
	</h4>
	<div class="mdash">&mdash;</div>
	<div class="clear"></div>
	<div id="follower-following">
		<?php if(!empty($followers)): ?>
			<div id="user_items_block" class="inner_block">
			<?php foreach($followers as $follower): ?>
				<div class="user-item">
					<?php echo $this->element('user-block-with-products',array('cache'=>false,'user'=>$follower)); ?>
				</div>
				<div class="mdash">&mdash;</div>
			<?php endforeach; ?>
			</div>
			<!-- End gridded items -->
		<?php endif; ?>
	</div>
</div>