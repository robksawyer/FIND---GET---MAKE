<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	
	//Sitemap
	Router::connect('/sitemap', array('controller' => 'sitemaps', 'action' => 'index')); 
	Router::connect('/sitemap/:action/*', array('controller' => 'sitemaps')); 
	// Sitemap Optional 
	Router::connect('/robots/:action/*', array('controller' => 'sitemaps', 'action' => 'robot'));
	
	Router::connect('/forum', array('plugin' => 'forum', 'controller' => 'home', 'action' => 'index'));
	Router::connect('/admin/users/add', array('plugin' => 'forum', 'controller' => 'users', 'action' => 'signup'));
	Router::connect('/profiles/*', array('plugin' => 'forum', 'controller' => 'users', 'action' => 'profile'));
	Router::connect('/users/signup', array('plugin' => 'forum', 'controller' => 'users', 'action' => 'signup'));
	Router::connect('/following/*', array('plugin' => '', 'controller' => 'user_followings', 'action' => 'following'));
	Router::connect('/followers/*', array('plugin' => '', 'controller' => 'user_followings', 'action' => 'followers'));
	//Router::connect('/users/login',array('plugin'=>'forum','controller'=>'users','action'=>'login')); 
	
	Router::parseExtensions('rss','xml');