<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
 
	//Router::connect('/', array('controller' => 'homes', 'action' => 'index'));
	
	//Router::connect('/', array('admin' => true,'prefix' => 'admin', 'controller' => 'admins', 'action' => 'login'));
	Router::connect('/', array('controller' => 'homes', 'action' => 'index'));
	Router::connect('/admin', array('admin' => true,'prefix' => 'admin', 'controller' => 'admins', 'action' => 'login'));
	Router::connect('/admin/:controller', array('action' => 'index', 'prefix' => 'admin', 'admin' => true));
	Router::connect('/admin/:controller/:action/*', array('admin' => true,'prefix' => 'admin'));
	
	#Router::connect('/:slug', array('controller' => 'static_pages', 'action' => 'page','slug'=>'[a-zA-Z-_0-9]+'));
	Router::connect('/users/:action/*', array('controller' => 'users'));
	Router::connect('/streams', array('controller' => 'streams','action' => 'index'));
	Router::connect('/categories', array('controller' => 'categories','action' => 'index'));
	Router::connect('/channels/:action/*', array('controller' => 'channels'));
	Router::connect('/:slug', array('controller' => 'static_pages', 'action' => 'page','slug'=>'[a-zA-Z-_0-9]+'));
	
	
	/* App::uses('ServiceUrlRoute','Lib');
	Router::connect('/:handle', array('controller' => 'users', 'action' => 'profile'), array('routeClass' => 'ServiceUrlRoute')); */
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
/* 	Router::connect('/facebook/*', array('controller' => 'users', 'action' => 'find_friend'));
	Router::connect('/google/*', array('controller' => 'users', 'action' => 'invite_frinends_gplash'));
	Router::connect('/invite-friends-yellaspree/*', array('controller' => 'users', 'action' => 'invite_frinends_yella_spree')); */

/**
 * Load all plugin routes.  See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
