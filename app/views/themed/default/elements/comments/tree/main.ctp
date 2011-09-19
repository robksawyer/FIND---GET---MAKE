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
?>
<div class="comments">
	<a name="comments"></a>
	<h3><?php __d('comments', 'Comments'); ?>:</h3>
	<?php
		if ($allowAddByAuth):
			if ($isAddMode && $allowAddByAuth): ?>
				<h4><?php __d('comments', 'Add New Comment'); ?></h4>
				<?php
				echo $commentWidget->element('form', array('comment' => (!empty($comment) ? $comment : 0)));
			else:
				if (empty($this->params[$adminRoute]) && $allowAddByAuth):
					echo $commentWidget->link(__d('comments', 'Add comment', true), am($url, array('comment' => 0)));
				endif;
			endif;
		else: ?>
			<?php
				echo sprintf(__d('comments', 'If you want to post comments, you need to login first.', true), $html->link(__d('comments', 'login', true), array('controller' => 'users', 'action' => 'login', 'prefix' => $adminRoute, $adminRoute => false)));
		endif;

		if (!$isAddMode || $isAddMode):
			echo $commentWidget->element('paginator');
			echo $tree->generate(${$viewComments}, array(
				'callback' => array(&$commentWidget, 'treeCallback'),
				'model' => 'Comment',
				'class' => 'tree-block'));
		endif;
	?>
</div>
<?php echo $this->Html->image('/comments/img/indicator.gif', array('id' => 'busy-indicator',
 'style' => 'display:none;')); ?>
