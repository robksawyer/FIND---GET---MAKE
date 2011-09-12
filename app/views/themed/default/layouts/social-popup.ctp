<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<style type="text/css">
	#social-service-login{
		background: #ffffff;
		text-align: center;
		font-weight: bold;
	}
	
	#social-service-login .lockup{
		position: relative;
		top: 100px;
		text-align: center;
		padding-bottom: 10px;
	}
</style>
<div id="social-service-login">
	<div class="lockup">
<?php 
	echo $this->Html->image('logo_128x128.jpg',array('alt'=>''));
	echo "<div class='loading'>Loading...</div>";
?>
	</div>
<?php
	echo $content_for_layout; 
?>
</div>