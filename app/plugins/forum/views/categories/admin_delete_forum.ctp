
<div class="forumHeader">
	<h2><?php __d('forum', 'Delete Forum'); ?></h2>
</div>

<?php if (!empty($forums)) { ?>

<p><?php printf(__d('forum', 'Before you delete the forum %s, please select which forum all child categories should be moved to upon deletion.', true), '<strong>'. $forum['Forum']['title'] .'</strong>'); ?></p>

<?php echo $this->Form->create('Forum', array('url' => array('controller' => 'categories', 'action' => 'delete_forum', $id, 'admin' => true)));
echo $this->Form->input('forum_id', array('option' => $forums, 'label' => __d('forum', 'Forum', true)));
echo $this->Form->end(__d('forum', 'Delete', true)); ?>

<?php } else { ?>

<p><?php __d('forum', 'You may not delete this forum, you must have at least one forum active.'); ?></p>

<?php } ?>