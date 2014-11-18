<?php
defined('_PAZLAB') or die;

// ROOT
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
// SUBDIR
define('PATH', ROOT . '/PazWork');

// DB
// development or production
define('ENV', 'development');

// Define consistent error reporting settings
switch (ENV) {
	case 'development':
	error_reporting(-1);
	ini_set('display_errors', 1);
	define ('DB_HOST', 'localhost');
	define ('DB_NAME', 'pazcms');
	define ('DB_USER', 'root');
	define ('DB_PASS', '');
	break;

	case 'production':
	ini_set('display_errors', 0);
	define ('DB_HOST', 'localhost');
	define ('DB_NAME', 'pazcms');
	define ('DB_USER', 'root');
	define ('DB_PASS', '');
	break;

	default:
	throwerr(503, EXIT_CONFIG, 'Application environment is set incorrectly.');
}

/*##################################*/

// Admin
define ('ADMIN', PATH . '/admin');
// Data
define('DATA', PATH . '/data');
// Layouts
define('LAYOUTS', PATH . '/layouts');
// Uploads
define('UPLOAD', PATH . '/uploads');

// Core
define('CORE', ADMIN . '/core');
define('HELPERS', CORE . '/helpers');

// Assets
define('ASSETS', LAYOUTS . '/assets');
define('CSS', ASSETS . '/css');
define('JS', ASSETS . '/js');
define('FONTS', ASSETS . '/fonts');
define('IMG', ASSETS . '/img');