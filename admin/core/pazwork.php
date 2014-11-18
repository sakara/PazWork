<?php
defined('_PAZLAB') or die;
/**
 * PazWork is based on Hackwork v2.0.1 (http://git.io/hackwork) but improved and powered
 * Licensed under the MIT License.
 */

/*
 * Paths
 *
 * Omit trailing slashes here.
 */

// Root
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('PATH', ROOT . '/PazWork');

// DB
/*
 * Environment
 *
 * Values:
 *
 * - development
 * - production
 */

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

/*
 * Helpers
 */

$_helpers = array(
  	'http',
  	'errors',
  	'layout',
	//'db',
	'functions'
);

foreach ($_helpers as $helper) {
  $helper = HELPERS . "/$helper.php";

  if (file_exists($helper)) {
    require_once $helper;
  }
}

/*
 * Settings
 */

// Compression
ini_set('zlib.output_compression', 1);
ini_set('zlib.output_compression_level', -1);

// Default charset
ini_set('default_charset', 'utf-8');

// Default timezone
date_default_timezone_set('UTC');