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
					echo $user['User']['user_followers_count']." Followers";
				?></li>
				<li><?php 
					echo $user['User']['total_products']." Products, ".$user['User']['total_sources']." Sources";
				?></li>
				<li><?php 
					echo $user['User']['total_collections']." Collections, ".$user['User']['total_inspirations']." Inspirations";
				?></li>
			</ul>
		</div>
	</div>
</div>
<div class="mdash">&mdash;&mdash;</div>
<div id="block_2">
	<h4>
	<?php 
		__('Members '.$user['User']['username'].' is following');
	?>
	</h4>
	<div class="mdash">&mdash;</div>
	<div class="clear"></div>
	<div id="follower-following">
		<?php if(!empty($following)): ?>
			<div id="user_items_block" class="inner_block">
			<?php foreach($following as $follower): ?>
				<div class="user-item">
					<?php 
						echo $this->element('user-block-with-products',array('cache'=>false,'user'=>$follower)); 
					?>
				</div>
				<div class="mdash">&mdash;</div>
			<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>