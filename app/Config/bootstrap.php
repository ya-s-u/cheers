<?php

/**
 * Configures default file logging options
 */
// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));


/**
 * Configures default file logging options
 */
CakePlugin::loadAll();


/**
 * Configures default file logging options
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));


/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));
