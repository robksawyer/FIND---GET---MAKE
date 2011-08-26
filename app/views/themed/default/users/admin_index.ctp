
<div class="forumHeader">
	<h2><?php __('Manage Users'); ?></h2>
</div>

<?php echo $this->Session->flash(); ?>

<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'index', 'admin' => true))); ?>
<table cellpadding="5" style="width: 100%">
<tr>
	<td class="ar">
    	<?php __('Search Users'); ?>
		<?php echo $this->Form->input('username', array('div' => false, 'label' => '('. __('Username', true) .'): ')); ?>
        <?php echo $this->Form->input('id', array('div' => false, 'label' => '('. __('ID', true) .'): ', 'type' => 'text')); ?>
    </td>
	<td style="width: 75px"><?php echo $this->Form->submit(__('Search', true), array('div' => false)); ?></td>
</tr>
</table>
<?php echo $this->Form->end(); ?>

<div class="forumWrap">
    <?php echo $this->element('pagination'); ?>
    
    <table class="table" cellspacing="0">
    <tr>
    	<th>#</th>
        <th><?php echo $paginator->sort(__('Username', true), 'User.username'); ?></th>
        <th><?php echo $paginator->sort(__('Email', true), 'User.email'); ?></th>
        <th><?php echo $paginator->sort(__('Joined', true), 'User.created'); ?></th>
        <th><?php echo $paginator->sort(__('Last Active', true), 'User.'. $this->Cupcake->columnMap['lastLogin']); ?></th>
        <th><?php echo $paginator->sort(__('Topics', true), 'User.'. $this->Cupcake->columnMap['totalTopics']); ?></th>
        <th><?php echo $paginator->sort(__('Posts', true), 'User.'. $this->Cupcake->columnMap['totalPosts']); ?></th>
        <th><?php __('Options'); ?></th>
    </tr>
    
    <?php // List
	if (!empty($users)) {
		$counter = 0;
		foreach ($users as $user) { ?>
        
    <tr<?php if ($counter % 2) echo ' class="altRow"'; ?>>
    	<td class="ac"><?php echo $user['User']['id']; ?></td>
        <td><?php echo $this->Html->link($user['User']['username'], array('action' => 'edit', $user['User']['id'], 'admin' => true)); ?></td>
        <td><?php echo $user['User']['email']; ?></td>
        <td class="ac"><?php echo $this->Time->nice($user['User']['created'], $this->Cupcake->timezone()); ?></td>
        <td class="ac">
            <?php if (!empty($user['User']['lastLogin'])) {
                echo $this->Time->relativeTime($user['User'][$this->Cupcake->columnMap['lastLogin']], array('userOffset' => $this->Cupcake->timezone()));
            } else {
                echo '<em>'. __('Never', true) .'</em>';
            } ?>
        </td>
        <td class="ac"><?php echo number_format($user['User']['totalTopics']); ?></td>
        <td class="ac"><?php echo number_format($user['User']['totalPosts']); ?></td>
        <td class="ac gray">
        	<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $user['User']['id'], 'admin' => true)); ?> -
        	<?php echo $this->Html->link(__('Reset Password', true), array('action' => 'reset', $user['User']['id'], 'admin' => true), array('confirm' => __('Are you sure you want to reset?', true))); ?> -
        	<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['User']['id'], 'admin' => true)); ?>
        </td>
    </tr>
    	<?php ++$counter; 
		}
	} else { ?>
    
    <tr>
    	<td colspan="5" class="empty"><?php __('There are no users signed up on this forum'); ?></td>
   	</tr>
    <?php } ?>
    
    </table>

	<?php echo $this->element('pagination'); ?>
</div>	