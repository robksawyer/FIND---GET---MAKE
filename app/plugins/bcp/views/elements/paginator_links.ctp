<?php
/**
 * PHP version 5
 * 
 * (C) Copyright 2009, Valerij Bancer (http://bancer.sourceforge.net)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @author        Valerij Bancer
 * @link          http://www.bancer.net
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?><div class="paging">
	<?php
	echo $paginator->prev('<< '.__('previous', true), array('url' => array($url)), null, array('class'=>'disabled'));
	echo ' | ';
	echo $paginator->numbers();
	echo ' | ';
	echo $paginator->next(__('next', true).' >>', array('url' => array($url)), null, array('class'=>'disabled'));
	?>
</div>