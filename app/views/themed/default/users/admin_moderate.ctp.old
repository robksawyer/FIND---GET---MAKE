<?php
$this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<?php if(empty($user['User']['hide_welcome'])): ?>
<div class="welcome">
	<?php 
		echo $this->Js->link($this->Html->image('/img/icons/delete.gif',array('alt'=>'Hide',
																			'title'=>'Hide the welcome',
																			'class'=>'hide-welcome'
																			)),'/users/hide_welcome',array(
																													'escape'=>false,
																													'success'=>'hideWelcome(data);'
																													)); 
	?>
<h3>Hi <?php echo $user['User']['fullname']; ?>! Welcome to your space. Here you'll find all of the items that you've added to the system.</h3>
</div>
<?php endif; ?>
<div class="header profile">
	<?php // Gravatar
	if ($this->Cupcake->settings['enable_gravatar'] == 1) {
		if ($avatar = $this->Cupcake->gravatar($user['User']['email'])) {
			echo "<div class='avatar'>";
			echo $avatar."<br/>";
			echo $this->Html->link('Change your <span class="gravatar">Gravatar</span>','http://en.gravatar.com/',array('title'=>'Change your Gravatar','escape'=>false,'target'=>'_blank'));
			echo "</div>";
		}else{
			echo "<div class='avatar'>";
			echo $this->Html->image('no_gravatar.jpg')."<br/>";
			echo $this->Html->link('Get a <span class="gravatar">Gravatar</span>','http://en.gravatar.com/',array('title'=>'Get a Gravatar','escape'=>false,'target'=>'_blank'));
			echo "</div>";
		} 
	}
	?>
	<div class="user-details">
		<ul>
			<?php 
				if(!empty($user['User']['fullname'])){
					echo "<li class='name'>".$user['User']['fullname']; 
					echo " <span class='serif'>a.k.a</span> ".$user['User']['username']."</li>";
				}else{
					echo "<li class='name'>".$user['User']['username']."</li>";
				}
			?>
			<li><?php echo $this->Html->link('Edit profile',array('plugin'=>'forum','admin'=>false,'controller'=>'users','action'=>'edit'),array('title'=>'Edit your profile.'))." | ".$this->Html->link('View your public profile',array('plugin'=>'forum','admin'=>false,'controller'=>'users','action'=>'profile',$user['User']['username']),array('title'=>'View your public profile.')); ?></li>
			<br/>
			<ul>
				<li>
					<?php 
					//Link to the user's feed
					echo $this->Html->link('Feed',array('admin'=>true,'controller'=>'feeds','action'=>'display'))." | ";
					echo $this->Html->link($user['User']['totalUsersFollowing'].' following,',array('admin'=>false,'plugin'=>'','controller'=>'user_followings','action'=>'following',$user['User']['username'])); 
					?>
					<?php 
					if($user['User']['totalFollowers'] > 1 || $user['User']['totalFollowers'] == 0){
						echo $this->Html->link($user['User']['totalFollowers'].' followers',array('admin'=>false,'plugin'=>'','controller'=>'user_followings','action'=>'followers',$user['User']['username'])); 
					}else{
						echo $this->Html->link($user['User']['totalFollowers'].' follower',array('admin'=>false,'plugin'=>'','controller'=>'user_followings','action'=>'followers',$user['User']['username'])); 
					}
					?>
				</li>
			</ul>
			<?php if (!empty($user['User']['about'])) { ?>
			<li class="about"><?php echo $user['User']['about']; ?></li>
			<?php } ?>
			<?php
				//$source_count = $this->requestAction('/sources/getCount/'.$user['User']['id']);
				//$product_count = $this->requestAction('/products/getCount/'.$user['User']['id']);
			
				//$user_product_likes = $this->requestAction('/votes/getAllUserLikes/Product');
				//$user_product_dislikes = $this->requestAction('/votes/getAllUserDislikes/Product');
				//debug("Likes: ". $user_product_likes. " | Dislikes: ".$user_product_dislikes);
				$user_likes = $user['User']['totalProductLikes'];
				$user_dislikes = $user['User']['totalProductDislikes'];
			
				if(!empty($wantedProducts)){
					$user_wants = count($wantedProducts);
				}else{
					$user_wants = 0;
				}
				if(!empty($haveProducts)){
					$user_haves = count($haveProducts);
				}else{
					$user_haves = 0;
				}
			
				//debug($user['Ownership']);
			?>
			<ul class="totals">
				<li><span class='total'><i>Total wants:</i> <?php echo $this->Html->link($user_wants,array('plugin'=>'','admin'=>false,'controller'=>'ownerships','action'=>'wants',$user['User']['id']));; ?></span> <span class='total'><i>Total owned:</i> <?php echo $this->Html->link($user_haves,array('plugin'=>'','admin'=>false,'controller'=>'ownerships','action'=>'haves',$user['User']['id'])); ?></span></li>
				<li><span class='total'><i>Total likes:</i> <?php echo $this->Html->link($user_likes,array('plugin'=>'','admin'=>false,'controller'=>'votes','action'=>'likes',$user['User']['id']));; ?></span> <span class='total'><i>Total dislikes:</i> <?php echo $this->Html->link($user_dislikes,array('plugin'=>'','admin'=>false,'controller'=>'votes','action'=>'dislikes',$user['User']['id'])); ?></span></li>
			</ul>
			<ul class="totals">
				<li><span class='total'><i>Total sources added:</i> <?php echo $this->Html->link($user['User']['totalSources'],array('plugin'=>'','admin'=>false,'controller'=>'sources','action'=>'users',$user['User']['id']));; ?></span> <span class='total'><i>Total products added:</i> <?php echo $this->Html->link($user['User']['totalProducts'],array('plugin'=>'','admin'=>false,'controller'=>'products','action'=>'users',$user['User']['id'])); ?></span></li>
				<li><span class='total'><i>Total inspirations:</i> <?php echo $this->Html->link($user['User']['totalInspirations'],array('plugin'=>'','admin'=>false,'controller'=>'inspirations','action'=>'users',$user['User']['id']));; ?></span> <span class='total'><i>Total collections:</i> <?php echo $this->Html->link($user['User']['totalCollections'],array('plugin'=>'','admin'=>false,'controller'=>'collections','action'=>'users',$user['User']['id'])); ?></span></li>
			</ul>
			<li>Joined: <?php echo $this->Time->nice($user['User']['created'], $this->Cupcake->timezone()); ?></li>
			<li>Total topics: <?php echo number_format($user['User'][$this->Cupcake->columnMap['totalTopics']]); ?></li>
			<li>Total posts: <?php echo number_format($user['User'][$this->Cupcake->columnMap['totalPosts']]); ?></li>
			<li>Last login: <?php if (!empty($user['User'][$this->Cupcake->columnMap['lastLogin']])) {
				echo $this->Time->relativeTime($user['User'][$this->Cupcake->columnMap['lastLogin']], array('userOffset' => $this->Cupcake->timezone()));
			} else {
				echo '<em>'. __d('forum', 'Never', true) .'</em>';
			} ?></li>
		</ul>
	</div>
</div>
<div class="moderate-area">
	<?php
	if(!empty($user)):
	?>
	<div class="left-container-with-sidebar">
		<?php
		//wants
		echo $this->element('users'.DS.'wants',array('products'=>$wantedProducts));

		//haves
		echo $this->element('users'.DS.'haves',array('products'=>$haveProducts));
		
		//collections
		echo $this->element('users'.DS.'collections',array('collections'=>$userCollections));
		
		//inspirations
		echo $this->element('users'.DS.'inspirations',array('inspirations'=>$userInspirations));
		
		//products
		echo $this->element('users'.DS.'products',array('products'=>$userProducts));

		?>
	</div>
	<div class="right-sidebar">
		<?php
		//sources
		echo $this->element('users'.DS.'sources',compact('userSources'));
		
		//ufos
		echo $this->element('users'.DS.'ufos',compact('userUfos'));
		
		?>
	</div>
	<div class="clear"></div>
	<?php
	endif;
	?>
</div>
<div class="clear"></div>
<script type="text/javascript">
function hideWelcome(data){
	if(data.success){
		$('.welcome').hide('slow');
	}
}
</script>