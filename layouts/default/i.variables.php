<?php

/**
 * Layout variables
 */

/*
 * Base
 */

// Doctype
$doctype = '<!DOCTYPE html>';

/*
 * Meta
 */

// `<meta>`
$charset = 'utf-8';
$meta = array(
  'author' => array('author', 'Sakara'),
  'description' => array('description', 'Personal site of Sakara.'),
  'keywords' => array('keywords', 'sakara, pazlab, pazwork, site, website'),
  'robots' => array('robots', 'noodp,noydir'),
  'viewport' => array('viewport', 'width=device-width, initial-scale=1')
);

// `<title>`
$site_title = 'Site';
$title_divider = '&middot;';
if ($page_title) {
  $title = "$page_title $title_divider $site_title";
}
else {
  $title = $site_title;
}

/*
 * Assets
 */

// `<link rel="stylesheet">`
$stylesheet = array(
  CSS . '/index.css'
);

// `<link rel="*icon*">`
$icon = array(
  'favicon' => array('icon', IMG . '/favicon.ico'),
  'apple_touch_icon' => array('apple-touch-icon', IMG .
                              '/apple-touch-icon.png')
);

// `<script>`
$script = array(
  JS . '/index.js'
);

/*
 * Copyright
 */

$cpsign = '&copy;';
$cpyear = date('Y');
$cpowner = $meta['author'][1];
$copyright = $cpsign $cpyear $cpowner;
