<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

//Clients
    Router::connect('/clients',array('controller'=> 'clients','action'=>'index'));
    Router::connect('/client/edit/:id',array('controller'=> 'clients','action'=>'edit'),array('pass' => array('id'),'id' => '[0-9]+'));
    Router::connect('/client/add',array('controller'=> 'clients','action'=>'add'));
    Router::connect('/client/:id/disable',array('controller'=> 'clients','action'=>'disable'),array('pass' => array('id'),'id' => '[0-9]+'));
    Router::connect('/client/:id/delete',array('controller'=> 'clients','action'=>'delete'),array('pass' => array('id'),'id' => '[0-9]+'));

//Cepages
    Router::connect('/cepages',array('controller'=> 'cepages','action'=>'index'));
    Router::connect('/cepage/edit/:id',array('controller'=> 'cepages','action'=>'edit'),array('pass' => array('id'),'id' => '[0-9]+'));
    Router::connect('/cepage/add',array('controller'=> 'cepages','action'=>'add'));
    Router::connect('/cepage/:id/delete',array('controller'=> 'cepages','action'=>'delete'),array('pass' => array('id'),'id' => '[0-9]+'));

//Origines
    Router::connect('/origines',array('controller'=> 'origines','action'=>'index'));
    Router::connect('/origine/edit/:id',array('controller'=> 'origines','action'=>'edit'),array('pass' => array('id'),'id' => '[0-9]+'));
    Router::connect('/origine/add',array('controller'=> 'origines','action'=>'add'));
    Router::connect('/origine/:id/delete',array('controller'=> 'origines','action'=>'delete'),array('pass' => array('id'),'id' => '[0-9]+'));

//Prix
    Router::connect('/prix',array('controller'=> 'prices','action'=>'index'));

/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));


//REST
Router::mapResources('vins');
Router::parseExtensions();

    Router::connect('/rest/vins',array('controller'=>'rest_vins','action'=>'index'));
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
