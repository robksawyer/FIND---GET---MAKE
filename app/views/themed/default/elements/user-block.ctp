<div class="follower">
	<?php if(empty($follow)) $follow = true; ?>
	<?php echo $this->element('avatar',array('cache'=>false,'user'=>$user,'height'=>82,'follow'=>$follow)); ?>
	<ul class="follower-details">
		<li class="username"><?php echo $this->Html->link($user['User']['username'],array('plugin'=>'','controller'=>'users','action'=>'profile',$user['User']['username']))?></li>
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
	<div class="clear"></div>
	<div class="bottom-detail">
		<?php if(empty($hideJoin)){ ?>
				<span class="date">Joined on <?php echo $this->Time->niceShort($user['User']['created'],null,null); ?>&nbsp;</span>
		<?php } ?>
		<div class="clear"></div>
	</div>
</div>