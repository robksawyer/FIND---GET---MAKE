<div class="header red"><?php 
		__('running bond: what others are posting.');
?></div>
<div class="clear"></div>
<h4>Content from the <?php echo $this->Html->link($authUser['User']['totalUsersFollowing']." users",array('controller'=>'user_followings','action'=>'following','admin'=>false,'plugin'=>'',$authUser['User']['username'])); ?> that you follow.</h4>
<?php
	echo $this->element('following-feed',array('cache'=>false));
?>