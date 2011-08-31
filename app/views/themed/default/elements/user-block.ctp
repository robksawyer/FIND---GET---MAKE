<div class="follower">
	<?php echo $this->element('avatar',array('cache'=>false,'user'=>$user,'height'=>82,'follow'=>true)); ?>
	<ul class="follower-details">
		<li class="username"><?php echo $this->Html->link($user['User']['username'],array('plugin'=>'','controller'=>'users','action'=>'profile',$user['User']['username']))?></li>
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
	<div class="clear"></div>
	<div class="bottom-detail">
		<span class="date">Joined on <?php echo $this->Time->niceShort($user['User']['created'],null,null); ?>&nbsp;</span>
		<div class="clear"></div>
	</div>
</div>