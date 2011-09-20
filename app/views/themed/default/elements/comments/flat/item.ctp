<?php
/**
 * Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$_actionLinks = array();
if (!empty($displayUrlToComment)) {
	$_actionLinks[] = sprintf('<a href="%s">%s</a>', $urlToComment . '/' . $comment['Comment']['slug'], __d('comments', 'View', true));
}

if (!empty($isAuthorized)) {
	$_actionLinks[] = $commentWidget->link(__d('comments', 'Reply', true), array_merge($url, array('comment' => $comment['Comment']['id'], '#' => 'comment' . $comment['Comment']['id'])));
	//$_actionLinks[] = $commentWidget->link(__d('comments', 'Quote', true), array_merge($url, array('comment' => $comment['Comment']['id'], 'quote' => 1, '#' => 'comment' . $comment['Comment']['id'])));
	if (!empty($isAdmin)) {
		if (empty($comment['Comment']['approved'])) {
			$_actionLinks[] = $commentWidget->link(__d('comments', 'Publish', true), array_merge($url, array('comment' => $comment['Comment']['id'], 'comment_action' => 'toggleApprove', '#' => 'comment' . $comment['id'])));
		} else {
			$_actionLinks[] = $commentWidget->link(__d('comments', 'Unpublish', true), array_merge($url, array('comment' => $comment['Comment']['id'], 'comment_action' => 'toggleApprove', '#' => 'comment' . $comment['Comment']['id'])));
		}
	}
}

$_userLink = $comment[$userModel]['username'];

?>
<div class="comment">
	<div class="header">
		<?php echo $this->element('avatar',array('cache'=>false,'user'=>$comment,'height'=>48)); ?>
		<!--<a name="comment<?php //echo $comment['Comment']['id'];?>"><?php //echo $comment['Comment']['title'];?></a> -->
		<span class="actions"><?php echo join('&nbsp;', $_actionLinks);?></span>
	</div>
	<div class="body"><?php echo $this->Cleaner->bbcode2js($comment['Comment']['body']);?></div>
	<div class="post-details">
		<span class="time-posted"><?php echo $this->Html->link($_userLink,array('controller'=>'users','action'=>'profile','ajax'=>false,'admin'=>false,'plugin'=>false,$_userLink)); ?>&nbsp;<?php echo $this->Time->timeAgoInWords($comment['Comment']['created']); ?></span>
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>

