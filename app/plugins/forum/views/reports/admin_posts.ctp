
<div class="forumHeader">
	<h2><?php __d('forum', 'Reported Posts'); ?></h2>
</div>

<div class="forumOptions">
	<span><?php __d('forum', 'View Reported'); ?>:</span>
	<?php echo $this->Html->link(__d('forum', 'Topics', true), array('controller' => 'reports', 'action' => 'topics')); ?>
    <?php echo $this->Html->link(__d('forum', 'Posts', true), array('controller' => 'reports', 'action' => 'posts')); ?>
    <?php echo $this->Html->link(__d('forum', 'Users', true), array('controller' => 'reports', 'action' => 'users')); ?>
</div>

<?php echo $this->Form->create('Report', array('url' => array('controller' => 'reports', 'action' => 'posts', 'admin' => true))); ?>
<div class="forumWrap">
    <?php echo $this->element('pagination'); ?>
    
    <table class="table" cellspacing="0">
    <tr>
    	<th style="width: 25px">&nbsp;</th>
        <th><?php __d('forum', 'Post'); ?></th>
        <th><?php echo $paginator->sort(__d('forum', 'Reported By', true), 'Reporter.username'); ?></th>
        <th><?php __d('forum', 'Comment'); ?></th>
        <th><?php echo $paginator->sort(__d('forum', 'Reported On', true), 'Report.created'); ?></th>
    </tr>
    
    <?php // List
	if (!empty($reports)) {
		$counter = 0;
		foreach ($reports as $report) { ?>
        
    <tr<?php if ($counter % 2) echo ' class="altRow"'; ?>>
    	<td class="ac"><input type="checkbox" name="data[Report][items][]" value="<?php echo $report['Report']['id']; ?>:<?php echo $report['Post']['id']; ?>" /></td>
        <td><?php echo $report['Post']['content']; ?> (<?php echo $this->Html->link(__d('forum', 'View Topic', true), array('controller' => 'topics', 'action' => 'view', $report['Post']['topic_id'], 'admin' => false)); ?>)</td>
        <td><?php echo $this->Html->link($report['Reporter']['username'], array('controller' => 'users', 'action' => 'edit', $report['Reporter']['id'], 'admin' => true)); ?></td>
        <td><?php echo $report['Report']['comment']; ?></td>
        <td><?php echo $this->Time->nice($report['Report']['created'], $this->Cupcake->timezone()); ?></td>
    </tr>
    	<?php ++$counter; 
		}
	} else { ?>
    
    <tr>
    	<td colspan="5" class="empty"><?php __d('forum', 'There are no reported posts.'); ?></td>
   	</tr>
    <?php } ?>
    
    </table>

	<?php echo $this->element('pagination'); ?>
</div>	

<?php echo $this->Form->input('action', array('options' => array(
	'delete' => __d('forum', 'Delete Post(s)', true),
	'remove' => __d('forum', 'Remove Report Only', true)),
	'div' => false,
	'label' => __d('forum', 'Perform Action', true) .': '
)); ?>
<?php echo $this->Form->submit(__d('forum', 'Process', true), array('div' => false)); ?>
<?php echo $this->Form->end(); ?>