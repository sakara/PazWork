<?php
defined('_PAZLAB') or die;
/**
 * Layout helper
 *
 * Crystallized layout generator.
 */

defined('PATH') or exit('No direct script access allowed');

/*
 * Layout generator
 *
 * `$layout`      => layout name
 * $module => nome modulo es. news o pages (opzionale)
 * `$data`        => data file name
 * `$page_title`  => [optional] page title
 */

function layout($layout = 'default', $data = 'view', $module = 'home', $page_title = '') {
  foreach (glob(LAYOUTS . "/$layout/i.*.php") as $item) {
    require_once $item;
  }

  require_once LAYOUTS . "/$layout/header.php";
	require_once DATA . "/" . $module . "/$data.php";
  require_once LAYOUTS . "/$layout/footer.php";
}
