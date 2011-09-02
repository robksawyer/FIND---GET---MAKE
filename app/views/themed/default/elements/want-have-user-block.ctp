<div class="ownership-item">
	<?php echo $this->element('avatar',array('cache'=>false,'user'=>$user,'height'=>82,'follow'=>true)); ?>
	<ul class="ownership-details">
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
</div>