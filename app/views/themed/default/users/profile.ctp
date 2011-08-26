<?php
$this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<?php // User exists
if (!empty($user)) { ?>
<div class="header profile">
	<button type="button" onclick="goTo('<?php echo $this->Html->url(array('action' => 'report', $user['User']['id'])); ?>');" class="fr button"><?php __('Report User'); ?></button>
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
			<li class="about value"><?php echo $user['User']['about']; ?></li>
			<?php } ?>
			<li class="link">Website/Blog: <?php echo $this->Html->link($user['User']['url'],$user['User']['url'],array('target'=>'_blank')); ?></li>
			<li>Member since: <span class="value"><?php echo $this->Time->nice($user['User']['created'], $this->Cupcake->timezone()); ?></span></li>
		</ul>
	</div>
</div>
<div class="moderate-area">
	<div class="left-container-with-sidebar">
		<div class="header red"><?php 
				__('running bond: what '.$user['User']['username'].' is posting.');
		?></div>
		<?php
		echo $this->element('user-feed',array('cache'=>false,'user_id'=>$user['User']['id']));
		?>
	</div>
	<div class="right-sidebar">
		<ul class="stats">
			<div class="title"><?php echo $user['User']['username']."'s"; ?> totals</div>
			<li>
				<div class='total'>
					<?php echo $this->Html->link($user['User']['totalFollowers'],array('plugin'=>'','admin'=>false,'controller'=>'','action'=>'followers',$user['User']['username'])); ?>
					<span>followers</span>
				</div> 
				<div class='total'>
					<?php echo $this->Html->link($user['User']['totalUsersFollowing'],array('plugin'=>'','admin'=>false,'controller'=>'','action'=>'following',$user['User']['username'])); ?>
					<span>following</span>
				</div>
			</li>
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
			<div class="clear"></div>
		</ul>
	</div>
</div>
<div class="clear"></div>
<?php // Topics
if (!empty($topics)) { ?>
<div class="forumWrap">
    <h3><?php __('Latest Topics'); ?></h3>
    
    <table class="table" cellspacing="0">
    <tr>
        <th><?php __('Topic'); ?></th>
        <th><?php __('Created'); ?></th>
        <th><?php __('Posts'); ?></th>
        <th><?php __('Views'); ?></th>
        <th><?php __('Last Activity'); ?></th>
    </tr>
    
    <?php $counter = 0;
    foreach ($topics as $topic) {
        $lastTime = (isset($topic['LastPost']['created'])) ? $topic['LastPost']['created'] : $topic['Topic']['modified']; ?>
        
    <tr<?php if ($counter % 2) echo ' class="altRow"'; ?>>
        <td><?php echo $this->Html->link($topic['Topic']['title'], array('plugin'=>'forum','controller' => 'topics', 'action' => 'view', $topic['Topic']['slug'])); ?></td>
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
    <h3><?php __('Latest Posts'); ?></h3>
    
    <table class="table" cellspacing="0">
    <tr>
        <th><?php __('Topic'); ?></th>
        <th><?php __('Author'); ?></th>
        <th><?php __('Posted On'); ?></th>
    </tr>
    
    <?php foreach($posts as $post) { ?>
    <tr class="altRow">
        <td><strong><?php echo $this->Html->link($post['Topic']['title'], array('plugin'=>'forum','controller' => 'topics', 'action' => 'view', $post['Topic']['slug'])); ?></strong></td>
        <td><?php echo $this->Html->link($post['Topic']['User']['username'], array('plugin'=>'forum','controller' => 'users', 'action' => 'profile', $post['Topic']['User']['id'])); ?></td>
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

<h2><?php __('Not Found'); ?></h2>
<?php __('The user you are looking for does not exist.'); ?>

<?php } ?>
<?php
//If this is removed the like/dislike buttons will not work
echo $this->Js->writeBuffer();
?>