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
<?php
if (!$isAddMode || $isAddMode):
	echo $commentWidget->element('paginator');
	foreach (${$viewComments} as $viewComment):
		echo $commentWidget->element('item', array('comment' => $viewComment));
	endforeach;
endif;
echo "&mdash;<br/>";
if ($allowAddByAuth):
	if ($isAddMode && $allowAddByAuth): ?>
		<?php
		echo $commentWidget->element('form', array('comment' => (!empty($comment) ? $comment : 0)));
	else:
		if(empty($this->params[$adminRoute]) && $allowAddByAuth):
			echo $commentWidget->link(__d('comments', 'Add comment', true), am($url, array('comment' => 0)));
		endif;
	endif;
else: ?>

	<h4><?php __d('comments', 'Comments'); ?></h4>
	<?php
		echo "<p>".sprintf(__d('comments', 'If you want to post comments, you need to login first.', true), $html->link(__d('comments', 'login', true), array('controller' => 'users', 'action' => 'login', 'prefix' => $adminRoute, $adminRoute => false)))."</p>";
endif;
?>
</div>
<?php echo $this->Html->image('/comments/img/indicator.gif', array('id' => 'busy-indicator','style' => 'display:none;')); ?>
