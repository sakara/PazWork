<?php
defined('_PAZLAB') or die;
/**
 * PazWork is based on Hackwork v2.0.2 (http://git.io/hackwork) but improved and powered
 * Licensed under the MIT License.
 */

// Load required DEFINE
require_once ('config.php');

/*
 * Helpers
 * add yours here
 */

/*$_helpers = array(
  	'http',
  	'errors',
  	'layout',
	'db',
	'functions'
);

foreach ($_helpers as $helper) {
  $helper = HELPERS . "/$helper.php";

  if (file_exists($helper)) {
    require_once $helper;
  }
}*/

foreach (glob(HELPERS . '/*.php') as $helper) {
  require_once $helper;
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
date_default_timezone_set('Europe/Rome');
