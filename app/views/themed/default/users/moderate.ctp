<?php
$this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<?php if(empty($user['User']['hide_welcome'])): ?>
<div class="welcome">
	<?php 
		echo $this->Js->link($this->Html->image('/img/icons/delete.gif',array('alt'=>'Hide',
																			'title'=>'Hide the welcome',
																			'class'=>'hide-welcome'
																			)),'/ajax/users/hide_welcome',array(
																													'escape'=>false,
																													'success'=>'fgm_api.hideWelcome(data);'
																													)); 
	?>
<h3>Hi <?php echo $user['User']['fullname']; ?>! Welcome to your space. Here you'll find all of the items that you've added to the system.</h3>
</div>
<?php endif; ?>
<div id="moderate-area">
	<?php
	if(!empty($user)):
	?>
	<div id="left-container-with-sidebar">
		<div class="header red">
		<?php __('running bond: what others are posting.'); ?>
		</div>
		<div class="clear"></div>
		<?php
		echo $this->element('following-feed',array('cache'=>false));
		?>
	</div>
	<div id="right-sidebar">
		<div class="header profile">
			<div class="user-details">
				<?php 
					if(!empty($user['User']['fullname'])){
						echo "<div class='name'>".$user['User']['fullname']."</div>"; 
						//echo " <span class='serif'>a.k.a</span> ".$user['User']['username']."</div>";
					}else{
						echo "<div class='name'>".$user['User']['username']."</div>";
					}
				?>
				<?php
					echo $this->element('avatar',array('cache'=>false,'avatar'=>$avatar,'follow'=>false));
				?>
				<ul class="btn-actions">
					<li>
						<?php echo $this->Html->link('<span>Edit profile</span>',
													array('plugin'=>'','admin'=>false,'controller'=>'settings','action'=>'account'),
													array(
														'title'=>'Edit your profile.',
														'class'=>'minibutton btn-edit-profile',
														'escape'=>false
														)
													); ?>
					</li>
				</ul>
				<ul>
					<li><?php echo $this->Html->link('View your public profile',array('plugin'=>'','admin'=>false,'controller'=>'users','action'=>'profile',$user['User']['username']),array('title'=>'View your public profile.')); ?></li>
				</ul>
			</div>
		</div>
		<br class="clear" />
		<div>
			<?php 
			if($authUser['User']['totalUsersFollowing'] > 1) $people = "people"; else $people = "person";
			echo $this->Html->link("Following ".$authUser['User']['totalUsersFollowing']." $people",
			array('controller'=>'user_followings','action'=>'following','admin'=>false,'plugin'=>'',$authUser['User']['username']),
			array('title'=>'The users you are following','class'=>'simple-btn')); ?>
		</div>
		<div class="followers">
		<?php 
			echo "<span>Followers ".$authUser['User']['totalFollowers']."</span> | ";
			echo "<span class='view-all'>";
			echo $this->Html->link("View all &rarr;",
										array('plugin'=>'',
												'admin'=>false,
												'controller'=>'user_followings',
												'action'=>'followers',
												$user['User']['username']
												),
												array('title'=>'See all of your followers','escape'=>false)
												); 
			echo "</span>";
			echo "<div>";
			//Doesn't work
			foreach($followers as $follower){
				$avatar = $this->requestAction('/users/getAvatar/'.$follower['User']['id']);
				echo $this->element('avatar-follower',array('cache'=>false,'follower'=>$follower,'avatar'=>$avatar));
			}
			echo "</div>";
			?>
		</div>
		<ul class="stats">
			<div class="title">Your totals</div>
			<li>
				<div class='total'>
					<?php echo $this->Html->link($user['User']['totalSources'],array('plugin'=>'','admin'=>false,'controller'=>'sources','action'=>'users',$user['User']['id'])); ?>
					<span>sources</span>
				</div> 
				<div class='total'>
					<?php echo $this->Html->link($user['User']['totalProducts'],array('plugin'=>'','admin'=>false,'controller'=>'products','action'=>'users',$user['User']['id'])); ?>
					<span>products</span>
				</div>
			</li>
			<li>
				<div class='total'>
					<?php echo $this->Html->link($user['User']['totalInspirations'],array('plugin'=>'','admin'=>false,'controller'=>'inspirations','action'=>'users',$user['User']['id'])); ?>
					<span>inspirations</span>
				</div> 
				<div class='total'>
					<?php echo $this->Html->link($user['User']['totalCollections'],array('plugin'=>'','admin'=>false,'controller'=>'collections','action'=>'users',$user['User']['id'])); ?>
					<span>collections</span>
				</div>
			</li>
			<li>
				<div class='total'>
					<?php echo $this->Html->link($user_haves,array('plugin'=>'','admin'=>false,'controller'=>'ownerships','action'=>'haves',$user['User']['id'])); ?>
					<span>owned</span>
				</div>
			</li>
			<div class="clear"></div>
		</ul>
	</div>
	<div class="clear"></div>
	<?php
	endif;
	?>
</div>
<div class="clear"></div>