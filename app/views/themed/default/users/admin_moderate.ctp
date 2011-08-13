<?php
$this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<div class="welcome">
<h3>Hi <?php echo $user['User']['fname']; ?>! Welcome to your space. Here you'll find all of the items that you've added to the system.</h3>
</div>
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
	<ul>
		<?php 
			if(!empty($user['User']['fname']) && !empty($user['User']['lname'])){
				echo "<li class='name'>".$user['User']['fname']." ".$user['User']['lname']; 
				echo " <span class='serif'>a.k.a</span> ".$user['User']['username']."</li>";
			}else{
				echo "<li class='name'>".$user['User']['username']."</li>";
			}
		?>
		<li><?php echo $this->Html->link('Edit profile',array('plugin'=>'forum','admin'=>false,'controller'=>'users','action'=>'edit'),array('title'=>'Edit your profile.'))." | ".$this->Html->link('View your public profile',array('plugin'=>'forum','admin'=>false,'controller'=>'users','action'=>'profile',$user['User']['id']),array('title'=>'View your public profile.')); ?></li>
		<br/>
		<?php if (!empty($user['User'][$this->Cupcake->columnMap['signature']])) { ?>
		<li class="signature"><?php $this->Decoda->parse($user['User'][$this->Cupcake->columnMap['signature']], false, array('b', 'i', 'u', 'img', 'url', 'align', 'color', 'size', 'code')); ?></li>
		<?php } ?>
		<?php
			$source_count = $this->requestAction('/sources/getCount/'.$user['User']['id']);
			$product_count = $this->requestAction('/products/getCount/'.$user['User']['id']);
			
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
			<li><span class='total'><i>Total sources added:</i> <?php echo $this->Html->link($source_count,array('plugin'=>'','admin'=>false,'controller'=>'sources','action'=>'users',$user['User']['id']));; ?></span> <span class='total'><i>Total products added:</i> <?php echo $this->Html->link($product_count,array('plugin'=>'','admin'=>false,'controller'=>'products','action'=>'users',$user['User']['id'])); ?></span></li>
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
<div class="moderate-area">
	<?php
	if(!empty($user)):
	?>
	<div class="left-container-with-sidebar">
		<?php
		//wants
		if(!empty($wantedProducts)){
			echo $this->element('users'.DS.'wants',array('products'=>$wantedProducts));
		}
		//haves
		if(!empty($haveProducts)){
			echo $this->element('users'.DS.'haves',array('products'=>$haveProducts));
		}
		
		//collections
		if(!empty($userCollections)){
			echo $this->element('users'.DS.'wants',array('products'=>$userCollections));
		}else{
			//Start adding now. Some description about adding collections and what they are.
		}
		
		//inspirations
		if(!empty($userInspirations)){
			echo $this->element('users'.DS.'inspirations',array('inspirations'=>$userInspirations));
		}else{
			//Start adding now. Some copy related to what inspirations are and how to add them.
		}
		
		//products
		if(!empty($userProducts)){
			echo $this->element('users'.DS.'products',array('products'=>$userProducts));
		}else{
			//Some copy related to what products are and how to add them and why.
		}
		?>
	</div>
	<div class="right-sidebar">
		<?php
		//sources
		if(!empty($userProducts)){
			echo $this->element('users'.DS.'sources',compact('userProducts'));
		}else{
			//Why how where
		}
		
		//ufos
		if(!empty($userUfos)){
			echo $this->element('users'.DS.'ufos',compact('userUfos'));
		}else{
			//Why how where
		}
		
		?>
	</div>
	<div class="clear"></div>
	<?php
	endif;
	?>
</div>
<div class="clear"></div>