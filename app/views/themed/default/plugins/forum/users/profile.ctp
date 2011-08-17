<?php
$this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<?php // User exists
if (!empty($user)) { ?>
<div class="forumHeader profile">
	<button type="button" onclick="goTo('<?php echo $this->Html->url(array('action' => 'report', $user['User']['id'])); ?>');" class="fr button"><?php __d('forum', 'Report User'); ?></button>
	<?php // Gravatar
	if ($this->Cupcake->settings['enable_gravatar'] == 1) {
		if ($avatar = $this->Cupcake->gravatar($user['User']['email'])) {
			echo "<div class='avatar'>".$avatar;
			echo $this->element('follow-unfollow',array('cache'=>false,'user_id'=>$user['User']['id']));
			echo '<div class="clear"></div>';
			echo "</div>";
		}else{
			echo "<div class='avatar'>";
			echo $this->Html->image('no_gravatar.jpg')."<br/>";
			echo $this->element('follow-unfollow',array('cache'=>false,'user_id'=>$user['User']['id']));
			echo '<div class="clear"></div>';
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
			<?php if (!empty($user['User']['about'])) { ?>
			<li class="about"><?php echo $user['User']['about']; ?></li>
			<?php } ?>
			<li>
				<?php 
				//Link to the user's feed
				echo $this->Html->link('Feed',array('plugin'=>'','admin'=>false,'controller'=>'feeds','action'=>'user',$user['User']['username']))." | ";
				echo $this->Html->link($user['User']['totalUsersFollowing'].' following,',array('plugin'=>'','controller'=>'user_followings','action'=>'following',$user['User']['username'])); 
				?>
				<?php 
				if($user['User']['totalFollowers'] > 1 || $user['User']['totalFollowers'] == 0){
					echo $this->Html->link($user['User']['totalFollowers'].' followers',array('plugin'=>'','controller'=>'user_followings','action'=>'followers',$user['User']['username'])); 
				}else{
					echo $this->Html->link($user['User']['totalFollowers'].' follower',array('plugin'=>'','controller'=>'user_followings','action'=>'followers',$user['User']['username'])); 
				}
				?>
			</li>
		</ul>
		<ul class="totals">
			<li><span class='total'><i>Total sources added:</i> <?php echo $this->Html->link($user['User']['totalSources'],array('plugin'=>'','admin'=>false,'controller'=>'sources','action'=>'users',$user['User']['id']));; ?></span> <span class='total'><i>Total products added:</i> <?php echo $this->Html->link($user['User']['totalProducts'],array('plugin'=>'','admin'=>false,'controller'=>'products','action'=>'users',$user['User']['id'])); ?></span></li>
			<li><span class='total'><i>Total inspirations:</i> <?php echo $this->Html->link($user['User']['totalInspirations'],array('plugin'=>'','admin'=>false,'controller'=>'inspirations','action'=>'users',$user['User']['id']));; ?></span> <span class='total'><i>Total collections:</i> <?php echo $this->Html->link($user['User']['totalCollections'],array('plugin'=>'','admin'=>false,'controller'=>'collections','action'=>'users',$user['User']['id'])); ?></span></li>
		</ul>
		<ul>
			<li>Joined <?php echo $this->Time->timeAgoInWords($user['User']['created']); ?></li>
			<li style="display: none">Total topics: <?php echo number_format($user['User'][$this->Cupcake->columnMap['totalTopics']]); ?></li>
			<li style="display: none">Total posts: <?php echo number_format($user['User'][$this->Cupcake->columnMap['totalPosts']]); ?></li>
			<li style="display:none">Roles: <?php if (!empty($user['Access'])) { 
				$roles = array();
				foreach ($user['Access'] as $access) {
					$roles[] = $access['AccessLevel']['title'];
				}
				echo implode(', ', $roles);
			} else {
				echo '<em>'. __d('forum', 'N/A', true) .'</em>';
			} ?></li>
			<li style="display: none">Last login: <?php if (!empty($user['User'][$this->Cupcake->columnMap['lastLogin']])) {
				echo $this->Time->relativeTime($user['User'][$this->Cupcake->columnMap['lastLogin']], array('userOffset' => $this->Cupcake->timezone()));
			} else {
				echo '<em>'. __d('forum', 'Never', true) .'</em>';
			} ?></li>
			<li style="display: none">Moderates: <?php if (!empty($user['Moderator'])) { 
				$mods = array();
				foreach ($user['Moderator'] as $mod) {
					$mods[] = $this->Html->link($mod['ForumCategory']['title'], array('controller' => 'category', 'action' => 'view', $mod['ForumCategory']['id']));
				}
				echo implode(', ', $mods);
			} else {
				echo '<em>'. __d('forum', 'N/A', true) .'</em>';
			} ?></li>
		</ul>
	</div>
</div>
<div class="clear"></div>
<div class="moderate-area">
	<div class="left-container-with-sidebar">
	<?php
	
	//inspirations
	echo $this->element('profile'.DS.'inspirations',array('user_id'=>$user['User']['id']));

	//collections
	echo $this->element('profile'.DS.'collections',array('user_id'=>$user['User']['id']));
	
	//products
	echo $this->element('profile'.DS.'products',array('user_id'=>$user['User']['id']));
	?>
	</div>
	<div class="right-sidebar">
	<?php
	//sources
	echo $this->element('profile'.DS.'sources',array('user_id'=>$user['User']['id']));
	
	//ufos
	echo $this->element('profile'.DS.'ufos',array('user_id'=>$user['User']['id']));
	?>
	</div>
</div>
<div class="clear"></div>
<?php // Topics
if (!empty($topics)) { ?>
<div class="forumWrap">
    <h3><?php __d('forum', 'Latest Topics'); ?></h3>
    
    <table class="table" cellspacing="0">
    <tr>
        <th><?php __d('forum', 'Topic'); ?></th>
        <th><?php __d('forum', 'Created'); ?></th>
        <th><?php __d('forum', 'Posts'); ?></th>
        <th><?php __d('forum', 'Views'); ?></th>
        <th><?php __d('forum', 'Last Activity'); ?></th>
    </tr>
    
    <?php $counter = 0;
    foreach ($topics as $topic) {
        $lastTime = (isset($topic['LastPost']['created'])) ? $topic['LastPost']['created'] : $topic['Topic']['modified']; ?>
        
    <tr<?php if ($counter % 2) echo ' class="altRow"'; ?>>
        <td><?php echo $this->Html->link($topic['Topic']['title'], array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug'])); ?></td>
        <td class="ac"><?php echo $this->Time->niceShort($topic['Topic']['created'], $this->Cupcake->timezone()); ?></td>
        <td class="ac"><?php echo number_format($topic['Topic']['post_count']); ?></td>
        <td class="ac"><?php echo number_format($topic['Topic']['view_count']); ?></td>
        <td><?php echo $this->Time->relativeTime($lastTime, array('userOffset' => $this->Cupcake->timezone())); ?></td>
    </tr>
    <?php ++$counter; } ?>
    
    </table>
</div>    
<?php } ?>

<?php // Posts
if (!empty($posts)) { ?>
<div class="forumWrap">
    <h3><?php __d('forum', 'Latest Posts'); ?></h3>
    
    <table class="table" cellspacing="0">
    <tr>
        <th><?php __d('forum', 'Topic'); ?></th>
        <th><?php __d('forum', 'Author'); ?></th>
        <th><?php __d('forum', 'Posted On'); ?></th>
    </tr>
    
    <?php foreach($posts as $post) { ?>
    <tr class="altRow">
        <td><strong><?php echo $this->Html->link($post['Topic']['title'], array('controller' => 'topics', 'action' => 'view', $post['Topic']['slug'])); ?></strong></td>
        <td><?php echo $this->Html->link($post['Topic']['User']['username'], array('controller' => 'users', 'action' => 'profile', $post['Topic']['User']['id'])); ?></td>
        <td class="ar"><?php echo $this->Time->relativeTime($post['Post']['created'], array('userOffset' => $this->Cupcake->timezone())); ?></td>
    </tr>
    <tr>
        <td colspan="3"><?php echo $this->Decoda->parse($post['Post']['content']); ?></td>
    </tr>
    <?php } ?>
    
    </table>
</div>    
<?php } ?>

<?php } else { ?>

<h2><?php __d('forum', 'Not Found'); ?></h2>
<?php __d('forum', 'The user you are looking for does not exist.'); ?>

<?php } ?>