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
			echo "<div class='avatar'>".$avatar."</div>";
		}else{
			echo "<div class='avatar'>";
			echo $this->Html->image('no_gravatar.jpg')."<br/>";
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
		<br/>
		<?php if (!empty($user['User'][$this->Cupcake->columnMap['signature']])) { ?>
		<li class="signature"><?php $this->Decoda->parse($user['User'][$this->Cupcake->columnMap['signature']], false, array('b', 'i', 'u', 'img', 'url', 'align', 'color', 'size', 'code')); ?></li>
		<?php } ?>
		<?php
			$source_count = $this->requestAction('/sources/getCount/'.$user['User']['id']);
			$product_count = $this->requestAction('/products/getCount/'.$user['User']['id']);
		?>
		<ul class="totals">
			<li><span class='total'><i>Total sources added:</i> <?php echo $this->Html->link($source_count,array('plugin'=>'','admin'=>false,'controller'=>'sources','action'=>'users',$user['User']['id']));; ?></span> <span class='total'><i>Total products added:</i> <?php echo $this->Html->link($product_count,array('plugin'=>'','admin'=>false,'controller'=>'products','action'=>'users',$user['User']['id'])); ?></span></li>
		</ul>
		<li>Joined: <?php echo $this->Time->nice($user['User']['created'], $this->Cupcake->timezone()); ?></li>
		<li>Total topics: <?php echo number_format($user['User'][$this->Cupcake->columnMap['totalTopics']]); ?></li>
		<li>Total posts: <?php echo number_format($user['User'][$this->Cupcake->columnMap['totalPosts']]); ?></li>
		<li>Roles: <?php if (!empty($user['Access'])) { 
			$roles = array();
			foreach ($user['Access'] as $access) {
				$roles[] = $access['AccessLevel']['title'];
			}
			echo implode(', ', $roles);
		} else {
			echo '<em>'. __d('forum', 'N/A', true) .'</em>';
		} ?></li>
		<li>Last login: <?php if (!empty($user['User'][$this->Cupcake->columnMap['lastLogin']])) {
			echo $this->Time->relativeTime($user['User'][$this->Cupcake->columnMap['lastLogin']], array('userOffset' => $this->Cupcake->timezone()));
		} else {
			echo '<em>'. __d('forum', 'Never', true) .'</em>';
		} ?></li>
		<li>Moderates: <?php if (!empty($user['Moderator'])) { 
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
<div class="clear"></div>
<div class="moderate-area">
	<div class="left-container-with-sidebar">
	<?php
	$userProducts = $this->requestAction('/products/userProducts/'.$user['User']['id'].'/10');
	$userInspirations = $this->requestAction('/inspirations/userInspirations/'.$user['User']['id'].'/10');
	
	//inspirations
	echo $this->element('profile'.DS.'inspirations',array('inspirations'=>$userInspirations));

	//products
	echo $this->element('profile'.DS.'products',array('products'=>$userProducts));
	?>
	</div>
	<div class="right-sidebar">
	<?php
	//sources
	echo $this->element('profile'.DS.'sources',array('user_id'=>$user['User']['id']));
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