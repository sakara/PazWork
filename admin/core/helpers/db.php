<?php
defined('_PAZLAB') or die;
/**
 * db helper
 *
 *
 */

defined('PATH') or exit('No direct script access allowed');

static $connectionLink = null;

if(!function_exists('openConnection')){
function openConnection()
{
    // Nome server database
	$databaseHostName = DB_HOST;
    // Nome utente database
	$databaseUserName = DB_USER;
    // Password utente database
	$databasePassword = DB_PASS;

    $connection = mysql_connect($databaseHostName, $databaseUserName, $databasePassword);
    if (false == $connection){die("Si &egrave; verificato un errore durante la connessione al database. Ricontrolla i dati di accesso");}
    return $connection;
}
}

if(!function_exists('getConnection')){
function getConnection()
{
    global $connectionLink;

    if (true == is_null($connectionLink))
    {
        // nome database
		$databaseName = DB_NAME;

        $connection = openConnection();
        if (false == mysql_select_db($databaseName, $connection)){die("Si &egrave; verificato un errore durante la selezione del database. Ricontrolla il nome del database specificato");}
        $connectionLink = $connection;
    }
    return $connectionLink;
}
}

$cn = getConnection();