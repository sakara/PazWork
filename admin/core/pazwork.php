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
define('PATH', ROOT . '/pazcms');

// DB
define ('DB_HOST', 'localhost');
define ('DB_NAME', 'pazcms');
define ('DB_USER', 'root');
define ('DB_PASS', '');

/*##################################*/

// Admin
define ('ADMIN', PATH . '/admin');
// Data
define('DATA', PATH . '/data');
// Uploads
define('UPLOAD', PATH . '/uploads');
// Layouts
define('LAYOUTS', PATH . '/layouts');

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
  	'config',
	'db',
	'functions'
);

foreach ($_helpers as $helper) {
  $helper = HELPERS . "/$helper.php";

  if (file_exists($helper)) {
    require_once $helper;
  }
}
