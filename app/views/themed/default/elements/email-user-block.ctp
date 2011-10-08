<div style="position:relative;margin:0;padding:0;">
	<?php echo $this->element('email-avatar',array('cache'=>false,'user'=>$user,'height'=>82)); ?>
	<ul style="float: left; position:relative;font-size: 12px;color: #999;list-style-type: none;padding: 0;margin:0;">
		<li class="username"><?php echo $this->Html->link($user['User']['username'],Router::url(array('ajax'=>false,
																															'plugin'=>'',
																															'controller'=>'users',
																															'action'=>'profile',
																															$user['User']['username']),true
																															))?></li>
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
	<div style="clear:both;width:100%;"></div>
	<div style="position: relative; margin-top: 5px; font-size: 12px;color:#999999;">
		<?php if(empty($hideJoin)){ ?>
				<span style="padding-left: 0;margin-left: 0px;">Joined on <?php echo $this->Time->niceShort($user['User']['created'],null,null); ?>&nbsp;</span>
		<?php } ?>
		<div style="clear:both;width:100%;"></div>
	</div>
</div>